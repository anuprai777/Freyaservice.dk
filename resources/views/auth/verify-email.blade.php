<x-guest-layout>
    <x-slot name="title">{{ __('Bekræft e-mail') }}</x-slot>

    <!-- Header -->
    <div class="mb-5 text-center">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-bg border border-brand-border text-xs font-semibold text-brand-secondary mb-3">
            <span class="w-2 h-2 rounded-full bg-brand-action"></span>
            <span>{{ __('FreyaService Portal') }}</span>
        </div>
        <h2 class="text-2xl font-black text-brand-primary tracking-tight">{{ __('Bekræft din e-mailadresse') }}</h2>
    </div>

    <div class="mb-4 text-xs sm:text-sm text-brand-muted leading-relaxed">
        {{ __('Tak fordi du oprettede en profil hos FreyaService! Før vi kan aktivere din adgang, bedes du bekræfte din e-mailadresse ved at klikke på det link, vi netop har sendt til dig. Modtog du ikke e-mailen, sender vi gerne et nyt link.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-semibold text-xs text-forest bg-forest-50 border border-forest-200 p-3 rounded-xl flex items-center gap-2">
            <x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" />
            <span>{{ __('Et nyt bekræftelseslink er sendt til den e-mailadresse, du oplyste under oprettelsen.') }}</span>
        </div>
    @endif

    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-3 pt-4 border-t border-brand-border">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
            @csrf
            <x-primary-button class="w-full sm:w-auto py-2.5 px-5 text-xs">
                {{ __('Gensend bekræftelsesmail') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto text-center">
            @csrf
            <button type="submit" class="underline text-xs text-brand-muted hover:text-brand-secondary rounded-lg transition focus:outline-none focus:ring-2 focus:ring-brand-action cursor-pointer">
                {{ __('Log ud') }}
            </button>
        </form>
    </div>
</x-guest-layout>
