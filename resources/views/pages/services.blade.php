@php
    $isEn = app()->getLocale() === 'en';
@endphp

<x-public-layout>
    <x-slot name="title">{{ __('Services & Sectors') }}</x-slot>

    <!-- Hero Header (Cream Background #FAF5F2) -->
    <section class="bg-[#FAF5F2] text-ink py-16 sm:py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden border-b border-[#EADBCC]" style="background-image:radial-gradient(rgba(90,20,41,0.035) 1.5px,transparent 0);background-size:24px 24px;">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-4xl sm:text-5xl font-black tracking-tight mb-4 text-[#5A1429]">{{ __('Services & Sectors') }}</h1>
            <p class="text-base sm:text-lg text-ink/80 max-w-2xl mx-auto leading-relaxed">{{ __('Skræddersyede bemanningsløsninger og faglærte vikarer til Danmarks førende virksomheder. Hvad enten du mangler en opvasker i aften eller 10 vikarer i tre måneder, har vi den rette løsning.') }}</p>
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

        <!-- 9 Specialized Roles Cards Grid (Matching Home Page Section Fitup) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-20 transition-all duration-300">
            <!-- 1. Dishwasher -->
            <div 
                id="dishwasher"
                x-show="activeSector === 'all' || activeSector === 'dishwasher'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                :class="activeSector === 'dishwasher' ? 'border-[#C9A24B] ring-2 ring-[#C9A24B]/70 shadow-xl' : 'border-[#EADBCC] shadow-sm'"
                class="bg-white rounded-3xl border hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col justify-between group w-full"
            >
                <!-- Top High-Quality Topic Image -->
                <div class="relative w-full h-48 sm:h-52 overflow-hidden bg-sand-200">
                    <img
                        src="{{ asset('images/dishwasher-pre-rinse.jpg') }}"
                        alt="{{ __('Dishwasher') }}"
                        loading="lazy"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-60"></div>
                </div>

                <!-- Card Content -->
                <div class="p-6 sm:p-7 flex flex-col justify-between flex-1 text-center items-center">
                    <div>
                        <!-- Card Heading -->
                        <h3 class="font-bold text-lg sm:text-xl text-[#5A1429] mb-3 leading-snug group-hover:text-brand-action transition-colors">
                            <a href="#dishwasher" @click.prevent="activeSector = 'dishwasher'" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
                                {{ $isEn ? 'Dishwasher' : 'Opvasker' }}
                            </a>
                        </h3>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-ink/75 leading-relaxed mb-6">
                            {{ $isEn 
                                ? 'Professional dishwashers and stewarding staff trained in industrial dishwashing machines, HACCP hygiene regulations, and fast-paced kitchen operations.' 
                                : 'Professionelle opvaskere og stewarding-personale med erfaring i industrielle opvaskemaskiner, HACCP-hygiejnekrav og højt arbejdstempo i professionelle køkkener.' }}
                        </p>
                    </div>

                    <!-- Bottom Outline Pill Button -->
                    <a href="{{ route('register', ['role' => 'client']) }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                        {{ $isEn ? 'Book staffing' : 'Bestil bemanding' }}
                    </a>
                </div>
            </div>

            <!-- 2. Cleaning Assistant -->
            <div 
                id="cleaning"
                x-show="activeSector === 'all' || activeSector === 'cleaning'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                :class="activeSector === 'cleaning' ? 'border-[#C9A24B] ring-2 ring-[#C9A24B]/70 shadow-xl' : 'border-[#EADBCC] shadow-sm'"
                class="bg-white rounded-3xl border hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col justify-between group w-full"
            >
                <!-- Top High-Quality Topic Image -->
                <div class="relative w-full h-48 sm:h-52 overflow-hidden bg-sand-200">
                    <img
                        src="{{ asset('images/cleaning-industry.jpg') }}"
                        alt="{{ __('Cleaning Assistant') }}"
                        loading="lazy"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-60"></div>
                </div>

                <!-- Card Content -->
                <div class="p-6 sm:p-7 flex flex-col justify-between flex-1 text-center items-center">
                    <div>
                        <!-- Card Heading -->
                        <h3 class="font-bold text-lg sm:text-xl text-[#5A1429] mb-3 leading-snug group-hover:text-brand-action transition-colors">
                            <a href="#cleaning" @click.prevent="activeSector = 'cleaning'" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
                                {{ $isEn ? 'Cleaning Assistant' : 'Rengøringsassistent' }}
                            </a>
                        </h3>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-ink/75 leading-relaxed mb-6">
                            {{ $isEn 
                                ? 'Thorough commercial cleaners for daily office maintenance, kitchen deep cleaning, hotels, and warehouse facility services.' 
                                : 'Grundige rengøringsassistenter til daglig kontorrengøring, dybderengøring af storkøkkener, hoteller og lagerfaciliteter.' }}
                            <span class="block mt-1 text-xs text-brand-muted">
                                <a href="{{ route('industries') }}#warehouse" class="underline hover:text-[#5A1429]">{{ $isEn ? 'Warehouse & facility services' : 'Lager- & erhvervsrengøring' }}</a>
                            </span>
                        </p>
                    </div>

                    <!-- Bottom Outline Pill Button -->
                    <a href="{{ route('register', ['role' => 'client']) }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                        {{ $isEn ? 'Book staffing' : 'Bestil bemanding' }}
                    </a>
                </div>
            </div>

            <!-- 3. Kitchen Assistant -->
            <div 
                id="kitchen"
                x-show="activeSector === 'all' || activeSector === 'kitchen'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                :class="activeSector === 'kitchen' ? 'border-[#C9A24B] ring-2 ring-[#C9A24B]/70 shadow-xl' : 'border-[#EADBCC] shadow-sm'"
                class="bg-white rounded-3xl border hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col justify-between group w-full"
            >
                <!-- Top High-Quality Topic Image -->
                <div class="relative w-full h-48 sm:h-52 overflow-hidden bg-sand-200">
                    <img
                        src="{{ asset('images/restaurant-industry.jpg') }}"
                        alt="{{ __('Kitchen Assistant') }}"
                        loading="lazy"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-60"></div>
                </div>

                <!-- Card Content -->
                <div class="p-6 sm:p-7 flex flex-col justify-between flex-1 text-center items-center">
                    <div>
                        <!-- Card Heading -->
                        <h3 class="font-bold text-lg sm:text-xl text-[#5A1429] mb-3 leading-snug group-hover:text-brand-action transition-colors">
                            <a href="#kitchen" @click.prevent="activeSector = 'kitchen'" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
                                {{ $isEn ? 'Kitchen Assistant' : 'Køkkenmedhjælper' }}
                            </a>
                        </h3>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-ink/75 leading-relaxed mb-6">
                            {{ $isEn 
                                ? 'Reliable kitchen assistants for mise en place, vegetable prep, cold stations, and assisting chefs during busy dining services.' 
                                : 'Pålidelige køkkenmedhjælpere til mise en place, grøntklargøring, anretning og assistance til kokke under travle serveringer.' }}
                            <span class="block mt-1 text-xs text-brand-muted">
                                <a href="{{ route('industries') }}#restaurant" class="underline hover:text-[#5A1429]">{{ $isEn ? 'View restaurant staffing' : 'Se restaurantbemanding' }}</a>
                            </span>
                        </p>
                    </div>

                    <!-- Bottom Outline Pill Button -->
                    <a href="{{ route('register', ['role' => 'client']) }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                        {{ $isEn ? 'Book staffing' : 'Bestil bemanding' }}
                    </a>
                </div>
            </div>

            <!-- 4. Chefs -->
            <div 
                id="chef"
                x-show="activeSector === 'all' || activeSector === 'chef'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                :class="activeSector === 'chef' ? 'border-[#C9A24B] ring-2 ring-[#C9A24B]/70 shadow-xl' : 'border-[#EADBCC] shadow-sm'"
                class="bg-white rounded-3xl border hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col justify-between group w-full"
            >
                <!-- Top High-Quality Topic Image -->
                <div class="relative w-full h-48 sm:h-52 overflow-hidden bg-sand-200">
                    <img
                        src="{{ asset('images/chef-grill-steaks.jpg') }}"
                        alt="{{ __('Chefs') }}"
                        loading="lazy"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-60"></div>
                </div>

                <!-- Card Content -->
                <div class="p-6 sm:p-7 flex flex-col justify-between flex-1 text-center items-center">
                    <div>
                        <!-- Card Heading -->
                        <h3 class="font-bold text-lg sm:text-xl text-[#5A1429] mb-3 leading-snug group-hover:text-brand-action transition-colors">
                            <a href="#chef" @click.prevent="activeSector = 'chef'" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
                                {{ $isEn ? 'Chefs' : 'Kokke' }}
                            </a>
                        </h3>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-ink/75 leading-relaxed mb-6">
                            {{ $isEn 
                                ? 'Skilled culinary chefs (a la carte, buffet, banquets) capable of running kitchen sections independently with top culinary standards.' 
                                : 'Faglærte og erfarne kokke (a la carte, buffet, selskaber), der kan varetage partier selvstændigt med høj gastronomisk kvalitet.' }}
                        </p>
                    </div>

                    <!-- Bottom Outline Pill Button -->
                    <a href="{{ route('register', ['role' => 'client']) }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                        {{ $isEn ? 'Book staffing' : 'Bestil bemanding' }}
                    </a>
                </div>
            </div>

            <!-- 5. Hostess / Stewards -->
            <div 
                id="steward"
                x-show="activeSector === 'all' || activeSector === 'steward'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                :class="activeSector === 'steward' ? 'border-[#C9A24B] ring-2 ring-[#C9A24B]/70 shadow-xl' : 'border-[#EADBCC] shadow-sm'"
                class="bg-white rounded-3xl border hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col justify-between group w-full"
            >
                <!-- Top High-Quality Topic Image -->
                <div class="relative w-full h-48 sm:h-52 overflow-hidden bg-sand-200">
                    <img
                        src="{{ asset('images/hotel-industry.jpg') }}"
                        alt="{{ __('Hostess / Stewards') }}"
                        loading="lazy"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-60"></div>
                </div>

                <!-- Card Content -->
                <div class="p-6 sm:p-7 flex flex-col justify-between flex-1 text-center items-center">
                    <div>
                        <!-- Card Heading -->
                        <h3 class="font-bold text-lg sm:text-xl text-[#5A1429] mb-3 leading-snug group-hover:text-brand-action transition-colors">
                            <a href="#steward" @click.prevent="activeSector = 'steward'" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
                                {{ $isEn ? 'Hostess / Stewards' : 'Værter & Værtinder' }}
                            </a>
                        </h3>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-ink/75 leading-relaxed mb-6">
                            {{ $isEn 
                                ? 'Welcoming hostesses, hosts, and stewards ensuring first-class guest reception, cloaking, and VIP hospitality services for premier hotels.' 
                                : 'Imødekommende værter, værtinder og stewards, der sikrer førsteklasses gæstemodtagelse, garderobe og VIP-service på hoteller.' }}
                            <span class="block mt-1 text-xs text-brand-muted">
                                <a href="{{ route('industries') }}#hotel" class="underline hover:text-[#5A1429]">{{ $isEn ? 'Hotel & Hospitality Staffing' : 'Hotel- & Værtindebemanding' }}</a>
                            </span>
                        </p>
                    </div>

                    <!-- Bottom Outline Pill Button -->
                    <a href="{{ route('register', ['role' => 'client']) }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                        {{ $isEn ? 'Book staffing' : 'Bestil bemanding' }}
                    </a>
                </div>
            </div>

            <!-- 6. Serving Staff -->
            <div 
                id="waiter"
                x-show="activeSector === 'all' || activeSector === 'waiter'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                :class="activeSector === 'waiter' ? 'border-[#C9A24B] ring-2 ring-[#C9A24B]/70 shadow-xl' : 'border-[#EADBCC] shadow-sm'"
                class="bg-white rounded-3xl border hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col justify-between group w-full"
            >
                <!-- Top High-Quality Topic Image -->
                <div class="relative w-full h-48 sm:h-52 overflow-hidden bg-sand-200">
                    <img
                        src="{{ asset('images/restaurant-industry.jpg') }}"
                        alt="{{ __('Serving Staff') }}"
                        loading="lazy"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-60"></div>
                </div>

                <!-- Card Content -->
                <div class="p-6 sm:p-7 flex flex-col justify-between flex-1 text-center items-center">
                    <div>
                        <!-- Card Heading -->
                        <h3 class="font-bold text-lg sm:text-xl text-[#5A1429] mb-3 leading-snug group-hover:text-brand-action transition-colors">
                            <a href="#waiter" @click.prevent="activeSector = 'waiter'" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
                                {{ $isEn ? 'Serving Staff' : 'Tjenere & Servering' }}
                            </a>
                        </h3>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-ink/75 leading-relaxed mb-6">
                            {{ $isEn 
                                ? 'Professional waitstaff and servers trained in plate service, wine presentation, order-taking, and banquet operations.' 
                                : 'Professionelle tjenere og serveringspersonale med kendskab til tallerkenservering, vinpræsentation og selskabsafvikling.' }}
                        </p>
                    </div>

                    <!-- Bottom Outline Pill Button -->
                    <a href="{{ route('register', ['role' => 'client']) }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                        {{ $isEn ? 'Book staffing' : 'Bestil bemanding' }}
                    </a>
                </div>
            </div>

            <!-- 7. Catering -->
            <div 
                id="catering"
                x-show="activeSector === 'all' || activeSector === 'catering'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                :class="activeSector === 'catering' ? 'border-[#C9A24B] ring-2 ring-[#C9A24B]/70 shadow-xl' : 'border-[#EADBCC] shadow-sm'"
                class="bg-white rounded-3xl border hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col justify-between group w-full"
            >
                <!-- Top High-Quality Topic Image -->
                <div class="relative w-full h-48 sm:h-52 overflow-hidden bg-sand-200">
                    <img
                        src="{{ asset('images/chef-pastry-piping.jpg') }}"
                        alt="{{ __('Catering') }}"
                        loading="lazy"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-60"></div>
                </div>

                <!-- Card Content -->
                <div class="p-6 sm:p-7 flex flex-col justify-between flex-1 text-center items-center">
                    <div>
                        <!-- Card Heading -->
                        <h3 class="font-bold text-lg sm:text-xl text-[#5A1429] mb-3 leading-snug group-hover:text-brand-action transition-colors">
                            <a href="#catering" @click.prevent="activeSector = 'catering'" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
                                {{ $isEn ? 'Catering' : 'Catering' }}
                            </a>
                        </h3>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-ink/75 leading-relaxed mb-6">
                            {{ $isEn 
                                ? 'Specialized catering staff for buffet assembly, temperature holding, plating, and large-scale delivery events.' 
                                : 'Specialiseret cateringpersonale til buffetopstilling, varmholdelse, anretning og store leverancer over hele landet.' }}
                        </p>
                    </div>

                    <!-- Bottom Outline Pill Button -->
                    <a href="{{ route('register', ['role' => 'client']) }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                        {{ $isEn ? 'Book staffing' : 'Bestil bemanding' }}
                    </a>
                </div>
            </div>

            <!-- 8. Canteen -->
            <div 
                id="canteen"
                x-show="activeSector === 'all' || activeSector === 'canteen'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                :class="activeSector === 'canteen' ? 'border-[#C9A24B] ring-2 ring-[#C9A24B]/70 shadow-xl' : 'border-[#EADBCC] shadow-sm'"
                class="bg-white rounded-3xl border hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col justify-between group w-full"
            >
                <!-- Top High-Quality Topic Image -->
                <div class="relative w-full h-48 sm:h-52 overflow-hidden bg-sand-200">
                    <img
                        src="{{ asset('images/canteen-industry.jpg') }}"
                        alt="{{ __('Canteen') }}"
                        loading="lazy"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-60"></div>
                </div>

                <!-- Card Content -->
                <div class="p-6 sm:p-7 flex flex-col justify-between flex-1 text-center items-center">
                    <div>
                        <!-- Card Heading -->
                        <h3 class="font-bold text-lg sm:text-xl text-[#5A1429] mb-3 leading-snug group-hover:text-brand-action transition-colors">
                            <a href="#canteen" @click.prevent="activeSector = 'canteen'" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
                                {{ $isEn ? 'Canteen' : 'Kantine' }}
                            </a>
                        </h3>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-ink/75 leading-relaxed mb-6">
                            {{ $isEn 
                                ? 'Flexible canteen personnel for corporate office lunch buffets, salad bars, employee service, and kitchen sanitation.' 
                                : 'Fleksible kantinemedarbejdere til frokostbuffeter i virksomheder, salatbar, gæstebetjening og god køkkenhygiejne.' }}
                            <span class="block mt-1 text-xs text-brand-muted">
                                <a href="{{ route('industries') }}#office" class="underline hover:text-[#5A1429]">{{ $isEn ? 'Corporate Office Canteens' : 'Kantineservice til kontorer' }}</a>
                            </span>
                        </p>
                    </div>

                    <!-- Bottom Outline Pill Button -->
                    <a href="{{ route('register', ['role' => 'client']) }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                        {{ $isEn ? 'Book staffing' : 'Bestil bemanding' }}
                    </a>
                </div>
            </div>

            <!-- 9. Events & Banquets -->
            <div 
                id="events"
                x-show="activeSector === 'all' || activeSector === 'events'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                :class="activeSector === 'events' ? 'border-[#C9A24B] ring-2 ring-[#C9A24B]/70 shadow-xl' : 'border-[#EADBCC] shadow-sm'"
                class="bg-white rounded-3xl border hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col justify-between group w-full"
            >
                <!-- Top High-Quality Topic Image -->
                <div class="relative w-full h-48 sm:h-52 overflow-hidden bg-sand-200">
                    <img
                        src="{{ asset('images/banquet-plating-rack.jpg') }}"
                        alt="{{ __('Events & Banquets') }}"
                        loading="lazy"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-60"></div>
                </div>

                <!-- Card Content -->
                <div class="p-6 sm:p-7 flex flex-col justify-between flex-1 text-center items-center">
                    <div>
                        <!-- Card Heading -->
                        <h3 class="font-bold text-lg sm:text-xl text-[#5A1429] mb-3 leading-snug group-hover:text-brand-action transition-colors">
                            <a href="#events" @click.prevent="activeSector = 'events'" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
                                {{ $isEn ? 'Events & Banquets' : 'Events & Selskaber' }}
                            </a>
                        </h3>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-ink/75 leading-relaxed mb-6">
                            {{ $isEn 
                                ? 'Energetic and experienced event staff for weddings, corporate galas, festive banquets, and large-scale celebrations.' 
                                : 'Engagerede teams til bryllupper, firmafester, konferencer og festivaler, der kræver hurtig koordination og høj energi.' }}
                        </p>
                    </div>

                    <!-- Bottom Outline Pill Button -->
                    <a href="{{ route('register', ['role' => 'client']) }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                        {{ $isEn ? 'Book staffing' : 'Bestil bemanding' }}
                    </a>
                </div>
            </div>
        </div>

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
