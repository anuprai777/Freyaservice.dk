<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $email = $this->string('email')->trim()->toString();
        $password = $this->string('password')->toString();
        $remember = $this->boolean('remember');

        // Look up all active user accounts registered under this email
        $candidates = \App\Models\User::where('email', $email)
            ->where(function ($q) {
                $q->whereNull('is_active')->orWhere('is_active', true);
            })
            ->get();

        $matchedUser = null;

        foreach ($candidates as $candidate) {
            // Direct bcrypt hash verification against each account's single password
            if (\Illuminate\Support\Facades\Hash::check($password, $candidate->password)) {
                $matchedUser = $candidate;
                break;
            }
        }

        // Fallback for single-account standard authentication
        if (! $matchedUser && $candidates->isEmpty()) {
            if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
                RateLimiter::clear($this->throttleKey());
                RateLimiter::clear($this->ipThrottleKey());
                return;
            }
        }

        if (! $matchedUser) {
            RateLimiter::hit($this->throttleKey(), 60);
            RateLimiter::hit($this->ipThrottleKey(), 60);

            \Illuminate\Support\Facades\Log::warning('Failed login attempt for credentials', [
                'email' => $email,
                'ip' => $this->ip(),
                'user_agent' => $this->userAgent(),
            ]);

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        Auth::login($matchedUser, $remember);

        RateLimiter::clear($this->throttleKey());
        RateLimiter::clear($this->ipThrottleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        // 1. IP-wide brute-force rate limit (max 10 attempts per minute across all accounts)
        if (RateLimiter::tooManyAttempts($this->ipThrottleKey(), 10)) {
            $seconds = RateLimiter::availableIn($this->ipThrottleKey());

            \Illuminate\Support\Facades\Log::warning('IP login rate limit exceeded', [
                'ip' => $this->ip(),
                'seconds' => $seconds,
            ]);

            throw ValidationException::withMessages([
                'email' => trans('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]),
            ]);
        }

        // 2. Account-specific rate limit (max 5 attempts per account/email per minute)
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        \Illuminate\Support\Facades\Log::warning('Account login rate limit exceeded', [
            'email' => $this->string('email'),
            'ip' => $this->ip(),
            'seconds' => $seconds,
        ]);

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the specific user/email.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }

    /**
     * Get the rate limiting throttle key for the client IP address.
     */
    public function ipThrottleKey(): string
    {
        return 'login_ip:'.$this->ip();
    }
}
