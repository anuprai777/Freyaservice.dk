<x-guest-layout>
    <x-slot name="title">{{ __('Nulstil adgangskode') }}</x-slot>

    <!-- Header -->
    <div class="mb-5 text-center">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-bg border border-brand-border text-xs font-semibold text-brand-secondary mb-3">
            <span class="w-2 h-2 rounded-full bg-brand-action"></span>
            <span>{{ __('FreyaService Portal') }}</span>
        </div>
        <h2 class="text-2xl font-black text-brand-primary tracking-tight">{{ __('Opret ny adgangskode') }}</h2>
        <p class="text-xs text-brand-muted mt-1">{{ __('Indtast din e-mail og din nye ønskede adgangskode herunder') }}</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-mailadresse')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Ny adgangskode')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Bekræft ny adgangskode')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end pt-4 border-t border-brand-border">
            <x-primary-button class="w-full sm:w-auto py-2.5 px-6 text-xs">
                {{ __('Nulstil adgangskode') }} &rarr;
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
