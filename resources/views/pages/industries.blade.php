<x-public-layout>
    <x-slot name="title">{{ __('Brancher') }}</x-slot>

    <!-- Hero -->
    <section class="bg-navy text-white py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden" style="background-image:radial-gradient(rgba(246,241,233,0.07) 1.5px,transparent 0);background-size:24px 24px;">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-4xl sm:text-5xl font-black tracking-tight mb-4 text-white">{{ __('Branchekendskab der gør en forskel') }}</h1>
            <p class="text-lg text-sand-200 max-w-2xl mx-auto">{{ __('Vi forstår din branches specifikke krav og stiller med medarbejdere, der har de nødvendige certifikater og erfaring.') }}</p>
        </div>
    </section>

    <!-- 6px Brand Section Divider (Burgundy, Teal, Mist segments) -->
    <div class="brand-divider">
        <div class="brand-divider-burgundy"></div>
        <div class="brand-divider-teal"></div>
        <div class="brand-divider-mist"></div>
    </div>

    <section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Sector Tags Chip Group (mist background with ink text, teal bg with white text on every 3rd tag) -->
        <div class="mb-14">
            <div class="text-center mb-6">
                <span class="text-xs font-bold text-navy uppercase tracking-widest">{{ __('Alle Brancher & Sektorer') }}</span>
            </div>
            <div class="flex flex-wrap justify-center gap-2.5 max-w-4xl mx-auto sector-tags">
                <span class="sector-tag">{{ __('Healthcare') }}</span>
                <span class="sector-tag">{{ __('Hospitality') }}</span>
                <span class="sector-tag">{{ __('Logistics') }}</span>
                <span class="sector-tag">{{ __('Construction') }}</span>
                <span class="sector-tag">{{ __('Retail') }}</span>
                <span class="sector-tag">{{ __('Office & Admin') }}</span>
                <span class="sector-tag">{{ __('IT') }}</span>
                <span class="sector-tag">{{ __('Industry') }}</span>
                <span class="sector-tag">{{ __('Cleaning') }}</span>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-16">
            <!-- Hotel & Restaurant -->
            <div id="hotel" class="bg-white rounded-2xl border border-mist shadow-sm hover:shadow-xl hover:border-burgundy/40 transition-all overflow-hidden group">
                <div id="restaurant" class="bg-sand p-8 flex items-start gap-6 border-b border-mist">
                    <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center shrink-0 shadow-xs group-hover:scale-110 transition-transform">
                        <x-heroicon-o-cake class="w-8 h-8 text-burgundy" />
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-navy mb-2">{{ __('Hotel & Restaurant') }}</h2>
                        <p class="text-sm text-ink/80 leading-relaxed">{{ __('Tjenere, bartendere, kokke, opvaskere og housekeeping til hoteller, restauranter og store events.') }}</p>
                    </div>
                </div>
                <div class="p-8">
                    <ul class="text-xs text-ink/90 space-y-2.5">
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> Tjenere & Bartendere</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> Kokke & Køkkenhjælp</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> Housekeeping & Roomservice</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> Event & Catering personale</li>
                    </ul>
                </div>
            </div>

            <!-- Rengøring -->
            <div id="cleaning" class="bg-white rounded-2xl border border-mist shadow-sm hover:shadow-xl hover:border-teal/40 transition-all overflow-hidden group">
                <div class="bg-sand p-8 flex items-start gap-6 border-b border-mist">
                    <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center shrink-0 shadow-xs group-hover:scale-110 transition-transform">
                        <x-heroicon-o-sparkles class="w-8 h-8 text-teal" />
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-navy mb-2">{{ __('Rengøring & Facility') }}</h2>
                        <p class="text-sm text-ink/80 leading-relaxed">{{ __('Erhvervsrengøring, vinduespudsning, hotelrengøring og hospitalsrengøring udført af grundige fagfolk.') }}</p>
                    </div>
                </div>
                <div class="p-8">
                    <ul class="text-xs text-ink/90 space-y-2.5">
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> Erhvervsrengøring</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> Hospitalsrengøring</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> Vinduespudsning</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> Facility Management</li>
                    </ul>
                </div>
            </div>

            <!-- Lager & Logistik -->
            <div id="warehouse" class="bg-white rounded-2xl border border-mist shadow-sm hover:shadow-xl hover:border-navy/40 transition-all overflow-hidden group">
                <div class="bg-sand p-8 flex items-start gap-6 border-b border-mist">
                    <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center shrink-0 shadow-xs group-hover:scale-110 transition-transform">
                        <x-heroicon-o-truck class="w-8 h-8 text-navy" />
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-navy mb-2">{{ __('Lager & Logistik') }}</h2>
                        <p class="text-sm text-ink/80 leading-relaxed">{{ __('Truckførere, pluk-og-pak medarbejdere samt chauffører til travle distributionscentre og lagre.') }}</p>
                    </div>
                </div>
                <div class="p-8">
                    <ul class="text-xs text-ink/90 space-y-2.5">
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> Truck- & Gaffeltruckførere</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> Pluk & Pak</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> Chauffører (B & C kørekort)</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> Lagermedarbejdere</li>
                    </ul>
                </div>
            </div>

            <!-- Kontor -->
            <div id="office" class="bg-white rounded-2xl border border-mist shadow-sm hover:shadow-xl hover:border-teal/40 transition-all overflow-hidden group">
                <div class="bg-sand p-8 flex items-start gap-6 border-b border-mist">
                    <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center shrink-0 shadow-xs group-hover:scale-110 transition-transform">
                        <x-heroicon-o-building-office class="w-8 h-8 text-teal" />
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-navy mb-2">{{ __('Kontor & Administration') }}</h2>
                        <p class="text-sm text-ink/80 leading-relaxed">{{ __('Receptionister, kundeservicemedarbejdere, bogholdere og data-entry personale til travle kontorer.') }}</p>
                    </div>
                </div>
                <div class="p-8">
                    <ul class="text-xs text-ink/90 space-y-2.5">
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> Receptionister</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> Kundeservice & Support</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> Bogholding & Økonomi</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> Data Entry & Administration</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('contact') }}" class="btn-primary inline-flex items-center gap-2 px-8 py-4 rounded-lg bg-burgundy hover:bg-burgundy-dark text-white font-bold text-base shadow-lg transition transform hover:-translate-y-0.5">
                <x-heroicon-o-chat-bubble-bottom-center-text class="w-5 h-5 text-white" /><span>{{ __('Kontakt') }} FreyaService</span><x-heroicon-o-arrow-right class="w-5 h-5 text-white" />
            </a>
        </div>
    </section>
</x-public-layout>
