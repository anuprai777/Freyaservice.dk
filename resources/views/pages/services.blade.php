<x-public-layout>
    <x-slot name="title">{{ __('Ydelser') }}</x-slot>

    <!-- Hero -->
    <section class="bg-brand-primary text-white py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden" style="background-image:radial-gradient(rgba(247,246,242,0.07) 1.5px,transparent 0);background-size:24px 24px;">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-navy-900 border border-brand-action/60 text-sand-100 text-xs font-semibold mb-6 shadow-xs">
                <x-heroicon-o-briefcase class="w-3.5 h-3.5 text-brand-action" /><span>{{ __('Vores Bemandingsløsninger') }}</span>
            </div>
            <h1 class="text-4xl sm:text-5xl font-black tracking-tight mb-4">{{ __('Vikarer til alle behov') }}</h1>
            <p class="text-lg text-sand-200 max-w-2xl mx-auto">{{ __('Hvad enten du mangler en opvasker i aften eller 10 lagermedarbejdere i tre måneder, har vi den rette løsning.') }}</p>
        </div>
    </section>



    <section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-8 mb-16">
            <div class="bg-brand-surface rounded-2xl p-8 border border-brand-border shadow-sm hover:shadow-xl hover:border-brand-action/40 transition-all group">
                <div class="w-14 h-14 rounded-xl bg-action-50 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <x-heroicon-o-clock class="w-7 h-7 text-brand-action" />
                </div>
                <h2 class="text-xl font-bold text-brand-secondary mb-3">{{ __('Akut og kortvarig vikardækning') }}</h2>
                <p class="text-sm text-brand-body leading-relaxed mb-6">{{ __('Dækning fra dag til dag ved akut sygdom, ferie eller uventet spidsbelastning. Vores vikarer er klar med få timers varsel.') }}</p>
                <ul class="text-xs text-brand-body space-y-2.5 border-t border-brand-border pt-4">
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" /><span>{{ __('Under 2 timer') }} {{ __('responstid') }}</span></li>
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" /><span>{{ __('Digital time- & QR-registrering') }}</span></li>
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" /><span>{{ __('Overenskomstmæssige vilkår') }}</span></li>
                </ul>
            </div>
            <div class="bg-brand-surface rounded-2xl p-8 border border-brand-border shadow-sm hover:shadow-xl hover:border-brand-action/40 transition-all group">
                <div class="w-14 h-14 rounded-xl bg-navy-50 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <x-heroicon-o-calendar-days class="w-7 h-7 text-brand-secondary" />
                </div>
                <h2 class="text-xl font-bold text-brand-secondary mb-3">{{ __('Længerevarende vikariater') }}</h2>
                <p class="text-sm text-brand-body leading-relaxed mb-6">{{ __('Stabile vikarer til projekter, barselsvikariater eller sæsonarbejde af ugers eller måneders varighed.') }}</p>
                <ul class="text-xs text-brand-body space-y-2.5 border-t border-brand-border pt-4">
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" /><span>{{ __('Gennemtestede vikarer') }}</span></li>
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" /><span>{{ __('Ensartet høj kvalitet') }}</span></li>
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" /><span>{{ __('Månedlig samlet fakturering') }}</span></li>
                </ul>
            </div>
            <div class="bg-brand-surface rounded-2xl p-8 border border-brand-border shadow-sm hover:shadow-xl hover:border-brand-action/40 transition-all group">
                <div class="w-14 h-14 rounded-xl bg-forest-50 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <x-heroicon-o-user-group class="w-7 h-7 text-forest" />
                </div>
                <h2 class="text-xl font-bold text-brand-secondary mb-3">{{ __('Fast rekruttering & Try & Hire') }}</h2>
                <p class="text-sm text-brand-body leading-relaxed mb-6">{{ __('Afprøv en medarbejder i en vikarperiode før fastansættelse. Minimer ansættelsesrisikoen og find det perfekte match.') }}</p>
                <ul class="text-xs text-brand-body space-y-2.5 border-t border-brand-border pt-4">
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" /><span>{{ __('Minimer ansættelsesrisiko') }}</span></li>
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" /><span>{{ __('Screenede kandidater med referencer') }}</span></li>
                    <li class="flex items-center gap-2 font-medium"><x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" /><span>{{ __('Fuld digital kontraktstyring') }}</span></li>
                </ul>
            </div>
        </div>

        <!-- Why FreyaService Section Makeover -->
        <div class="bg-gradient-to-b from-brand-surface to-brand-bg rounded-3xl border border-brand-border p-8 sm:p-12 mb-16 shadow-sm">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-action/10 border border-brand-action/30 text-brand-action text-xs font-bold mb-3">
                    <x-heroicon-o-shield-check class="w-4 h-4 text-brand-action" />
                    <span>{{ __('Vores Værdier & Fordele') }}</span>
                </div>
                <h2 class="text-3xl font-black text-brand-secondary tracking-tight">{{ __('Hvorfor vælge FreyaService?') }}</h2>
                <p class="text-sm text-brand-muted mt-2">{{ __('Et moderne vikarbureau bygget på gennemsigtighed og kvalitet') }}</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mb-10">
                <div class="bg-brand-surface rounded-2xl p-6 border border-brand-border shadow-xs hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-action-50 text-brand-action flex items-center justify-center mb-4">
                        <x-heroicon-o-bolt class="w-6 h-6 text-brand-action" />
                    </div>
                    <h3 class="font-bold text-brand-secondary mb-2">{{ __('Akut vikardækning døgnet rundt') }}</h3>
                    <p class="text-xs text-brand-body leading-relaxed">{{ __('Når sygdom eller uventet travlhed rammer, stiller vi med erfarne vikarer med få timers varsel i hele landet.') }}</p>
                </div>

                <div class="bg-brand-surface rounded-2xl p-6 border border-brand-border shadow-xs hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-navy-50 text-brand-secondary flex items-center justify-center mb-4">
                        <x-heroicon-o-shield-check class="w-6 h-6 text-brand-secondary" />
                    </div>
                    <h3 class="font-bold text-brand-secondary mb-2">{{ __('Gennemtestede vikarer') }}</h3>
                    <p class="text-xs text-brand-body leading-relaxed">{{ __('Alle vikarer screenes personligt, straffeattest og arbejdstilladelser tjekkes, og referencer indhentes før udsendelse.') }}</p>
                </div>

                <div class="bg-brand-surface rounded-2xl p-6 border border-brand-border shadow-xs hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-forest-50 text-forest flex items-center justify-center mb-4">
                        <x-heroicon-o-qr-code class="w-6 h-6 text-forest" />
                    </div>
                    <h3 class="font-bold text-brand-secondary mb-2">{{ __('Digital time- & QR-registrering') }}</h3>
                    <p class="text-xs text-brand-body leading-relaxed">{{ __('Præcis tjek-ind og tjek-ud via QR-kode på arbejdspladsen. Ingen manuelle papirsedler – kun godkendte timer.') }}</p>
                </div>
            </div>

            <div class="bg-brand-primary text-white rounded-2xl p-6 grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
                <div>
                    <div class="text-2xl font-black text-brand-action">&lt; 2t</div>
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
                    <div class="text-2xl font-black text-forest-300">24/7</div>
                    <div class="text-[11px] text-sand-200 mt-0.5">{{ __('Bemandet vagtcentral') }}</div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-brand-action hover:bg-brand-action-hover text-white font-bold text-base shadow-lg shadow-brand-action/30 transition transform hover:-translate-y-0.5">
                <x-heroicon-o-briefcase class="w-5 h-5" /><span>{{ __('Bestil vikar nu') }}</span><x-heroicon-o-arrow-right class="w-5 h-5" />
            </a>
            <p class="text-xs text-brand-muted mt-3">{{ __('Ring +45 70 20 30 40') }} — {{ __('Akut vagttelefon') }}</p>
        </div>
    </section>
</x-public-layout>
