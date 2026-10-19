<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $role = $request->input('role', 'worker');
        if (!in_array($role, ['client', 'worker'], true)) {
            $role = 'worker';
        }

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:client,worker'],
            'phone' => ['required', 'string', 'max:30'],
            'gdpr_consent' => ['accepted'],
        ];

        if ($role === 'client') {
            $rules['company_name'] = ['required', 'string', 'max:255'];
            $rules['cvr'] = ['required', 'string', 'regex:/^[0-9]{8}$/'];
            $rules['address'] = ['required', 'string', 'max:255'];
            $rules['city'] = ['required', 'string', 'max:100'];
            $rules['postcode'] = ['required', 'string', 'max:20'];
            $rules['contact_person'] = ['nullable', 'string', 'max:255'];
        } else {
            $rules['city'] = ['required', 'string', 'max:100'];
            $rules['postcode'] = ['required', 'string', 'max:20'];
            $rules['availability_type'] = ['required', 'in:temporary,part_time,full_time,any'];
            $rules['skills'] = ['nullable', 'array'];
        }

        $validated = $request->validate($rules);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $role,
            'phone' => $validated['phone'],
            'locale' => 'da',
            'gdpr_consent_at' => now(),
            'is_active' => true,
        ]);

        if ($role === 'client') {
            \App\Models\ClientProfile::create([
                'user_id' => $user->id,
                'company_name' => $validated['company_name'],
                'cvr' => $validated['cvr'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'postcode' => $validated['postcode'],
                'contact_person' => $validated['contact_person'] ?? $validated['name'],
                'phone' => $validated['phone'],
                'status' => 'active',
            ]);
        } else {
            \App\Models\WorkerProfile::create([
                'user_id' => $user->id,
                'skills' => $validated['skills'] ?? ['General Vikar'],
                'city' => $validated['city'],
                'postcode' => $validated['postcode'],
                'availability_type' => $validated['availability_type'],
                'status' => 'pending',
                'hourly_rate' => 185.00,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        if ($user->isClient()) {
            return redirect(route('client.dashboard', absolute: false));
        }

        return redirect(route('worker.dashboard', absolute: false));
    }
}
