<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        $defaultRoute = match ($user->role) {
            'admin' => route('admin.dashboard'),
            'client' => route('client.dashboard'),
            'worker' => route('worker.dashboard'),
            default => route('dashboard'),
        };

        // If a previously stored intended URL was from a different portal role, clear it
        $intendedUrl = session()->get('url.intended');
        if ($intendedUrl) {
            $isInvalidIntended = match ($user->role) {
                'admin' => str_contains($intendedUrl, '/client') || str_contains($intendedUrl, '/worker'),
                'client' => str_contains($intendedUrl, '/admin') || str_contains($intendedUrl, '/worker'),
                'worker' => str_contains($intendedUrl, '/admin') || str_contains($intendedUrl, '/client'),
                default => false,
            };

            if ($isInvalidIntended) {
                session()->forget('url.intended');
            }
        }

        return redirect()->intended($defaultRoute);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
