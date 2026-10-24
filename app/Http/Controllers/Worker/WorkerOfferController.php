<?php

namespace App\Http\Controllers\Worker;

use App\Enums\AssignmentStatus;
use App\Enums\ShiftStatus;
use App\Enums\StaffRequestStatus;
use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Shift;
use App\Models\StaffRequest;
use App\Services\MatchingService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkerOfferController extends Controller
{
    public function index(Request $request, MatchingService $matchingService): View
    {
        $worker = $request->user()->workerProfile;

        // 1. Direct assignments offered to this worker
        $directOffers = Assignment::with(['staffRequest.client.user', 'shift'])
            ->where('worker_id', $worker->id)
            ->where('status', AssignmentStatus::OFFERED)
            ->latest('offered_at')
            ->get();

        // 2. Open matching requests and shifts across Denmark (prioritizing local worker region)
        $openRequests = StaffRequest::with(['client', 'shifts'])
            ->whereIn('status', [StaffRequestStatus::NEW, StaffRequestStatus::IN_PROGRESS])
            ->where(function ($q) {
                $q->whereDate('start_date', '>=', now()->toDateString())
                  ->orWhere(function ($sq) {
                      $sq->whereNotNull('end_date')
                         ->whereDate('end_date', '>=', now()->toDateString());
                  });
            })
            ->whereDoesntHave('assignments', function ($q) use ($worker) {
                $q->where('worker_id', $worker->id)
                  ->whereIn('status', [AssignmentStatus::ACCEPTED, AssignmentStatus::ACTIVE]);
            })
            ->withCount(['assignments as accepted_count' => function ($q) {
                $q->whereIn('status', [AssignmentStatus::ACCEPTED, AssignmentStatus::ACTIVE]);
            }])
            ->get()
            ->filter(function ($req) {
                return $req->accepted_count < $req->workers_needed;
            })
            ->sortByDesc(function ($req) use ($worker) {
                $isLocal = false;
                if (! empty($worker->city) && ! empty($req->city)) {
                    $isLocal = str_contains(mb_strtolower($req->city), mb_strtolower($worker->city))
                            || str_contains(mb_strtolower($worker->city), mb_strtolower($req->city));
                }
                return $isLocal ? 1000 : 1;
            })
            ->values();

        return view('worker.offers.index', compact('worker', 'directOffers', 'openRequests'));
    }

    public function accept(Assignment $assignment, Request $request): RedirectResponse
    {
        $worker = $request->user()->workerProfile;
        if ($assignment->worker_id !== $worker->id) {
            abort(403);
        }

        $assignment->update([
            'status' => AssignmentStatus::ACCEPTED,
            'responded_at' => now(),
        ]);

        if ($assignment->shift) {
            $shift = $assignment->shift;
            $acceptedCount = $shift->assignments()->where('status', 'accepted')->count();
            if ($acceptedCount >= $shift->workers_needed) {
                $shift->update(['status' => ShiftStatus::FILLED]);
            }
        }

        return redirect()->route('worker.dashboard')
            ->with('success', 'Du har accepteret vagten! Tjek ind på lokationen ved at scanne QR-koden ved vagtstart.');
    }

    public function decline(Assignment $assignment, Request $request): RedirectResponse
    {
        $worker = $request->user()->workerProfile;
        if ($assignment->worker_id !== $worker->id) {
            abort(403);
        }

        $assignment->update([
            'status' => AssignmentStatus::DECLINED,
            'responded_at' => now(),
        ]);

        return back()->with('info', 'Du har afvist vagttilbuddet.');
    }

    public function claim(StaffRequest $staffRequest, Request $request): RedirectResponse
    {
        $worker = $request->user()->workerProfile;

        if (! $worker) {
            abort(404, 'Vikarprofil ikke fundet.');
        }

        // Check if worker already has an assignment for this request
        $existing = Assignment::where('staff_request_id', $staffRequest->id)
            ->where('worker_id', $worker->id)
            ->first();

        if ($existing) {
            if (in_array($existing->status, [AssignmentStatus::ACCEPTED, AssignmentStatus::ACTIVE])) {
                return back()->with('info', __('Du har allerede accepteret denne vagt.'));
            }

            // If offered or declined, update to accepted
            $existing->update([
                'status' => AssignmentStatus::ACCEPTED,
                'responded_at' => now(),
            ]);

            if ($existing->shift) {
                $acceptedCount = $existing->shift->assignments()->where('status', 'accepted')->count();
                if ($acceptedCount >= $existing->shift->workers_needed) {
                    $existing->shift->update(['status' => ShiftStatus::FILLED]);
                }
            }

            return redirect()->route('worker.dashboard')
                ->with('success', __('Du har accepteret vagten for ') . ($staffRequest->client->company_name ?? __('kunden')) . '. ' . __('Tjek ind på lokationen ved vagtstart.'));
        }

        // Check if spots are still available
        $currentAccepted = Assignment::where('staff_request_id', $staffRequest->id)
            ->whereIn('status', ['accepted', 'active'])
            ->count();

        if ($currentAccepted >= $staffRequest->workers_needed) {
            return back()->with('warning', __('Beklager, denne vagt er netop blevet besat af andre vikarer.'));
        }

        // Find or create shift
        $shift = $staffRequest->shifts()->whereIn('status', [ShiftStatus::OPEN, ShiftStatus::DRAFT])->first();

        if (! $shift) {
            $startTime = $staffRequest->start_time ?? '08:00';
            $endTime = $staffRequest->end_time ?? '16:00';
            $startAt = Carbon::parse($staffRequest->start_date->format('Y-m-d') . ' ' . $startTime);
            $endAt = Carbon::parse(($staffRequest->end_date ? $staffRequest->end_date->format('Y-m-d') : $staffRequest->start_date->format('Y-m-d')) . ' ' . $endTime);

            if ($endAt->lessThan($startAt)) {
                $endAt->addDay();
            }

            $shift = Shift::create([
                'staff_request_id' => $staffRequest->id,
                'title' => $staffRequest->role . ' ' . __('dækning'),
                'start_at' => $startAt,
                'end_at' => $endAt,
                'workers_needed' => $staffRequest->workers_needed ?: 1,
                'status' => ShiftStatus::OPEN,
            ]);
        }

        $workerRate = $worker->hourly_rate > 0 ? $worker->hourly_rate : 195.00;
        $clientRate = $staffRequest->hourly_rate_offered ?: 265.00;

        Assignment::create([
            'staff_request_id' => $staffRequest->id,
            'shift_id' => $shift->id,
            'worker_id' => $worker->id,
            'status' => AssignmentStatus::ACCEPTED,
            'offered_at' => now(),
            'responded_at' => now(),
            'worker_hourly_rate' => $workerRate,
            'client_hourly_rate' => $clientRate,
            'notes' => __('Accepteret direkte af vikar via portalen.'),
        ]);

        // Check if shift is now filled
        $shiftAcceptedCount = $shift->assignments()->where('status', 'accepted')->count();
        if ($shiftAcceptedCount >= $shift->workers_needed) {
            $shift->update(['status' => ShiftStatus::FILLED]);
        }

        // Check if staff request is matched or in progress
        $totalAccepted = Assignment::where('staff_request_id', $staffRequest->id)
            ->whereIn('status', ['accepted', 'active'])
            ->count();

        if ($totalAccepted >= $staffRequest->workers_needed) {
            $staffRequest->update(['status' => StaffRequestStatus::MATCHED]);
        } else {
            $staffRequest->update(['status' => StaffRequestStatus::IN_PROGRESS]);
        }

        return redirect()->route('worker.dashboard')
            ->with('success', __('Du har accepteret vagten for ') . ($staffRequest->client->company_name ?? __('kunden')) . '! ' . __('Du kan se detaljer og tjekke ind under dine aktive vagter.'));
    }

    public function claimShift(Shift $shift, Request $request): RedirectResponse
    {
        return $this->claim($shift->staffRequest, $request);
    }
}
