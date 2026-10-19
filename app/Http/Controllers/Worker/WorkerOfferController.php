<?php

namespace App\Http\Controllers\Worker;

use App\Enums\AssignmentStatus;
use App\Enums\ShiftStatus;
use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\StaffRequest;
use App\Services\MatchingService;
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

        // 2. Open matching requests in their city or region
        $openRequests = StaffRequest::with(['client', 'shifts'])
            ->whereIn('status', ['new', 'in_progress'])
            ->whereDate('start_date', '>=', now()->toDateString())
            ->where(function ($q) use ($worker) {
                $q->where('city', $worker->city)
                  ->orWhere('postcode', $worker->postcode)
                  ->orWhereNull('city');
            })
            ->latest('start_date')
            ->take(10)
            ->get();

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
}
