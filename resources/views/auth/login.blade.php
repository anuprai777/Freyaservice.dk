<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-brand-border text-brand-secondary shadow-sm focus:ring-brand-secondary" name="remember">
                <span class="ms-2 text-xs font-medium text-brand-muted">{{ __('Husk mig') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs font-semibold text-brand-muted hover:text-brand-secondary transition underline focus:outline-none focus:ring-2 focus:ring-brand-secondary" href="{{ route('password.request') }}">
                    {{ __('Glemt adgangskode?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full">
                {{ __('Log ind') }}
            </x-primary-button>
        </div>

        <div class="pt-4 text-center border-t border-brand-border">
            <p class="text-xs text-brand-muted">
                {{ __('Har du ikke en konto endnu?') }}
                <a href="{{ route('register') }}" class="font-bold text-brand-secondary hover:text-brand-action transition ms-1">
                    {{ __('Opret profil her') }} &rarr;
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
