<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TimesheetStatus;
use App\Http\Controllers\Controller;
use App\Models\Timesheet;
use App\Services\AuditService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminTimesheetController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status');

        $query = Timesheet::with(['worker.user', 'shift.staffRequest.client', 'approvedByUser'])
            ->latest('clock_in');

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        $timesheets = $query->paginate(20)->withQueryString();

        return view('admin.timesheets.index', compact('timesheets', 'status'));
    }

    public function approve(Timesheet $timesheet, Request $request): RedirectResponse
    {
        $timesheet->update([
            'status' => TimesheetStatus::APPROVED,
            'client_approved_at' => now(),
            'client_approved_by' => $request->user()->id,
            'rejection_reason' => null,
        ]);

        AuditService::log('admin_timesheet_approved', Timesheet::class, $timesheet->id);

        return back()->with('success', 'Timeseddel godkendt af administrationen.');
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $fileName = 'freya_timesheets_' . date('Y-m-d_His') . '.csv';

        $timesheets = Timesheet::with(['worker.user', 'shift.staffRequest.client'])
            ->latest('clock_in')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () use ($timesheets) {
            $handle = fopen('php://output', 'w');
            // Add UTF-8 BOM for Excel compatibility
            fputs($handle, "\xEF\xBB\xBF");

            // Header row
            fputcsv($handle, [
                'ID',
                'Kunde (Virksomhed)',
                'CVR',
                'Vikar Navn',
                'Dato',
                'Tjek ind',
                'Tjek ud',
                'Pause (min)',
                'Timer',
                'Vikar Timeløn (DKK)',
                'Vikar Løn Total',
                'Kunde Timepris (DKK)',
                'Kunde Faktura Total',
                'Status',
                'Godkendt Dato',
            ], ';');

            foreach ($timesheets as $ts) {
                fputcsv($handle, [
                    $ts->id,
                    $ts->shift->staffRequest->client->company_name ?? 'N/A',
                    $ts->shift->staffRequest->client->cvr ?? 'N/A',
                    $ts->worker->user->name ?? 'N/A',
                    $ts->clock_in ? $ts->clock_in->format('Y-m-d') : '',
                    $ts->clock_in ? $ts->clock_in->format('H:i') : '',
                    $ts->clock_out ? $ts->clock_out->format('H:i') : '',
                    $ts->break_minutes,
                    number_format((float)$ts->hours, 2, ',', '.'),
                    number_format((float)$ts->hourly_rate, 2, ',', '.'),
                    number_format((float)$ts->worker_total_pay, 2, ',', '.'),
                    number_format((float)$ts->client_hourly_rate, 2, ',', '.'),
                    number_format((float)$ts->client_total_charge, 2, ',', '.'),
                    $ts->status->label(),
                    $ts->client_approved_at ? $ts->client_approved_at->format('Y-m-d H:i') : '',
                ], ';');
            }

            fclose($handle);
        }, 200, $headers);
    }
}
