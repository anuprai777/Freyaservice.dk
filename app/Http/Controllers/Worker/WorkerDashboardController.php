<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Shift;
use App\Models\Timesheet;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkerDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $worker = $request->user()->workerProfile;

        if (! $worker) {
            abort(404, 'Vikarprofil ikke fundet.');
        }

        // Pending shift offers waiting for worker acceptance
        $pendingOffers = Assignment::with(['staffRequest.client', 'shift'])
            ->where('worker_id', $worker->id)
            ->where('status', 'offered')
            ->latest('offered_at')
            ->get();

        // Active assignments
        $activeAssignments = Assignment::with(['staffRequest.client', 'shift'])
            ->where('worker_id', $worker->id)
            ->whereIn('status', ['accepted', 'active'])
            ->latest()
            ->get();

        // Today's active or upcoming shifts
        $todayShifts = Shift::with(['staffRequest.client', 'assignments'])
            ->whereHas('assignments', function ($q) use ($worker) {
                $q->where('worker_id', $worker->id)
                  ->whereIn('status', ['accepted', 'active']);
            })
            ->whereDate('start_at', '<=', now()->toDateString())
            ->whereDate('end_at', '>=', now()->toDateString())
            ->get();

        // Currently clocked in timesheet (if any)
        $currentTimesheet = Timesheet::with(['shift.staffRequest.client'])
            ->where('worker_id', $worker->id)
            ->whereNotNull('clock_in')
            ->whereNull('clock_out')
            ->first();

        // Earnings metrics
        $thisMonthEarnings = Timesheet::where('worker_id', $worker->id)
            ->whereIn('status', ['approved', 'submitted'])
            ->whereMonth('clock_in', now()->month)
            ->whereYear('clock_in', now()->year)
            ->sum('worker_total_pay');

        $totalCompletedHours = Timesheet::where('worker_id', $worker->id)
            ->where('status', 'approved')
            ->sum('hours');

        return view('worker.dashboard', compact(
            'worker',
            'pendingOffers',
            'activeAssignments',
            'todayShifts',
            'currentTimesheet',
            'thisMonthEarnings',
            'totalCompletedHours'
        ));
    }
}
