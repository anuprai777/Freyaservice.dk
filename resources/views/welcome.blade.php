<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $isEn = app()->getLocale() === 'en';
        $seoTitle = $isEn
            ? 'Temp Staffing Denmark: Danish Vikarbureau | Freya Service'
            : 'Vikarbureau Danmark: Vikarer under 2 timer | Freya Service';
        $seoDescription = $isEn
            ? 'Temp staffing across Denmark for hotels, restaurants, warehouses and offices in under 2 hours. No lock-in or onboarding fees. Request vetted staff online now!'
            : 'Vikarbureau med vikarer til hotel, restaurant, lager og kontor i hele Danmark på under 2 timer. Ingen binding eller oprettelsesgebyr. Bestil vikar online nu!';
        $canonicalUrl = 'https://freyaservice.dk';
    @endphp
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">

    <!-- Favicon & Touch Icon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-icon.png') }}">

    <!-- Canonical URL & Multilingual Hreflang Tags -->
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <link rel="alternate" hreflang="da" href="https://freyaservice.dk">
    <link rel="alternate" hreflang="en" href="https://freyaservice.dk/locale/en">
    <link rel="alternate" hreflang="x-default" href="https://freyaservice.dk">

    <!-- Open Graph / Facebook / LinkedIn / WhatsApp -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Freya Service">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:image" content="{{ asset('images/og-image.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="{{ $isEn ? 'en_US' : 'da_DK' }}">
    <meta property="og:locale:alternate" content="{{ $isEn ? 'da_DK' : 'en_US' }}">

    <!-- Twitter / X Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ asset('images/og-image.png') }}">

    <!-- Structured Data (JSON-LD): EmploymentAgency + FAQPage -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "EmploymentAgency",
                "@id": "https://freyaservice.dk/#organization",
                "name": "Freya Service",
                "url": "https://freyaservice.dk",
                "logo": "https://freyaservice.dk/images/logo.png",
                "image": "https://freyaservice.dk/images/og-image.png",
                "telephone": "+4528260926",
                "email": "kontakt@freyaservice.dk",
                "vatID": "DK44556677",
                "taxID": "44556677",
                "priceRange": "$$",
                "currenciesAccepted": "DKK",
                "paymentAccepted": "Bank transfer, Invoice",
                "description": "{{ $isEn ? 'Nationwide Danish vikarbureau delivering vetted temp staff for hotels, restaurants, warehouses and offices with dispatch in under 2 hours, 100% collective agreement compliance, and no onboarding fees.' : 'Landsdækkende dansk vikarbureau der leverer godkendte vikarer til hotel, restaurant, lager og kontor på under 2 timer med 100% overenskomstdækning og ingen binding.' }}",
                "areaServed": {
                    "@type": "Country",
                    "name": "Denmark"
                },
                "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "[PLACEHOLDER: Street address, e.g. Vestergade 1]",
                    "addressLocality": "[PLACEHOLDER: City, e.g. København]",
                    "postalCode": "[PLACEHOLDER: Postal code, e.g. 1000]",
                    "addressCountry": "DK"
                },
                "openingHoursSpecification": [
                    {
                        "@type": "OpeningHoursSpecification",
                        "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
                        "opens": "00:00",
                        "closes": "23:59",
                        "description": "24/7 Emergency dispatch"
                    }
                ]
            },
            {
                "@type": "FAQPage",
                "@id": "https://freyaservice.dk/#faq",
                "mainEntity": [
                    {
                        "@type": "Question",
                        "name": "{{ $isEn ? 'How fast can I get a temp in Denmark?' : 'Hvor hurtigt kan jeg få en vikar i Danmark?' }}",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "{{ $isEn ? 'Freya Service dispatches qualified temps in under 2 hours for urgent staffing requests nationwide. Planned shifts can also be scheduled days or weeks ahead via our 24/7 emergency dispatch line (+45 28 26 09 26) or online client portal.' : 'Freya Service stiller med kvalificerede vikarer på under 2 timer ved akutte henvendelser i hele Danmark. Planlagte vagter kan bestilles dage eller uger i forvejen via vores døgnbemandede vagttelefon (+45 28 26 09 26) eller online kundeportal.' }}"
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "{{ $isEn ? 'Are there any lock-in periods or onboarding fees?' : 'Er der bindingsperiode eller oprettelsesgebyrer?' }}",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "{{ $isEn ? 'No. Freya Service operates with zero lock-in contracts, zero subscription fees, and zero onboarding fees. You only pay for the approved hours worked by the dispatched temp.' : 'Nej. Freya Service har ingen bindingsperiode, ingen abonnementer og intet oprettelsesgebyr. Du betaler udelukkende for de faktiske, godkendte timer, som vikaren udfører.' }}"
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "{{ $isEn ? 'Do Freya Service temps follow Danish collective agreements?' : 'Følger vikarerne danske overenskomster?' }}",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "{{ $isEn ? 'Yes. 100% of temporary workers dispatched by Freya Service are employed under Danish collective agreement terms (overenskomst), including statutory pension, holiday pay (feriepenge), sick pay, and mandatory workplace injury insurance.' : 'Ja. 100% af vikarer udsendt af Freya Service arbejder under gældende danske overenskomster. Dette sikrer ordnede løn- og arbejdsvilkår, feriepenge, pension, sygeløn samt lovpligtig arbejdsskadeforsikring.' }}"
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "{{ $isEn ? 'What does temp staffing cost with Freya Service?' : 'Hvad koster en vikar gennem Freya Service?' }}",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "{{ $isEn ? 'Temp staffing costs depend on the industry, job role, and shift type (day, evening, night, or weekend) in compliance with collective agreement tariffs. Base rates start from [PLACEHOLDER: DKK XXX per hour ex. VAT]. Invoicing is transparent with 25% Danish VAT and no hidden surcharges.' : 'Prisen for en vikar afhænger af branchen, stillingstypen og arbejdstidspunktet (dag, aften, nat eller weekend) i henhold til gældende overenskomster. Timeprisen starter fra [PLACEHOLDER: DKK XXX pr. time ekskl. moms]. Fakturering sker gennemskueligt med 25% moms uden skjulte tillæg.' }}"
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "{{ $isEn ? 'Which industries does Freya Service provide staff for?' : 'Hvilke brancher leverer Freya Service vikarer til?' }}",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "{{ $isEn ? 'Freya Service supplies vetted temp staff across four core industries in Denmark: hotels (reception, housekeeping), restaurants and catering (chefs, waiters, kitchen assistants), warehouses and logistics (forklift drivers, pick-and-pack), and offices (administrative, customer service).' : 'Freya Service leverer godkendte vikarer til fire primære brancher i Danmark: hotel (reception, housekeeping), restaurant og catering (kokke, tjenere, køkkenmedhjælpere), lager og logistik (truckførere, pluk og pak) samt kontor og administration.' }}"
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "{{ $isEn ? 'How does Freya Service vet and verify temp workers?' : 'Hvordan kvalitetssikres og godkendes vikarerne?' }}",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "{{ $isEn ? 'Every candidate undergoes personal interviews, reference validation, verification of valid Danish work permits, and criminal background checks prior to dispatch. On-site attendance and worked hours are verified digitally via QR-code time tracking.' : 'Alle vikarer gennemgår personlige samtaler, referencevalidering, tjek af ren straffeattest samt kontrol af gyldig arbejdstilladelse i Danmark før udsendelse. Mødetid og arbejdstimer dokumenteres digitalt via QR-kode registrering.' }}"
                        }
                    }
                ]
            }
        ]
    }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .hero-pattern {
            background-color: #5A1429;
            background-image: radial-gradient(rgba(243, 227, 230, 0.08) 1.5px, transparent 0);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="bg-brand-bg text-brand-body antialiased selection:bg-brand-secondary selection:text-white">
    <!-- Floating Toast Notifications for Form Success & Alerts -->
    <x-notification-toast />

    <!-- Top Danish / English Info Bar (Primary Dark: Deep burgundy #5A1429) -->
    <div class="bg-brand-primary text-sand-100 text-xs py-2 px-4 border-b border-navy-800">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-2">
            <div class="flex flex-wrap justify-center md:justify-start items-center gap-2 sm:gap-4 text-center sm:text-left">
                <span class="flex items-center gap-1.5">
                    <x-heroicon-o-globe-europe-africa class="w-3.5 h-3.5 text-sand-300" />
                    <span>{{ __('Landsdækkende vikarservice') }}</span>
                </span>
                <span class="hidden sm:inline text-navy-700">•</span>
                <span class="flex items-center gap-1">
                    <x-heroicon-o-phone class="w-3.5 h-3.5 text-brand-action" />
                    <span>{{ __('Akut vagttelefon') }}: <a href="tel:+4528260926" class="text-white hover:text-brand-action font-semibold">+45 28 26 09 26</a></span>
                </span>
                <span class="hidden md:inline text-navy-700">•</span>
                <span class="hidden sm:inline text-sand-300">CVR: 44556677</span>
            </div>
            <div class="flex items-center gap-3 sm:gap-4">
                <!-- Success indicator: Forest Green #2F7D5B -->
                <span class="text-forest-100 font-medium flex items-center gap-1.5 text-[11px] sm:text-xs">
                    <span class="w-2 h-2 rounded-full bg-forest animate-pulse shrink-0"></span>
                    <span>{{ __('Vikarer klar til udrykning 24/7') }}</span>
                </span>

                <!-- Top bar language switch -->
                <div class="flex items-center gap-1 text-xs font-medium" role="group" aria-label="Sprogvælger">
                    <a href="{{ route('locale.switch', 'da') }}" class="inline-flex items-center gap-1 transition-colors px-1.5 py-0.5 rounded {{ app()->getLocale() === 'da' ? 'text-white font-bold underline underline-offset-4 decoration-2 decoration-brand-action' : 'text-sand-300 hover:text-white' }}" aria-label="Skift til dansk">
                        <span>🇩🇰</span>
                        <span>DA</span>
                    </a>
                    <span class="text-navy-700 select-none">/</span>
                    <a href="{{ route('locale.switch', 'en') }}" class="inline-flex items-center gap-1 transition-colors px-1.5 py-0.5 rounded {{ app()->getLocale() === 'en' ? 'text-white font-bold underline underline-offset-4 decoration-2 decoration-brand-action' : 'text-sand-300 hover:text-white' }}" aria-label="Switch to English">
                        <span>🇬🇧</span>
                        <span>EN</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <header x-data="{ mobileOpen: false }" class="sticky top-0 z-50 bg-navy text-white border-b border-navy-800 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 sm:h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="/" class="flex items-center group shrink-0 focus-visible:ring-2 focus-visible:ring-burgundy rounded-lg focus:outline-none" aria-label="Freya Service Forside">
                <img src="{{ asset('images/logo-white.png') }}" alt="Freya Service vikarbureau logo" class="h-9 sm:h-11 md:h-12 w-auto object-contain group-hover:scale-105 transition-transform" width="180" height="48">
            </a>

            <!-- Nav Links (Matching layout style: Services, Industries, About, How It Works, Contact) -->
            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold" aria-label="Hovednavigation">
                <a href="{{ route('services') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('services') ? 'text-white border-burgundy' : 'text-sand-200 hover:text-white border-transparent hover:border-sand-300' }} focus-visible:ring-2 focus-visible:ring-burgundy rounded-sm focus:outline-none">
                    <x-heroicon-o-briefcase class="w-4 h-4 text-teal" />
                    <span>{{ __('Ydelser') }}</span>
                </a>
                <a href="{{ route('industries') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('industries') ? 'text-white border-burgundy' : 'text-sand-200 hover:text-white border-transparent hover:border-sand-300' }} focus-visible:ring-2 focus-visible:ring-burgundy rounded-sm focus:outline-none">
                    <x-heroicon-o-building-office-2 class="w-4 h-4 text-teal" />
                    <span>{{ __('Brancher') }}</span>
                </a>
                <a href="{{ route('about') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('about') ? 'text-white border-burgundy' : 'text-sand-200 hover:text-white border-transparent hover:border-sand-300' }} focus-visible:ring-2 focus-visible:ring-burgundy rounded-sm focus:outline-none">
                    <x-heroicon-o-user-group class="w-4 h-4 text-teal" />
                    <span>{{ __('Om os') }}</span>
                </a>
                <a href="{{ route('how-it-works') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('how-it-works') ? 'text-white border-burgundy' : 'text-sand-200 hover:text-white border-transparent hover:border-sand-300' }} focus-visible:ring-2 focus-visible:ring-burgundy rounded-sm focus:outline-none">
                    <x-heroicon-o-arrows-pointing-in class="w-4 h-4 text-teal" />
                    <span>{{ __('Sådan virker det') }}</span>
                </a>
                <a href="{{ route('contact') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('contact') ? 'text-white border-burgundy' : 'text-sand-200 hover:text-white border-transparent hover:border-sand-300' }} focus-visible:ring-2 focus-visible:ring-burgundy rounded-sm focus:outline-none">
                    <x-heroicon-o-chat-bubble-bottom-center-text class="w-4 h-4 text-teal" />
                    <span>{{ __('Kontakt') }}</span>
                </a>
            </nav>

            <!-- Auth Buttons -->
            <div class="flex items-center gap-2 sm:gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary border-2 border-white/35 inline-flex items-center gap-2 px-3.5 sm:px-5 py-2 sm:py-2.5 rounded-lg text-xs sm:text-sm font-bold text-white shadow-sm transition focus-visible:ring-2 focus-visible:ring-burgundy focus:outline-none">
                            <x-heroicon-o-squares-2x2 class="w-4 h-4 shrink-0" />
                            <span class="hidden sm:inline">{{ __('Min Profil / Dashboard') }}</span>
                            <span class="sm:hidden">{{ __('Dashboard') }}</span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5 hidden sm:inline shrink-0" />
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden lg:flex text-sm font-bold text-sand-200 hover:text-white px-3 py-2 rounded-lg transition items-center gap-1.5 focus-visible:ring-2 focus-visible:ring-burgundy focus:outline-none">
                            <x-heroicon-o-arrow-right-end-on-rectangle class="w-4 h-4 text-teal" />
                            <span>{{ __('Log ind') }}</span>
                        </a>

                        @if (Route::has('register'))
                            <!-- Primary CTA Button on Navy (burgundy bg with 2px rgba(255,255,255,0.35) border) -->
                            <a href="{{ route('register') }}" class="btn-primary border-2 border-white/35 hidden lg:inline-flex items-center justify-center gap-1.5 px-5 py-2.5 rounded-lg text-sm font-bold text-white shadow-md transition focus-visible:ring-2 focus-visible:ring-burgundy focus:outline-none">
                                <x-heroicon-o-user-plus class="w-4 h-4" />
                                <span>{{ __('Opret konto') }}</span>
                            </a>
                        @endif
                    @endauth
                @endif

                <!-- Mobile Hamburger Toggle Button -->
                <button @click="mobileOpen = !mobileOpen" type="button" class="lg:hidden inline-flex items-center justify-center p-2.5 min-h-[44px] min-w-[44px] rounded-lg text-sand-200 hover:text-white hover:bg-navy-800 focus-visible:ring-2 focus-visible:ring-burgundy focus:outline-none transition" aria-label="Menu" :aria-expanded="mobileOpen.toString()">
                    <x-heroicon-o-bars-3 class="h-6 w-6" x-show="!mobileOpen" />
                    <x-heroicon-o-x-mark class="h-6 w-6" x-show="mobileOpen" x-cloak />
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div x-show="mobileOpen" x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden border-t border-navy-800 bg-navy text-white shadow-xl">
            <!-- Mobile Language Selector -->
            <div class="px-4 py-3 flex items-center justify-between border-b border-navy-800 bg-navy-900/60">
                <span class="text-xs font-bold text-sand-300 uppercase tracking-wider">{{ __('Sprog / Language') }}</span>
                <div class="flex items-center gap-1 bg-navy-950 p-1 rounded-lg border border-navy-800 text-xs">
                    <a href="{{ route('locale.switch', 'da') }}" class="px-3 py-1.5 min-h-[36px] rounded-md transition flex items-center gap-1.5 {{ app()->getLocale() === 'da' ? 'bg-burgundy text-white font-bold' : 'text-sand-300 hover:text-white' }}">
                        <span>🇩🇰</span><span>Dansk</span>
                    </a>
                    <a href="{{ route('locale.switch', 'en') }}" class="px-3 py-1.5 min-h-[36px] rounded-md transition flex items-center gap-1.5 {{ app()->getLocale() === 'en' ? 'bg-burgundy text-white font-bold' : 'text-sand-300 hover:text-white' }}">
                        <span>🇬🇧</span><span>English</span>
                    </a>
                </div>
            </div>

            <!-- Mobile Navigation Links -->
            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('services') }}" class="flex items-center gap-3 px-3 py-2.5 min-h-[44px] rounded-lg text-sm font-semibold transition {{ request()->routeIs('services') ? 'bg-navy-800 text-white font-bold border-l-4 border-burgundy' : 'text-sand-200 hover:bg-navy-800 hover:text-white' }} focus-visible:ring-2 focus-visible:ring-burgundy focus:outline-none">
                    <x-heroicon-o-briefcase class="w-5 h-5 text-teal" />
                    <span>{{ __('Ydelser') }}</span>
                </a>
                <a href="{{ route('industries') }}" class="flex items-center gap-3 px-3 py-2.5 min-h-[44px] rounded-lg text-sm font-semibold transition {{ request()->routeIs('industries') ? 'bg-navy-800 text-white font-bold border-l-4 border-burgundy' : 'text-sand-200 hover:bg-navy-800 hover:text-white' }} focus-visible:ring-2 focus-visible:ring-burgundy focus:outline-none">
                    <x-heroicon-o-building-office-2 class="w-5 h-5 text-teal" />
                    <span>{{ __('Brancher') }}</span>
                </a>
                <a href="{{ route('about') }}" class="flex items-center gap-3 px-3 py-2.5 min-h-[44px] rounded-lg text-sm font-semibold transition {{ request()->routeIs('about') ? 'bg-navy-800 text-white font-bold border-l-4 border-burgundy' : 'text-sand-200 hover:bg-navy-800 hover:text-white' }} focus-visible:ring-2 focus-visible:ring-burgundy focus:outline-none">
                    <x-heroicon-o-user-group class="w-5 h-5 text-teal" />
                    <span>{{ __('Om os') }}</span>
                </a>
                <a href="{{ route('how-it-works') }}" class="flex items-center gap-3 px-3 py-2.5 min-h-[44px] rounded-lg text-sm font-semibold transition {{ request()->routeIs('how-it-works') ? 'bg-navy-800 text-white font-bold border-l-4 border-burgundy' : 'text-sand-200 hover:bg-navy-800 hover:text-white' }} focus-visible:ring-2 focus-visible:ring-burgundy focus:outline-none">
                    <x-heroicon-o-arrows-pointing-in class="w-5 h-5 text-teal" />
                    <span>{{ __('Sådan virker det') }}</span>
                </a>
                <a href="{{ route('contact') }}" class="flex items-center gap-3 px-3 py-2.5 min-h-[44px] rounded-lg text-sm font-semibold transition {{ request()->routeIs('contact') ? 'bg-navy-800 text-white font-bold border-l-4 border-burgundy' : 'text-sand-200 hover:bg-navy-800 hover:text-white' }} focus-visible:ring-2 focus-visible:ring-burgundy focus:outline-none">
                    <x-heroicon-o-chat-bubble-bottom-center-text class="w-5 h-5 text-teal" />
                    <span>{{ __('Kontakt') }}</span>
                </a>
            </div>

            <!-- Mobile Auth / CTA -->
            <div class="p-4 border-t border-navy-800">
                @auth
                    <a href="{{ url('/dashboard') }}" class="w-full btn-primary border-2 border-white/35 inline-flex items-center justify-center gap-2 px-5 py-3 min-h-[44px] rounded-lg text-sm font-bold text-white shadow-md transition">
                        <x-heroicon-o-squares-2x2 class="w-5 h-5" />
                        <span>{{ __('Gå til Dashboard') }}</span>
                        <x-heroicon-o-arrow-right class="w-4 h-4" />
                    </a>
                @else
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('login') }}" class="btn-secondary border-2 border-teal bg-transparent text-white hover:bg-teal/10 inline-flex items-center justify-center gap-1.5 px-4 py-2.5 min-h-[44px] rounded-lg text-sm font-bold transition">
                            <x-heroicon-o-arrow-right-end-on-rectangle class="w-4 h-4 text-teal" />
                            <span>{{ __('Log ind') }}</span>
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary border-2 border-white/35 inline-flex items-center justify-center gap-1.5 px-4 py-2.5 min-h-[44px] rounded-lg text-sm font-bold text-white shadow-sm transition">
                            <x-heroicon-o-user-plus class="w-4 h-4" />
                            <span>{{ __('Opret konto') }}</span>
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    @php
        $isEn = app()->getLocale() === 'en';
        $words1 = $isEn ? ['Temp', 'Full-time', 'Part-time'] : ['Vikar', 'Fast', 'Fleksibel'];
        $words2 = $isEn ? ['temps', 'staff', 'workers'] : ['vikarer', 'medarbejdere', 'personale'];
    @endphp

    <!-- Hero Section with Authentic Colleagues in Background & 3D Flip Headline -->
    <section id="heroSection" class="relative text-white min-h-[calc(100vh-100px)] sm:min-h-[calc(100vh-116px)] min-h-[calc(100dvh-100px)] sm:min-h-[calc(100dvh-116px)] flex flex-col justify-center py-12 sm:py-16 md:py-20 px-4 sm:px-6 lg:px-8 overflow-hidden bg-[#5A1429]">

        <!-- Background Image Layer: Authentic Freya Service Colleagues in Action -->
        <div class="absolute inset-0 w-full h-full overflow-hidden pointer-events-none select-none z-0">
            <img 
                id="heroBg1" 
                src="{{ asset('images/banquet-plating-rack.jpg') }}" 
                alt="Freya Service kolleger på arbejde" 
                class="absolute inset-0 w-full h-full object-cover object-center filter brightness-[0.88] contrast-[1.05] saturate-[1.05] transition-opacity duration-1000 ease-in-out opacity-100 scale-100"
                loading="eager"
                fetchpriority="high"
            >
            <img 
                id="heroBg2" 
                src="{{ asset('images/chef-grill-steaks.jpg') }}" 
                alt="Freya Service kolleger på arbejde" 
                class="absolute inset-0 w-full h-full object-cover object-center filter brightness-[0.88] contrast-[1.05] saturate-[1.05] transition-opacity duration-1000 ease-in-out opacity-0 scale-100"
                loading="lazy"
            >
            <!-- Balanced Burgundy Brand Wash: Keeps image clearly visible while preserving high text contrast -->
            <div class="absolute inset-0 bg-gradient-to-b from-[#5A1429]/65 via-[#5A1429]/40 to-[#5A1429]/75"></div>
            <div class="absolute inset-0 bg-black/20"></div>
        </div>

        <div class="max-w-5xl mx-auto w-full relative z-10 flex flex-col items-center text-center">
            
            <!-- Sleek 16+ Years Experience Badge (No Rounded Circle) -->
            <div class="mb-6 flex justify-center">
                <x-experience-badge />
            </div>

            <!-- Headline (H1): Exactly one H1 in sentence case with verified claims -->
            <h1 
                id="heroHeadline" 
                class="font-black tracking-tight leading-[1.18] text-white max-w-4xl mx-auto text-center drop-shadow-md"
                style="font-size: clamp(2rem, 5.6vw, 4rem);"
                aria-live="polite"
                data-words1='@json($words1)'
                data-words2='@json($words2)'
            >
                @if($isEn)
                    <span class="hero-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span id="flipWord1" class="hero-flip-word" style="color:#C9A24B; display:inline-block; white-space:nowrap; transform-origin:50% 50%;">Temp</span></span> staffing in Denmark: vetted <span class="hero-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span id="flipWord2" class="hero-flip-word" style="color:#C9A24B; display:inline-block; white-space:nowrap; transform-origin:50% 50%;">temps</span></span> ready in under 2 hours
                @else
                    <span class="hero-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span id="flipWord1" class="hero-flip-word" style="color:#C9A24B; display:inline-block; white-space:nowrap; transform-origin:50% 50%;">Vikar</span></span>bureau i Danmark: godkendte <span class="hero-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span id="flipWord2" class="hero-flip-word" style="color:#C9A24B; display:inline-block; white-space:nowrap; transform-origin:50% 50%;">vikarer</span></span> klar på under 2 timer
                @endif
            </h1>

            <!-- Intro Copy: Plain, specific language with main keyword, vikarbureau, 16+ years exp and core offer -->
            <p class="mt-6 text-base sm:text-lg lg:text-xl text-sand-100 max-w-3xl mx-auto text-center leading-relaxed drop-shadow-md">
                {{ __('With 16+ years of experience, Freya Service is a Danish vikarbureau providing nationwide temp staffing for hotels, restaurants, warehouses and offices in under 2 hours, with no lock-in or onboarding fees.') }}
            </p>

            <!-- Action Bar (CTA Buttons) -->
            <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-4 w-full sm:w-auto max-w-md sm:max-w-none">
                <!-- Primary CTA Button (Burgundy #7B1E3A, white text, 8px radius, bold; 2px border rgba(255,255,255,0.35) on navy) -->
                @auth
                    @if(auth()->user()->isClient())
                        <a href="{{ route('client.requests.create') }}" class="btn-primary border-2 border-white/35 inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-lg text-base font-extrabold text-white bg-burgundy hover:bg-burgundy-dark shadow-lg transition-all transform hover:-translate-y-0.5 min-h-[48px]">
                            <x-heroicon-o-briefcase class="w-5 h-5 text-white shrink-0" />
                            <span>{{ __('Bestil vikar nu') }}</span>
                            <x-heroicon-o-arrow-right class="w-5 h-5 shrink-0" />
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn-primary border-2 border-white/35 inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-lg text-base font-extrabold text-white bg-burgundy hover:bg-burgundy-dark shadow-lg transition-all transform hover:-translate-y-0.5 min-h-[48px]">
                            <x-heroicon-o-briefcase class="w-5 h-5 text-white shrink-0" />
                            <span>{{ __('Bestil vikar nu') }}</span>
                            <x-heroicon-o-arrow-right class="w-5 h-5 shrink-0" />
                        </a>
                    @endif
                @else
                    <a href="{{ route('register', ['role' => 'client']) }}" class="btn-primary border-2 border-white/35 inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-lg text-base font-extrabold text-white bg-burgundy hover:bg-burgundy-dark shadow-lg transition-all transform hover:-translate-y-0.5 min-h-[48px]">
                        <x-heroicon-o-briefcase class="w-5 h-5 text-white shrink-0" />
                        <span>{{ __('Bestil vikar nu') }}</span>
                        <x-heroicon-o-arrow-right class="w-5 h-5 shrink-0" />
                    </a>
                @endauth

                <!-- Secondary CTA Button (Transparent with 2px teal border, white text on navy) -->
                @auth
                    <a href="{{ auth()->user()->isWorker() ? route('worker.dashboard') : route('dashboard') }}" class="btn-secondary border-2 border-teal bg-transparent text-white hover:bg-teal/10 inline-flex items-center justify-center gap-2 px-8 py-4 rounded-lg text-base font-bold transition min-h-[48px]">
                        <x-heroicon-o-user-plus class="w-5 h-5 shrink-0 text-teal" />
                        <span>{{ __('Tilmeld dig som vikar') }}</span>
                    </a>
                @else
                    <a href="{{ route('register', ['role' => 'worker']) }}" class="btn-secondary border-2 border-teal bg-transparent text-white hover:bg-teal/10 inline-flex items-center justify-center gap-2 px-8 py-4 rounded-lg text-base font-bold transition min-h-[48px]">
                        <x-heroicon-o-user-plus class="w-5 h-5 shrink-0 text-teal" />
                        <span>{{ __('Tilmeld dig som vikar') }}</span>
                    </a>
                @endauth
            </div>
        </div>
    </section>



    <!-- Styles & Vanilla JS for 3D Headline Flip -->
    <style>
        .hero-flip-container {
            display: inline-block;
            white-space: nowrap;
            perspective: 600px;
            vertical-align: baseline;
        }
        .hero-flip-word {
            display: inline-block;
            white-space: nowrap;
            color: #C9A24B;
            transform-origin: 50% 50%;
            transform-style: preserve-3d;
            backface-visibility: hidden;
            will-change: transform, opacity;
        }
        @media (prefers-reduced-motion: reduce) {
            .hero-flip-word {
                transition: none !important;
                transform: none !important;
                opacity: 1 !important;
            }
        }
    </style>
    <script>
        (function() {
            function initHeroFlip() {
                var headline = document.getElementById('heroHeadline');
                var flipWord1 = document.getElementById('flipWord1');
                var flipWord2 = document.getElementById('flipWord2');

                if (!headline || !flipWord1 || !flipWord2) return;

                var words1 = [];
                var words2 = [];
                try {
                    words1 = JSON.parse(headline.getAttribute('data-words1') || '[]');
                    words2 = JSON.parse(headline.getAttribute('data-words2') || '[]');
                } catch(e) {
                    return;
                }

                if (!words1.length || words1.length !== words2.length) return;

                var currentIndex = 0;
                var isAnimating = false;
                var timer = null;

                var prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

                function setWordDirect(index) {
                    currentIndex = index;
                    flipWord1.textContent = words1[index];
                    flipWord2.textContent = words2[index];
                }

                function animateFlip(nextIndex) {
                    if (isAnimating) return;
                    if (prefersReducedMotion) {
                        setWordDirect(nextIndex);
                        return;
                    }

                    isAnimating = true;

                    // Phase 1: rotateX 0 to -90deg, fade out, 0.38s
                    var outTransition = 'transform 0.38s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.38s ease';
                    flipWord1.style.transition = outTransition;
                    flipWord2.style.transition = outTransition;
                    flipWord1.style.transform = 'perspective(600px) rotateX(-90deg)';
                    flipWord2.style.transform = 'perspective(600px) rotateX(-90deg)';
                    flipWord1.style.opacity = '0';
                    flipWord2.style.opacity = '0';

                    setTimeout(function() {
                        currentIndex = nextIndex;
                        flipWord1.textContent = words1[nextIndex];
                        flipWord2.textContent = words2[nextIndex];

                        // Prepare rotate-in from 90deg (instant, no transition)
                        flipWord1.style.transition = 'none';
                        flipWord2.style.transition = 'none';
                        flipWord1.style.transform = 'perspective(600px) rotateX(90deg)';
                        flipWord2.style.transform = 'perspective(600px) rotateX(90deg)';
                        flipWord1.style.opacity = '0';
                        flipWord2.style.opacity = '0';

                        // Force DOM reflow
                        void flipWord1.offsetWidth;

                        // Phase 2: rotateX 90deg to 0, fade in, 0.38s
                        var inTransition = 'transform 0.38s cubic-bezier(0.2, 0, 0.2, 1), opacity 0.38s ease-out';
                        flipWord1.style.transition = inTransition;
                        flipWord2.style.transition = inTransition;
                        flipWord1.style.transform = 'perspective(600px) rotateX(0deg)';
                        flipWord2.style.transform = 'perspective(600px) rotateX(0deg)';
                        flipWord1.style.opacity = '1';
                        flipWord2.style.opacity = '1';

                        setTimeout(function() {
                            isAnimating = false;
                        }, 380);
                    }, 380);
                }

                // Auto-rotation every 2.5 seconds (unless prefers-reduced-motion)
                if (!prefersReducedMotion) {
                    timer = setInterval(function() {
                        var nextIndex = (currentIndex + 1) % words1.length;
                        animateFlip(nextIndex);
                    }, 2500);
                }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initHeroFlip);
            } else {
                initHeroFlip();
            }
        })();

        // Gentle crossfade between authentic colleague background photos
        (function() {
            var bgImages = [
                "{{ asset('images/banquet-plating-rack.jpg') }}",
                "{{ asset('images/chef-grill-steaks.jpg') }}",
                "{{ asset('images/chef-pastry-piping.jpg') }}",
                "{{ asset('images/dishwasher-pre-rinse.jpg') }}"
            ];
            var bgIndex = 0;
            var bg1 = document.getElementById('heroBg1');
            var bg2 = document.getElementById('heroBg2');
            var activeBg = 1;
            var prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            if (!prefersReducedMotion && bg1 && bg2 && bgImages.length > 1) {
                setInterval(function() {
                    bgIndex = (bgIndex + 1) % bgImages.length;
                    var nextSrc = bgImages[bgIndex];
                    if (activeBg === 1) {
                        bg2.src = nextSrc;
                        bg2.style.opacity = '1';
                        bg1.style.opacity = '0';
                        activeBg = 2;
                    } else {
                        bg1.src = nextSrc;
                        bg1.style.opacity = '1';
                        bg2.style.opacity = '0';
                        activeBg = 1;
                    }
                }, 7500);
            }
        })();
    </script>

    <!-- Why Choose Freya Service Section (Comprehensive Makeover: Premium, Structured & Trust-Building) -->
    <section id="why-choose" class="py-24 bg-gradient-to-b from-brand-bg via-brand-surface to-brand-bg border-y border-brand-border relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#5A1429 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Bento Grid (Structured Table Layout Matching Reference Image) -->
            <div class="bg-white border border-neutral-300 rounded-2xl lg:rounded-3xl shadow-sm relative overflow-hidden mb-12">
                <!-- Top Row (3 Columns on Desktop) -->
                <div class="grid grid-cols-1 lg:grid-cols-3">
                    <!-- Top Col 1: Why Choose Header & Relatable Narrative -->
                    <div class="p-8 sm:p-10 flex flex-col justify-center bg-sand/20">
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-navy tracking-tight leading-tight mb-4">
                            {{ $isEn ? 'Why Choose' : 'Hvorfor vælge' }}<br>
                            <span class="text-burgundy">Freya Service</span> ?
                        </h2>
                        <p class="text-xs sm:text-sm text-ink/75 leading-relaxed">
                            {{ $isEn
                                ? 'At Freya Service, we offer more than just temp staffing. Founded on 16 years of hands-on chef and hospitality experience, we provide vetted, reliable professionals who truly understand the pressure, standards, and pace of your workplace.'
                                : 'Hos Freya Service tilbyder vi mere end blot vikardækning. Grundlagt på 16 års praktisk kokerfaring fra restaurationsbranchen leverer vi godkendte, motiverede vikarer, der forstår presset, tempoet og standarderne på din arbejdsplads.' }}
                        </p>
                    </div>

                    <!-- Top Col 2: Urgent Dispatch -->
                    <div class="p-8 sm:p-10 flex flex-col justify-start border-t lg:border-t-0 lg:border-l border-neutral-300">
                        <div class="w-12 h-12 rounded-xl bg-burgundy/10 flex items-center justify-center mb-6">
                            <x-heroicon-o-bolt class="w-7 h-7 text-burgundy" />
                        </div>
                        <h3 class="text-base sm:text-lg font-bold text-navy mb-2.5 leading-snug">
                            {{ $isEn ? 'Urgent dispatch in' : 'Akut udrykning på' }}
                            <span class="font-extrabold text-burgundy">{{ $isEn ? 'under 2 hours' : 'under 2 timer' }}</span>
                            {{ $isEn ? 'nationwide' : 'i hele Danmark' }}
                        </h3>
                        <p class="text-xs sm:text-sm text-ink/70 leading-relaxed">
                            {{ $isEn
                                ? 'When sudden illness or peak workloads hit, we dispatch experienced workers within under 2 hours across Denmark 24/7.'
                                : 'Når akut sygdom rammer eller travlheden spidser til, stiller vores erfarne vikarer med få timers varsel i hele landet døgnet rundt.' }}
                        </p>
                    </div>

                    <!-- Top Col 3: Thoroughly Vetted -->
                    <div class="p-8 sm:p-10 flex flex-col justify-start border-t lg:border-t-0 lg:border-l border-neutral-300">
                        <div class="w-12 h-12 rounded-xl bg-teal/10 flex items-center justify-center mb-6">
                            <x-heroicon-o-shield-check class="w-7 h-7 text-teal" />
                        </div>
                        <h3 class="text-base sm:text-lg font-bold text-navy mb-2.5 leading-snug">
                            <span class="font-extrabold text-teal">{{ $isEn ? '100% vetted' : '100% godkendte' }}</span>
                            {{ $isEn ? '& personally interviewed staff' : '& personligt screenede vikarer' }}
                        </h3>
                        <p class="text-xs sm:text-sm text-ink/70 leading-relaxed">
                            {{ $isEn
                                ? 'Every temp is interviewed personally, with verified criminal records, work permits and validated references before deployment.'
                                : 'Alle vikarer gennemgår personlig samtale, referencetjek, ren straffeattest og validerede arbejdstilladelser før udsendelse.' }}
                        </p>
                    </div>
                </div>

                <!-- Golden 4-Point Sparkle Star at Grid Intersection (Matching Reference Image) -->
                <div class="hidden lg:flex absolute left-1/3 top-1/2 -translate-x-1/2 -translate-y-1/2 z-20 items-center justify-center pointer-events-none" aria-hidden="true">
                    <svg class="w-8 h-8 text-[#C9A24B] drop-shadow-sm" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 0L14.59 9.41L24 12L14.59 14.59L12 24L9.41 14.59L0 12L9.41 9.41L12 0Z" />
                    </svg>
                </div>

                <!-- Bottom Row (4 Columns on Desktop) -->
                <div class="border-t border-neutral-300 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Bottom Col 1: Right Person Match -->
                    <div class="p-8 sm:p-10 flex flex-col justify-start">
                        <div class="w-12 h-12 rounded-xl bg-navy/10 flex items-center justify-center mb-6">
                            <x-heroicon-o-user-group class="w-7 h-7 text-navy" />
                        </div>
                        <h3 class="text-base font-bold text-navy mb-2.5 leading-snug">
                            <span class="font-extrabold text-navy">{{ $isEn ? 'The right person' : 'Det rette menneske' }}</span>
                            {{ $isEn ? 'in the right place, at the right time' : 'på det rette sted, til rette tid' }}
                        </h3>
                        <p class="text-xs sm:text-sm text-ink/70 leading-relaxed">
                            {{ $isEn
                                ? 'Matched based on operational culinary insight, workplace expectations, and individual strengths.'
                                : 'Matcher baseret på reel køkkenforståelse og arbejdsstil, så vikaren passer direkte ind i dit faste team.' }}
                        </p>
                    </div>

                    <!-- Bottom Col 2: Collective Agreement Compliance -->
                    <div class="p-8 sm:p-10 flex flex-col justify-start border-t sm:border-t-0 sm:border-l border-neutral-300">
                        <div class="w-12 h-12 rounded-xl bg-teal/10 flex items-center justify-center mb-6">
                            <x-heroicon-o-scale class="w-7 h-7 text-teal" />
                        </div>
                        <h3 class="text-base font-bold text-navy mb-2.5 leading-snug">
                            <span class="font-extrabold text-teal">{{ $isEn ? '100% collective agreement' : '100% overenskomstdækket' }}</span>
                            {{ $isEn ? 'terms & legal safety' : 'og juridisk tryghed' }}
                        </h3>
                        <p class="text-xs sm:text-sm text-ink/70 leading-relaxed">
                            {{ $isEn
                                ? 'Strict compliance with Danish collective agreements, statutory pension, holiday pay, and mandatory accident insurance.'
                                : 'Garant for overenskomstmæssig løn, feriepenge, pension og lovpligtig arbejdsskadeforsikring på alle vagter.' }}
                        </p>
                    </div>

                    <!-- Bottom Col 3: Digital QR Timesheets -->
                    <div class="p-8 sm:p-10 flex flex-col justify-start border-t lg:border-t-0 sm:border-t lg:border-l sm:border-l-0 lg:border-l-neutral-300 border-neutral-300">
                        <div class="w-12 h-12 rounded-xl bg-burgundy/10 flex items-center justify-center mb-6">
                            <x-heroicon-o-qr-code class="w-7 h-7 text-burgundy" />
                        </div>
                        <h3 class="text-base font-bold text-navy mb-2.5 leading-snug">
                            <span class="font-extrabold text-burgundy">{{ $isEn ? 'Digital QR check-in' : 'Digital QR-tjek ind' }}</span>
                            {{ $isEn ? '& automated timesheets' : '& automatiske timesedler' }}
                        </h3>
                        <p class="text-xs sm:text-sm text-ink/70 leading-relaxed">
                            {{ $isEn
                                ? 'Accurate check-in and check-out via on-site QR code. Zero manual paper timesheets – verified hours approved online.'
                                : 'Ingen manuelle papirsedler. Præcis stempling on-site via QR-kode og digital godkendelse direkte i din portal.' }}
                        </p>
                    </div>

                    <!-- Bottom Col 4: Zero Lock-in & Direct Support -->
                    <div class="p-8 sm:p-10 flex flex-col justify-start border-t sm:border-t lg:border-t-0 sm:border-l border-neutral-300">
                        <div class="w-12 h-12 rounded-xl bg-navy/10 flex items-center justify-center mb-6">
                            <x-heroicon-o-hand-raised class="w-7 h-7 text-navy" />
                        </div>
                        <h3 class="text-base font-bold text-navy mb-2.5 leading-snug">
                            <span class="font-extrabold text-navy">{{ $isEn ? 'Zero lock-in' : 'Ingen binding' }}</span>{{ $isEn ? ', clear pricing & 24/7 hotline' : ', faste priser og 24/7 vagttelefon' }}
                        </h3>
                        <p class="text-xs sm:text-sm text-ink/70 leading-relaxed">
                            {{ $isEn
                                ? 'Zero onboarding fees or surprise charges. You only pay for approved hours worked with direct advisor support.'
                                : 'Ingen oprettelsesgebyrer eller uigennemskuelige tillæg. Du betaler udelukkende for faktiske godkendte timer.' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Trust Bar / Key Metrics Strip (Retaining All Verified Claims) -->
            <div class="bg-navy text-white rounded-3xl p-8 sm:p-10 shadow-2xl relative overflow-hidden border border-navy-800">
                <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-6 text-center relative z-10">
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-navy-950 border border-navy-800 lg:border-0 lg:bg-transparent lg:p-0">
                        <div class="text-2xl sm:text-4xl font-black text-[#C9A24B] tracking-tight">&lt; 2t</div>
                        <div class="text-[11px] sm:text-xs text-sand-200 font-medium mt-1">{{ __('Average response time') }}</div>
                    </div>
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-navy-950 border border-navy-800 lg:border-0 lg:bg-transparent lg:p-0 lg:border-l lg:border-navy-700 lg:pl-6">
                        <div class="text-2xl sm:text-4xl font-black text-white tracking-tight">100%</div>
                        <div class="text-[11px] sm:text-xs text-sand-200 font-medium mt-1">{{ __('Collective agreement compliance') }}</div>
                    </div>
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-navy-950 border border-navy-800 lg:border-0 lg:bg-transparent lg:p-0 lg:border-l lg:border-navy-700 lg:pl-6">
                        <div class="text-2xl sm:text-4xl font-black text-white tracking-tight">2.500+</div>
                        <div class="text-[11px] sm:text-xs text-sand-200 font-medium mt-1">{{ __('Vetted active temps') }}</div>
                    </div>
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-navy-950 border border-navy-800 lg:border-0 lg:bg-transparent lg:p-0 lg:border-l lg:border-navy-700 lg:pl-6">
                        <div class="text-2xl sm:text-4xl font-black text-[#C9A24B] tracking-tight">98%</div>
                        <div class="text-[11px] sm:text-xs text-sand-200 font-medium mt-1">{{ __('Client satisfaction') }}</div>
                    </div>
                    <div class="col-span-2 lg:col-span-1 p-3.5 sm:p-4 rounded-2xl bg-navy-950 border border-navy-800 lg:border-0 lg:bg-transparent lg:p-0 lg:border-l lg:border-navy-700 lg:pl-6">
                        <div class="text-2xl sm:text-4xl font-black text-[#C9A24B] tracking-tight">24/7</div>
                        <div class="text-[11px] sm:text-xs text-sand-200 font-medium mt-1">
                            <a href="tel:+4528260926" class="hover:text-[#C9A24B] transition-colors focus-visible:ring-2 focus-visible:ring-teal rounded">{{ __('Emergency dispatch') }}: +45 28 26 09 26</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Industries Section (Hotel, Restaurant, Warehouse, Office with Links and One-line Descriptions) -->
    <section id="industries" class="py-20 bg-sand-200/50 border-y border-brand-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-10">
                <div class="text-xs font-bold text-burgundy uppercase tracking-widest mb-3">{{ __('Specialized sectors') }}</div>
                <h2 class="text-3xl sm:text-4xl font-black text-navy tracking-tight">
                    {{ __('Industries we staff with qualified temps') }}
                </h2>
                <p class="mt-3 text-sm text-ink/80 leading-relaxed">
                    {{ __('Freya Service provides pre-screened temporary workers across four core sectors in Denmark, matching required certifications, experience and language skills to every shift.') }}
                </p>
            </div>

            <!-- Sector Tags Chip Group (mist background with ink text, teal bg with white text on every 3rd tag) -->
            <div class="flex flex-wrap justify-center gap-2.5 max-w-4xl mx-auto mb-12 sector-tags">
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

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- 1. Hotel Temps -->
                <div class="bg-brand-surface p-6 rounded-2xl border border-brand-border text-center hover:shadow-xl transition-all duration-300 group flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-action-50 text-brand-action flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <x-heroicon-o-building-office class="w-8 h-8 text-brand-action" />
                        </div>
                        <h3 class="font-bold text-lg text-brand-secondary mb-2 group-hover:text-brand-action transition-colors">
                            <a href="{{ route('industries') }}#hotel" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
                                {{ __('Hotel temps') }}
                            </a>
                        </h3>
                        <p class="text-xs text-brand-muted leading-relaxed">
                            {{ __('Experienced receptionists, night auditors and housekeeping staff for hotels across Denmark.') }}
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-brand-border/60">
                        <a href="{{ route('industries') }}#hotel" class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-action hover:text-brand-action-hover focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none transition-colors">
                            <span>{{ __('Read about hotel staffing') }}</span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                        </a>
                    </div>
                </div>

                <!-- 2. Restaurant & Catering Temps -->
                <div class="bg-brand-surface p-6 rounded-2xl border border-brand-border text-center hover:shadow-xl transition-all duration-300 group flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-action-50 text-brand-action flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <x-heroicon-o-cake class="w-8 h-8 text-brand-action" />
                        </div>
                        <h3 class="font-bold text-lg text-brand-secondary mb-2 group-hover:text-brand-action transition-colors">
                            <a href="{{ route('industries') }}#restaurant" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
                                {{ __('Restaurant and catering temps') }}
                            </a>
                        </h3>
                        <p class="text-xs text-brand-muted leading-relaxed">
                            {{ __('Qualified chefs, waiters, kitchen assistants and dishwashers for busy dining venues.') }}
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-brand-border/60">
                        <a href="{{ route('industries') }}#restaurant" class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-action hover:text-brand-action-hover focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none transition-colors">
                            <span>{{ __('Read about restaurant staffing') }}</span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                        </a>
                    </div>
                </div>

                <!-- 3. Warehouse & Logistics Temps -->
                <div class="bg-brand-surface p-6 rounded-2xl border border-brand-border text-center hover:shadow-xl transition-all duration-300 group flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-navy-100 text-brand-primary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <x-heroicon-o-truck class="w-8 h-8 text-brand-primary" />
                        </div>
                        <h3 class="font-bold text-lg text-brand-secondary mb-2 group-hover:text-brand-action transition-colors">
                            <a href="{{ route('industries') }}#warehouse" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
                                {{ __('Warehouse and logistics temps') }}
                            </a>
                        </h3>
                        <p class="text-xs text-brand-muted leading-relaxed">
                            {{ __('Certified forklift drivers, pick-and-pack operators and inventory staff for distribution hubs.') }}
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-brand-border/60">
                        <a href="{{ route('industries') }}#warehouse" class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-action hover:text-brand-action-hover focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none transition-colors">
                            <span>{{ __('Read about warehouse staffing') }}</span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                        </a>
                    </div>
                </div>

                <!-- 4. Office Temps -->
                <div class="bg-brand-surface p-6 rounded-2xl border border-brand-border text-center hover:shadow-xl transition-all duration-300 group flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-forest-50 text-forest flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <x-heroicon-o-building-office-2 class="w-8 h-8 text-forest" />
                        </div>
                        <h3 class="font-bold text-lg text-brand-secondary mb-2 group-hover:text-brand-action transition-colors">
                            <a href="{{ route('industries') }}#office" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
                                {{ __('Office temps') }}
                            </a>
                        </h3>
                        <p class="text-xs text-brand-muted leading-relaxed">
                            {{ __('Vetted administrative assistants, receptionists, data entry clerks and customer support staff.') }}
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-brand-border/60">
                        <a href="{{ route('industries') }}#office" class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-action hover:text-brand-action-hover focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none transition-colors">
                            <span>{{ __('Read about office staffing') }}</span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                        </a>
                    </div>
            </div>
        </div>
    </section>

    <!-- How to Order Temps in 3 Steps Section (Ordered List) -->
    <section id="how-it-works" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="text-xs font-bold text-brand-action uppercase tracking-widest mb-3">{{ __('Quick ordering process') }}</div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-secondary tracking-tight">
                {{ __('How to order temps in 3 steps') }}
            </h2>
            <p class="mt-3 text-sm text-brand-body leading-relaxed max-w-2xl mx-auto">
                {{ __('Ordering qualified temporary workers is straightforward and takes less than two minutes from your computer or phone.') }}
            </p>
        </div>

        <!-- Semantic Ordered List -->
        <ol class="grid md:grid-cols-3 gap-8 list-none">
            <!-- Step 1 -->
            <li class="bg-brand-surface p-8 rounded-2xl border border-brand-border shadow-sm relative flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-action-50 text-brand-action font-black text-lg flex items-center justify-center mb-6 shadow-xs" aria-hidden="true">
                        1
                    </div>
                    <h3 class="text-xl font-bold text-brand-secondary mb-3">
                        {{ __('1. Request your staffing requirements') }}
                    </h3>
                    <p class="text-sm text-brand-body leading-relaxed">
                        {{ __('Specify your industry, number of temps, location and shift times via our online portal or 24/7 emergency line (+45 28 26 09 26).') }}
                    </p>
                </div>
                <div class="pt-6 mt-6 border-t border-brand-border/60 text-xs font-semibold text-brand-muted">
                    <span>{{ __('Estimeret tid: 2 minutter') }}</span>
                </div>
            </li>

            <!-- Step 2 -->
            <li class="bg-brand-surface p-8 rounded-2xl border border-brand-border shadow-sm relative flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-navy-50 text-brand-secondary font-black text-lg flex items-center justify-center mb-6 shadow-xs" aria-hidden="true">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-brand-secondary mb-3">
                        {{ __('2. Vetted temps dispatched in under 2 hours') }}
                    </h3>
                    <p class="text-sm text-brand-body leading-relaxed">
                        {{ __('We match and dispatch pre-screened, collective agreement compliant workers to your workplace in under 2 hours.') }}
                    </p>
                </div>
                <div class="pt-6 mt-6 border-t border-brand-border/60 text-xs font-semibold text-brand-muted">
                    <span>{{ __('Udrykningstid: Under 2 timer') }}</span>
                </div>
            </li>

            <!-- Step 3 -->
            <li class="bg-brand-surface p-8 rounded-2xl border border-brand-border shadow-sm relative flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-forest-50 text-forest font-black text-lg flex items-center justify-center mb-6 shadow-xs" aria-hidden="true">
                        3
                    </div>
                    <h3 class="text-xl font-bold text-brand-secondary mb-3">
                        {{ __('3. Digital QR check-in and transparent invoicing') }}
                    </h3>
                    <p class="text-sm text-brand-body leading-relaxed">
                        {{ __('Workers check in on-site with a QR scan. You approve verified hours digitally with zero onboarding or lock-in fees.') }}
                    </p>
                </div>
                <div class="pt-6 mt-6 border-t border-brand-border/60 text-xs font-semibold text-brand-muted">
                    <span>{{ __('Ingen binding • 100% digitalt') }}</span>
                </div>
            </li>
        </ol>
    </section>

    <!-- Frequently Asked Questions Section (AI-Search Ready & JSON-LD Mirrored) -->
    <section id="faq" class="py-24 bg-sand-200/40 border-t border-brand-border relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-secondary tracking-tight">
                    FAQ
                </h2>
            </div>

            <div class="relative max-w-5xl mx-auto">
                <!-- Curved SVG Path behind the cards -->
                <svg class="absolute -top-12 -bottom-12 -left-8 -right-8 w-[calc(100%+4rem)] h-[calc(100%+6rem)] pointer-events-none select-none z-0" viewBox="0 0 1000 850" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <defs>
                        <linearGradient id="faq-curve-grad-1" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#C9A24B" stop-opacity="0.45" />
                            <stop offset="35%" stop-color="#7B1E3A" stop-opacity="0.4" />
                            <stop offset="70%" stop-color="#C9A24B" stop-opacity="0.35" />
                            <stop offset="100%" stop-color="#5A1429" stop-opacity="0.3" />
                        </linearGradient>
                        <linearGradient id="faq-curve-grad-2" x1="100%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#7B1E3A" stop-opacity="0.4" />
                            <stop offset="50%" stop-color="#C9A24B" stop-opacity="0.3" />
                            <stop offset="100%" stop-color="#E4D6D9" stop-opacity="0.25" />
                        </linearGradient>
                        <filter id="faq-blur" x="-20%" y="-20%" width="140%" height="140%">
                            <feGaussianBlur stdDeviation="12" />
                        </filter>
                    </defs>

                    <!-- Soft ambient glow path -->
                    <path d="M -20,90 C 150,20 320,30 460,110 C 510,140 520,200 620,130 C 740,50 880,60 980,150 C 1040,200 1020,290 890,280 C 750,270 630,285 500,280 C 360,275 220,265 100,320 C 0,360 -20,450 60,510 C 140,570 320,540 480,545 C 640,550 820,520 930,590 C 1030,650 1020,750 890,810 C 750,870 550,830 380,820 C 220,810 80,850 -20,810"
                          stroke="url(#faq-curve-grad-1)"
                          stroke-width="16"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          fill="none"
                          filter="url(#faq-blur)"
                          opacity="0.3"
                          vector-effect="non-scaling-stroke" />

                    <!-- Primary curved path -->
                    <path d="M -20,90 C 150,20 320,30 460,110 C 510,140 520,200 620,130 C 740,50 880,60 980,150 C 1040,200 1020,290 890,280 C 750,270 630,285 500,280 C 360,275 220,265 100,320 C 0,360 -20,450 60,510 C 140,570 320,540 480,545 C 640,550 820,520 930,590 C 1030,650 1020,750 890,810 C 750,870 550,830 380,820 C 220,810 80,850 -20,810"
                          stroke="url(#faq-curve-grad-1)"
                          stroke-width="3"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          fill="none"
                          vector-effect="non-scaling-stroke" />

                    <!-- Secondary dashed harmonic curved path -->
                    <path d="M 40,40 C 200,-10 380,60 520,70 C 680,80 840,-10 960,80 C 1040,140 990,340 850,340 C 690,340 590,350 440,360 C 290,370 120,390 40,470 C -30,540 30,660 170,680 C 340,710 650,650 830,710 C 940,750 990,830 920,850"
                          stroke="url(#faq-curve-grad-2)"
                          stroke-width="1.5"
                          stroke-dasharray="6 8"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          fill="none"
                          vector-effect="non-scaling-stroke" />
                </svg>

                <div class="relative z-10 grid md:grid-cols-2 gap-6 items-start">
                    <!-- Q1 -->
                    <div x-data="{ open: false }"
                         class="bg-brand-surface rounded-2xl p-6 sm:p-7 border transition-all duration-300"
                         :class="open ? 'border-brand-action/50 shadow-md ring-1 ring-brand-action/20' : 'border-brand-border shadow-xs hover:border-brand-action/40'">
                        <button @click="open = !open"
                                type="button"
                                class="w-full text-left flex items-start justify-between gap-4 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-action rounded-lg group cursor-pointer"
                                :aria-expanded="open.toString()">
                            <h3 class="text-base sm:text-lg font-bold text-brand-secondary group-hover:text-brand-action transition-colors duration-200 flex items-start gap-3">
                                <span class="w-6 h-6 rounded-lg bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">Q</span>
                                <span>{{ __('How fast can I get a temp in Denmark?') }}</span>
                            </h3>
                            <span class="w-7 h-7 rounded-full bg-sand-200/80 group-hover:bg-sand-300/80 flex items-center justify-center shrink-0 mt-0.5 text-brand-secondary transition-all duration-300 ease-out"
                                  :class="{ 'rotate-180 bg-brand-action text-white group-hover:bg-brand-action': open }">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div x-show="open" x-collapse.duration.300ms x-cloak>
                            <div class="pt-3.5 text-sm text-brand-body leading-relaxed pl-9">
                                <p>
                                    {{ __('Freya Service dispatches qualified temps in under 2 hours for urgent staffing requests nationwide. Planned shifts can also be scheduled days or weeks ahead via our 24/7 emergency dispatch line (+45 28 26 09 26) or online client portal.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Q2 -->
                    <div x-data="{ open: false }"
                         class="bg-brand-surface rounded-2xl p-6 sm:p-7 border transition-all duration-300"
                         :class="open ? 'border-brand-action/50 shadow-md ring-1 ring-brand-action/20' : 'border-brand-border shadow-xs hover:border-brand-action/40'">
                        <button @click="open = !open"
                                type="button"
                                class="w-full text-left flex items-start justify-between gap-4 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-action rounded-lg group cursor-pointer"
                                :aria-expanded="open.toString()">
                            <h3 class="text-base sm:text-lg font-bold text-brand-secondary group-hover:text-brand-action transition-colors duration-200 flex items-start gap-3">
                                <span class="w-6 h-6 rounded-lg bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">Q</span>
                                <span>{{ __('Are there any lock-in periods or onboarding fees?') }}</span>
                            </h3>
                            <span class="w-7 h-7 rounded-full bg-sand-200/80 group-hover:bg-sand-300/80 flex items-center justify-center shrink-0 mt-0.5 text-brand-secondary transition-all duration-300 ease-out"
                                  :class="{ 'rotate-180 bg-brand-action text-white group-hover:bg-brand-action': open }">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div x-show="open" x-collapse.duration.300ms x-cloak>
                            <div class="pt-3.5 text-sm text-brand-body leading-relaxed pl-9">
                                <p>
                                    {{ __('No. Freya Service operates with zero lock-in contracts, zero subscription fees, and zero onboarding fees. You only pay for the approved hours worked by the dispatched temp.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Q3 -->
                    <div x-data="{ open: false }"
                         class="bg-brand-surface rounded-2xl p-6 sm:p-7 border transition-all duration-300"
                         :class="open ? 'border-brand-action/50 shadow-md ring-1 ring-brand-action/20' : 'border-brand-border shadow-xs hover:border-brand-action/40'">
                        <button @click="open = !open"
                                type="button"
                                class="w-full text-left flex items-start justify-between gap-4 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-action rounded-lg group cursor-pointer"
                                :aria-expanded="open.toString()">
                            <h3 class="text-base sm:text-lg font-bold text-brand-secondary group-hover:text-brand-action transition-colors duration-200 flex items-start gap-3">
                                <span class="w-6 h-6 rounded-lg bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">Q</span>
                                <span>{{ __('Do Freya Service temps follow Danish collective agreements?') }}</span>
                            </h3>
                            <span class="w-7 h-7 rounded-full bg-sand-200/80 group-hover:bg-sand-300/80 flex items-center justify-center shrink-0 mt-0.5 text-brand-secondary transition-all duration-300 ease-out"
                                  :class="{ 'rotate-180 bg-brand-action text-white group-hover:bg-brand-action': open }">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div x-show="open" x-collapse.duration.300ms x-cloak>
                            <div class="pt-3.5 text-sm text-brand-body leading-relaxed pl-9">
                                <p>
                                    {{ __('Yes. 100% of temporary workers dispatched by Freya Service are employed under Danish collective agreement terms (overenskomst), including statutory pension, holiday pay (feriepenge), sick pay, and mandatory workplace injury insurance.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Q4 -->
                    <div x-data="{ open: false }"
                         class="bg-brand-surface rounded-2xl p-6 sm:p-7 border transition-all duration-300"
                         :class="open ? 'border-brand-action/50 shadow-md ring-1 ring-brand-action/20' : 'border-brand-border shadow-xs hover:border-brand-action/40'">
                        <button @click="open = !open"
                                type="button"
                                class="w-full text-left flex items-start justify-between gap-4 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-action rounded-lg group cursor-pointer"
                                :aria-expanded="open.toString()">
                            <h3 class="text-base sm:text-lg font-bold text-brand-secondary group-hover:text-brand-action transition-colors duration-200 flex items-start gap-3">
                                <span class="w-6 h-6 rounded-lg bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">Q</span>
                                <span>{{ __('What does temp staffing cost with Freya Service?') }}</span>
                            </h3>
                            <span class="w-7 h-7 rounded-full bg-sand-200/80 group-hover:bg-sand-300/80 flex items-center justify-center shrink-0 mt-0.5 text-brand-secondary transition-all duration-300 ease-out"
                                  :class="{ 'rotate-180 bg-brand-action text-white group-hover:bg-brand-action': open }">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div x-show="open" x-collapse.duration.300ms x-cloak>
                            <div class="pt-3.5 text-sm text-brand-body leading-relaxed pl-9">
                                <p>
                                    {{ __('Temp staffing costs depend on the industry, job role, and shift type (day, evening, night, or weekend) in compliance with collective agreement tariffs. Base rates start from [PLACEHOLDER: DKK XXX per hour ex. VAT]. Invoicing is transparent with 25% Danish VAT and no hidden surcharges.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Q5 -->
                    <div x-data="{ open: false }"
                         class="bg-brand-surface rounded-2xl p-6 sm:p-7 border transition-all duration-300"
                         :class="open ? 'border-brand-action/50 shadow-md ring-1 ring-brand-action/20' : 'border-brand-border shadow-xs hover:border-brand-action/40'">
                        <button @click="open = !open"
                                type="button"
                                class="w-full text-left flex items-start justify-between gap-4 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-action rounded-lg group cursor-pointer"
                                :aria-expanded="open.toString()">
                            <h3 class="text-base sm:text-lg font-bold text-brand-secondary group-hover:text-brand-action transition-colors duration-200 flex items-start gap-3">
                                <span class="w-6 h-6 rounded-lg bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">Q</span>
                                <span>{{ __('Which industries does Freya Service provide staff for?') }}</span>
                            </h3>
                            <span class="w-7 h-7 rounded-full bg-sand-200/80 group-hover:bg-sand-300/80 flex items-center justify-center shrink-0 mt-0.5 text-brand-secondary transition-all duration-300 ease-out"
                                  :class="{ 'rotate-180 bg-brand-action text-white group-hover:bg-brand-action': open }">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div x-show="open" x-collapse.duration.300ms x-cloak>
                            <div class="pt-3.5 text-sm text-brand-body leading-relaxed pl-9">
                                <p>
                                    {{ __('Freya Service supplies vetted temp staff across four core industries in Denmark: hotels (reception, housekeeping), restaurants and catering (chefs, waiters, kitchen assistants), warehouses and logistics (forklift drivers, pick-and-pack), and offices (administrative, customer service).') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Q6 -->
                    <div x-data="{ open: false }"
                         class="bg-brand-surface rounded-2xl p-6 sm:p-7 border transition-all duration-300"
                         :class="open ? 'border-brand-action/50 shadow-md ring-1 ring-brand-action/20' : 'border-brand-border shadow-xs hover:border-brand-action/40'">
                        <button @click="open = !open"
                                type="button"
                                class="w-full text-left flex items-start justify-between gap-4 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-action rounded-lg group cursor-pointer"
                                :aria-expanded="open.toString()">
                            <h3 class="text-base sm:text-lg font-bold text-brand-secondary group-hover:text-brand-action transition-colors duration-200 flex items-start gap-3">
                                <span class="w-6 h-6 rounded-lg bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">Q</span>
                                <span>{{ __('How does Freya Service vet and verify temp workers?') }}</span>
                            </h3>
                            <span class="w-7 h-7 rounded-full bg-sand-200/80 group-hover:bg-sand-300/80 flex items-center justify-center shrink-0 mt-0.5 text-brand-secondary transition-all duration-300 ease-out"
                                  :class="{ 'rotate-180 bg-brand-action text-white group-hover:bg-brand-action': open }">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div x-show="open" x-collapse.duration.300ms x-cloak>
                            <div class="pt-3.5 text-sm text-brand-body leading-relaxed pl-9">
                                <p>
                                    {{ __('Every candidate undergoes personal interviews, reference validation, verification of valid Danish work permits, and criminal background checks prior to dispatch. On-site attendance and worked hours are verified digitally via QR-code time tracking.') }}
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>

    <!-- Call to action / Contact (Primary Dark: Deep burgundy #5A1429) -->
    <section id="contact" class="py-16 bg-navy text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            <h2 class="text-3xl font-extrabold text-white">
                {{ __('Ready to order temps or need immediate staffing?') }}
            </h2>
            <p class="text-sand-200 max-w-xl mx-auto text-sm leading-relaxed">
                {{ __('Call our 24/7 emergency dispatch line directly or create your client account online in two minutes.') }}
            </p>
            <div class="flex flex-wrap justify-center gap-4 pt-4">
                <!-- Primary Action Button: Burgundy #7B1E3A with 2px white/35 border -->
                <a href="tel:+4528260926" class="btn-primary border-2 border-white/35 inline-flex items-center gap-2 px-6 py-3.5 rounded-lg bg-burgundy hover:bg-burgundy-dark text-white font-bold text-sm shadow-md transition focus-visible:ring-2 focus-visible:ring-burgundy focus:outline-none">
                    <x-heroicon-s-phone class="w-4 h-4 text-white" />
                    <span>{{ __('Ring +45 28 26 09 26') }}</span>
                </a>
                <!-- Secondary Action Button: Transparent with 2px teal border, white text on navy -->
                <a href="{{ route('register', ['role' => 'client']) }}" class="btn-secondary border-2 border-teal bg-transparent hover:bg-teal/10 inline-flex items-center gap-2 px-6 py-3.5 rounded-lg text-white font-bold text-sm transition focus-visible:ring-2 focus-visible:ring-teal focus:outline-none">
                    <x-heroicon-o-building-office class="w-4 h-4 text-teal" />
                    <span>{{ __('Opret virksomhedskonto') }}</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer (Primary Dark: Deep burgundy #5A1429, Border: Deep burgundy 800) -->
    <footer class="bg-navy text-sand-300 py-12 border-t border-navy-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-4 gap-8">
            <div class="space-y-4">
                <a href="/" class="inline-block group focus-visible:ring-2 focus-visible:ring-burgundy rounded focus:outline-none" aria-label="Freya Service">
                    <img src="{{ asset('images/logo-white.png') }}" alt="Freya Service vikarbureau logo hvid" class="h-10 w-auto object-contain group-hover:opacity-90 transition" width="160" height="40" loading="lazy" decoding="async">
                </a>
                <p class="text-xs leading-relaxed text-sand-200">
                    {{ __('Dansk vikarbureau med fokus på fleksibilitet, pålidelighed og digital gennemsigtighed.') }}
                </p>
                <div class="text-xs text-sand-400">
                    CVR: 44556677 • Moms nr. DK44556677
                </div>
            </div>

            <div>
                <p class="text-xs font-bold text-white uppercase tracking-wider mb-3">{{ __('Virksomheder') }}</p>
                <ul class="text-xs space-y-2">
                    <li><a href="{{ route('register', ['role' => 'client']) }}" class="text-sand-300 hover:text-white flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-burgundy rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-teal" />{{ __('Bestil Vikar') }}</a></li>
                    <li><a href="{{ route('login') }}" class="text-sand-300 hover:text-white flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-burgundy rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-teal" />{{ __('Timesedler') }}</a></li>
                    <li><a href="{{ route('login') }}" class="text-sand-300 hover:text-white flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-burgundy rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-teal" />{{ __('Fakturaer') }}</a></li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-bold text-white uppercase tracking-wider mb-3">{{ __('Vikarer') }}</p>
                <ul class="text-xs space-y-2">
                    <li><a href="{{ route('register', ['role' => 'worker']) }}" class="text-sand-300 hover:text-white flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-burgundy rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-teal" />{{ __('Tilmeld dig som vikar') }}</a></li>
                    <li><a href="{{ route('login') }}" class="text-sand-300 hover:text-white flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-burgundy rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-teal" />{{ __('Ledige Vagter') }}</a></li>
                    <li><a href="{{ route('login') }}" class="text-sand-300 hover:text-white flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-burgundy rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-teal" />{{ __('QR Tjek-ind') }}</a></li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-bold text-white uppercase tracking-wider mb-3">{{ __('GDPR & Sikkerhed') }}</p>
                <ul class="text-xs space-y-2">
                    <li class="flex items-start gap-1.5">
                        <x-heroicon-s-shield-check class="w-4 h-4 text-teal shrink-0 mt-0.5" />
                        <span class="text-sand-200">{{ __('Ingen CPR-numre gemmes i systemet. Bankoplysninger krypteres med AES-256.') }}</span>
                    </li>
                    <li class="flex items-start gap-1.5">
                        <x-heroicon-s-check class="w-4 h-4 text-teal shrink-0 mt-0.5" />
                        <span class="text-sand-200">{{ __('Alle rettigheder forbeholdes. Overholder gældende EU GDPR-lovgivning samt dansk overenskomst.') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 mt-8 border-t border-navy-800 text-center text-xs text-sand-400">
            &copy; {{ date('Y') }} FreyaService.dk — {{ __('Alle rettigheder forbeholdes. Overholder gældende EU GDPR-lovgivning samt dansk overenskomst.') }} Timezone: Europe/Copenhagen.
        </div>
    </footer>

    <!-- Back to Top Button -->
    <x-back-to-top />
</body>
</html>
