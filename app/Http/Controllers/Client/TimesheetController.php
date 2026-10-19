<?php

namespace App\Http\Controllers\Client;

use App\Enums\TimesheetStatus;
use App\Http\Controllers\Controller;
use App\Models\Timesheet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function approve(Timesheet $timesheet, Request $request): RedirectResponse
    {
        $client = $request->user()->clientProfile;

        // Ensure this timesheet belongs to a request from this client
        if ($timesheet->assignment->staffRequest->client_id !== $client->id) {
            abort(403);
        }

        $timesheet->update([
            'status' => TimesheetStatus::APPROVED,
            'client_approved_at' => now(),
            'client_approved_by' => $request->user()->id,
            'rejection_reason' => null,
        ]);

        return back()->with('success', 'Timeseddel godkendt! Vikarens timer er registreret.');
    }

    public function reject(Timesheet $timesheet, Request $request): RedirectResponse
    {
        $client = $request->user()->clientProfile;

        if ($timesheet->assignment->staffRequest->client_id !== $client->id) {
            abort(403);
        }

        $validated = $request->validate([
            'rejection_reason' => ['required', 'string', 'min:5', 'max:500'],
        ]);

        $timesheet->update([
            'status' => TimesheetStatus::REJECTED,
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        return back()->with('warning', 'Timeseddel afvist. Vikaren og FreyaService er adviseret.');
    }
}
