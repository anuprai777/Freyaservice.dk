<x-public-layout>
    @php
        $isEn = app()->getLocale() === 'en';
        $phone = '+4528260926';
        $phoneLabel = '+45 28 26 09 26';
        $email = 'info@freyaservice.dk';
        $mapUrl = 'https://www.google.com/maps/search/?api=1&query=Vestergade+12%2C+1456+K%C3%B8benhavn+K';

        $departments = [
            [
                'icon' => 'phone',
                'badge' => '24/7',
                'title' => $isEn ? 'Emergency desk' : 'Vagtcentral & bemanding',
                'description' => $isEn
                    ? 'Need staff today? Our emergency desk is always staffed and ready to help.'
                    : 'Mangler du folk i dag? Vores vagtcentral er altid bemandet og klar til at hjælpe.',
                'action' => $isEn ? 'Call the emergency desk' : 'Ring til vagtcentralen',
                'href' => 'tel:'.$phone,
                'external' => false,
            ],
            [
                'icon' => 'user-group',
                'badge' => $isEn ? 'Workers' : 'Vikarer',
                'title' => $isEn ? 'Workers & HR' : 'Vikar & HR',
                'description' => $isEn
                    ? 'Questions about sign-up, documents, contracts or pay? Talk to our HR team.'
                    : 'Spørgsmål om optagelse, dokumenter, kontrakter eller løn? Kontakt vores HR-team.',
                'action' => $isEn ? 'Write to HR' : 'Skriv til HR',
                'href' => 'mailto:'.$email.'?subject='.rawurlencode($isEn ? 'Worker - HR' : 'Vikar - HR'),
                'external' => false,
            ],
            [
                'icon' => 'building-office-2',
                'badge' => $isEn ? 'Clients' : 'Kunder',
                'title' => $isEn ? 'Sales & companies' : 'Salg & virksomheder',
                'description' => $isEn
                    ? 'New agreements, quotes and help with staffing for your company.'
                    : 'Nye aftaler, tilbud og hjælp til bemanding af din virksomhed.',
                'action' => $isEn ? 'Write to sales' : 'Skriv til salg',
                'href' => 'mailto:'.$email.'?subject='.rawurlencode($isEn ? 'Company - Sales' : 'Virksomhed - Salg'),
                'external' => false,
            ],
            [
                'icon' => 'banknotes',
                'badge' => $isEn ? 'Invoices' : 'Faktura',
                'title' => $isEn ? 'Finance & invoicing' : 'Økonomi & fakturering',
                'description' => $isEn
                    ? 'Timesheets, invoices, VAT and payment questions handled by our finance team.'
                    : 'Timesedler, fakturaer, moms og betalingsspørgsmål håndteres af vores økonomiteam.',
                'action' => $isEn ? 'Write to finance' : 'Skriv til økonomi',
                'href' => 'mailto:'.$email.'?subject='.rawurlencode($isEn ? 'Invoice - Finance' : 'Faktura - Økonomi'),
                'external' => false,
            ],
        ];
    @endphp

    <x-slot name="title">{{ __('Kontakt') }}</x-slot>
    <x-slot name="metaDescription">{{ $isEn ? 'Contact Freya Service ApS - emergency desk, workers & HR, sales and finance. One company, four clear ways to reach us.' : 'Kontakt Freya Service ApS - vagtcentral, vikar & HR, salg og økonomi. Én virksomhed med fire klare kontaktveje.' }}</x-slot>

    <!-- Hero Header (Cream Background #FAF5F2) -->
    <section class="bg-[#FAF5F2] text-ink relative overflow-hidden border-b border-[#EADBCC]" style="background-image:radial-gradient(rgba(90,20,41,0.035) 1.5px,transparent 0);background-size:24px 24px;">
        <div class="absolute -top-24 -right-24 w-80 h-80 bg-burgundy/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-[#C9A24B]/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-20 relative z-10">
            <div class="grid lg:grid-cols-12 gap-10 lg:gap-16 items-center">
                <div class="lg:col-span-7">
                    <h1 class="sr-only">{{ $isEn ? 'Contact' : 'Kontakt' }}</h1>
                    <p class="text-lg sm:text-xl text-ink/80 leading-relaxed max-w-xl font-medium">
                        {{ $isEn
                            ? 'Call our 24/7 emergency desk or write directly to the department that can help you.'
                            : 'Ring til vores døgnbemandede vagtcentral eller skriv direkte til den afdeling, der kan hjælpe dig.' }}
                    </p>
                </div>

                <!-- Emergency desk panel -->
                <div class="lg:col-span-5">
                    <div class="rounded-2xl border border-[#EADBCC] bg-white p-6 sm:p-7 shadow-sm">
                        <div class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-[0.18em] text-[#5A1429]">
                            <span class="relative flex w-2.5 h-2.5">
                                <span class="absolute inline-flex w-full h-full rounded-full bg-emerald-500 opacity-60 animate-ping"></span>
                                <span class="relative inline-flex w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                            </span>
                            {{ $isEn ? 'Emergency desk open now' : 'Vagtcentral åben nu' }}
                        </div>
                        <a href="tel:{{ $phone }}" class="mt-3 block text-2xl sm:text-3xl font-black tracking-tight text-[#5A1429] hover:text-[#7B1E3A] transition-colors">
                            {{ $phoneLabel }}
                        </a>
                        <p class="mt-2 text-sm text-ink/75 leading-relaxed">
                            {{ $isEn ? 'Emergency staffing 24 hours a day, 7 days a week — all year round.' : 'Akut bemanding 24 timer i døgnet, 7 dage om ugen — hele året.' }}
                        </p>
                        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <a href="tel:{{ $phone }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-burgundy hover:bg-burgundy-dark text-white text-sm font-bold transition shadow-xs">
                                <x-heroicon-o-phone class="w-4 h-4" />
                                {{ $isEn ? 'Call now' : 'Ring nu' }}
                            </a>
                            <a href="mailto:{{ $email }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-sm font-semibold transition">
                                <x-heroicon-o-envelope class="w-4 h-4 text-[#5A1429]" />
                                {{ $isEn ? 'Write to us' : 'Skriv til os' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brand Divider -->
    <div class="brand-divider">
        <div class="brand-divider-burgundy"></div>
        <div class="brand-divider-teal"></div>
        <div class="brand-divider-mist"></div>
    </div>

    <!-- Company Structure / Departments -->
    <section class="py-16 sm:py-24 bg-brand-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mb-10 sm:mb-12">
                <span class="text-[11px] font-bold uppercase tracking-[0.2em] text-burgundy">{{ $isEn ? 'Our organization' : 'Vores organisation' }}</span>
                <h2 class="mt-3 text-2xl sm:text-4xl font-extrabold tracking-tight text-navy">
                    {{ $isEn ? 'One company, four clear routes' : 'Én virksomhed, fire klare kontaktveje' }}
                </h2>
                <p class="mt-3 text-sm sm:text-base text-ink/70 leading-relaxed">
                    {{ $isEn
                        ? 'We are organized around the people we serve. Pick the department that matches your question and get a faster answer.'
                        : 'Vi er organiseret efter dem, vi arbejder for. Vælg den afdeling, der passer til din henvendelse, og få et hurtigere svar.' }}
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ($departments as $department)
                    <article class="group relative flex h-full flex-col rounded-2xl border border-mist bg-white p-6 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md hover:border-burgundy/30">
                        <div class="mb-5 flex items-start justify-between gap-3">
                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-burgundy/10 text-burgundy transition-colors group-hover:bg-burgundy group-hover:text-white shrink-0">
                                <x-dynamic-component :component="'heroicon-o-'.$department['icon']" class="w-5 h-5" />
                            </div>
                            <span class="rounded-full border border-mist bg-sand px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-ink/60">
                                {{ $department['badge'] }}
                            </span>
                        </div>
                        <h3 class="text-base font-extrabold text-navy tracking-tight">{{ $department['title'] }}</h3>
                        <p class="mt-2 flex-1 text-sm text-ink/70 leading-relaxed">{{ $department['description'] }}</p>
                        <a href="{{ $department['href'] }}" class="mt-5 inline-flex items-center gap-1.5 text-sm font-bold text-burgundy hover:text-burgundy-dark transition-colors">
                            {{ $department['action'] }}
                            <x-heroicon-o-arrow-up-right class="w-4 h-4 transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5" />
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Company Details + Get Started -->
    <section class="py-16 sm:py-24 bg-white border-t border-mist">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-10 items-start">
                <!-- Company registration -->
                <div class="lg:col-span-7">
                    <div class="overflow-hidden rounded-2xl border border-mist bg-white shadow-xs">
                        <div class="border-b border-mist p-6 sm:p-8">
                            <div class="flex flex-wrap items-start justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-navy text-white shrink-0">
                                        <x-heroicon-o-building-office-2 class="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-extrabold text-navy tracking-tight">Freya Service ApS</h2>
                                        <p class="text-sm text-ink/60">{{ $isEn ? 'Staffing & recruitment across Denmark' : 'Vikarbureau & bemanding i hele Danmark' }}</p>
                                    </div>
                                </div>
                                <span class="rounded-full border border-mist bg-sand px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-ink/60">
                                    CVR 44556677
                                </span>
                            </div>
                        </div>

                        <dl class="divide-y divide-mist">
                            <!-- Address -->
                            <div class="flex items-start gap-4 p-5 sm:px-8">
                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-sand text-navy shrink-0">
                                    <x-heroicon-o-map-pin class="w-4 h-4" />
                                </div>
                                <div class="min-w-0">
                                    <dt class="text-[10px] font-bold uppercase tracking-wider text-ink/50">{{ $isEn ? 'Address' : 'Adresse' }}</dt>
                                    <dd class="mt-0.5 text-sm font-semibold text-navy">
                                        <a href="{{ $mapUrl }}" target="_blank" rel="noopener noreferrer" class="hover:text-burgundy transition-colors">
                                            Vestergade 12, 1456 København K
                                        </a>
                                    </dd>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-start gap-4 p-5 sm:px-8">
                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-sand text-navy shrink-0">
                                    <x-heroicon-o-phone class="w-4 h-4" />
                                </div>
                                <div class="min-w-0">
                                    <dt class="text-[10px] font-bold uppercase tracking-wider text-ink/50">{{ $isEn ? 'Phone' : 'Telefon' }}</dt>
                                    <dd class="mt-0.5 text-sm font-semibold text-navy">
                                        <a href="tel:{{ $phone }}" class="hover:text-burgundy transition-colors">{{ $phoneLabel }}</a>
                                        <span class="ml-2 text-xs font-normal text-ink/50">{{ $isEn ? '— emergency desk 24/7' : '— vagtcentral 24/7' }}</span>
                                    </dd>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-start gap-4 p-5 sm:px-8">
                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-sand text-navy shrink-0">
                                    <x-heroicon-o-envelope class="w-4 h-4" />
                                </div>
                                <div class="min-w-0">
                                    <dt class="text-[10px] font-bold uppercase tracking-wider text-ink/50">E-mail</dt>
                                    <dd class="mt-0.5 text-sm font-semibold text-navy">
                                        <a href="mailto:{{ $email }}" class="hover:text-burgundy transition-colors break-all">{{ $email }}</a>
                                        <span class="ml-2 text-xs font-normal text-ink/50">{{ $isEn ? '— reply within 2 hours' : '— svar inden for 2 timer' }}</span>
                                    </dd>
                                </div>
                            </div>

                            <!-- Registration -->
                            <div class="flex items-start gap-4 p-5 sm:px-8">
                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-sand text-navy shrink-0">
                                    <x-heroicon-o-identification class="w-4 h-4" />
                                </div>
                                <div class="min-w-0">
                                    <dt class="text-[10px] font-bold uppercase tracking-wider text-ink/50">{{ $isEn ? 'Registration' : 'Registrering' }}</dt>
                                    <dd class="mt-0.5 text-sm font-semibold text-navy">
                                        CVR 44556677 <span class="text-ink/40">·</span> {{ $isEn ? 'VAT' : 'Moms' }} DK44556677
                                    </dd>
                                </div>
                            </div>

                            <!-- Opening hours -->
                            <div class="flex items-start gap-4 p-5 sm:px-8">
                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-sand text-navy shrink-0">
                                    <x-heroicon-o-clock class="w-4 h-4" />
                                </div>
                                <div class="min-w-0">
                                    <dt class="text-[10px] font-bold uppercase tracking-wider text-ink/50">{{ $isEn ? 'Opening hours' : 'Åbningstider' }}</dt>
                                    <dd class="mt-0.5 text-sm font-semibold text-navy">
                                        {{ $isEn ? 'Emergency desk 24/7' : 'Vagtcentral 24/7' }}
                                        <span class="text-ink/40">·</span>
                                        {{ $isEn ? 'Office Mon–Fri 08:00–16:00' : 'Kontor man–fre 08.00–16.00' }}
                                    </dd>
                                </div>
                            </div>
                        </dl>

                        <div class="flex items-start gap-3 border-t border-mist bg-sand/60 p-5 sm:px-8">
                            <x-heroicon-s-shield-check class="w-4 h-4 text-teal shrink-0 mt-0.5" />
                            <p class="text-xs text-ink/70 leading-relaxed">
                                {{ $isEn
                                    ? 'No CPR numbers are stored in the system. Bank details are encrypted with AES-256. GDPR compliant and covered by the Danish collective agreement.'
                                    : 'Ingen CPR-numre gemmes i systemet. Bankoplysninger krypteres med AES-256. Vi overholder EU’s GDPR-lovgivning samt dansk overenskomst.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Get started -->
                <div class="lg:col-span-5">
                    <span class="text-[11px] font-bold uppercase tracking-[0.2em] text-burgundy">{{ $isEn ? 'Get started' : 'Kom i gang' }}</span>
                    <h2 class="mt-3 text-2xl sm:text-3xl font-extrabold tracking-tight text-navy">
                        {{ $isEn ? 'New to Freya Service?' : 'Ny hos Freya Service?' }}
                    </h2>
                    <p class="mt-3 text-sm text-ink/70 leading-relaxed">
                        {{ $isEn ? 'Create a free account in minutes — or call us and we will guide you.' : 'Opret en gratis konto på få minutter — eller ring til os, så guider vi dig.' }}
                    </p>

                    <div class="mt-6 space-y-4">
                        <!-- Companies -->
                        <div class="rounded-2xl bg-navy p-6 text-white">
                            <div class="flex items-start gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 border border-white/15 text-teal shrink-0">
                                    <x-heroicon-o-building-office class="w-5 h-5" />
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-white">{{ $isEn ? 'Company (client)' : 'Virksomhed (kunde)' }}</h3>
                                    <p class="mt-1 text-sm text-sand-300 leading-relaxed">
                                        {{ $isEn ? 'Order staff digitally and get a reply within 30 minutes.' : 'Bestil vikarer digitalt og få svar inden for 30 minutter.' }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                <a href="{{ route('register', ['role' => 'client']) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-burgundy hover:bg-burgundy-dark text-white text-sm font-bold transition border border-white/25">
                                    <x-heroicon-o-user-plus class="w-4 h-4" />
                                    {{ $isEn ? 'Create company account' : 'Opret virksomhedskonto' }}
                                </a>
                                <a href="tel:{{ $phone }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg border border-teal/60 hover:bg-white/10 text-white text-sm font-bold transition">
                                    <x-heroicon-o-phone class="w-4 h-4 text-teal" />
                                    {{ $isEn ? 'Call now' : 'Ring nu' }}
                                </a>
                            </div>
                        </div>

                        <!-- Workers -->
                        <div class="rounded-2xl border border-mist bg-white p-6">
                            <div class="flex items-start gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-teal/15 text-teal shrink-0">
                                    <x-heroicon-o-user class="w-5 h-5" />
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-navy">{{ $isEn ? 'Worker (employee)' : 'Vikar (arbejdstager)' }}</h3>
                                    <p class="mt-1 text-sm text-ink/70 leading-relaxed">
                                        {{ $isEn ? 'Find shifts, set your availability and join our network across Denmark.' : 'Find vagter, angiv din tilgængelighed og bliv en del af vores netværk i hele Danmark.' }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                <a href="{{ route('register', ['role' => 'worker']) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-burgundy hover:bg-burgundy-dark text-white text-sm font-bold transition">
                                    <x-heroicon-o-user-plus class="w-4 h-4" />
                                    {{ $isEn ? 'Sign up as worker' : 'Tilmeld dig som vikar' }}
                                </a>
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg border border-navy/30 text-navy hover:bg-navy/5 text-sm font-bold transition">
                                    <x-heroicon-o-arrow-right-end-on-rectangle class="w-4 h-4" />
                                    {{ $isEn ? 'Log in' : 'Log ind' }}
                                </a>
                            </div>
                        </div>

                        <!-- Live status -->
                        <div class="flex items-center gap-3 rounded-xl border border-mist bg-sand px-4 py-3.5">
                            <span class="relative flex w-2.5 h-2.5 shrink-0">
                                <span class="absolute inline-flex w-full h-full rounded-full bg-emerald-500 opacity-60 animate-ping"></span>
                                <span class="relative inline-flex w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                            </span>
                            <p class="text-xs text-ink/70">
                                <span class="font-bold text-navy">{{ $isEn ? 'Emergency desk open 24/7' : 'Vagtcentral åben 24/7' }}</span>
                                — {{ $isEn ? 'workers ready to respond around the clock.' : 'vikarer klar til udrykning hele døgnet.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
