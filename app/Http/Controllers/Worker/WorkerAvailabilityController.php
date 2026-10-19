<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkerAvailabilityController extends Controller
{
    public function index(Request $request): View
    {
        $worker = $request->user()->workerProfile;
        $availabilities = $worker->availabilities()->where('type', 'recurring')->get()->keyBy('day_of_week');

        $days = [
            1 => 'Mandag',
            2 => 'Tirsdag',
            3 => 'Onsdag',
            4 => 'Torsdag',
            5 => 'Fredag',
            6 => 'Lørdag',
            0 => 'Søndag',
        ];

        return view('worker.availability.index', compact('worker', 'availabilities', 'days'));
    }

    public function update(Request $request): RedirectResponse
    {
        $worker = $request->user()->workerProfile;

        $validated = $request->validate([
            'days' => ['required', 'array'],
            'days.*.is_available' => ['nullable', 'boolean'],
            'days.*.start_time' => ['required', 'date_format:H:i'],
            'days.*.end_time' => ['required', 'date_format:H:i'],
        ]);

        foreach ($validated['days'] as $dayOfWeek => $data) {
            Availability::updateOrCreate(
                [
                    'worker_profile_id' => $worker->id,
                    'day_of_week' => (int) $dayOfWeek,
                    'type' => 'recurring',
                ],
                [
                    'is_available' => ! empty($data['is_available']),
                    'start_time' => $data['start_time'],
                    'end_time' => $data['end_time'],
                ]
            );
        }

        return back()->with('success', 'Dine rådighedstider og ugeplan er opdateret!');
    }
}
