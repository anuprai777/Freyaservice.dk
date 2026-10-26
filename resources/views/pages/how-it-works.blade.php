<x-public-layout>
    <x-slot name="title">{{ __('Sådan virker det') }}</x-slot>

    <!-- Hero -->
    <section class="bg-navy text-white py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden" style="background-image:radial-gradient(rgba(246,241,233,0.07) 1.5px,transparent 0);background-size:24px 24px;">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-4xl sm:text-5xl font-black tracking-tight mb-4 text-white">{{ __('Fra behov til bemanding på 4 enkle trin') }}</h1>
            <p class="text-lg text-sand-200 max-w-2xl mx-auto">{{ __('Simpel, digital og gennemsigtig proces — fra du opretter en forespørgsel til vikaren møder op.') }}</p>
        </div>
    </section>

    <!-- 6px Brand Section Divider (Burgundy, Teal, Mist segments) -->
    <div class="brand-divider">
        <div class="brand-divider-burgundy"></div>
        <div class="brand-divider-teal"></div>
        <div class="brand-divider-mist"></div>
    </div>

    <section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- 4 Steps -->
        <div class="relative mb-24">
            <!-- Connector line (desktop) -->
            <div class="hidden md:block absolute top-10 left-[12.5%] right-[12.5%] h-0.5 bg-gradient-to-r from-burgundy via-navy to-teal"></div>

            <div class="grid md:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="relative bg-white p-8 rounded-2xl border border-mist shadow-sm hover:shadow-xl transition-all group text-center">
                    <div class="w-14 h-14 mx-auto rounded-full bg-burgundy flex items-center justify-center text-white font-black text-xl mb-6 shadow-lg shadow-burgundy/30 group-hover:scale-110 transition-transform ring-4 ring-white relative z-10">1</div>
                    <div class="w-10 h-10 mx-auto rounded-xl bg-mist flex items-center justify-center mb-4">
                        <x-heroicon-o-clipboard-document-check class="w-5 h-5 text-navy" />
                    </div>
                    <h2 class="font-bold text-navy mb-2">{{ __('1. Opret forespørgsel') }}</h2>
                    <p class="text-xs text-ink/80 leading-relaxed">{{ __('Angiv branche, antal medarbejdere, mødetid og adresse på 2 minutter via vores digitale kundeportal.') }}</p>
                </div>
                <!-- Step 2 -->
                <div class="relative bg-white p-8 rounded-2xl border border-mist shadow-sm hover:shadow-xl transition-all group text-center">
                    <div class="w-14 h-14 mx-auto rounded-full bg-navy flex items-center justify-center text-white font-black text-xl mb-6 shadow-lg shadow-navy/30 group-hover:scale-110 transition-transform ring-4 ring-white relative z-10">2</div>
                    <div class="w-10 h-10 mx-auto rounded-xl bg-mist flex items-center justify-center mb-4">
                        <x-heroicon-o-cpu-chip class="w-5 h-5 text-teal" />
                    </div>
                    <h2 class="font-bold text-navy mb-2">{{ __('2. Intelligent match') }}</h2>
                    <p class="text-xs text-ink/80 leading-relaxed">{{ __('Vores system og rådgivere matcher straks opgaven med de bedst egnede vikarer baseret på færdigheder og lokation.') }}</p>
                </div>
                <!-- Step 3 -->
                <div class="relative bg-white p-8 rounded-2xl border border-mist shadow-sm hover:shadow-xl transition-all group text-center">
                    <div class="w-14 h-14 mx-auto rounded-full bg-teal flex items-center justify-center text-white font-black text-xl mb-6 shadow-lg shadow-teal/30 group-hover:scale-110 transition-transform ring-4 ring-white relative z-10">3</div>
                    <div class="w-10 h-10 mx-auto rounded-xl bg-mist flex items-center justify-center mb-4">
                        <x-heroicon-o-qr-code class="w-5 h-5 text-navy" />
                    </div>
                    <h2 class="font-bold text-navy mb-2">{{ __('3. Vikaren møder op') }}</h2>
                    <p class="text-xs text-ink/80 leading-relaxed">{{ __('Vikaren scanner virksomhedens QR-kode ved ankomst og påbegynder arbejdet punktligt og professionelt.') }}</p>
                </div>
                <!-- Step 4 -->
                <div class="relative bg-white p-8 rounded-2xl border border-mist shadow-sm hover:shadow-xl transition-all group text-center">
                    <div class="w-14 h-14 mx-auto rounded-full bg-navy flex items-center justify-center text-white font-black text-xl mb-6 shadow-lg shadow-navy/30 group-hover:scale-110 transition-transform ring-4 ring-white relative z-10">4</div>
                    <div class="w-10 h-10 mx-auto rounded-xl bg-mist flex items-center justify-center mb-4">
                        <x-heroicon-o-check-badge class="w-5 h-5 text-teal" />
                    </div>
                    <h2 class="font-bold text-navy mb-2">{{ __('4. Godkend & fakturér') }}</h2>
                    <p class="text-xs text-ink/80 leading-relaxed">{{ __('Godkend timesedlen med ét klik. Gennemskuelig faktura med 25% dansk moms og specificerede timer fremsendes automatisk.') }}</p>
                </div>
            </div>
        </div>

        <!-- For Companies vs Workers -->
        <div class="grid md:grid-cols-2 gap-8 mb-16">
            <div class="bg-navy text-white rounded-2xl p-8 border border-navy-800">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-navy-800 border border-navy-700 flex items-center justify-center">
                        <x-heroicon-o-building-office class="w-5 h-5 text-teal" />
                    </div>
                    <h2 class="text-lg font-bold text-white">{{ __('Virksomhed (Kunde)') }}</h2>
                </div>
                <ul class="space-y-3 text-sm text-sand-200">
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Opret en forespørgsel via portalen på under 2 min') }}</span></li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Modtag bekræftelse med vikarens navn og profil') }}</span></li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Generer QR-kode til virksomheden én gang') }}</span></li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Godkend timer med ét klik — ingen papirarbejde') }}</span></li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Modtag faktura automatisk med specifikation') }}</span></li>
                </ul>
                <a href="{{ route('register', ['role' => 'client']) }}" class="btn-primary border-2 border-white/35 mt-6 inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-burgundy hover:bg-burgundy-dark text-white text-sm font-bold transition">
                    {{ __('Bestil Vikar') }} <x-heroicon-o-arrow-right class="w-4 h-4" />
                </a>
            </div>
            <div class="bg-white border border-mist rounded-2xl p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-mist flex items-center justify-center">
                        <x-heroicon-o-user class="w-5 h-5 text-teal" />
                    </div>
                    <h2 class="text-lg font-bold text-navy">{{ __('Vikar (Arbejdstager)') }}</h2>
                </div>
                <ul class="space-y-3 text-sm text-ink/80">
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Opret din profil og vælg kompetencer') }}</span></li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Angiv dine ledige dage i rådighedskalenderen') }}</span></li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Modtag vagt-tilbud og accepter med ét klik') }}</span></li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Scan QR-kode ved ankomst og afgang') }}</span></li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Se din indtjening og download lønsedler') }}</span></li>
                </ul>
                <a href="{{ route('register', ['role' => 'worker']) }}" class="btn-secondary border-2 border-teal bg-transparent hover:bg-teal/10 mt-6 inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-navy text-sm font-bold transition">
                    {{ __('Tilmeld dig som vikar') }} <x-heroicon-o-arrow-right class="w-4 h-4 text-teal" />
                </a>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('contact') }}" class="btn-primary inline-flex items-center gap-2 px-8 py-4 rounded-lg bg-burgundy hover:bg-burgundy-dark text-white font-bold text-base shadow-lg transition transform hover:-translate-y-0.5">
                <x-heroicon-o-phone class="w-5 h-5 text-white" /><span>{{ __('Ring +45 28 26 09 26') }}</span>
            </a>
        </div>
    </section>
</x-public-layout>
