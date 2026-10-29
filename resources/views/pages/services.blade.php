<x-public-layout>
    <x-slot name="title">{{ __('Ydelser') }}</x-slot>

    <!-- Hero -->
    <section class="bg-navy text-white py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden" style="background-image:radial-gradient(rgba(246,241,233,0.07) 1.5px,transparent 0);background-size:24px 24px;">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-4xl sm:text-5xl font-black tracking-tight mb-4 text-white">{{ __('Vikarer til alle behov') }}</h1>
            <p class="text-lg text-sand-200 max-w-2xl mx-auto">{{ __('Hvad enten du mangler en opvasker i aften eller 10 lagermedarbejdere i tre måneder, har vi den rette løsning.') }}</p>
        </div>
    </section>

    <!-- 6px Brand Section Divider (Burgundy, Teal, Mist segments) -->
    <div class="brand-divider">
        <div class="brand-divider-burgundy"></div>
        <div class="brand-divider-teal"></div>
        <div class="brand-divider-mist"></div>
    </div>

    <section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- 3 Specific Service Cards: Sand bg, 14px radius, 5px coloured top border -->
        <div class="grid md:grid-cols-3 gap-8 mb-16">
            <!-- 1. Temporary Staff: Burgundy 5px top border -->
            <x-card variant="sand" hover="true" accent="burgundy" class="service-card service-card-temp flex flex-col justify-between p-8">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center mb-4 shadow-xs group-hover:scale-110 transition-transform">
                        <x-heroicon-o-clock class="w-6 h-6 text-burgundy" />
                    </div>
                    <div class="text-xs font-bold text-burgundy uppercase tracking-wider mb-1">{{ __('Vikarbemanding') }}</div>
                    <h2 class="text-xl font-bold text-navy mb-3">{{ __('Akut og kortvarig vikardækning') }}</h2>
                    <p class="text-sm text-ink/80 leading-relaxed mb-6">{{ __('Dækning fra dag til dag ved akut sygdom, ferie eller uventet spidsbelastning. Vores vikarer er klar med få timers varsel.') }}</p>
                </div>
                <ul class="text-xs text-ink/90 space-y-2.5 border-t border-mist pt-4">
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /><span>{{ __('Under 2 timer') }} {{ __('responstid') }}</span></li>
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /><span>{{ __('Digital time- & QR-registrering') }}</span></li>
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /><span>{{ __('Overenskomstmæssige vilkår') }}</span></li>
                </ul>
            </x-card>

            <!-- 2. Permanent Hiring: Navy 5px top border -->
            <x-card variant="sand" hover="true" accent="navy" class="service-card service-card-perm flex flex-col justify-between p-8">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center mb-4 shadow-xs group-hover:scale-110 transition-transform">
                        <x-heroicon-o-calendar-days class="w-6 h-6 text-navy" />
                    </div>
                    <div class="text-xs font-bold text-navy uppercase tracking-wider mb-1">{{ __('Fast Rekruttering') }}</div>
                    <h2 class="text-xl font-bold text-navy mb-3">{{ __('Fast rekruttering & Try & Hire') }}</h2>
                    <p class="text-sm text-ink/80 leading-relaxed mb-6">{{ __('Afprøv en medarbejder i en vikarperiode før fastansættelse. Minimer ansættelsesrisikoen og find det perfekte match til din virksomhed.') }}</p>
                </div>
                <ul class="text-xs text-ink/90 space-y-2.5 border-t border-mist pt-4">
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /><span>{{ __('Gennemtestede vikarer med referencer') }}</span></li>
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /><span>{{ __('Ensartet høj faglig kvalitet') }}</span></li>
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /><span>{{ __('Fuld digital kontraktstyring') }}</span></li>
                </ul>
            </x-card>

            <!-- 3. Part-Time Staff: Teal 5px top border -->
            <x-card variant="sand" hover="true" accent="teal" class="service-card service-card-part flex flex-col justify-between p-8">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center mb-4 shadow-xs group-hover:scale-110 transition-transform">
                        <x-heroicon-o-user-group class="w-6 h-6 text-teal" />
                    </div>
                    <div class="text-xs font-bold text-teal uppercase tracking-wider mb-1">{{ __('Deltidsbemanding') }}</div>
                    <h2 class="text-xl font-bold text-navy mb-3">{{ __('Fleksibel deltidsbemanding') }}</h2>
                    <p class="text-sm text-ink/80 leading-relaxed mb-6">{{ __('Stabile deltidsmedarbejdere til aften-, weekend- eller faste ugentlige vagter. Ideelt til spidsbelastninger uden faste omkostninger.') }}</p>
                </div>
                <ul class="text-xs text-ink/90 space-y-2.5 border-t border-mist pt-4">
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /><span>{{ __('Fleksible vagtplaner') }}</span></li>
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /><span>{{ __('Ingen binding eller oprettelsesgebyr') }}</span></li>
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /><span>{{ __('Månedlig samlet fakturering') }}</span></li>
                </ul>
            </x-card>
        </div>

        <!-- Sector Tags Chip Group -->
        <div class="mb-16">
            <div class="text-center mb-6">
                <span class="text-xs font-bold text-navy uppercase tracking-widest">{{ __('Brancher vi dækker') }}</span>
            </div>
            <div class="flex flex-wrap justify-center gap-2.5 max-w-4xl mx-auto sector-tags">
                <span class="sector-tag">{{ __('Sundhed & Pleje') }}</span>
                <span class="sector-tag">{{ __('Hotel & Restauration') }}</span>
                <span class="sector-tag">{{ __('Lager & Logistik') }}</span>
                <span class="sector-tag">{{ __('Byggeri & Håndværk') }}</span>
                <span class="sector-tag">{{ __('Detailhandel') }}</span>
                <span class="sector-tag">{{ __('Kontor & Administration') }}</span>
                <span class="sector-tag">{{ __('IT & Teknologi') }}</span>
                <span class="sector-tag">{{ __('Industri & Produktion') }}</span>
                <span class="sector-tag">{{ __('Rengøring & Facility') }}</span>
            </div>
        </div>

        <!-- Why FreyaService Section Makeover -->
        <div class="bg-sand rounded-3xl border border-mist p-8 sm:p-12 mb-16 shadow-sm">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <div class="text-xs font-bold text-burgundy uppercase tracking-widest mb-3">{{ __('Vores Værdier & Fordele') }}</div>
                <h2 class="text-3xl font-black text-navy tracking-tight">{{ __('Hvorfor vælge FreyaService?') }}</h2>
                <p class="text-sm text-ink/70 mt-2">{{ __('Et moderne vikarbureau bygget på gennemsigtighed og kvalitet') }}</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mb-10">
                <x-card variant="white" hover="true" class="p-6">
                    <div class="w-12 h-12 rounded-xl bg-mist flex items-center justify-center mb-4">
                        <x-heroicon-o-bolt class="w-6 h-6 text-burgundy" />
                    </div>
                    <h3 class="font-bold text-navy mb-2">{{ __('Akut vikardækning døgnet rundt') }}</h3>
                    <p class="text-xs text-ink/80 leading-relaxed">{{ __('Når sygdom eller uventet travlhed rammer, stiller vi med erfarne vikarer med få timers varsel i hele landet.') }}</p>
                </x-card>

                <x-card variant="white" hover="true" class="p-6">
                    <div class="w-12 h-12 rounded-xl bg-mist flex items-center justify-center mb-4">
                        <x-heroicon-o-shield-check class="w-6 h-6 text-navy" />
                    </div>
                    <h3 class="font-bold text-navy mb-2">{{ __('Gennemtestede vikarer') }}</h3>
                    <p class="text-xs text-ink/80 leading-relaxed">{{ __('Alle vikarer screenes personligt, straffeattest og arbejdstilladelser tjekkes, og referencer indhentes før udsendelse.') }}</p>
                </x-card>

                <x-card variant="white" hover="true" class="p-6">
                    <div class="w-12 h-12 rounded-xl bg-mist flex items-center justify-center mb-4">
                        <x-heroicon-o-qr-code class="w-6 h-6 text-teal" />
                    </div>
                    <h3 class="font-bold text-navy mb-2">{{ __('Digital time- & QR-registrering') }}</h3>
                    <p class="text-xs text-ink/80 leading-relaxed">{{ __('Præcis tjek-ind og tjek-ud via QR-kode på arbejdspladsen. Ingen manuelle papirsedler – kun godkendte timer.') }}</p>
                </x-card>
            </div>

            <x-card variant="navy" class="p-6 grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
                <div>
                    <div class="text-2xl font-black text-[#C9A24B]">{{ app()->getLocale() === 'en' ? '< 2h' : '< 2t' }}</div>
                    <div class="text-[11px] text-sand-200 mt-0.5">{{ __('Gennemsnitlig responstid') }}</div>
                </div>
                <div>
                    <div class="text-2xl font-black text-white">100%</div>
                    <div class="text-[11px] text-sand-200 mt-0.5">{{ __('Overenskomstdækning') }}</div>
                </div>
                <div>
                    <div class="text-2xl font-black text-white">2.500+</div>
                    <div class="text-[11px] text-sand-200 mt-0.5">{{ __('Kvalificerede vikarer') }}</div>
                </div>
                <div>
                    <div class="text-2xl font-black text-[#C9A24B]">24/7</div>
                    <div class="text-[11px] text-sand-200 mt-0.5">{{ __('Bemandet vagtcentral') }}</div>
                </div>
            </x-card>
        </div>

        <div class="text-center">
            <a href="{{ route('register', ['role' => 'client']) }}" class="btn-primary inline-flex items-center gap-2 px-8 py-4 rounded-lg bg-burgundy hover:bg-burgundy-dark text-white font-bold text-base shadow-lg transition transform hover:-translate-y-0.5">
                <x-heroicon-o-briefcase class="w-5 h-5 text-white" /><span>{{ __('Bestil vikar nu') }}</span><x-heroicon-o-arrow-right class="w-5 h-5 text-white" />
            </a>
            <p class="text-xs text-ink/60 mt-3">{{ __('Ring +45 28 26 09 26') }} — {{ __('Akut vagttelefon') }}</p>
        </div>
    </section>
</x-public-layout>
