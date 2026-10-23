<x-public-layout>
    <x-slot name="title">{{ __('Brancher') }}</x-slot>

    <!-- Hero -->
    <section class="bg-brand-primary text-white py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden" style="background-image:radial-gradient(rgba(247,246,242,0.07) 1.5px,transparent 0);background-size:24px 24px;">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-4xl sm:text-5xl font-black tracking-tight mb-4">{{ __('Branchekendskab der gør en forskel') }}</h1>
            <p class="text-lg text-sand-200 max-w-2xl mx-auto">{{ __('Vi forstår din branches specifikke krav og stiller med medarbejdere, der har de nødvendige certifikater og erfaring.') }}</p>
        </div>
    </section>



    <section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-8 mb-16">
            <!-- Hotel & Restaurant -->
            <div class="bg-brand-surface rounded-2xl border border-brand-border shadow-sm hover:shadow-xl hover:border-brand-action/40 transition-all overflow-hidden group">
                <div class="bg-gradient-to-r from-brand-action/10 to-transparent p-8 flex items-start gap-6">
                    <div class="w-16 h-16 rounded-2xl bg-action-50 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-cake class="w-8 h-8 text-brand-action" />
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-brand-secondary mb-2">{{ __('Hotel & Restaurant') }}</h2>
                        <p class="text-sm text-brand-body leading-relaxed">{{ __('Tjenere, bartendere, kokke, opvaskere og housekeeping til hoteller, restauranter og store events.') }}</p>
                    </div>
                </div>
                <div class="px-8 pb-8">
                    <ul class="text-xs text-brand-body space-y-2 mt-2">
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-3.5 h-3.5 text-forest shrink-0" /> Tjenere & Bartendere</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-3.5 h-3.5 text-forest shrink-0" /> Kokke & Køkkenhjælp</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-3.5 h-3.5 text-forest shrink-0" /> Housekeeping & Roomservice</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-3.5 h-3.5 text-forest shrink-0" /> Event & Catering personale</li>
                    </ul>
                </div>
            </div>

            <!-- Rengøring -->
            <div class="bg-brand-surface rounded-2xl border border-brand-border shadow-sm hover:shadow-xl hover:border-brand-action/40 transition-all overflow-hidden group">
                <div class="bg-gradient-to-r from-brand-secondary/10 to-transparent p-8 flex items-start gap-6">
                    <div class="w-16 h-16 rounded-2xl bg-navy-50 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-sparkles class="w-8 h-8 text-brand-secondary" />
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-brand-secondary mb-2">{{ __('Rengøring & Facility') }}</h2>
                        <p class="text-sm text-brand-body leading-relaxed">{{ __('Erhvervsrengøring, vinduespudsning, hotelrengøring og hospitalsrengøring udført af grundige fagfolk.') }}</p>
                    </div>
                </div>
                <div class="px-8 pb-8">
                    <ul class="text-xs text-brand-body space-y-2 mt-2">
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-3.5 h-3.5 text-forest shrink-0" /> Erhvervsrengøring</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-3.5 h-3.5 text-forest shrink-0" /> Hospitalsrengøring</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-3.5 h-3.5 text-forest shrink-0" /> Vinduespudsning</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-3.5 h-3.5 text-forest shrink-0" /> Facility Management</li>
                    </ul>
                </div>
            </div>

            <!-- Lager & Logistik -->
            <div class="bg-brand-surface rounded-2xl border border-brand-border shadow-sm hover:shadow-xl hover:border-brand-action/40 transition-all overflow-hidden group">
                <div class="bg-gradient-to-r from-navy-900/5 to-transparent p-8 flex items-start gap-6">
                    <div class="w-16 h-16 rounded-2xl bg-navy-100 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-truck class="w-8 h-8 text-brand-primary" />
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-brand-secondary mb-2">{{ __('Lager & Logistik') }}</h2>
                        <p class="text-sm text-brand-body leading-relaxed">{{ __('Truckførere, pluk-og-pak medarbejdere samt chauffører til travle distributionscentre og lagre.') }}</p>
                    </div>
                </div>
                <div class="px-8 pb-8">
                    <ul class="text-xs text-brand-body space-y-2 mt-2">
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-3.5 h-3.5 text-forest shrink-0" /> Truck- & Gaffeltruckførere</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-3.5 h-3.5 text-forest shrink-0" /> Pluk & Pak</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-3.5 h-3.5 text-forest shrink-0" /> Chauffører (B & C kørekort)</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-3.5 h-3.5 text-forest shrink-0" /> Lagermedarbejdere</li>
                    </ul>
                </div>
            </div>

            <!-- Kontor -->
            <div class="bg-brand-surface rounded-2xl border border-brand-border shadow-sm hover:shadow-xl hover:border-brand-action/40 transition-all overflow-hidden group">
                <div class="bg-gradient-to-r from-forest/10 to-transparent p-8 flex items-start gap-6">
                    <div class="w-16 h-16 rounded-2xl bg-forest-50 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-building-office class="w-8 h-8 text-forest" />
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-brand-secondary mb-2">{{ __('Kontor & Administration') }}</h2>
                        <p class="text-sm text-brand-body leading-relaxed">{{ __('Receptionister, kundeservicemedarbejdere, bogholdere og data-entry personale til travle kontorer.') }}</p>
                    </div>
                </div>
                <div class="px-8 pb-8">
                    <ul class="text-xs text-brand-body space-y-2 mt-2">
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-3.5 h-3.5 text-forest shrink-0" /> Receptionister</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-3.5 h-3.5 text-forest shrink-0" /> Kundeservice & Support</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-3.5 h-3.5 text-forest shrink-0" /> Bogholding & Økonomi</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-3.5 h-3.5 text-forest shrink-0" /> Data Entry & Administration</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-brand-action hover:bg-brand-action-hover text-white font-bold text-base shadow-lg shadow-brand-action/30 transition transform hover:-translate-y-0.5">
                <x-heroicon-o-chat-bubble-bottom-center-text class="w-5 h-5" /><span>{{ __('Kontakt') }} FreyaService</span><x-heroicon-o-arrow-right class="w-5 h-5" />
            </a>
        </div>
    </section>
</x-public-layout>
