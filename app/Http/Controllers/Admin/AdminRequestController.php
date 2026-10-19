<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StaffRequestStatus;
use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\StaffRequest;
use App\Services\AuditService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminRequestController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status');
        $type = $request->query('type');
        $search = $request->query('search');

        $query = StaffRequest::with(['client', 'shifts.assignments.worker.user'])->latest();

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }
        if ($type && $type !== 'all') {
            $query->where('request_type', $type);
        }
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('role', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhereHas('client', function ($cq) use ($search) {
                      $cq->where('company_name', 'like', "%{$search}%");
                  });
            });
        }

        $requests = $query->paginate(15)->withQueryString();

        return view('admin.requests.index', compact('requests', 'status', 'type', 'search'));
    }

    public function show(StaffRequest $staffRequest): View
    {
        $staffRequest->load(['client.user', 'shifts.assignments.worker.user', 'preferredWorker.user']);
        $qrCodeService = app(\App\Services\QrCodeService::class);

        return view('admin.requests.show', compact('staffRequest', 'qrCodeService'));
    }

    public function updateStatus(StaffRequest $staffRequest, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,in_progress,matched,active,completed,cancelled'],
        ]);

        $oldStatus = $staffRequest->status->value;
        $staffRequest->update(['status' => $validated['status']]);

        AuditService::log(
            'staff_request_status_updated',
            StaffRequest::class,
            $staffRequest->id,
            ['status' => $oldStatus],
            ['status' => $validated['status']]
        );

        return back()->with('success', 'Forespørgslens status er opdateret til ' . $staffRequest->status->label());
    }

    public function addShift(StaffRequest $staffRequest, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:100'],
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date', 'after:start_at'],
            'workers_needed' => ['required', 'integer', 'min:1', 'max:50'],
        ]);

        Shift::create([
            'staff_request_id' => $staffRequest->id,
            'title' => $validated['title'] ?? ($staffRequest->role . ' vagt'),
            'start_at' => Carbon::parse($validated['start_at']),
            'end_at' => Carbon::parse($validated['end_at']),
            'workers_needed' => $validated['workers_needed'],
            'status' => 'open',
        ]);

        AuditService::log('shift_created', StaffRequest::class, $staffRequest->id);

        return back()->with('success', 'Ny vagt er oprettet og klar til matchning.');
    }
}
