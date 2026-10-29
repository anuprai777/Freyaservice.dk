<x-public-layout>
    <x-slot name="title">{{ __('Services & Sectors') }}</x-slot>

    <!-- Hero -->
    <section class="bg-navy text-white py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden" style="background-image:radial-gradient(rgba(246,241,233,0.07) 1.5px,transparent 0);background-size:24px 24px;">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-4xl sm:text-5xl font-black tracking-tight mb-4 text-white">{{ __('Services & Sectors') }}</h1>
            <p class="text-lg text-sand-200 max-w-2xl mx-auto">{{ __('Skræddersyede bemanningsløsninger og faglærte vikarer til Danmarks førende virksomheder. Hvad enten du mangler en opvasker i aften eller 10 vikarer i tre måneder, har vi den rette løsning.') }}</p>
        </div>
    </section>

    <!-- 6px Brand Section Divider (Burgundy, Teal, Mist segments) -->
    <div class="brand-divider">
        <div class="brand-divider-burgundy"></div>
        <div class="brand-divider-teal"></div>
        <div class="brand-divider-mist"></div>
    </div>

    <section 
        class="py-16 sm:py-20 lg:py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
        x-data="{
            activeSector: (function() {
                var h = window.location.hash.replace('#', '');
                if (['dishwasher', 'cleaning', 'kitchen', 'chef', 'steward', 'waiter', 'catering', 'canteen', 'events'].includes(h)) return h;
                if (h === 'hotel') return 'steward';
                if (h === 'restaurant') return 'kitchen';
                if (h === 'warehouse') return 'cleaning';
                if (h === 'office') return 'canteen';
                return 'all';
            })()
        }"
        x-init="window.addEventListener('hashchange', () => {
            var h = window.location.hash.replace('#', '');
            if (['dishwasher', 'cleaning', 'kitchen', 'chef', 'steward', 'waiter', 'catering', 'canteen', 'events'].includes(h)) activeSector = h;
            else if (h === 'hotel') activeSector = 'steward';
            else if (h === 'restaurant') activeSector = 'kitchen';
            else if (h === 'warehouse') activeSector = 'cleaning';
            else if (h === 'office') activeSector = 'canteen';
        })"
    >
        <!-- 3 Specific Service Models: Sand bg, 14px radius, 5px coloured top border -->
        <div class="grid md:grid-cols-3 gap-8 mb-20">
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

        <!-- Section Header for Specialized Sectors & Roles -->
        <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-10">
            <h2 class="text-3xl sm:text-4xl font-black text-navy tracking-tight mb-2">
                {{ __('Specialized sectors') }}
            </h2>
            <p class="text-xs font-semibold text-ink/60 uppercase tracking-wider mb-3">
                {{ __('Specialiserede roller inden for') }} {{ __('Healthcare') }}, {{ __('Hospitality') }} {{ __('og servicefag') }}:
            </p>
            <p class="text-sm text-ink/80 leading-relaxed max-w-2xl mx-auto">
                {{ __('Vælg en rolle for at se krav, kompetencer og erfaring for vores faglærte personale.') }}
            </p>
        </div>

        <!-- Sector Tab Bar (Themed with Official Freya Service Brand Palette: Deep Burgundy #5A1429, Champagne Gold #C9A24B, Warm Cream #FAF5F2) -->
        <div class="w-full max-w-7xl mx-auto mb-10 sm:mb-12 px-2 sm:px-4">
            <div class="overflow-x-auto overflow-y-hidden no-scrollbar pb-1">
                <div class="relative border-b-2 border-[#5A1429] min-w-full w-max flex items-end justify-start xl:justify-center gap-1 sm:gap-1.5 md:gap-2">
                    @php
                        $sectors = [
                            'all' => __('All'),
                            'dishwasher' => __('Dishwasher'),
                            'cleaning' => __('Cleaning Assistant'),
                            'kitchen' => __('Kitchen Assistant'),
                            'chef' => __('Chefs'),
                            'steward' => __('Hostess / Stewards'),
                            'waiter' => __('Serving Staff'),
                            'catering' => __('Catering'),
                            'canteen' => __('Canteen'),
                            'events' => __('Events & Banquets'),
                        ];
                    @endphp

                    @foreach($sectors as $key => $label)
                        <button
                            type="button"
                            @click="activeSector = '{{ $key }}'"
                            :class="activeSector === '{{ $key }}' 
                                ? 'border-t-2 border-l-2 border-r-2 border-b-0 border-[#5A1429] rounded-t-lg text-[#5A1429] bg-[#FAF5F2] font-bold px-3.5 sm:px-4 lg:px-4.5 py-2 sm:py-2.5 -mb-[2px] z-10' 
                                : 'border border-transparent hover:border-[#5A1429]/40 hover:bg-[#5A1429]/5 hover:rounded-lg text-[#6B5E62] hover:text-[#5A1429] font-medium px-3.5 sm:px-4 lg:px-4.5 py-2 sm:py-2.5 transition-all duration-150'"
                            class="text-xs sm:text-xs lg:text-sm whitespace-nowrap focus:outline-none shrink-0 cursor-pointer"
                        >
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- 9 Specialized Roles Cards Grid -->
        <div class="grid md:grid-cols-2 gap-8 mb-20">
            <!-- 1. Dishwasher -->
            <x-card padding="none" hover="true" id="dishwasher" class="overflow-hidden group hover:border-burgundy/40" x-show="activeSector === 'all' || activeSector === 'dishwasher'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="relative w-full h-44 sm:h-52 overflow-hidden bg-sand-200">
                    <img src="{{ asset('images/dishwasher-pre-rinse.jpg') }}" alt="{{ __('Dishwasher') }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent opacity-60"></div>
                </div>
                <div class="bg-sand p-6 sm:p-8 flex items-start gap-4 sm:gap-6 border-b border-mist">
                    <div>
                        <h3 class="text-xl font-bold text-navy mb-2">{{ __('Dishwasher') }}</h3>
                        <p class="text-sm text-ink/80 leading-relaxed">{{ __('Professionelle opvaskere og stewarding-personale med erfaring i industrielle opvaskemaskiner.') }}</p>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <ul class="text-xs text-ink/90 space-y-2.5">
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Hætteopvaskere & Båndopvaskere') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('HACCP & Fødevarehygiejne') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Hurtig afrydning og sortering') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Klar med under 2 timers varsel') }}</li>
                    </ul>
                </div>
            </x-card>

            <!-- 2. Cleaning Assistant -->
            <x-card padding="none" hover="true" id="cleaning" class="overflow-hidden group hover:border-burgundy/40" x-show="activeSector === 'all' || activeSector === 'cleaning'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="relative w-full h-44 sm:h-52 overflow-hidden bg-sand-200">
                    <img src="{{ asset('images/cleaning-industry.jpg') }}" alt="{{ __('Cleaning Assistant') }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent opacity-60"></div>
                </div>
                <div class="bg-sand p-6 sm:p-8 flex items-start gap-4 sm:gap-6 border-b border-mist">
                    <div>
                        <h3 class="text-xl font-bold text-navy mb-2">{{ __('Cleaning Assistant') }}</h3>
                        <p class="text-sm text-ink/80 leading-relaxed">{{ __('Erhvervsrengøring, dybderengøring af køkkener, hoteller og lagerfaciliteter.') }}</p>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <ul class="text-xs text-ink/90 space-y-2.5">
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Erhvervs- & kontorrengøring') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Køkkendesinfektion & Slutrengøring') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Housekeeping & Værelsesrengøring') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Lager- og facilitetsrengøring') }}</li>
                    </ul>
                </div>
            </x-card>

            <!-- 3. Kitchen Assistant -->
            <x-card padding="none" hover="true" id="kitchen" class="overflow-hidden group hover:border-navy/40" x-show="activeSector === 'all' || activeSector === 'kitchen'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="relative w-full h-44 sm:h-52 overflow-hidden bg-sand-200">
                    <img src="{{ asset('images/restaurant-industry.jpg') }}" alt="{{ __('Kitchen Assistant') }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent opacity-60"></div>
                </div>
                <div class="bg-sand p-6 sm:p-8 flex items-start gap-4 sm:gap-6 border-b border-mist">
                    <div>
                        <h3 class="text-xl font-bold text-navy mb-2">{{ __('Kitchen Assistant') }}</h3>
                        <p class="text-sm text-ink/80 leading-relaxed">{{ __('Pålidelige køkkenmedhjælpere til mise en place, grøntklargøring og assistance til kokke.') }}</p>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <ul class="text-xs text-ink/90 space-y-2.5">
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Mise en place & Råvareforberedelse') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Kolde anretninger & Salatbar') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Assistance på varme partier') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Fødevaresikkerhed og hygiejne') }}</li>
                    </ul>
                </div>
            </x-card>

            <!-- 4. Chefs -->
            <x-card padding="none" hover="true" id="chef" class="overflow-hidden group hover:border-navy/40" x-show="activeSector === 'all' || activeSector === 'chef'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="relative w-full h-44 sm:h-52 overflow-hidden bg-sand-200">
                    <img src="{{ asset('images/chef-grill-steaks.jpg') }}" alt="{{ __('Chefs') }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent opacity-60"></div>
                </div>
                <div class="bg-sand p-6 sm:p-8 flex items-start gap-4 sm:gap-6 border-b border-mist">
                    <div>
                        <h3 class="text-xl font-bold text-navy mb-2">{{ __('Chefs') }}</h3>
                        <p class="text-sm text-ink/80 leading-relaxed">{{ __('Faglærte og erfarne kokke til a la carte, buffet, selskaber og travle restauranter.') }}</p>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <ul class="text-xs text-ink/90 space-y-2.5">
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('A la carte & Selskabskokke') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Selvstændig partiledelse') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Kvalitetskontrol & Menuafvikling') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Høj gastronomisk standard') }}</li>
                    </ul>
                </div>
            </x-card>

            <!-- 5. Hostess / Stewards -->
            <x-card padding="none" hover="true" id="steward" class="overflow-hidden group hover:border-burgundy/40" x-show="activeSector === 'all' || activeSector === 'steward'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="relative w-full h-44 sm:h-52 overflow-hidden bg-sand-200">
                    <img src="{{ asset('images/hotel-industry.jpg') }}" alt="{{ __('Hostess / Stewards') }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent opacity-60"></div>
                </div>
                <div class="bg-sand p-6 sm:p-8 flex items-start gap-4 sm:gap-6 border-b border-mist">
                    <div>
                        <h3 class="text-xl font-bold text-navy mb-2">{{ __('Hostess / Stewards') }}</h3>
                        <p class="text-sm text-ink/80 leading-relaxed">{{ __('Imødekommende værter, værtinder og stewards til hoteller, VIP-arrangementer og receptioner.') }}</p>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <ul class="text-xs text-ink/90 space-y-2.5">
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Gæstemodtagelse & Registrering') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('VIP Hospitality & Loungeservice') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Garderobe & Salstilsyn') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Flersproget kundebetjening') }}</li>
                    </ul>
                </div>
            </x-card>

            <!-- 6. Serving Staff -->
            <x-card padding="none" hover="true" id="waiter" class="overflow-hidden group hover:border-teal/40" x-show="activeSector === 'all' || activeSector === 'waiter'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="relative w-full h-44 sm:h-52 overflow-hidden bg-sand-200">
                    <img src="{{ asset('images/restaurant-industry.jpg') }}" alt="{{ __('Serving Staff') }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent opacity-60"></div>
                </div>
                <div class="bg-sand p-6 sm:p-8 flex items-start gap-4 sm:gap-6 border-b border-mist">
                    <div>
                        <h3 class="text-xl font-bold text-navy mb-2">{{ __('Serving Staff') }}</h3>
                        <p class="text-sm text-ink/80 leading-relaxed">{{ __('Erfarne tjenere og serveringspersonale med kendskab til tallerkenservering og selskabsafvikling.') }}</p>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <ul class="text-xs text-ink/90 space-y-2.5">
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('A la carte & Selskabsservering') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Vinpræsentation & Bæring af 3-4 tallerkener') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Kasse- og POS-betjening') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Imødekommende gæstekontakt') }}</li>
                    </ul>
                </div>
            </x-card>

            <!-- 7. Catering -->
            <x-card padding="none" hover="true" id="catering" class="overflow-hidden group hover:border-teal/40" x-show="activeSector === 'all' || activeSector === 'catering'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="relative w-full h-44 sm:h-52 overflow-hidden bg-sand-200">
                    <img src="{{ asset('images/chef-pastry-piping.jpg') }}" alt="{{ __('Catering') }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent opacity-60"></div>
                </div>
                <div class="bg-sand p-6 sm:p-8 flex items-start gap-4 sm:gap-6 border-b border-mist">
                    <div>
                        <h3 class="text-xl font-bold text-navy mb-2">{{ __('Catering') }}</h3>
                        <p class="text-sm text-ink/80 leading-relaxed">{{ __('Specialiseret cateringpersonale til buffetopstilling, varmholdelse, anretning og store selskabsleverancer.') }}</p>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <ul class="text-xs text-ink/90 space-y-2.5">
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Buffetopstilling & Anretning') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Termobokse & Varmholdelse') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Udkørsel & Onsite assistance') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Store erhvervs- og privatleverancer') }}</li>
                    </ul>
                </div>
            </x-card>

            <!-- 8. Canteen -->
            <x-card padding="none" hover="true" id="canteen" class="overflow-hidden group hover:border-navy/40" x-show="activeSector === 'all' || activeSector === 'canteen'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="relative w-full h-44 sm:h-52 overflow-hidden bg-sand-200">
                    <img src="{{ asset('images/office-industry.jpg') }}" alt="{{ __('Canteen') }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent opacity-60"></div>
                </div>
                <div class="bg-sand p-6 sm:p-8 flex items-start gap-4 sm:gap-6 border-b border-mist">
                    <div>
                        <h3 class="text-xl font-bold text-navy mb-2">{{ __('Canteen') }}</h3>
                        <p class="text-sm text-ink/80 leading-relaxed">{{ __('Fleksible kantinemedarbejdere til frokostbuffeter i virksomheder, salatbar og gæstebetjening.') }}</p>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <ul class="text-xs text-ink/90 space-y-2.5">
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Frokostbuffet opsætning & genopfyldning') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Frisk salatbar & kolde retter') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Køkkenrengøring & Egenkontrol') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Smilende service til medarbejdere') }}</li>
                    </ul>
                </div>
            </x-card>

            <!-- 9. Events & Banquets -->
            <x-card padding="none" hover="true" id="events" class="overflow-hidden group hover:border-teal/40" x-show="activeSector === 'all' || activeSector === 'events'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="relative w-full h-44 sm:h-52 overflow-hidden bg-sand-200">
                    <img src="{{ asset('images/banquet-plating-rack.jpg') }}" alt="{{ __('Events & Banquets') }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent opacity-60"></div>
                </div>
                <div class="bg-sand p-6 sm:p-8 flex items-start gap-4 sm:gap-6 border-b border-mist">
                    <div>
                        <h3 class="text-xl font-bold text-navy mb-2">{{ __('Events & Banquets') }}</h3>
                        <p class="text-sm text-ink/80 leading-relaxed">{{ __('Engagerede teams til bryllupper, firmafester, konferencer og festivaler.') }}</p>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <ul class="text-xs text-ink/90 space-y-2.5">
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Bryllupper & Gallamiddage') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Konference- & Mødeafvikling') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Festivaler & Pop-up events') }}</li>
                        <li class="flex items-center gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal shrink-0" /> {{ __('Komplet afviklingsteam fra start til slut') }}</li>
                    </ul>
                </div>
            </x-card>
        </div>

        <!-- Why FreyaService Section Makeover -->
        <div class="bg-sand rounded-3xl border border-mist p-8 sm:p-12 mb-16 shadow-sm">
            <div class="text-center max-w-3xl mx-auto mb-12">
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
