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
        "@@context": "https://schema.org",
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
                <span class="flex items-center gap-1">
                    <x-heroicon-o-phone class="w-3.5 h-3.5 text-teal" />
                    <span>{{ __('Akut vagttelefon') }}: <a href="tel:+4528260926" class="text-white hover:text-teal font-semibold">+45 28 26 09 26</a></span>
                </span>
                <span class="hidden md:inline text-sand-400/60">•</span>
                <span class="hidden sm:inline text-sand-300">CVR: 44556677</span>
            </div>
            <div class="flex items-center gap-3 sm:gap-4">
                <!-- Top bar language switch -->
                <div class="flex items-center gap-1 text-xs font-medium" role="group" aria-label="Sprogvælger">
                    <a href="{{ route('locale.switch', 'da') }}" class="inline-flex items-center gap-1 transition-colors px-1.5 py-0.5 rounded {{ app()->getLocale() === 'da' ? 'text-white font-bold underline underline-offset-4 decoration-2 decoration-teal' : 'text-sand-300 hover:text-white' }}" aria-label="Skift til dansk">
                        <span>🇩🇰</span>
                        <span>DA</span>
                    </a>
                    <span class="text-sand-400/60 select-none">/</span>
                    <a href="{{ route('locale.switch', 'en') }}" class="inline-flex items-center gap-1 transition-colors px-1.5 py-0.5 rounded {{ app()->getLocale() === 'en' ? 'text-white font-bold underline underline-offset-4 decoration-2 decoration-teal' : 'text-sand-300 hover:text-white' }}" aria-label="Switch to English">
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

            <!-- Nav Links (Services & Sectors, About, How It Works, Contact) -->
            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold" aria-label="Hovednavigation">
                <a href="{{ route('services') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('services') || request()->routeIs('industries') ? 'text-white border-burgundy' : 'text-sand-200 hover:text-white border-transparent hover:border-sand-300' }} focus-visible:ring-2 focus-visible:ring-burgundy rounded-sm focus:outline-none">
                    <x-heroicon-o-briefcase class="w-4 h-4 text-teal" />
                    <span>{{ __('Services & Sectors') }}</span>
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
                            <a href="{{ route('register') }}" class="btn-primary border-2 border-white/35 inline-flex items-center justify-center gap-1 sm:gap-1.5 px-2.5 sm:px-4 lg:px-5 py-1.5 sm:py-2 lg:py-2.5 rounded-lg text-xs sm:text-sm font-bold text-white shadow-md transition focus-visible:ring-2 focus-visible:ring-burgundy focus:outline-none">
                                <x-heroicon-o-user-plus class="w-3.5 h-3.5 sm:w-4 sm:h-4" />
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
                    <a href="{{ route('locale.switch', 'da') }}" class="px-3 py-1.5 min-h-[36px] rounded-md transition flex items-center gap-1.5 {{ app()->getLocale() === 'da' ? 'bg-burgundy text-white font-bold underline underline-offset-4 decoration-2 decoration-teal' : 'text-sand-300 hover:text-white' }}">
                        <span>🇩🇰</span><span>Dansk</span>
                    </a>
                    <a href="{{ route('locale.switch', 'en') }}" class="px-3 py-1.5 min-h-[36px] rounded-md transition flex items-center gap-1.5 {{ app()->getLocale() === 'en' ? 'bg-burgundy text-white font-bold underline underline-offset-4 decoration-2 decoration-teal' : 'text-sand-300 hover:text-white' }}">
                        <span>🇬🇧</span><span>English</span>
                    </a>
                </div>
            </div>

            <!-- Mobile Navigation Links -->
            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('services') }}" class="flex items-center gap-3 px-3 py-2.5 min-h-[44px] rounded-lg text-sm font-semibold transition {{ request()->routeIs('services') || request()->routeIs('industries') ? 'bg-navy-800 text-white font-bold border-l-4 border-burgundy' : 'text-sand-200 hover:bg-navy-800 hover:text-white' }} focus-visible:ring-2 focus-visible:ring-burgundy focus:outline-none">
                    <x-heroicon-o-briefcase class="w-5 h-5 text-teal" />
                    <span>{{ __('Services & Sectors') }}</span>
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
                    <div class="grid grid-cols-2 gap-2.5">
                        <a href="{{ route('login') }}" class="btn-secondary border-2 border-teal bg-transparent text-white hover:bg-teal/10 inline-flex items-center justify-center gap-1.5 px-3 py-2 min-h-[38px] rounded-lg text-xs font-bold transition">
                            <x-heroicon-o-arrow-right-end-on-rectangle class="w-3.5 h-3.5 text-teal" />
                            <span>{{ __('Log ind') }}</span>
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary border-2 border-white/35 inline-flex items-center justify-center gap-1.5 px-3 py-2 min-h-[38px] rounded-lg text-xs font-bold text-white shadow-sm transition">
                            <x-heroicon-o-user-plus class="w-3.5 h-3.5" />
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
        $btnWords = $isEn ? ['temp', 'full-time', 'part-time'] : ['vikar', 'fuldtid', 'deltid'];
    @endphp

    <!-- Hero Section with Authentic Colleagues in Background & 3D Flip Headline -->
    <section id="heroSection" class="relative text-white min-h-[calc(100vh-100px)] sm:min-h-[calc(100vh-116px)] min-h-[calc(100dvh-100px)] sm:min-h-[calc(100dvh-116px)] flex flex-col justify-center py-8 sm:py-12 md:py-14 px-4 sm:px-6 lg:px-8 overflow-hidden bg-[#5A1429]">

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
            
            <!-- Giant Outline 16+ Years Experience Element (Right-Aligned, Responsive Fit) -->
            <div class="w-full flex justify-end pr-2 sm:pr-4 md:pr-6 mb-2 sm:mb-3">
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
                data-words-btn='@json($btnWords)'
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
                        <a href="{{ route('client.requests.create') }}" class="btn-primary border-2 border-white/35 inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-lg text-base font-extrabold text-white bg-burgundy hover:bg-burgundy-dark shadow-lg transition-all transform hover:-translate-y-0.5 min-h-[48px] min-w-[280px] sm:min-w-[310px]">
                            <x-heroicon-o-briefcase class="w-5 h-5 text-white shrink-0" />
                            @if($isEn)
                                <span class="inline-flex items-center gap-1.5 whitespace-nowrap"><span>Order</span><span class="hero-btn-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span class="hero-btn-flip-word font-extrabold text-white" style="display:inline-block; white-space:nowrap; transform-origin:50% 50%;">temp</span></span><span>staff now</span></span>
                            @else
                                <span class="inline-flex items-center gap-1.5 whitespace-nowrap"><span>Bestil</span><span class="hero-btn-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span class="hero-btn-flip-word font-extrabold text-white" style="display:inline-block; white-space:nowrap; transform-origin:50% 50%;">vikar</span></span><span>nu</span></span>
                            @endif
                            <x-heroicon-o-arrow-right class="w-5 h-5 shrink-0" />
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn-primary border-2 border-white/35 inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-lg text-base font-extrabold text-white bg-burgundy hover:bg-burgundy-dark shadow-lg transition-all transform hover:-translate-y-0.5 min-h-[48px] min-w-[280px] sm:min-w-[310px]">
                            <x-heroicon-o-briefcase class="w-5 h-5 text-white shrink-0" />
                            @if($isEn)
                                <span class="inline-flex items-center gap-1.5 whitespace-nowrap"><span>Order</span><span class="hero-btn-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span class="hero-btn-flip-word font-extrabold text-white" style="display:inline-block; white-space:nowrap; transform-origin:50% 50%;">temp</span></span><span>staff now</span></span>
                            @else
                                <span class="inline-flex items-center gap-1.5 whitespace-nowrap"><span>Bestil</span><span class="hero-btn-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span class="hero-btn-flip-word font-extrabold text-white" style="display:inline-block; white-space:nowrap; transform-origin:50% 50%;">vikar</span></span><span>nu</span></span>
                            @endif
                            <x-heroicon-o-arrow-right class="w-5 h-5 shrink-0" />
                        </a>
                    @endif
                @else
                    <a href="{{ route('register', ['role' => 'client']) }}" class="btn-primary border-2 border-white/35 inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-lg text-base font-extrabold text-white bg-burgundy hover:bg-burgundy-dark shadow-lg transition-all transform hover:-translate-y-0.5 min-h-[48px] min-w-[280px] sm:min-w-[310px]">
                        <x-heroicon-o-briefcase class="w-5 h-5 text-white shrink-0" />
                        @if($isEn)
                            <span class="inline-flex items-center gap-1.5 whitespace-nowrap"><span>Order</span><span class="hero-btn-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span class="hero-btn-flip-word font-extrabold text-white" style="display:inline-block; white-space:nowrap; transform-origin:50% 50%;">temp</span></span><span>staff now</span></span>
                        @else
                            <span class="inline-flex items-center gap-1.5 whitespace-nowrap"><span>Bestil</span><span class="hero-btn-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span class="hero-btn-flip-word font-extrabold text-white" style="display:inline-block; white-space:nowrap; transform-origin:50% 50%;">vikar</span></span><span>nu</span></span>
                        @endif
                        <x-heroicon-o-arrow-right class="w-5 h-5 shrink-0" />
                    </a>
                @endauth

                <!-- Secondary CTA Button: White Text "Apply as worker" with Frosted Glass Surface -->
                @auth
                    <a href="{{ auth()->user()->isWorker() ? route('worker.dashboard') : route('dashboard') }}" class="btn-secondary border-2 border-white bg-white/15 hover:bg-white/25 backdrop-blur-md text-white shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5 inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-lg text-base font-extrabold min-h-[48px]">
                        <x-heroicon-o-user-plus class="w-5 h-5 shrink-0 text-white" />
                        <span class="text-white">{{ $isEn ? 'Apply as worker' : 'Ansøg som vikar' }}</span>
                    </a>
                @else
                    <a href="{{ route('register', ['role' => 'worker']) }}" class="btn-secondary border-2 border-white bg-white/15 hover:bg-white/25 backdrop-blur-md text-white shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5 inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-lg text-base font-extrabold min-h-[48px]">
                        <x-heroicon-o-user-plus class="w-5 h-5 shrink-0 text-white" />
                        <span class="text-white">{{ $isEn ? 'Apply as worker' : 'Ansøg som vikar' }}</span>
                    </a>
                @endauth
            </div>
        </div>
    </section>



    <!-- Styles & Vanilla JS for 3D Headline & Button Flip -->
    <style>
        .hero-flip-container, .hero-btn-flip-container {
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
        .hero-btn-flip-word {
            display: inline-block;
            white-space: nowrap;
            color: #ffffff;
            transform-origin: 50% 50%;
            transform-style: preserve-3d;
            backface-visibility: hidden;
            will-change: transform, opacity;
        }
        @media (prefers-reduced-motion: reduce) {
            .hero-flip-word, .hero-btn-flip-word {
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
                var btnFlipWords = document.querySelectorAll('.hero-btn-flip-word');

                if (!headline || !flipWord1 || !flipWord2) return;

                var words1 = [];
                var words2 = [];
                var wordsBtn = [];
                try {
                    words1 = JSON.parse(headline.getAttribute('data-words1') || '[]');
                    words2 = JSON.parse(headline.getAttribute('data-words2') || '[]');
                    wordsBtn = JSON.parse(headline.getAttribute('data-words-btn') || '[]');
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
                    if (wordsBtn[index]) {
                        btnFlipWords.forEach(function(el) {
                            el.textContent = wordsBtn[index];
                        });
                    }
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

                    btnFlipWords.forEach(function(el) {
                        el.style.transition = outTransition;
                        el.style.transform = 'perspective(600px) rotateX(-90deg)';
                        el.style.opacity = '0';
                    });

                    setTimeout(function() {
                        currentIndex = nextIndex;
                        flipWord1.textContent = words1[nextIndex];
                        flipWord2.textContent = words2[nextIndex];
                        if (wordsBtn[nextIndex]) {
                            btnFlipWords.forEach(function(el) {
                                el.textContent = wordsBtn[nextIndex];
                            });
                        }

                        // Prepare rotate-in from 90deg (instant, no transition)
                        flipWord1.style.transition = 'none';
                        flipWord2.style.transition = 'none';
                        flipWord1.style.transform = 'perspective(600px) rotateX(90deg)';
                        flipWord2.style.transform = 'perspective(600px) rotateX(90deg)';
                        flipWord1.style.opacity = '0';
                        flipWord2.style.opacity = '0';

                        btnFlipWords.forEach(function(el) {
                            el.style.transition = 'none';
                            el.style.transform = 'perspective(600px) rotateX(90deg)';
                            el.style.opacity = '0';
                        });

                        // Force DOM reflow
                        void flipWord1.offsetWidth;
                        btnFlipWords.forEach(function(el) {
                            void el.offsetWidth;
                        });

                        // Phase 2: rotateX 90deg to 0, fade in, 0.38s
                        var inTransition = 'transform 0.38s cubic-bezier(0.2, 0, 0.2, 1), opacity 0.38s ease-out';
                        flipWord1.style.transition = inTransition;
                        flipWord2.style.transition = inTransition;
                        flipWord1.style.transform = 'perspective(600px) rotateX(0deg)';
                        flipWord2.style.transform = 'perspective(600px) rotateX(0deg)';
                        flipWord1.style.opacity = '1';
                        flipWord2.style.opacity = '1';

                        btnFlipWords.forEach(function(el) {
                            el.style.transition = inTransition;
                            el.style.transform = 'perspective(600px) rotateX(0deg)';
                            el.style.opacity = '1';
                        });

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

    <!-- Industries Section (Hotel, Restaurant, Warehouse, Office with Links and One-line Descriptions) -->
    <section id="industries" class="py-10 sm:py-14 lg:py-16 bg-[#FAF5F2] border-y border-brand-border relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10" x-data="{ activeSector: 'all' }">
            <div class="text-center max-w-3xl mx-auto mb-5 sm:mb-6">
                <h2 class="text-3xl sm:text-4xl lg:text-3xl xl:text-4xl font-black text-navy tracking-tight">
                    {{ __('Sectors we staff with qualified temps') }}
                </h2>
                <p class="mt-2 text-xs sm:text-sm text-ink/80 leading-relaxed max-w-2xl mx-auto">
                    {{ __('Freya Service provides pre-screened temporary workers across all core sectors in Denmark, matching required certifications, experience and language skills to every shift.') }}
                </p>
            </div>

            <!-- Sector Tab Bar (Themed with Official Freya Service Brand Palette: Deep Burgundy #5A1429, Champagne Gold #C9A24B, Warm Cream #FAF5F2) -->
            <div class="w-full max-w-7xl mx-auto mb-8 sm:mb-10 px-2 sm:px-4">
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

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 transition-all duration-300">
                <!-- 1. Dishwasher -->
                <div 
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
                                <a href="{{ route('services') }}#dishwasher" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
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
                        <a href="{{ route('services') }}#dishwasher" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                            {{ $isEn ? 'Read more' : 'Læs mere' }}
                        </a>
                    </div>
                </div>

                <!-- 2. Cleaning Assistant -->
                <div 
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
                                <a href="{{ route('services') }}#cleaning" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
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
                        <a href="{{ route('services') }}#cleaning" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                            {{ $isEn ? 'Read more' : 'Læs mere' }}
                        </a>
                    </div>
                </div>

                <!-- 3. Kitchen Assistant -->
                <div 
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
                                <a href="{{ route('services') }}#kitchen" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
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
                        <a href="{{ route('services') }}#kitchen" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                            {{ $isEn ? 'Read more' : 'Læs mere' }}
                        </a>
                    </div>
                </div>

                <!-- 4. Chefs -->
                <div 
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
                                <a href="{{ route('services') }}#chef" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
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
                        <a href="{{ route('services') }}#chef" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                            {{ $isEn ? 'Read more' : 'Læs mere' }}
                        </a>
                    </div>
                </div>

                <!-- 5. Hostess / Stewards -->
                <div 
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
                                <a href="{{ route('services') }}#steward" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
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
                        <a href="{{ route('services') }}#steward" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                            {{ $isEn ? 'Read more' : 'Læs mere' }}
                        </a>
                    </div>
                </div>

                <!-- 6. Serving Staff -->
                <div 
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
                                <a href="{{ route('services') }}#waiter" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
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
                        <a href="{{ route('services') }}#waiter" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                            {{ $isEn ? 'Read more' : 'Læs mere' }}
                        </a>
                    </div>
                </div>

                <!-- 7. Catering -->
                <div 
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
                                <a href="{{ route('services') }}#catering" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
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
                        <a href="{{ route('services') }}#catering" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                            {{ $isEn ? 'Read more' : 'Læs mere' }}
                        </a>
                    </div>
                </div>

                <!-- 8. Canteen -->
                <div 
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
                            src="{{ asset('images/office-industry.jpg') }}"
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
                                <a href="{{ route('services') }}#canteen" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
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
                        <a href="{{ route('services') }}#canteen" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                            {{ $isEn ? 'Read more' : 'Læs mere' }}
                        </a>
                    </div>
                </div>

                <!-- 9. Events & Banquets -->
                <div 
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
                                <a href="{{ route('services') }}#events" class="focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none">
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
                        <a href="{{ route('services') }}#events" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs mt-auto">
                            {{ $isEn ? 'Read more' : 'Læs mere' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How to Order Temps in 3 Steps Section (Ordered List) -->
    <section id="how-it-works" class="py-10 sm:py-14 lg:py-16 w-full relative overflow-hidden bg-sand-50/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center max-w-3xl mx-auto mb-6 sm:mb-8">
                <h2 class="text-3xl sm:text-4xl lg:text-3xl xl:text-4xl font-extrabold text-brand-secondary tracking-tight">
                    {{ __('How to order temps in 3 steps') }}
                </h2>
                <p class="mt-2 text-xs sm:text-sm text-brand-body leading-relaxed max-w-2xl mx-auto">
                    {{ __('Ordering qualified temporary workers is straightforward and takes less than two minutes from your computer or phone.') }}
                </p>
            </div>

            <!-- Semantic Ordered List -->
            <ol class="grid md:grid-cols-3 gap-8 list-none">
                <!-- Step 1 -->
                <li class="bg-white rounded-3xl border border-[#EADBCC] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 p-6 sm:p-7 lg:p-6 xl:p-8 flex flex-col justify-between text-center items-center group">
                    <div>
                        <!-- Step Badge Shape -->
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-[#5A1429] text-white shadow-xs flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-[#C9A24B] transition-all duration-300">
                            <span class="text-lg font-black leading-none text-white">01</span>
                        </div>

                        <!-- Uppercase Kicker Tag -->
                        <span class="block text-[11px] sm:text-xs font-bold tracking-[0.2em] uppercase text-brand-muted mb-2">
                            {{ $isEn ? 'STEP 01' : 'TRIN 01' }}
                        </span>

                        <!-- Card Heading -->
                        <h3 class="font-bold text-lg sm:text-xl text-[#5A1429] mb-3 leading-snug">
                            {{ __('1. Request your staffing requirements') }}
                        </h3>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-ink/75 leading-relaxed mb-6">
                            {{ __('Specify your industry, number of temps, location and shift times via our online portal or 24/7 emergency line (+45 28 26 09 26).') }}
                        </p>
                    </div>

                    <!-- Bottom Outline Pill Button -->
                    <a href="{{ route('how-it-works') }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs">
                        {{ $isEn ? 'Read more' : 'Læs mere' }}
                    </a>
                </li>

                <!-- Step 2 -->
                <li class="bg-white rounded-3xl border border-[#EADBCC] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 p-6 sm:p-7 lg:p-6 xl:p-8 flex flex-col justify-between text-center items-center group">
                    <div>
                        <!-- Step Badge Shape -->
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-[#5A1429] text-white shadow-xs flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-[#C9A24B] transition-all duration-300">
                            <span class="text-lg font-black leading-none text-white">02</span>
                        </div>

                        <!-- Uppercase Kicker Tag -->
                        <span class="block text-[11px] sm:text-xs font-bold tracking-[0.2em] uppercase text-brand-muted mb-2">
                            {{ $isEn ? 'STEP 02' : 'TRIN 02' }}
                        </span>

                        <!-- Card Heading -->
                        <h3 class="font-bold text-lg sm:text-xl text-[#5A1429] mb-3 leading-snug">
                            {{ __('2. Vetted temps dispatched in under 2 hours') }}
                        </h3>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-ink/75 leading-relaxed mb-6">
                            {{ __('We match and dispatch pre-screened, collective agreement compliant workers to your workplace in under 2 hours.') }}
                        </p>
                    </div>

                    <!-- Bottom Outline Pill Button -->
                    <a href="{{ route('how-it-works') }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs">
                        {{ $isEn ? 'Read more' : 'Læs mere' }}
                    </a>
                </li>

                <!-- Step 3 -->
                <li class="bg-white rounded-3xl border border-[#EADBCC] shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 p-6 sm:p-7 lg:p-6 xl:p-8 flex flex-col justify-between text-center items-center group">
                    <div>
                        <!-- Step Badge Shape -->
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-[#5A1429] text-white shadow-xs flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-[#C9A24B] transition-all duration-300">
                            <span class="text-lg font-black leading-none text-white">03</span>
                        </div>

                        <!-- Uppercase Kicker Tag -->
                        <span class="block text-[11px] sm:text-xs font-bold tracking-[0.2em] uppercase text-brand-muted mb-2">
                            {{ $isEn ? 'STEP 03' : 'TRIN 03' }}
                        </span>

                        <!-- Card Heading -->
                        <h3 class="font-bold text-lg sm:text-xl text-[#5A1429] mb-3 leading-snug">
                            {{ __('3. Digital QR check-in and transparent invoicing') }}
                        </h3>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-ink/75 leading-relaxed mb-6">
                            {{ __('Workers check in on-site with a QR scan. You approve verified hours digitally with zero onboarding or lock-in fees.') }}
                        </p>
                    </div>

                    <!-- Bottom Outline Pill Button -->
                    <a href="{{ route('how-it-works') }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full border border-[#C9A24B] text-[#5A1429] hover:bg-[#5A1429] hover:text-white hover:border-[#5A1429] text-xs sm:text-sm font-semibold transition-all duration-200 shadow-2xs">
                        {{ $isEn ? 'Read more' : 'Læs mere' }}
                    </a>
                </li>
            </ol>
        </div>
    </section>

    <!-- Why Choose Freya Service Section (5-Step Staggered Flow UI from Design) -->
    <section id="why-choose" class="py-12 sm:py-16 lg:pt-16 lg:pb-28 bg-[#FAF6F0] border-y border-brand-border relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.025] pointer-events-none" style="background-image: radial-gradient(#5A1429 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <!-- Section Header: Why Choose Freya Service -->
            <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-10">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-navy tracking-tight">
                    {{ $isEn ? 'Why Choose Freya Service?' : 'Hvorfor vælge Freya Service?' }}
                </h2>
                <p class="mt-2 text-brand-muted text-xs sm:text-sm lg:text-base max-w-2xl mx-auto leading-relaxed">
                    {{ $isEn
                        ? 'Our 5-step commitment to quality, rapid dispatch, and transparent staffing across Denmark.'
                        : 'Vores 5-trins kvalitetsløfte om hurtig udrykning, personlig matching og gennemskuelige vilkår i hele landet.' }}
                </p>
            </div>

            <!-- Upper Workflow Process Line (Request → Match → Dispatch → QR Check-in → Approve & Pay) -->
            <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-3 mb-12 sm:mb-16">
                <div class="px-4 py-1.5 rounded-full bg-white text-[#5A1429] font-bold text-xs sm:text-sm shadow-xs border border-[#EADBCC]">
                    {{ $isEn ? 'Request' : 'Forespørgsel' }}
                </div>
                <span class="text-[#C9A24B] font-bold text-sm sm:text-base select-none">→</span>
                <div class="px-4 py-1.5 rounded-full bg-white text-[#5A1429] font-bold text-xs sm:text-sm shadow-xs border border-[#EADBCC]">
                    {{ $isEn ? 'Match' : 'Match' }}
                </div>
                <span class="text-[#C9A24B] font-bold text-sm sm:text-base select-none">→</span>
                <div class="px-4 py-1.5 rounded-full bg-white text-[#5A1429] font-bold text-xs sm:text-sm shadow-xs border border-[#EADBCC]">
                    {{ $isEn ? 'Dispatch' : 'Udrykning' }}
                </div>
                <span class="text-[#C9A24B] font-bold text-sm sm:text-base select-none">→</span>
                <div class="px-4 py-1.5 rounded-full bg-white text-[#5A1429] font-bold text-xs sm:text-sm shadow-xs border border-[#EADBCC]">
                    {{ $isEn ? 'QR Check-in' : 'QR-tjek ind' }}
                </div>
                <span class="text-[#C9A24B] font-bold text-sm sm:text-base select-none">→</span>
                <div class="px-4 py-1.5 rounded-full bg-white text-[#5A1429] font-bold text-xs sm:text-sm shadow-xs border border-[#EADBCC]">
                    {{ $isEn ? 'Approve & Pay' : 'Godkend & Betal' }}
                </div>
            </div>

            <!-- 5-Step Staggered Cards Flow -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 lg:gap-4 xl:gap-5 relative items-start">

                <!-- Step 01 (Elevated) -->
                <div class="relative flex flex-col">
                    <div class="relative bg-white rounded-3xl border border-[#EADBCC] shadow-sm hover:shadow-md transition-all duration-300 p-6 pt-10 pb-7 flex flex-col justify-between min-h-[380px] group">
                        <!-- Top Step Badge -->
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 sm:w-13 sm:h-13 rounded-full bg-[#5A1429] text-white border-4 border-white shadow-md flex items-center justify-center group-hover:scale-105 transition-transform z-10">
                            <span class="text-base sm:text-lg font-black text-white leading-none">01</span>
                        </div>

                        <!-- Card Header & Body -->
                        <div>
                            <div class="text-center mb-3">
                                <h3 class="text-base sm:text-lg font-bold text-[#5A1429] leading-snug">
                                    {{ $isEn ? '16+ Years Hands-on Experience' : '16+ års praktisk brancheerfaring' }}
                                </h3>
                            </div>
                            <p class="text-center text-xs text-ink/75 leading-relaxed">
                                {{ $isEn
                                    ? 'Founded on hands-on chef and service roots. We understand the rapid pace, hygiene standards, and operational demands on your floor.'
                                    : 'Grundlagt på praktisk kokerfaring fra branchen. Vi forstår presset, hygiejnekravene og det høje tempo på gulvet og i driften.' }}
                            </p>
                        </div>

                        <!-- Divider & Checklist -->
                        <div class="mt-4 pt-4 border-t border-dashed border-[#EADBCC]">
                            <ul class="space-y-2 text-left text-xs text-ink/85">
                                <li class="flex items-start gap-2">
                                    <span class="text-[#C9A24B] font-bold text-sm shrink-0 leading-none mt-0.5">✓</span>
                                    <span>{{ $isEn ? 'Team of former chefs, kitchen and service professionals' : 'Team af tidligere kokke, køkken- og servicefolk' }}</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#C9A24B] font-bold text-sm shrink-0 leading-none mt-0.5">✓</span>
                                    <span>{{ $isEn ? 'Fluent in peak-hour pressure and hygiene routines' : 'Kender spidsbelastning, tempo og hygiejnerutiner' }}</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#C9A24B] font-bold text-sm shrink-0 leading-none mt-0.5">✓</span>
                                    <span>{{ $isEn ? 'Staff briefed on your standards before shift one' : 'Vikarer instrueres i dine krav inden første vagt' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Step 02 (Staggered Down on Desktop) -->
                <div class="relative flex flex-col lg:translate-y-12">
                    <div class="relative bg-white rounded-3xl border border-[#EADBCC] shadow-sm hover:shadow-md transition-all duration-300 p-6 pt-7 pb-10 flex flex-col justify-between min-h-[380px] group">
                        <!-- Card Header & Body -->
                        <div>
                            <div class="text-center mb-3">
                                <h3 class="text-base sm:text-lg font-bold text-[#5A1429] leading-snug">
                                    {{ $isEn ? 'Precision Staff Matching' : 'Præcis personlig matching' }}
                                </h3>
                            </div>
                            <p class="text-center text-xs text-ink/75 leading-relaxed">
                                {{ $isEn
                                    ? 'We match staff based on verified competencies and work style, ensuring seamless integration into your team from day one.'
                                    : 'Matcher vikarer ud fra reelle faglige kompetencer og arbejdskultur, så vikaren skaber værdi og passer ind fra første minut.' }}
                            </p>
                        </div>

                        <!-- Divider & Checklist -->
                        <div class="mt-4 pt-4 border-t border-dashed border-[#EADBCC]">
                            <ul class="space-y-2 text-left text-xs text-ink/85">
                                <li class="flex items-start gap-2">
                                    <span class="text-[#C9A24B] font-bold text-sm shrink-0 leading-none mt-0.5">✓</span>
                                    <span>{{ $isEn ? 'Matched on role, certifications, languages and experience' : 'Matchet på rolle, certifikater, sprog og erfaring' }}</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#C9A24B] font-bold text-sm shrink-0 leading-none mt-0.5">✓</span>
                                    <span>{{ $isEn ? 'Work-style fit: fast line vs. guest-facing service' : 'Rigtigt match: højt tempo i drift vs. gæstekontakt' }}</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#C9A24B] font-bold text-sm shrink-0 leading-none mt-0.5">✓</span>
                                    <span>{{ $isEn ? 'Request your favourite staff again for continuity' : 'Genbestil dine favoritvikarer for fast kontinuitet' }}</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Bottom Step Badge -->
                        <div class="absolute -bottom-6 left-1/2 -translate-x-1/2 w-12 h-12 sm:w-13 sm:h-13 rounded-full bg-[#5A1429] text-white border-4 border-white shadow-md flex items-center justify-center group-hover:scale-105 transition-transform z-10">
                            <span class="text-base sm:text-lg font-black text-white leading-none">02</span>
                        </div>
                    </div>
                </div>

                <!-- Step 03 (Elevated) -->
                <div class="relative flex flex-col">
                    <div class="relative bg-white rounded-3xl border border-[#EADBCC] shadow-sm hover:shadow-md transition-all duration-300 p-6 pt-10 pb-7 flex flex-col justify-between min-h-[380px] group">
                        <!-- Top Step Badge -->
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 sm:w-13 sm:h-13 rounded-full bg-[#5A1429] text-white border-4 border-white shadow-md flex items-center justify-center group-hover:scale-105 transition-transform z-10">
                            <span class="text-base sm:text-lg font-black text-white leading-none">03</span>
                        </div>

                        <!-- Card Header & Body -->
                        <div>
                            <div class="text-center mb-3">
                                <h3 class="text-base sm:text-lg font-bold text-[#5A1429] leading-snug">
                                    {{ $isEn ? 'Urgent Dispatch < 2 Hours' : 'Akut udrykning under 2 timer' }}
                                </h3>
                            </div>
                            <p class="text-center text-xs text-ink/75 leading-relaxed">
                                {{ $isEn
                                    ? 'When sudden illness strikes, our qualified staff arrive on-site across Denmark within 2 hours with 24/7 manned support.'
                                    : 'Når akut sygdom rammer eller travlheden spidser til, stiller vores erfarne vikarer med få timers varsel i hele landet 24/7.' }}
                            </p>
                        </div>

                        <!-- Divider & Checklist -->
                        <div class="mt-4 pt-4 border-t border-dashed border-[#EADBCC]">
                            <ul class="space-y-2 text-left text-xs text-ink/85">
                                <li class="flex items-start gap-2">
                                    <span class="text-[#C9A24B] font-bold text-sm shrink-0 leading-none mt-0.5">✓</span>
                                    <span>{{ $isEn ? 'Covers sick calls, no-shows and unexpected rushes' : 'Dækker sygemeldinger, udeblivelser og uventet travlhed' }}</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#C9A24B] font-bold text-sm shrink-0 leading-none mt-0.5">✓</span>
                                    <span>{{ $isEn ? 'Nationwide coverage across Denmark' : 'Dækker i hele Danmark med lokal forankring' }}</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#C9A24B] font-bold text-sm shrink-0 leading-none mt-0.5">✓</span>
                                    <span>{{ $isEn ? 'A real person answers, day or night' : 'Et rigtigt menneske svarer telefonen dag og nat' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Step 04 (Staggered Down on Desktop) -->
                <div class="relative flex flex-col lg:translate-y-12">
                    <div class="relative bg-white rounded-3xl border border-[#EADBCC] shadow-sm hover:shadow-md transition-all duration-300 p-6 pt-7 pb-10 flex flex-col justify-between min-h-[380px] group">
                        <!-- Card Header & Body -->
                        <div>
                            <div class="text-center mb-3">
                                <h3 class="text-base sm:text-lg font-bold text-[#5A1429] leading-snug">
                                    {{ $isEn ? '100% Digital QR Check-in' : '100% digital QR-tjek ind' }}
                                </h3>
                            </div>
                            <p class="text-center text-xs text-ink/75 leading-relaxed">
                                {{ $isEn
                                    ? 'Zero manual paper timesheets. Accurate on-site QR verification with instant 1-click hour approval in your digital portal.'
                                    : 'Ingen manuelle papirsedler. Præcis stempling on-site via QR-kode og digital godkendelse af timer direkte i din portal.' }}
                            </p>
                        </div>

                        <!-- Divider & Checklist -->
                        <div class="mt-4 pt-4 border-t border-dashed border-[#EADBCC]">
                            <ul class="space-y-2 text-left text-xs text-ink/85">
                                <li class="flex items-start gap-2">
                                    <span class="text-[#C9A24B] font-bold text-sm shrink-0 leading-none mt-0.5">✓</span>
                                    <span>{{ $isEn ? 'Staff scan in and out, so times are verified on-site' : 'Vikarer scanner ind og ud, så timer verificeres on-site' }}</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#C9A24B] font-bold text-sm shrink-0 leading-none mt-0.5">✓</span>
                                    <span>{{ $isEn ? 'Hours appear instantly in your portal' : 'Timer vises øjeblikkeligt i din portal klar til godkendelse' }}</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#C9A24B] font-bold text-sm shrink-0 leading-none mt-0.5">✓</span>
                                    <span>{{ $isEn ? 'Downloadable records for payroll and invoice checks' : 'Eksportérbare data til løn og fakturakontrol' }}</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Bottom Step Badge -->
                        <div class="absolute -bottom-6 left-1/2 -translate-x-1/2 w-12 h-12 sm:w-13 sm:h-13 rounded-full bg-[#5A1429] text-white border-4 border-white shadow-md flex items-center justify-center group-hover:scale-105 transition-transform z-10">
                            <span class="text-base sm:text-lg font-black text-white leading-none">04</span>
                        </div>
                    </div>
                </div>

                <!-- Step 05 (Elevated) -->
                <div class="relative flex flex-col">
                    <div class="relative bg-white rounded-3xl border border-[#EADBCC] shadow-sm hover:shadow-md transition-all duration-300 p-6 pt-10 pb-7 flex flex-col justify-between min-h-[380px] group">
                        <!-- Top Step Badge -->
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 sm:w-13 sm:h-13 rounded-full bg-[#5A1429] text-white border-4 border-white shadow-md flex items-center justify-center group-hover:scale-105 transition-transform z-10">
                            <span class="text-base sm:text-lg font-black text-white leading-none">05</span>
                        </div>

                        <!-- Card Header & Body -->
                        <div>
                            <div class="text-center mb-3">
                                <h3 class="text-base sm:text-lg font-bold text-[#5A1429] leading-snug">
                                    {{ $isEn ? 'Zero Lock-in & Clear Pricing' : 'Ingen binding & faste priser' }}
                                </h3>
                            </div>
                            <p class="text-center text-xs text-ink/75 leading-relaxed">
                                {{ $isEn
                                    ? 'Zero onboarding fees or surprise charges. You pay solely for actual approved hours worked with direct advisor support.'
                                    : 'Ingen oprettelsesgebyrer eller uigennemskuelige tillæg. Du betaler udelukkende for faktiske godkendte timer med fast rådgiver.' }}
                            </p>
                        </div>

                        <!-- Divider & Checklist -->
                        <div class="mt-4 pt-4 border-t border-dashed border-[#EADBCC]">
                            <ul class="space-y-2 text-left text-xs text-ink/85">
                                <li class="flex items-start gap-2">
                                    <span class="text-[#C9A24B] font-bold text-sm shrink-0 leading-none mt-0.5">✓</span>
                                    <span>{{ $isEn ? 'No minimum contract or cancellation penalty' : 'Ingen bindingsperiode eller afbestillingsgebyrer' }}</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#C9A24B] font-bold text-sm shrink-0 leading-none mt-0.5">✓</span>
                                    <span>{{ $isEn ? 'Rate shown before you book' : 'Fast timepris oplyses altid inden du bestiller' }}</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#C9A24B] font-bold text-sm shrink-0 leading-none mt-0.5">✓</span>
                                    <span>{{ $isEn ? 'Direct advisor for any invoice question' : 'Fast personlig rådgiver til alle fakturaspørgsmål' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Frequently Asked Questions Section (AI-Search Ready & JSON-LD Mirrored) -->
    <section id="faq" class="py-10 sm:py-14 lg:py-16 bg-sand-200/40 border-t border-brand-border relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-5 sm:mb-6">
                <h2 class="text-3xl sm:text-4xl lg:text-3xl xl:text-4xl font-extrabold text-brand-secondary tracking-tight">
                    {{ __('Frequently asked questions') }}
                </h2>
                <p class="mt-2 text-brand-muted text-xs sm:text-sm max-w-2xl mx-auto">
                    {{ __('Factual, straightforward answers about response times, pricing, collective agreements, vetting and booking terms.') }}
                </p>
            </div>

            <div class="relative max-w-5xl mx-auto w-full">
                <!-- Curved SVG Path behind the cards (hardware-accelerated compositing) -->
                <svg class="absolute -top-12 -bottom-12 -left-8 -right-8 w-[calc(100%+4rem)] h-[calc(100%+6rem)] pointer-events-none select-none z-0"
                     style="transform: translateZ(0); will-change: auto;"
                     viewBox="0 0 1000 850" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
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
                    </defs>

                    <!-- Soft ambient glow path -->
                    <path d="M -20,90 C 150,20 320,30 460,110 C 510,140 520,200 620,130 C 740,50 880,60 980,150 C 1040,200 1020,290 890,280 C 750,270 630,285 500,280 C 360,275 220,265 100,320 C 0,360 -20,450 60,510 C 140,570 320,540 480,545 C 640,550 820,520 930,590 C 1030,650 1020,750 890,810 C 750,870 550,830 380,820 C 220,810 80,850 -20,810"
                          stroke="url(#faq-curve-grad-1)"
                          stroke-width="12"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          fill="none"
                          opacity="0.18"
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

                <!-- Independent 2-Column Grid (Prevents cross-column row height jumping) -->
                <div class="relative z-10 grid md:grid-cols-2 gap-3.5 sm:gap-4 lg:gap-3.5 xl:gap-4 items-start">
                    <!-- Left Column: Booking, Response Time & Agreements -->
                    <div class="flex flex-col gap-3 sm:gap-3.5 lg:gap-3 xl:gap-3.5">
                        <!-- Q1 -->
                        <div x-data="{ open: false }"
                             class="bg-brand-surface rounded-2xl p-4 sm:p-5 lg:p-3.5 xl:p-4.5 border border-brand-border shadow-xs hover:border-brand-action/40 transition-[border-color,box-shadow,background-color] duration-200 ease-out"
                             :class="{ 'border-brand-action/50 shadow-md ring-1 ring-brand-action/20': open }">
                            <button @click="open = !open"
                                    type="button"
                                    class="w-full text-left flex items-start justify-between gap-3 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-action rounded-lg group cursor-pointer select-none"
                                    :aria-expanded="open.toString()">
                                <h3 class="text-sm sm:text-base lg:text-sm xl:text-base font-bold text-brand-secondary group-hover:text-brand-action transition-colors duration-200 flex items-start gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5 transition-colors duration-200"
                                          :class="{ 'bg-brand-action text-white': open }">Q</span>
                                    <span>{{ __('How fast can I get a temp in Denmark?') }}</span>
                                </h3>
                                <span class="w-6 h-6 rounded-full bg-sand-200/80 group-hover:bg-sand-300/80 flex items-center justify-center shrink-0 mt-0.5 text-brand-secondary transition-[transform,background-color,color] duration-300 ease-out"
                                      :class="{ 'rotate-180 bg-brand-action text-white group-hover:bg-brand-action': open }">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </button>
                            <div class="faq-grid-collapse" :class="{ 'is-open': open }" x-cloak>
                                <div class="faq-grid-inner">
                                    <div class="pt-2.5 text-xs sm:text-sm text-brand-body leading-relaxed pl-7.5">
                                        <p class="m-0">
                                             {{ __('Freya Service dispatches qualified temps in under 2 hours for urgent staffing requests nationwide. Planned shifts can also be scheduled days or weeks ahead via our 24/7 emergency dispatch line (+45 28 26 09 26) or online client portal.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Q2 -->
                        <div x-data="{ open: false }"
                             class="bg-brand-surface rounded-2xl p-4 sm:p-5 lg:p-3.5 xl:p-4.5 border border-brand-border shadow-xs hover:border-brand-action/40 transition-[border-color,box-shadow,background-color] duration-200 ease-out"
                             :class="{ 'border-brand-action/50 shadow-md ring-1 ring-brand-action/20': open }">
                            <button @click="open = !open"
                                    type="button"
                                    class="w-full text-left flex items-start justify-between gap-3 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-action rounded-lg group cursor-pointer select-none"
                                    :aria-expanded="open.toString()">
                                <h3 class="text-sm sm:text-base lg:text-sm xl:text-base font-bold text-brand-secondary group-hover:text-brand-action transition-colors duration-200 flex items-start gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5 transition-colors duration-200"
                                          :class="{ 'bg-brand-action text-white': open }">Q</span>
                                    <span>{{ __('Are there any lock-in periods or onboarding fees?') }}</span>
                                </h3>
                                <span class="w-6 h-6 rounded-full bg-sand-200/80 group-hover:bg-sand-300/80 flex items-center justify-center shrink-0 mt-0.5 text-brand-secondary transition-[transform,background-color,color] duration-300 ease-out"
                                      :class="{ 'rotate-180 bg-brand-action text-white group-hover:bg-brand-action': open }">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </button>
                            <div class="faq-grid-collapse" :class="{ 'is-open': open }" x-cloak>
                                <div class="faq-grid-inner">
                                    <div class="pt-2.5 text-xs sm:text-sm text-brand-body leading-relaxed pl-7.5">
                                        <p class="m-0">
                                            {{ __('No. Freya Service operates with zero lock-in contracts, zero subscription fees, and zero onboarding fees. You only pay for the approved hours worked by the dispatched temp.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Q3 -->
                        <div x-data="{ open: false }"
                             class="bg-brand-surface rounded-2xl p-4 sm:p-5 lg:p-3.5 xl:p-4.5 border border-brand-border shadow-xs hover:border-brand-action/40 transition-[border-color,box-shadow,background-color] duration-200 ease-out"
                             :class="{ 'border-brand-action/50 shadow-md ring-1 ring-brand-action/20': open }">
                            <button @click="open = !open"
                                    type="button"
                                    class="w-full text-left flex items-start justify-between gap-3 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-action rounded-lg group cursor-pointer select-none"
                                    :aria-expanded="open.toString()">
                                <h3 class="text-sm sm:text-base lg:text-sm xl:text-base font-bold text-brand-secondary group-hover:text-brand-action transition-colors duration-200 flex items-start gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5 transition-colors duration-200"
                                          :class="{ 'bg-brand-action text-white': open }">Q</span>
                                    <span>{{ __('Do Freya Service temps follow Danish collective agreements?') }}</span>
                                </h3>
                                <span class="w-6 h-6 rounded-full bg-sand-200/80 group-hover:bg-sand-300/80 flex items-center justify-center shrink-0 mt-0.5 text-brand-secondary transition-[transform,background-color,color] duration-300 ease-out"
                                      :class="{ 'rotate-180 bg-brand-action text-white group-hover:bg-brand-action': open }">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </button>
                            <div class="faq-grid-collapse" :class="{ 'is-open': open }" x-cloak>
                                <div class="faq-grid-inner">
                                    <div class="pt-2.5 text-xs sm:text-sm text-brand-body leading-relaxed pl-7.5">
                                        <p class="m-0">
                                            {{ __('Yes. 100% of temporary workers dispatched by Freya Service are employed under Danish collective agreement terms (overenskomst), including statutory pension, holiday pay (feriepenge), sick pay, and mandatory workplace injury insurance.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Costs, Industries & Candidate Vetting -->
                    <div class="flex flex-col gap-3 sm:gap-3.5 lg:gap-3 xl:gap-3.5">
                        <!-- Q4 -->
                        <div x-data="{ open: false }"
                             class="bg-brand-surface rounded-2xl p-4 sm:p-5 lg:p-3.5 xl:p-4.5 border border-brand-border shadow-xs hover:border-brand-action/40 transition-[border-color,box-shadow,background-color] duration-200 ease-out"
                             :class="{ 'border-brand-action/50 shadow-md ring-1 ring-brand-action/20': open }">
                            <button @click="open = !open"
                                    type="button"
                                    class="w-full text-left flex items-start justify-between gap-3 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-action rounded-lg group cursor-pointer select-none"
                                    :aria-expanded="open.toString()">
                                <h3 class="text-sm sm:text-base lg:text-sm xl:text-base font-bold text-brand-secondary group-hover:text-brand-action transition-colors duration-200 flex items-start gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5 transition-colors duration-200"
                                          :class="{ 'bg-brand-action text-white': open }">Q</span>
                                    <span>{{ __('What does temp staffing cost with Freya Service?') }}</span>
                                </h3>
                                <span class="w-6 h-6 rounded-full bg-sand-200/80 group-hover:bg-sand-300/80 flex items-center justify-center shrink-0 mt-0.5 text-brand-secondary transition-[transform,background-color,color] duration-300 ease-out"
                                      :class="{ 'rotate-180 bg-brand-action text-white group-hover:bg-brand-action': open }">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </button>
                            <div class="faq-grid-collapse" :class="{ 'is-open': open }" x-cloak>
                                <div class="faq-grid-inner">
                                    <div class="pt-2.5 text-xs sm:text-sm text-brand-body leading-relaxed pl-7.5">
                                        <p class="m-0">
                                            {{ __('Temp staffing costs depend on the industry, job role, and shift type (day, evening, night, or weekend) in compliance with collective agreement tariffs. Base rates start from [PLACEHOLDER: DKK XXX per hour ex. VAT]. Invoicing is transparent with 25% Danish VAT and no hidden surcharges.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Q5 -->
                        <div x-data="{ open: false }"
                             class="bg-brand-surface rounded-2xl p-4 sm:p-5 lg:p-3.5 xl:p-4.5 border border-brand-border shadow-xs hover:border-brand-action/40 transition-[border-color,box-shadow,background-color] duration-200 ease-out"
                             :class="{ 'border-brand-action/50 shadow-md ring-1 ring-brand-action/20': open }">
                            <button @click="open = !open"
                                    type="button"
                                    class="w-full text-left flex items-start justify-between gap-3 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-action rounded-lg group cursor-pointer select-none"
                                    :aria-expanded="open.toString()">
                                <h3 class="text-sm sm:text-base lg:text-sm xl:text-base font-bold text-brand-secondary group-hover:text-brand-action transition-colors duration-200 flex items-start gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5 transition-colors duration-200"
                                          :class="{ 'bg-brand-action text-white': open }">Q</span>
                                    <span>{{ __('Which industries does Freya Service provide staff for?') }}</span>
                                </h3>
                                <span class="w-6 h-6 rounded-full bg-sand-200/80 group-hover:bg-sand-300/80 flex items-center justify-center shrink-0 mt-0.5 text-brand-secondary transition-[transform,background-color,color] duration-300 ease-out"
                                      :class="{ 'rotate-180 bg-brand-action text-white group-hover:bg-brand-action': open }">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </button>
                            <div class="faq-grid-collapse" :class="{ 'is-open': open }" x-cloak>
                                <div class="faq-grid-inner">
                                    <div class="pt-2.5 text-xs sm:text-sm text-brand-body leading-relaxed pl-7.5">
                                        <p class="m-0">
                                            {{ __('Freya Service supplies vetted temp staff across four core industries in Denmark: hotels (reception, housekeeping), restaurants and catering (chefs, waiters, kitchen assistants), warehouses and logistics (forklift drivers, pick-and-pack), and offices (administrative, customer service).') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Q6 -->
                        <div x-data="{ open: false }"
                             class="bg-brand-surface rounded-2xl p-4 sm:p-5 lg:p-3.5 xl:p-4.5 border border-brand-border shadow-xs hover:border-brand-action/40 transition-[border-color,box-shadow,background-color] duration-200 ease-out"
                             :class="{ 'border-brand-action/50 shadow-md ring-1 ring-brand-action/20': open }">
                            <button @click="open = !open"
                                    type="button"
                                    class="w-full text-left flex items-start justify-between gap-3 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-action rounded-lg group cursor-pointer select-none"
                                    :aria-expanded="open.toString()">
                                <h3 class="text-sm sm:text-base lg:text-sm xl:text-base font-bold text-brand-secondary group-hover:text-brand-action transition-colors duration-200 flex items-start gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5 transition-colors duration-200"
                                          :class="{ 'bg-brand-action text-white': open }">Q</span>
                                    <span>{{ __('How does Freya Service vet and verify temp workers?') }}</span>
                                </h3>
                                <span class="w-6 h-6 rounded-full bg-sand-200/80 group-hover:bg-sand-300/80 flex items-center justify-center shrink-0 mt-0.5 text-brand-secondary transition-[transform,background-color,color] duration-300 ease-out"
                                      :class="{ 'rotate-180 bg-brand-action text-white group-hover:bg-brand-action': open }">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </button>
                            <div class="faq-grid-collapse" :class="{ 'is-open': open }" x-cloak>
                                <div class="faq-grid-inner">
                                    <div class="pt-2.5 text-xs sm:text-sm text-brand-body leading-relaxed pl-7.5">
                                        <p class="m-0">
                                            {{ __('Every candidate undergoes personal interviews, reference validation, verification of valid Danish work permits, and criminal background checks prior to dispatch. On-site attendance and worked hours are verified digitally via QR-code time tracking.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to action / Contact (Primary Dark: Deep burgundy #5A1429) -->
    <section id="contact" class="py-10 sm:py-12 bg-navy text-white relative overflow-hidden border-t border-navy-800">
        <!-- Subtle atmospheric ambient background glows -->
        <div class="absolute inset-0 pointer-events-none select-none overflow-hidden" aria-hidden="true">
            <div class="absolute -top-20 -left-20 w-64 h-64 rounded-full bg-burgundy/20 blur-2xl"></div>
            <div class="absolute -bottom-20 -right-20 w-64 h-64 rounded-full bg-gold/10 blur-2xl"></div>
        </div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                {{ __('Ready to order temps or need immediate staffing?') }}
            </h2>
            <p class="text-sand-200 max-w-xl mx-auto text-xs sm:text-sm leading-relaxed">
                {{ __('Call our 24/7 emergency dispatch line directly or create your client account online in two minutes.') }}
            </p>
            <div class="flex flex-wrap justify-center gap-3.5 pt-2">
                <!-- Primary Action Button: Burgundy #7B1E3A with 2px white/35 border -->
                <a href="tel:+4528260926" class="btn-primary border-2 border-white/35 inline-flex items-center gap-2 px-5 py-2.5 sm:px-6 sm:py-3 rounded-lg bg-burgundy hover:bg-burgundy-dark text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5 focus-visible:ring-2 focus-visible:ring-burgundy focus:outline-none">
                    <x-heroicon-s-phone class="w-4 h-4 text-white" />
                    <span>{{ __('Ring +45 28 26 09 26') }}</span>
                </a>
                <!-- Secondary Action Button: Transparent with 2px teal border, white text on navy -->
                <a href="{{ route('register', ['role' => 'client']) }}" class="btn-secondary border-2 border-teal bg-transparent hover:bg-teal/15 inline-flex items-center gap-2 px-5 py-2.5 sm:px-6 sm:py-3 rounded-lg text-white font-bold text-xs sm:text-sm shadow-xs hover:shadow-sm transition-all duration-200 transform hover:-translate-y-0.5 focus-visible:ring-2 focus-visible:ring-teal focus:outline-none">
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
