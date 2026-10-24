<x-public-layout>
    <x-slot name="title">{{ __('Kontakt') }}</x-slot>

    <!-- Hero -->
    <section class="bg-brand-primary text-white py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden" style="background-image:radial-gradient(rgba(247,246,242,0.07) 1.5px,transparent 0);background-size:24px 24px;">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-4xl sm:text-5xl font-black tracking-tight mb-4">{{ __('Klar til at få hjælp eller starte som vikar?') }}</h1>
            <p class="text-lg text-sand-200 max-w-2xl mx-auto">{{ __('Kontakt vores døgnbemandede vagtcentral eller opret din profil online i dag.') }}</p>
        </div>
    </section>



    <section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 mb-16">
            <!-- Contact Info -->
            <div class="space-y-8">
                <div>
                    <h2 class="text-2xl font-extrabold text-brand-secondary mb-2">{{ __('Akut vagttelefon') }}</h2>
                    <p class="text-sm text-brand-muted mb-6">Vores vagtcentral er bemandet 24 timer i døgnet, 7 dage om ugen.</p>
                </div>

                <a href="tel:+4528260926" class="flex items-center gap-5 p-6 bg-brand-action/10 border border-brand-action/30 rounded-2xl hover:bg-brand-action/20 transition group">
                    <div class="w-14 h-14 rounded-xl bg-brand-action flex items-center justify-center shadow-md shadow-brand-action/30 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-phone class="w-7 h-7 text-white" />
                    </div>
                    <div>
                        <div class="text-xs font-bold text-brand-action uppercase tracking-wider">{{ __('Ring +45 28 26 09 26') }}</div>
                        <div class="text-2xl font-black text-brand-secondary">+45 28 26 09 26</div>
                        <div class="text-xs text-brand-muted">Åben 24/7 — Akut dækning</div>
                    </div>
                </a>

                <a href="mailto:info@freyaservice.dk" class="flex items-center gap-5 p-6 bg-brand-surface border border-brand-border rounded-2xl hover:border-brand-secondary/40 hover:shadow-md transition group">
                    <div class="w-14 h-14 rounded-xl bg-navy-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <x-heroicon-o-envelope class="w-7 h-7 text-brand-secondary" />
                    </div>
                    <div>
                        <div class="text-xs font-bold text-brand-muted uppercase tracking-wider">E-mail</div>
                        <div class="text-lg font-bold text-brand-secondary">info@freyaservice.dk</div>
                        <div class="text-xs text-brand-muted">Svar inden for 2 timer</div>
                    </div>
                </a>

                <div class="flex items-center gap-5 p-6 bg-brand-surface border border-brand-border rounded-2xl">
                    <div class="w-14 h-14 rounded-xl bg-forest-50 flex items-center justify-center">
                        <x-heroicon-o-map-pin class="w-7 h-7 text-forest" />
                    </div>
                    <div>
                        <div class="text-xs font-bold text-brand-muted uppercase tracking-wider">Adresse</div>
                        <div class="text-lg font-bold text-brand-secondary">Vestergade 12</div>
                        <div class="text-xs text-brand-muted">1456 København K • CVR: 44556677</div>
                    </div>
                </div>

                <div class="p-5 bg-forest/5 border border-forest/20 rounded-xl flex items-start gap-3">
                    <x-heroicon-s-shield-check class="w-5 h-5 text-forest shrink-0 mt-0.5" />
                    <p class="text-xs text-brand-body leading-relaxed">{{ __('Ingen CPR-numre gemmes i systemet. Bankoplysninger krypteres med AES-256.') }} {{ __('Alle rettigheder forbeholdes. Overholder gældende EU GDPR-lovgivning samt dansk overenskomst.') }}</p>
                </div>
            </div>

            <!-- CTA Cards -->
            <div class="space-y-6">
                <h2 class="text-2xl font-extrabold text-brand-secondary">Kom i gang</h2>
                <div class="bg-brand-primary text-white rounded-2xl p-8 hover:shadow-xl transition border border-navy-800">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-navy-800 border border-navy-700 flex items-center justify-center">
                            <x-heroicon-o-building-office class="w-5 h-5 text-brand-action" />
                        </div>
                        <h3 class="font-bold text-lg">{{ __('Virksomhed (Kunde)') }}</h3>
                    </div>
                    <p class="text-sand-200 text-sm mb-6 leading-relaxed">Bestil vikarer nemt og hurtigt via vores digitale portal. Opret en gratis virksomhedskonto og få svar inden for 30 minutter.</p>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('register', ['role' => 'client']) }}" class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-brand-action hover:bg-brand-action-hover text-white text-sm font-bold transition">
                            <x-heroicon-o-user-plus class="w-4 h-4" />{{ __('Opret virksomhedskonto') }}
                        </a>
                        <a href="tel:+4528260926" class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-navy-800 hover:bg-navy-700 border border-navy-600 text-white text-sm font-bold transition">
                            <x-heroicon-o-phone class="w-4 h-4" />Ring nu
                        </a>
                    </div>
                </div>

                <div class="bg-brand-surface border border-brand-border rounded-2xl p-8 hover:shadow-xl transition">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-forest-50 flex items-center justify-center">
                            <x-heroicon-o-user class="w-5 h-5 text-forest" />
                        </div>
                        <h3 class="font-bold text-lg text-brand-secondary">{{ __('Vikar (Arbejdstager)') }}</h3>
                    </div>
                    <p class="text-brand-body text-sm mb-6 leading-relaxed">Søg ledige vagter, angiv din tilgængelighed og bliv en del af vores netværk af godkendte vikarer i hele Danmark.</p>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('register', ['role' => 'worker']) }}" class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-brand-secondary hover:bg-navy-800 text-white text-sm font-bold transition">
                            <x-heroicon-o-user-plus class="w-4 h-4" />{{ __('Tilmeld dig som vikar') }}
                        </a>
                        <a href="{{ route('login') }}" class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-brand-border hover:bg-brand-bg text-brand-secondary text-sm font-bold transition">
                            <x-heroicon-o-arrow-right-end-on-rectangle class="w-4 h-4" />{{ __('Log ind') }}
                        </a>
                    </div>
                </div>

                <!-- Hours badge -->
                <div class="flex items-center gap-3 p-4 bg-brand-action/5 border border-brand-action/20 rounded-xl">
                    <span class="w-3 h-3 rounded-full bg-forest animate-pulse shrink-0"></span>
                    <div>
                        <span class="text-xs font-bold text-brand-secondary">Vagtcentral åben 24/7</span>
                        <span class="text-xs text-brand-muted ml-2">— {{ __('Vikarer klar til udrykning 24/7') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
