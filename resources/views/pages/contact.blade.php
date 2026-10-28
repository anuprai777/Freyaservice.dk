<x-public-layout>
    <x-slot name="title">{{ __('Kontakt') }}</x-slot>

    <!-- Hero -->
    <section class="bg-navy text-white py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden" style="background-image:radial-gradient(rgba(247,246,242,0.07) 1.5px,transparent 0);background-size:24px 24px;">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-4xl sm:text-5xl font-black tracking-tight mb-4">{{ __('Klar til at få hjælp eller starte som vikar?') }}</h1>
            <p class="text-lg text-sand-200 max-w-2xl mx-auto">{{ __('Kontakt vores døgnbemandede vagtcentral eller opret din profil online i dag.') }}</p>
        </div>
    </section>

    <!-- Brand Divider -->
    <div class="brand-divider"></div>

    <section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 mb-16">
            <!-- Contact Info -->
            <div class="space-y-8">
                <div>
                    <h2 class="text-2xl font-extrabold text-navy mb-2">{{ __('Akut vagttelefon') }}</h2>
                    <p class="text-sm text-ink/70 mb-6">Vores vagtcentral er bemandet 24 timer i døgnet, 7 dage om ugen.</p>
                </div>

                <x-card as="a" href="tel:+4528260926" variant="sand" hover="true" padding="none" class="flex items-center gap-5 p-6 hover:border-burgundy/40 group">
                    <div class="w-14 h-14 rounded-xl bg-burgundy flex items-center justify-center shadow-md shadow-burgundy/30 group-hover:scale-110 transition-transform shrink-0">
                        <x-heroicon-o-phone class="w-7 h-7 text-white" />
                    </div>
                    <div>
                        <div class="text-xs font-bold text-burgundy uppercase tracking-wider">{{ __('Ring +45 28 26 09 26') }}</div>
                        <div class="text-2xl font-black text-navy">+45 28 26 09 26</div>
                        <div class="text-xs text-ink/60">Åben 24/7 — Akut dækning</div>
                    </div>
                </x-card>

                <x-card as="a" href="mailto:info@freyaservice.dk" variant="sand" hover="true" padding="none" class="flex items-center gap-5 p-6 hover:border-navy/40 group">
                    <div class="w-14 h-14 rounded-xl bg-navy flex items-center justify-center group-hover:scale-110 transition-transform text-white shrink-0">
                        <x-heroicon-o-envelope class="w-7 h-7" />
                    </div>
                    <div>
                        <div class="text-xs font-bold text-ink/60 uppercase tracking-wider">E-mail</div>
                        <div class="text-lg font-bold text-navy">info@freyaservice.dk</div>
                        <div class="text-xs text-ink/60">Svar inden for 2 timer</div>
                    </div>
                </x-card>

                <x-card variant="sand" padding="none" class="flex items-center gap-5 p-6">
                    <div class="w-14 h-14 rounded-xl bg-teal/15 flex items-center justify-center shrink-0">
                        <x-heroicon-o-map-pin class="w-7 h-7 text-teal" />
                    </div>
                    <div>
                        <div class="text-xs font-bold text-ink/60 uppercase tracking-wider">Adresse</div>
                        <div class="text-lg font-bold text-navy">Vestergade 12</div>
                        <div class="text-xs text-ink/60">1456 København K • CVR: 44556677</div>
                    </div>
                </x-card>

                <x-card padding="none" class="p-5 bg-teal/5 border border-teal/20 rounded-xl flex items-start gap-3">
                    <x-heroicon-s-shield-check class="w-5 h-5 text-teal shrink-0 mt-0.5" />
                    <p class="text-xs text-ink/80 leading-relaxed">{{ __('Ingen CPR-numre gemmes i systemet. Bankoplysninger krypteres med AES-256.') }} {{ __('Alle rettigheder forbeholdes. Overholder gældende EU GDPR-lovgivning samt dansk overenskomst.') }}</p>
                </x-card>
            </div>

            <!-- CTA Cards -->
            <div class="space-y-6">
                <h2 class="text-2xl font-extrabold text-navy">Kom i gang</h2>
                <x-card variant="navy" hover="true" padding="lg">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-navy-800 border border-navy-700 flex items-center justify-center">
                            <x-heroicon-o-building-office class="w-5 h-5 text-[#C9A24B]" />
                        </div>
                        <h3 class="font-bold text-lg text-white">{{ __('Virksomhed (Kunde)') }}</h3>
                    </div>
                    <p class="text-sand-200 text-sm mb-6 leading-relaxed">Bestil vikarer nemt og hurtigt via vores digitale portal. Opret en gratis virksomhedskonto og få svar inden for 30 minutter.</p>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('register', ['role' => 'client']) }}" class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-lg bg-burgundy hover:bg-burgundy-dark text-white text-sm font-bold transition border-2 border-white/35">
                            <x-heroicon-o-user-plus class="w-4 h-4" />{{ __('Opret virksomhedskonto') }}
                        </a>
                        <a href="tel:+4528260926" class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-lg border-2 border-teal bg-transparent hover:bg-white/10 text-white text-sm font-bold transition">
                            <x-heroicon-o-phone class="w-4 h-4" />Ring nu
                        </a>
                    </div>
                </x-card>

                <x-card variant="sand" hover="true" padding="lg">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-teal/15 flex items-center justify-center">
                            <x-heroicon-o-user class="w-5 h-5 text-teal" />
                        </div>
                        <h3 class="font-bold text-lg text-navy">{{ __('Vikar (Arbejdstager)') }}</h3>
                    </div>
                    <p class="text-ink/80 text-sm mb-6 leading-relaxed">Søg ledige vagter, angiv din tilgængelighed og bliv en del af vores netværk af godkendte vikarer i hele Danmark.</p>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('register', ['role' => 'worker']) }}" class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-lg bg-burgundy hover:bg-burgundy-dark text-white text-sm font-bold transition">
                            <x-heroicon-o-user-plus class="w-4 h-4" />{{ __('Tilmeld dig som vikar') }}
                        </a>
                        <a href="{{ route('login') }}" class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-lg border-2 border-teal bg-transparent hover:bg-teal/10 text-navy text-sm font-bold transition">
                            <x-heroicon-o-arrow-right-end-on-rectangle class="w-4 h-4" />{{ __('Log ind') }}
                        </a>
                    </div>
                </x-card>

                <!-- Hours badge -->
                <div class="flex items-center gap-3 p-4 bg-sand border border-mist rounded-xl">
                    <span class="w-3 h-3 rounded-full bg-teal animate-pulse shrink-0"></span>
                    <div>
                        <span class="text-xs font-bold text-navy">Vagtcentral åben 24/7</span>
                        <span class="text-xs text-ink/70 ml-2">— {{ __('Vikarer klar til udrykning 24/7') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
