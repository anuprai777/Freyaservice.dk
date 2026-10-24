<?php

namespace App\Http\Controllers\Client;

use App\Enums\StaffRequestReason;
use App\Enums\StaffRequestStatus;
use App\Enums\StaffRequestType;
use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\StaffRequest;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StaffRequestController extends Controller
{
    public function create(Request $request): View
    {
        $client = $request->user()->clientProfile;
        $favouriteWorkers = $client->favouriteWorkers()->with('user')->get();
        $selectedType = $request->query('type', 'temporary_cover');

        return view('client.requests.create', compact('client', 'favouriteWorkers', 'selectedType'));
    }

    public function store(Request $request): RedirectResponse
    {
        $client = $request->user()->clientProfile;

        $validated = $request->validate([
            'request_type' => ['required', 'in:temporary_cover,part_time,full_time'],
            'role' => ['required', 'string', 'max:100'],
            'workers_needed' => ['required', 'integer', 'min:1', 'max:50'],
            'reason' => ['required', 'in:absence,peak,permanent_need'],
            'location' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'postcode' => ['required', 'string', 'max:20'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'start_time' => ['nullable', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i'],
            'hours_per_week' => ['nullable', 'numeric', 'min:1', 'max:70'],
            'recurring_days' => ['nullable', 'array'],
            'dress_code' => ['nullable', 'string', 'max:255'],
            'instructions' => ['nullable', 'string'],
            'preferred_worker_id' => ['nullable', 'exists:worker_profiles,id'],
            'is_urgent' => ['nullable', 'boolean'],
        ]);

        $staffRequest = StaffRequest::create([
            'client_id' => $client->id,
            'request_type' => $validated['request_type'],
            'role' => $validated['role'],
            'workers_needed' => $validated['workers_needed'],
            'reason' => $validated['reason'],
            'location' => $validated['location'],
            'city' => $validated['city'],
            'postcode' => $validated['postcode'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? null,
            'start_time' => $validated['start_time'] ?? null,
            'end_time' => $validated['end_time'] ?? null,
            'hours_per_week' => $validated['hours_per_week'] ?? null,
            'recurring_schedule' => $validated['recurring_days'] ?? null,
            'dress_code' => $validated['dress_code'] ?? null,
            'instructions' => $validated['instructions'] ?? null,
            'preferred_worker_id' => $validated['preferred_worker_id'] ?? null,
            'is_urgent' => $request->boolean('is_urgent'),
            'status' => StaffRequestStatus::NEW,
            'hourly_rate_offered' => 245.00,
        ]);

        // Auto-generate initial shift for any staff request (temporary cover, part-time, full-time)
        $startTime = $validated['start_time'] ?? '08:00';
        $endTime = $validated['end_time'] ?? '16:00';
        $startAt = Carbon::parse($validated['start_date'] . ' ' . $startTime);
        $endAt = Carbon::parse(($validated['end_date'] ?? $validated['start_date']) . ' ' . $endTime);

        if ($endAt->lessThan($startAt)) {
            $endAt->addDay(); // Overnight shift
        }

        $shift = Shift::create([
            'staff_request_id' => $staffRequest->id,
            'title' => $staffRequest->role . ' ' . __('dækning'),
            'start_at' => $startAt,
            'end_at' => $endAt,
            'workers_needed' => $staffRequest->workers_needed,
            'status' => 'open',
        ]);

        // If client selected a preferred worker, immediately dispatch an offer to that worker
        if (! empty($validated['preferred_worker_id'])) {
            \App\Models\Assignment::create([
                'staff_request_id' => $staffRequest->id,
                'shift_id' => $shift->id,
                'worker_id' => $validated['preferred_worker_id'],
                'status' => \App\Enums\AssignmentStatus::OFFERED,
                'offered_at' => now(),
                'worker_hourly_rate' => 195.00,
                'client_hourly_rate' => $staffRequest->hourly_rate_offered ?: 265.00,
                'notes' => __('Foretrukket vikar valgt af kunde ved oprettelse.'),
            ]);
        }

        return redirect()->route('client.dashboard')
            ->with('success', 'Din bemandingsforespørgsel er oprettet! FreyaService er gået i gang med at matche vikarer.');
    }

    public function show(StaffRequest $staffRequest, Request $request): View
    {
        $client = $request->user()->clientProfile;
        if ($staffRequest->client_id !== $client->id) {
            abort(403);
        }

        $staffRequest->load(['shifts.assignments.worker.user', 'preferredWorker.user']);
        $qrCodeService = app(\App\Services\QrCodeService::class);

        return view('client.requests.show', compact('staffRequest', 'qrCodeService'));
    }

    public function cancel(StaffRequest $staffRequest, Request $request): RedirectResponse
    {
        $client = $request->user()->clientProfile;
        if ($staffRequest->client_id !== $client->id) {
            abort(403);
        }

        $staffRequest->update(['status' => StaffRequestStatus::CANCELLED]);

        return back()->with('success', 'Forespørgslen er nu annulleret.');
    }
}
