<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\WorkerProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $client = $request->user()->clientProfile;

        $validated = $request->validate([
            'worker_id' => ['required', 'exists:worker_profiles,id'],
            'staff_request_id' => ['nullable', 'exists:staff_requests,id'],
            'shift_id' => ['nullable', 'exists:shifts,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'punctuality_score' => ['nullable', 'integer', 'min:1', 'max:5'],
            'quality_score' => ['nullable', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:500'],
        ]);

        Rating::create([
            'client_id' => $client->id,
            'worker_id' => $validated['worker_id'],
            'staff_request_id' => $validated['staff_request_id'] ?? null,
            'shift_id' => $validated['shift_id'] ?? null,
            'rating' => $validated['rating'],
            'punctuality_score' => $validated['punctuality_score'] ?? null,
            'quality_score' => $validated['quality_score'] ?? null,
            'comment' => $validated['comment'] ?? null,
        ]);

        // Recompute worker rating average
        $worker = WorkerProfile::find($validated['worker_id']);
        if ($worker) {
            $avg = $worker->ratings()->avg('rating') ?: 0;
            $count = $worker->ratings()->count();
            $worker->update([
                'rating_avg' => round($avg, 2),
                'ratings_count' => $count,
            ]);
        }

        return back()->with('success', 'Tak for din bedømmelse af vikaren!');
    }

    public function toggleFavourite(WorkerProfile $worker, Request $request): RedirectResponse
    {
        $client = $request->user()->clientProfile;

        if ($client->favouriteWorkers()->where('worker_profiles.id', $worker->id)->exists()) {
            $client->favouriteWorkers()->detach($worker->id);
            $msg = 'Vikaren er fjernet fra dine favoritter.';
        } else {
            $client->favouriteWorkers()->attach($worker->id, [
                'notes' => $request->input('notes', 'Foretrukken vikar til fremtidige opgaver'),
            ]);
            $msg = 'Vikaren er tilføjet som foretrukken favorit!';
        }

        return back()->with('success', $msg);
    }
}
