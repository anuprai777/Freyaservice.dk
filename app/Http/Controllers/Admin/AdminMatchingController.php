<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AssignmentStatus;
use App\Enums\StaffRequestStatus;
use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Shift;
use App\Models\StaffRequest;
use App\Models\WorkerProfile;
use App\Services\AuditService;
use App\Services\MatchingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminMatchingController extends Controller
{
    public function show(StaffRequest $staffRequest, MatchingService $matchingService): View
    {
        $staffRequest->load(['client', 'shifts.assignments.worker.user', 'preferredWorker.user']);
        $candidates = $matchingService->findMatches($staffRequest, 15);

        // Get existing assigned or offered worker IDs
        $assignedWorkerIds = Assignment::where('staff_request_id', $staffRequest->id)
            ->whereIn('status', ['offered', 'accepted', 'active', 'completed'])
            ->pluck('worker_id')
            ->toArray();

        return view('admin.matching.show', compact('staffRequest', 'candidates', 'assignedWorkerIds'));
    }

    public function dispatchOffer(StaffRequest $staffRequest, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'worker_id' => ['required', 'exists:worker_profiles,id'],
            'shift_id' => ['nullable', 'exists:shifts,id'],
            'worker_hourly_rate' => ['nullable', 'numeric'],
            'client_hourly_rate' => ['nullable', 'numeric'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $worker = WorkerProfile::findOrFail($validated['worker_id']);

        // Check if already offered
        $existing = Assignment::where('staff_request_id', $staffRequest->id)
            ->where('worker_id', $worker->id)
            ->whereIn('status', ['offered', 'accepted', 'active'])
            ->first();

        if ($existing) {
            return back()->with('warning', 'Denne vikar har allerede modtaget et tilbud eller er aktiv på opgaven.');
        }

        $workerRate = $validated['worker_hourly_rate'] ?? ($worker->hourly_rate ?: 195.00);
        $clientRate = $validated['client_hourly_rate'] ?? ($staffRequest->hourly_rate_offered ?: 265.00);

        Assignment::create([
            'staff_request_id' => $staffRequest->id,
            'shift_id' => $validated['shift_id'] ?? null,
            'worker_id' => $worker->id,
            'status' => AssignmentStatus::OFFERED,
            'offered_at' => now(),
            'worker_hourly_rate' => $workerRate,
            'client_hourly_rate' => $clientRate,
            'notes' => $validated['notes'] ?? null,
        ]);

        if ($staffRequest->status === StaffRequestStatus::NEW) {
            $staffRequest->update(['status' => StaffRequestStatus::IN_PROGRESS]);
        }

        AuditService::log(
            'offer_dispatched_to_worker',
            StaffRequest::class,
            $staffRequest->id,
            null,
            ['worker_id' => $worker->id, 'worker_name' => $worker->user->name]
        );

        return back()->with('success', 'Vagttilbud er sendt til ' . $worker->user->name . '!');
    }
}
