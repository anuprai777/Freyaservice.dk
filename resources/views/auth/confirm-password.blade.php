<x-guest-layout>
    <x-slot name="title">{{ __('Bekræft adgangskode') }}</x-slot>

    <!-- Header -->
    <div class="mb-5 text-center">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-bg border border-brand-border text-xs font-semibold text-brand-secondary mb-3">
            <span class="w-2 h-2 rounded-full bg-brand-action"></span>
            <span>{{ __('FreyaService Portal') }}</span>
        </div>
        <h2 class="text-2xl font-black text-brand-primary tracking-tight">{{ __('Sikkerhedsbekræftelse') }}</h2>
    </div>

    <div class="mb-4 text-xs sm:text-sm text-brand-muted leading-relaxed">
        {{ __('Dette er et beskyttet område af systemet. Bekræft venligst din adgangskode for at fortsætte.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Adgangskode')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end pt-4 border-t border-brand-border">
            <x-primary-button class="w-full sm:w-auto py-2.5 px-6 text-xs">
                {{ __('Bekræft') }} &rarr;
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
