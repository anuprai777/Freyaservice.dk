<x-guest-layout>
    <x-slot name="title">{{ __('Glemt adgangskode') }}</x-slot>

    <!-- Header -->
    <div class="mb-5 text-center">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sand border border-mist text-xs font-semibold text-navy mb-3">
            <span class="w-2 h-2 rounded-full bg-burgundy"></span>
            <span>{{ __('FreyaService Portal') }}</span>
        </div>
        <h2 class="text-2xl font-black text-navy tracking-tight">{{ __('Glemt din adgangskode?') }}</h2>
        <p class="text-xs text-ink/70 mt-1 leading-relaxed">
            {{ __('Indtast din registrerede e-mailadresse, så sender vi dig et link til at nulstille din adgangskode.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-mailadresse')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="navn@virksomhed.dk" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-2">
            <a href="{{ route('login') }}" class="text-xs text-ink/70 hover:text-burgundy underline transition">
                &larr; {{ __('Tilbage til login') }}
            </a>

            <x-primary-button class="w-full sm:w-auto py-2.5 px-5 text-xs">
                {{ __('Send nulstillingslink') }} &rarr;
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
