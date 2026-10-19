<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkerProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = $request->user();
        $worker = $user->workerProfile;

        return view('worker.profile.edit', compact('user', 'worker'));
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();
        $worker = $user->workerProfile;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'city' => ['required', 'string', 'max:100'],
            'postcode' => ['required', 'string', 'max:20'],
            'availability_type' => ['required', 'in:temporary,part_time,full_time,any'],
            'skills' => ['nullable', 'array'],
            'hourly_rate' => ['nullable', 'numeric', 'min:120', 'max:800'],
            'bank_reg_number' => ['nullable', 'string', 'regex:/^[0-9]{4}$/'],
            'bank_account_number' => ['nullable', 'string', 'regex:/^[0-9]{6,10}$/'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $user->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
        ]);

        $workerUpdate = [
            'city' => $validated['city'],
            'postcode' => $validated['postcode'],
            'availability_type' => $validated['availability_type'],
            'skills' => $validated['skills'] ?? $worker->skills,
            'hourly_rate' => $validated['hourly_rate'] ?? $worker->hourly_rate,
            'notes' => $validated['notes'] ?? $worker->notes,
        ];

        // Only update encrypted bank details if filled
        if (! empty($validated['bank_reg_number'])) {
            $workerUpdate['bank_reg_number'] = $validated['bank_reg_number'];
        }
        if (! empty($validated['bank_account_number'])) {
            $workerUpdate['bank_account_number'] = $validated['bank_account_number'];
        }

        $worker->update($workerUpdate);

        return back()->with('success', 'Din profil og bankoplysninger er opdateret sikkert.');
    }
}
