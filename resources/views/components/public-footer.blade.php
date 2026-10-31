<!-- Footer (Primary Dark: Deep burgundy #5A1429, Border: Deep burgundy 800) -->
<footer class="bg-navy text-sand-300 py-12 border-t border-navy-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-4 gap-8">
        <div class="space-y-4">
            <a href="/" class="inline-block group focus-visible:ring-2 focus-visible:ring-burgundy rounded focus:outline-none" aria-label="Freya Service">
                <img src="{{ asset('images/logo-white.png') }}" alt="Freya Service vikarbureau logo hvid" class="h-10 w-auto object-contain group-hover:opacity-90 transition" width="160" height="40" loading="lazy" decoding="async">
            </a>
            <p class="text-xs leading-relaxed text-sand-200">
                {{ __('Dansk vikarbureau med fokus på fleksibilitet, pålidelighed og digital gennemsigtighed.') }}
            </p>
            <div class="text-xs text-sand-400">
                CVR: 44556677 • Moms nr. DK44556677
            </div>
            <div class="pt-4 border-t border-white/10">
                <p class="text-[10px] font-bold text-sand-400 uppercase tracking-wider mb-3">{{ __('Følg os') }}</p>
                <x-social-links variant="dark" aria-label="{{ __('Freya Service på sociale medier') }}" />
            </div>
        </div>

        <div>
            <p class="text-xs font-bold text-white uppercase tracking-wider mb-3">{{ __('Virksomheder') }}</p>
            <ul class="text-xs space-y-2">
                <li><a href="{{ route('register', ['role' => 'client']) }}" class="text-sand-300 hover:text-white flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-burgundy rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-teal" />{{ __('Bestil Vikar') }}</a></li>
                <li><a href="{{ route('login') }}" class="text-sand-300 hover:text-white flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-burgundy rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-teal" />{{ __('Timesedler') }}</a></li>
                <li><a href="{{ route('login') }}" class="text-sand-300 hover:text-white flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-burgundy rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-teal" />{{ __('Fakturaer') }}</a></li>
            </ul>
        </div>

        <div>
            <p class="text-xs font-bold text-white uppercase tracking-wider mb-3">{{ __('Vikarer') }}</p>
            <ul class="text-xs space-y-2">
                <li><a href="{{ route('register', ['role' => 'worker']) }}" class="text-sand-300 hover:text-white flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-burgundy rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-teal" />{{ __('Tilmeld dig som vikar') }}</a></li>
                <li><a href="{{ route('login') }}" class="text-sand-300 hover:text-white flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-burgundy rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-teal" />{{ __('Ledige Vagter') }}</a></li>
                <li><a href="{{ route('login') }}" class="text-sand-300 hover:text-white flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-burgundy rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-teal" />{{ __('QR Tjek-ind') }}</a></li>
            </ul>
        </div>

        <div>
            <p class="text-xs font-bold text-white uppercase tracking-wider mb-3">{{ __('GDPR & Sikkerhed') }}</p>
            <ul class="text-xs space-y-2">
                <li class="flex items-start gap-1.5">
                    <x-heroicon-s-shield-check class="w-4 h-4 text-teal shrink-0 mt-0.5" />
                    <span class="text-sand-200">{{ __('Ingen CPR-numre gemmes i systemet. Bankoplysninger krypteres med AES-256.') }}</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 mt-8 border-t border-navy-800 text-center text-xs text-sand-400">
        &copy; {{ date('Y') }} FreyaService.dk — {{ __('Alle rettigheder forbeholdes.') }} Timezone: Europe/Copenhagen.
    </div>
</footer>
