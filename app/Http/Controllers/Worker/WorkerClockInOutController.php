<?php

namespace App\Http\Controllers\Worker;

use App\Enums\AssignmentStatus;
use App\Enums\TimesheetStatus;
use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Shift;
use App\Models\Timesheet;
use App\Services\QrCodeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkerClockInOutController extends Controller
{
    public function scan(Request $request, QrCodeService $qrCodeService): View|RedirectResponse
    {
        $worker = $request->user()->workerProfile;
        $shiftId = $request->query('shift');
        $token = $request->query('token');

        if ($shiftId && $token) {
            $shift = Shift::find($shiftId);
            if ($shift && $qrCodeService->validateScan($shift, $token, $worker)) {
                return view('worker.shifts.clock-in-confirm', compact('shift', 'token', 'worker'));
            } else {
                return redirect()->route('worker.dashboard')
                    ->with('error', 'Ugyldig eller udløbet QR-kode, eller du er ikke tildelt denne vagt.');
            }
        }

        return view('worker.shifts.scan', compact('worker'));
    }

    public function clockIn(Request $request, QrCodeService $qrCodeService): RedirectResponse
    {
        $worker = $request->user()->workerProfile;

        $validated = $request->validate([
            'shift_id' => ['required', 'exists:shifts,id'],
            'token' => ['required', 'string'],
        ]);

        $shift = Shift::findOrFail($validated['shift_id']);

        if (! $qrCodeService->validateScan($shift, $validated['token'], $worker)) {
            return back()->with('error', 'Sikkerhedsvalidering fejlede. Scan venligst QR-koden igen hos kunden.');
        }

        // Find assignment
        $assignment = Assignment::where('worker_id', $worker->id)
            ->where(function ($q) use ($shift) {
                $q->where('shift_id', $shift->id)
                  ->orWhere('staff_request_id', $shift->staff_request_id);
            })
            ->first();

        if (! $assignment) {
            return back()->with('error', 'Ingen aktiv tildeling fundet.');
        }

        // Check if already active
        $activeTimesheet = Timesheet::where('worker_id', $worker->id)
            ->whereNotNull('clock_in')
            ->whereNull('clock_out')
            ->first();

        if ($activeTimesheet) {
            return redirect()->route('worker.dashboard')
                ->with('warning', 'Du er allerede stemplet ind på en aktiv vagt.');
        }

        // Create new timesheet
        $workerRate = $assignment->worker_hourly_rate > 0 ? $assignment->worker_hourly_rate : ($worker->hourly_rate ?: 195.00);
        $clientRate = $assignment->client_hourly_rate > 0 ? $assignment->client_hourly_rate : ($shift->staffRequest->hourly_rate_offered ?: 265.00);

        Timesheet::create([
            'assignment_id' => $assignment->id,
            'worker_id' => $worker->id,
            'shift_id' => $shift->id,
            'clock_in' => now(),
            'hourly_rate' => $workerRate,
            'client_hourly_rate' => $clientRate,
            'status' => TimesheetStatus::SUBMITTED,
        ]);

        $assignment->update(['status' => AssignmentStatus::ACTIVE]);
        $shift->update(['status' => 'in_progress']);

        return redirect()->route('worker.dashboard')
            ->with('success', 'Du er nu stemplet ind! God arbejdslyst.');
    }

    public function clockOut(Timesheet $timesheet, Request $request): RedirectResponse
    {
        $worker = $request->user()->workerProfile;
        if ($timesheet->worker_id !== $worker->id) {
            abort(403);
        }

        $validated = $request->validate([
            'break_minutes' => ['required', 'integer', 'min:0', 'max:240'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $timesheet->clock_out = now();
        $timesheet->break_minutes = $validated['break_minutes'];
        $timesheet->notes = $validated['notes'] ?? null;
        $timesheet->status = TimesheetStatus::SUBMITTED;
        $timesheet->calculateTotals();
        $timesheet->save();

        if ($timesheet->assignment) {
            $timesheet->assignment->update(['status' => AssignmentStatus::COMPLETED]);
        }

        return redirect()->route('worker.dashboard')
            ->with('success', sprintf(
                'Du er stemplet ud! Registreret: %s timer. Din timeseddel er sendt til kundens godkendelse.',
                number_format($timesheet->hours, 2, ',', '.')
            ));
    }
}
