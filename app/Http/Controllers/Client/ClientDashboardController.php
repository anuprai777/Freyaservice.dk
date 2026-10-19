<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\StaffRequest;
use App\Models\Timesheet;
use App\Services\QrCodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $client = $request->user()->clientProfile;

        if (! $client) {
            abort(404, 'Virksomhedsprofil ikke fundet.');
        }

        $status = $request->query('status', 'all');

        $requestsQuery = StaffRequest::with(['shifts.assignments.worker.user', 'preferredWorker.user'])
            ->where('client_id', $client->id)
            ->latest();

        if ($status !== 'all') {
            $requestsQuery->where('status', $status);
        }

        $requests = $requestsQuery->paginate(10);

        // Pending timesheets for approval
        $pendingTimesheets = Timesheet::with(['worker.user', 'assignment.staffRequest', 'shift'])
            ->whereHas('assignment.staffRequest', function ($q) use ($client) {
                $q->where('client_id', $client->id);
            })
            ->where('status', 'submitted')
            ->latest('clock_in')
            ->get();

        // Active shifts for QR codes
        $activeShifts = \App\Models\Shift::with(['staffRequest', 'assignments.worker.user'])
            ->whereHas('staffRequest', function ($q) use ($client) {
                $q->where('client_id', $client->id);
            })
            ->whereIn('status', ['open', 'filled', 'in_progress'])
            ->whereDate('start_at', '<=', now()->toDateString())
            ->whereDate('end_at', '>=', now()->toDateString())
            ->latest('start_at')
            ->get();

        // Counts for tabs
        $counts = [
            'all' => StaffRequest::where('client_id', $client->id)->count(),
            'new' => StaffRequest::where('client_id', $client->id)->where('status', 'new')->count(),
            'in_progress' => StaffRequest::where('client_id', $client->id)->where('status', 'in_progress')->count(),
            'matched' => StaffRequest::where('client_id', $client->id)->where('status', 'matched')->count(),
            'active' => StaffRequest::where('client_id', $client->id)->where('status', 'active')->count(),
            'completed' => StaffRequest::where('client_id', $client->id)->where('status', 'completed')->count(),
        ];

        return view('client.dashboard', compact('client', 'requests', 'pendingTimesheets', 'activeShifts', 'counts', 'status'));
    }

    /**
     * Polling endpoint for client dashboard (every 30 seconds).
     */
    public function poll(Request $request): JsonResponse
    {
        $client = $request->user()->clientProfile;

        if (! $client) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $counts = [
            'new' => StaffRequest::where('client_id', $client->id)->where('status', 'new')->count(),
            'matched' => StaffRequest::where('client_id', $client->id)->where('status', 'matched')->count(),
            'active' => StaffRequest::where('client_id', $client->id)->where('status', 'active')->count(),
            'pending_timesheets' => Timesheet::whereHas('assignment.staffRequest', function ($q) use ($client) {
                $q->where('client_id', $client->id);
            })->where('status', 'submitted')->count(),
        ];

        return response()->json([
            'success' => true,
            'timestamp' => now()->toIso8601String(),
            'counts' => $counts,
        ]);
    }
}
