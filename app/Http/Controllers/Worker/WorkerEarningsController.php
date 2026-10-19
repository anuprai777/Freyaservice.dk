<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\Timesheet;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkerEarningsController extends Controller
{
    public function index(Request $request): View
    {
        $worker = $request->user()->workerProfile;

        $timesheets = Timesheet::with(['shift.staffRequest.client'])
            ->where('worker_id', $worker->id)
            ->whereNotNull('clock_out')
            ->latest('clock_in')
            ->paginate(15);

        // Earnings metrics
        $thisWeekEarnings = Timesheet::where('worker_id', $worker->id)
            ->whereBetween('clock_in', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('worker_total_pay');

        $thisMonthEarnings = Timesheet::where('worker_id', $worker->id)
            ->whereMonth('clock_in', now()->month)
            ->whereYear('clock_in', now()->year)
            ->sum('worker_total_pay');

        $totalEarningsAllTime = Timesheet::where('worker_id', $worker->id)
            ->where('status', 'approved')
            ->sum('worker_total_pay');

        $pendingApprovalAmount = Timesheet::where('worker_id', $worker->id)
            ->where('status', 'submitted')
            ->sum('worker_total_pay');

        return view('worker.earnings.index', compact(
            'worker',
            'timesheets',
            'thisWeekEarnings',
            'thisMonthEarnings',
            'totalEarningsAllTime',
            'pendingApprovalAmount'
        ));
    }
}
