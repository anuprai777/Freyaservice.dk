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
                                        {{ $isEn ? 'Open 24 hours' : 'Åbent 24 timer' }}
                                    </dd>
                                </div>
                            </div>
                        </dl>

                        <!-- Social Media Links -->
                        <div class="flex flex-wrap items-center justify-between gap-4 border-t border-mist bg-sand/60 p-5 sm:px-8">
                            <span class="text-xs font-bold uppercase tracking-wider text-ink/60">{{ $isEn ? 'Follow us' : 'Følg os' }}</span>
                            <div class="flex items-center gap-3">
                                <!-- Instagram -->
                                <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="flex h-9 w-9 items-center justify-center rounded-lg bg-white border border-mist text-ink/70 hover:text-burgundy hover:border-burgundy/40 hover:bg-sand transition-all shadow-2xs">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                                    </svg>
                                </a>

                                <!-- Facebook -->
                                <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="flex h-9 w-9 items-center justify-center rounded-lg bg-white border border-mist text-ink/70 hover:text-burgundy hover:border-burgundy/40 hover:bg-sand transition-all shadow-2xs">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                    </svg>
                                </a>

                                <!-- LinkedIn -->
                                <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="flex h-9 w-9 items-center justify-center rounded-lg bg-white border border-mist text-ink/70 hover:text-burgundy hover:border-burgundy/40 hover:bg-sand transition-all shadow-2xs">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 8.76c-.88 0-1.59-.71-1.59-1.59 0-.88.71-1.59 1.59-1.59.88 0 1.59.71 1.59 1.59 0 .88-.71 1.59-1.59 1.59M5.07 18.5h2.78v-8.37H5.07v8.37z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
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
