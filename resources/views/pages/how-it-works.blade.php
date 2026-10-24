<x-public-layout>
    <x-slot name="title">{{ __('Sådan virker det') }}</x-slot>

    <!-- Hero -->
    <section class="bg-brand-primary text-white py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden" style="background-image:radial-gradient(rgba(247,246,242,0.07) 1.5px,transparent 0);background-size:24px 24px;">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-4xl sm:text-5xl font-black tracking-tight mb-4">{{ __('Fra behov til bemanding på 4 enkle trin') }}</h1>
            <p class="text-lg text-sand-200 max-w-2xl mx-auto">{{ __('Simpel, digital og gennemsigtig proces — fra du opretter en forespørgsel til vikaren møder op.') }}</p>
        </div>
    </section>



    <section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- 4 Steps -->
        <div class="relative mb-24">
            <!-- Connector line (desktop) -->
            <div class="hidden md:block absolute top-10 left-[12.5%] right-[12.5%] h-0.5 bg-gradient-to-r from-brand-action via-brand-secondary to-forest"></div>

            <div class="grid md:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="relative bg-brand-surface p-8 rounded-2xl border border-brand-border shadow-sm hover:shadow-xl transition-all group text-center">
                    <div class="w-14 h-14 mx-auto rounded-full bg-brand-action flex items-center justify-center text-white font-black text-xl mb-6 shadow-lg shadow-brand-action/30 group-hover:scale-110 transition-transform ring-4 ring-white relative z-10">1</div>
                    <div class="w-10 h-10 mx-auto rounded-xl bg-navy-50 flex items-center justify-center mb-4">
                        <x-heroicon-o-clipboard-document-check class="w-5 h-5 text-brand-secondary" />
                    </div>
                    <h2 class="font-bold text-brand-secondary mb-2">{{ __('1. Opret forespørgsel') }}</h2>
                    <p class="text-xs text-brand-body leading-relaxed">{{ __('Angiv branche, antal medarbejdere, mødetid og adresse på 2 minutter via vores digitale kundeportal.') }}</p>
                </div>
                <!-- Step 2 -->
                <div class="relative bg-brand-surface p-8 rounded-2xl border border-brand-border shadow-sm hover:shadow-xl transition-all group text-center">
                    <div class="w-14 h-14 mx-auto rounded-full bg-brand-secondary flex items-center justify-center text-white font-black text-xl mb-6 shadow-lg shadow-brand-secondary/30 group-hover:scale-110 transition-transform ring-4 ring-white relative z-10">2</div>
                    <div class="w-10 h-10 mx-auto rounded-xl bg-action-50 flex items-center justify-center mb-4">
                        <x-heroicon-o-cpu-chip class="w-5 h-5 text-brand-action" />
                    </div>
                    <h2 class="font-bold text-brand-secondary mb-2">{{ __('2. Intelligent match') }}</h2>
                    <p class="text-xs text-brand-body leading-relaxed">{{ __('Vores system og rådgivere matcher straks opgaven med de bedst egnede vikarer baseret på færdigheder og lokation.') }}</p>
                </div>
                <!-- Step 3 -->
                <div class="relative bg-brand-surface p-8 rounded-2xl border border-brand-border shadow-sm hover:shadow-xl transition-all group text-center">
                    <div class="w-14 h-14 mx-auto rounded-full bg-brand-secondary flex items-center justify-center text-white font-black text-xl mb-6 shadow-lg shadow-brand-secondary/30 group-hover:scale-110 transition-transform ring-4 ring-white relative z-10">3</div>
                    <div class="w-10 h-10 mx-auto rounded-xl bg-navy-50 flex items-center justify-center mb-4">
                        <x-heroicon-o-qr-code class="w-5 h-5 text-brand-secondary" />
                    </div>
                    <h2 class="font-bold text-brand-secondary mb-2">{{ __('3. Vikaren møder op') }}</h2>
                    <p class="text-xs text-brand-body leading-relaxed">{{ __('Vikaren scanner virksomhedens QR-kode ved ankomst og påbegynder arbejdet punktligt og professionelt.') }}</p>
                </div>
                <!-- Step 4 -->
                <div class="relative bg-brand-surface p-8 rounded-2xl border border-brand-border shadow-sm hover:shadow-xl transition-all group text-center">
                    <div class="w-14 h-14 mx-auto rounded-full bg-forest flex items-center justify-center text-white font-black text-xl mb-6 shadow-lg shadow-forest/30 group-hover:scale-110 transition-transform ring-4 ring-white relative z-10">4</div>
                    <div class="w-10 h-10 mx-auto rounded-xl bg-forest-50 flex items-center justify-center mb-4">
                        <x-heroicon-o-check-badge class="w-5 h-5 text-forest" />
                    </div>
                    <h2 class="font-bold text-brand-secondary mb-2">{{ __('4. Godkend & fakturér') }}</h2>
                    <p class="text-xs text-brand-body leading-relaxed">{{ __('Godkend timesedlen med ét klik. Gennemskuelig faktura med 25% dansk moms og specificerede timer fremsendes automatisk.') }}</p>
                </div>
            </div>
        </div>

        <!-- For Companies vs Workers -->
        <div class="grid md:grid-cols-2 gap-8 mb-16">
            <div class="bg-brand-primary text-white rounded-2xl p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-navy-800 border border-navy-700 flex items-center justify-center">
                        <x-heroicon-o-building-office class="w-5 h-5 text-brand-action" />
                    </div>
                    <h2 class="text-lg font-bold">{{ __('Virksomhed (Kunde)') }}</h2>
                </div>
                <ul class="space-y-3 text-sm text-sand-200">
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-brand-action mt-0.5 shrink-0" />Opret en forespørgsel via portalen på under 2 min</li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-brand-action mt-0.5 shrink-0" />Modtag bekræftelse med vikarens navn og profil</li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-brand-action mt-0.5 shrink-0" />Generer QR-kode til virksomheden én gang</li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-brand-action mt-0.5 shrink-0" />Godkend timer med ét klik — ingen papirarbejde</li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-brand-action mt-0.5 shrink-0" />Modtag faktura automatisk med specifikation</li>
                </ul>
                <a href="{{ route('register', ['role' => 'client']) }}" class="mt-6 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-brand-action hover:bg-brand-action-hover text-white text-sm font-bold transition">
                    {{ __('Bestil Vikar') }} <x-heroicon-o-arrow-right class="w-4 h-4" />
                </a>
            </div>
            <div class="bg-brand-surface border border-brand-border rounded-2xl p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-forest-50 flex items-center justify-center">
                        <x-heroicon-o-user class="w-5 h-5 text-forest" />
                    </div>
                    <h2 class="text-lg font-bold text-brand-secondary">{{ __('Vikar (Arbejdstager)') }}</h2>
                </div>
                <ul class="space-y-3 text-sm text-brand-body">
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-forest mt-0.5 shrink-0" />Opret din profil og vælg kompetencer</li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-forest mt-0.5 shrink-0" />Angiv dine ledige dage i rådighedskalenderen</li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-forest mt-0.5 shrink-0" />Modtag vagt-tilbud og accepter med ét klik</li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-forest mt-0.5 shrink-0" />Scan QR-kode ved ankomst og afgang</li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-forest mt-0.5 shrink-0" />Se din indtjening og download lønsedler</li>
                </ul>
                <a href="{{ route('register', ['role' => 'worker']) }}" class="mt-6 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-brand-secondary hover:bg-navy-800 text-white text-sm font-bold transition">
                    {{ __('Tilmeld dig som vikar') }} <x-heroicon-o-arrow-right class="w-4 h-4" />
                </a>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-brand-action hover:bg-brand-action-hover text-white font-bold text-base shadow-lg shadow-brand-action/30 transition transform hover:-translate-y-0.5">
                <x-heroicon-o-phone class="w-5 h-5" /><span>{{ __('Ring +45 28 26 09 26') }}</span>
            </a>
        </div>
    </section>
</x-public-layout>
