<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\ClientProfile;
use App\Models\Shift;
use App\Models\StaffRequest;
use App\Models\Timesheet;
use App\Models\WorkerDocument;
use App\Models\WorkerProfile;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $newRequestsCount = StaffRequest::where('status', 'new')->count();
        $inProgressRequestsCount = StaffRequest::where('status', 'in_progress')->count();
        $activeShiftsCount = Shift::whereIn('status', ['filled', 'in_progress'])->count();
        $pendingWorkersCount = WorkerProfile::where('status', 'pending')->count();
        $pendingDocumentsCount = WorkerDocument::where('status', 'pending')->count();
        $unapprovedTimesheetsCount = Timesheet::where('status', 'submitted')->count();

        // Recent requests requiring attention
        $recentRequests = StaffRequest::with(['client.user', 'preferredWorker.user'])
            ->latest()
            ->take(6)
            ->get();

        // Expiring worker documents (within 30 days)
        $expiringDocuments = WorkerDocument::with(['workerProfile.user'])
            ->where('status', 'approved')
            ->whereNotNull('expiry_date')
            ->whereBetween('expiry_date', [now()->toDateString(), now()->addDays(30)->toDateString()])
            ->orderBy('expiry_date')
            ->take(5)
            ->get();

        // Recent audit logs
        $recentAuditLogs = AuditLog::with('user')->latest('created_at')->take(8)->get();

        return view('admin.dashboard', compact(
            'newRequestsCount',
            'inProgressRequestsCount',
            'activeShiftsCount',
            'pendingWorkersCount',
            'pendingDocumentsCount',
            'unapprovedTimesheetsCount',
            'recentRequests',
            'expiringDocuments',
            'recentAuditLogs'
        ));
    }
}
