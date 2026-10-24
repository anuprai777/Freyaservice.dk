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
            background-color: #14263F;
            background-image: radial-gradient(rgba(247, 246, 242, 0.08) 1.5px, transparent 0);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="bg-brand-bg text-brand-body antialiased selection:bg-brand-secondary selection:text-white">
    <!-- Floating Toast Notifications for Form Success & Alerts -->
    <x-notification-toast />

    <!-- Top Danish / English Info Bar (Primary Brand: Navy 900 #14263F, Warm Off-White #F7F6F2 text) -->
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

    <header x-data="{ mobileOpen: false }" class="sticky top-0 z-50 bg-brand-surface border-b border-brand-border shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 sm:h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="/" class="flex items-center group shrink-0 focus-visible:ring-2 focus-visible:ring-brand-action rounded-lg focus:outline-none" aria-label="Freya Service Forside">
                <img src="{{ asset('images/logo.png') }}" alt="Freya Service vikarbureau logo" class="h-9 sm:h-11 md:h-12 w-auto object-contain group-hover:scale-105 transition-transform" width="180" height="48">
            </a>

            <!-- Nav Links (Matching layout style: Services, Industries, How It Works, Contact) -->
            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold" aria-label="Hovednavigation">
                <a href="{{ route('services') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('services') ? 'text-brand-secondary border-brand-action' : 'text-brand-muted hover:text-brand-secondary hover:border-brand-action border-transparent' }} focus-visible:ring-2 focus-visible:ring-brand-action rounded-sm focus:outline-none">
                    <x-heroicon-o-briefcase class="w-4 h-4" />
                    <span>{{ __('Ydelser') }}</span>
                </a>
                <a href="{{ route('industries') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('industries') ? 'text-brand-secondary border-brand-action' : 'text-brand-muted hover:text-brand-secondary hover:border-brand-action border-transparent' }} focus-visible:ring-2 focus-visible:ring-brand-action rounded-sm focus:outline-none">
                    <x-heroicon-o-building-office-2 class="w-4 h-4" />
                    <span>{{ __('Brancher') }}</span>
                </a>
                <a href="{{ route('how-it-works') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('how-it-works') ? 'text-brand-secondary border-brand-action' : 'text-brand-muted hover:text-brand-secondary hover:border-brand-action border-transparent' }} focus-visible:ring-2 focus-visible:ring-brand-action rounded-sm focus:outline-none">
                    <x-heroicon-o-arrows-pointing-in class="w-4 h-4" />
                    <span>{{ __('Sådan virker det') }}</span>
                </a>
                <a href="{{ route('contact') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('contact') ? 'text-brand-secondary border-brand-action' : 'text-brand-muted hover:text-brand-secondary hover:border-brand-action border-transparent' }} focus-visible:ring-2 focus-visible:ring-brand-action rounded-sm focus:outline-none">
                    <x-heroicon-o-chat-bubble-bottom-center-text class="w-4 h-4" />
                    <span>{{ __('Kontakt') }}</span>
                </a>
            </nav>

            <!-- Auth Buttons -->
            <div class="flex items-center gap-2 sm:gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 px-3.5 sm:px-5 py-2 sm:py-2.5 rounded-xl text-xs sm:text-sm font-bold text-white bg-brand-action hover:bg-brand-action-hover shadow-sm transition focus-visible:ring-2 focus-visible:ring-brand-action focus:outline-none">
                            <x-heroicon-o-squares-2x2 class="w-4 h-4 shrink-0" />
                            <span class="hidden sm:inline">{{ __('Min Profil / Dashboard') }}</span>
                            <span class="sm:hidden">{{ __('Dashboard') }}</span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5 hidden sm:inline shrink-0" />
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden lg:flex text-sm font-bold text-brand-secondary hover:text-brand-action px-3 py-2 rounded-lg transition items-center gap-1.5 focus-visible:ring-2 focus-visible:ring-brand-action focus:outline-none">
                            <x-heroicon-o-arrow-right-end-on-rectangle class="w-4 h-4 text-brand-muted" />
                            <span>{{ __('Log ind') }}</span>
                        </a>

                        @if (Route::has('register'))
                            <!-- Primary CTA Button: Action / Accent Orange 500 #E8833A, hover Orange 600 #D2702A -->
                            <a href="{{ route('register') }}" class="hidden lg:inline-flex items-center justify-center gap-1.5 px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-brand-action hover:bg-brand-action-hover shadow-md transition focus-visible:ring-2 focus-visible:ring-brand-action focus:outline-none">
                                <x-heroicon-o-user-plus class="w-4 h-4" />
                                <span>{{ __('Opret konto') }}</span>
                            </a>
                        @endif
                    @endauth
                @endif

                <!-- Mobile Hamburger Toggle Button -->
                <button @click="mobileOpen = !mobileOpen" type="button" class="lg:hidden inline-flex items-center justify-center p-2.5 min-h-[44px] min-w-[44px] rounded-xl text-brand-muted hover:text-brand-secondary hover:bg-brand-bg focus-visible:ring-2 focus-visible:ring-brand-action focus:outline-none transition" aria-label="Menu" :aria-expanded="mobileOpen.toString()">
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
             class="lg:hidden border-t border-brand-border bg-brand-surface shadow-xl">
            <!-- Mobile Language Selector -->
            <div class="px-4 py-3 flex items-center justify-between border-b border-brand-border bg-brand-bg/60">
                <span class="text-xs font-bold text-brand-muted uppercase tracking-wider">{{ __('Sprog / Language') }}</span>
                <div class="flex items-center gap-1 bg-brand-surface p-1 rounded-xl border border-brand-border text-xs">
                    <a href="{{ route('locale.switch', 'da') }}" class="px-3 py-1.5 min-h-[36px] rounded-lg transition flex items-center gap-1.5 {{ app()->getLocale() === 'da' ? 'bg-brand-bg text-brand-secondary font-bold underline underline-offset-4 decoration-2 decoration-brand-action shadow-sm' : 'text-brand-muted font-medium' }}">
                        <span>🇩🇰</span><span>Dansk</span>
                    </a>
                    <a href="{{ route('locale.switch', 'en') }}" class="px-3 py-1.5 min-h-[36px] rounded-lg transition flex items-center gap-1.5 {{ app()->getLocale() === 'en' ? 'bg-brand-bg text-brand-secondary font-bold underline underline-offset-4 decoration-2 decoration-brand-action shadow-sm' : 'text-brand-muted font-medium' }}">
                        <span>🇬🇧</span><span>English</span>
                    </a>
                </div>
            </div>

            <!-- Mobile Navigation Links -->
            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('services') }}" class="flex items-center gap-3 px-3 py-2.5 min-h-[44px] rounded-xl text-sm font-semibold transition {{ request()->routeIs('services') ? 'bg-navy-50 text-brand-secondary font-bold' : 'text-brand-body hover:bg-brand-bg hover:text-brand-secondary' }} focus-visible:ring-2 focus-visible:ring-brand-action focus:outline-none">
                    <x-heroicon-o-briefcase class="w-5 h-5 text-brand-action" />
                    <span>{{ __('Ydelser') }}</span>
                </a>
                <a href="{{ route('industries') }}" class="flex items-center gap-3 px-3 py-2.5 min-h-[44px] rounded-xl text-sm font-semibold transition {{ request()->routeIs('industries') ? 'bg-navy-50 text-brand-secondary font-bold' : 'text-brand-body hover:bg-brand-bg hover:text-brand-secondary' }} focus-visible:ring-2 focus-visible:ring-brand-action focus:outline-none">
                    <x-heroicon-o-building-office-2 class="w-5 h-5 text-brand-action" />
                    <span>{{ __('Brancher') }}</span>
                </a>
                <a href="{{ route('how-it-works') }}" class="flex items-center gap-3 px-3 py-2.5 min-h-[44px] rounded-xl text-sm font-semibold transition {{ request()->routeIs('how-it-works') ? 'bg-navy-50 text-brand-secondary font-bold' : 'text-brand-body hover:bg-brand-bg hover:text-brand-secondary' }} focus-visible:ring-2 focus-visible:ring-brand-action focus:outline-none">
                    <x-heroicon-o-arrows-pointing-in class="w-5 h-5 text-brand-action" />
                    <span>{{ __('Sådan virker det') }}</span>
                </a>
                <a href="{{ route('contact') }}" class="flex items-center gap-3 px-3 py-2.5 min-h-[44px] rounded-xl text-sm font-semibold transition {{ request()->routeIs('contact') ? 'bg-navy-50 text-brand-secondary font-bold' : 'text-brand-body hover:bg-brand-bg hover:text-brand-secondary' }} focus-visible:ring-2 focus-visible:ring-brand-action focus:outline-none">
                    <x-heroicon-o-chat-bubble-bottom-center-text class="w-5 h-5 text-brand-action" />
                    <span>{{ __('Kontakt') }}</span>
                </a>
            </div>

            <!-- Mobile Auth / CTA -->
            <div class="p-4 border-t border-brand-border">
                @auth
                    <a href="{{ url('/dashboard') }}" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 min-h-[44px] rounded-xl text-sm font-bold text-white bg-brand-action hover:bg-brand-action-hover shadow-md transition">
                        <x-heroicon-o-squares-2x2 class="w-5 h-5" />
                        <span>{{ __('Gå til Dashboard') }}</span>
                        <x-heroicon-o-arrow-right class="w-4 h-4" />
                    </a>
                @else
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 min-h-[44px] rounded-xl text-sm font-bold text-brand-secondary bg-brand-bg hover:bg-slate-100 border border-brand-border transition">
                            <x-heroicon-o-arrow-right-end-on-rectangle class="w-4 h-4 text-brand-muted" />
                            <span>{{ __('Log ind') }}</span>
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 min-h-[44px] rounded-xl text-sm font-bold text-white bg-brand-action hover:bg-brand-action-hover shadow-sm transition">
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

    <!-- Hero Section (Centered Design: 3D Flip Headline & Clean Stats) -->
    <section id="heroSection" class="hero-pattern text-white pt-16 pb-20 sm:pt-24 sm:pb-28 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="max-w-6xl mx-auto w-full relative z-10 flex flex-col items-center text-center">
            
            <!-- 16+ Years Experience Rounded Badge (Matching User Reference Design) -->
            <div class="mb-6 flex justify-center">
                <x-experience-badge />
            </div>

            <!-- Headline (H1): Exactly one H1 in sentence case with verified claims -->
            <h1 
                id="heroHeadline" 
                class="font-black tracking-tight leading-[1.18] text-white max-w-4xl mx-auto"
                style="font-size: clamp(2rem, 5.6vw, 4rem);"
                aria-live="polite"
                data-words1='@json($words1)'
                data-words2='@json($words2)'
            >
                @if($isEn)
                    <span class="hero-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span id="flipWord1" class="hero-flip-word" style="color:#5a9e78; display:inline-block; white-space:nowrap; transform-origin:50% 50%;">Temp</span></span> staffing in Denmark: vetted <span class="hero-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span id="flipWord2" class="hero-flip-word" style="color:#5a9e78; display:inline-block; white-space:nowrap; transform-origin:50% 50%;">temps</span></span> ready in under 2 hours
                @else
                    <span class="hero-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span id="flipWord1" class="hero-flip-word" style="color:#5a9e78; display:inline-block; white-space:nowrap; transform-origin:50% 50%;">Vikar</span></span>bureau i Danmark: godkendte <span class="hero-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span id="flipWord2" class="hero-flip-word" style="color:#5a9e78; display:inline-block; white-space:nowrap; transform-origin:50% 50%;">vikarer</span></span> klar på under 2 timer
                @endif
            </h1>

            <!-- Intro Copy: Plain, specific language with main keyword, vikarbureau, 16+ years exp and core offer -->
            <p class="mt-6 text-base sm:text-lg lg:text-xl text-sand-100/90 max-w-3xl mx-auto leading-relaxed">
                {{ __('With 16+ years of experience, Freya Service is a Danish vikarbureau providing nationwide temp staffing for hotels, restaurants, warehouses and offices in under 2 hours, with no lock-in or onboarding fees.') }}
            </p>

            <!-- Action Bar (CTA Buttons) -->
            <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-4 w-full sm:w-auto max-w-md sm:max-w-none">
                <!-- Primary CTA Button: Orange 500 #E8833A, hover Orange 600 #D2702A -->
                @auth
                    @if(auth()->user()->isClient())
                        <a href="{{ route('client.requests.create') }}" class="inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-xl text-base font-extrabold text-white bg-brand-action hover:bg-brand-action-hover shadow-lg shadow-brand-action/30 transition-all transform hover:-translate-y-0.5 min-h-[48px]">
                            <x-heroicon-o-briefcase class="w-5 h-5 text-white shrink-0" />
                            <span>{{ __('Bestil vikar nu') }}</span>
                            <x-heroicon-o-arrow-right class="w-5 h-5 shrink-0" />
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-xl text-base font-extrabold text-white bg-brand-action hover:bg-brand-action-hover shadow-lg shadow-brand-action/30 transition-all transform hover:-translate-y-0.5 min-h-[48px]">
                            <x-heroicon-o-briefcase class="w-5 h-5 text-white shrink-0" />
                            <span>{{ __('Bestil vikar nu') }}</span>
                            <x-heroicon-o-arrow-right class="w-5 h-5 shrink-0" />
                        </a>
                    @endif
                @else
                    <a href="{{ route('register', ['role' => 'client']) }}" class="inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-xl text-base font-extrabold text-white bg-brand-action hover:bg-brand-action-hover shadow-lg shadow-brand-action/30 transition-all transform hover:-translate-y-0.5 min-h-[48px]">
                        <x-heroicon-o-briefcase class="w-5 h-5 text-white shrink-0" />
                        <span>{{ __('Bestil vikar nu') }}</span>
                        <x-heroicon-o-arrow-right class="w-5 h-5 shrink-0" />
                    </a>
                @endauth

                <!-- Secondary CTA Button: Navy 800 -->
                @auth
                    <a href="{{ auth()->user()->isWorker() ? route('worker.dashboard') : route('dashboard') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl text-base font-bold text-white bg-navy-800 hover:bg-navy-700 border border-navy-600 shadow-sm transition min-h-[48px]">
                        <x-heroicon-o-user-plus class="w-5 h-5 shrink-0" />
                        <span>{{ __('Tilmeld dig som vikar') }}</span>
                    </a>
                @else
                    <a href="{{ route('register', ['role' => 'worker']) }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl text-base font-bold text-white bg-navy-800 hover:bg-navy-700 border border-navy-600 shadow-sm transition min-h-[48px]">
                        <x-heroicon-o-user-plus class="w-5 h-5 shrink-0" />
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
            color: #5a9e78;
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
    </script>

    <!-- Why Choose Freya Service Section (Comprehensive Makeover: Premium, Structured & Trust-Building) -->
    <section id="why-choose" class="py-24 bg-gradient-to-b from-brand-bg via-brand-surface to-brand-bg border-y border-brand-border relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#14263F 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="text-xs font-bold text-brand-action uppercase tracking-widest mb-3">{{ __('Core values & guarantees') }}</div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-brand-secondary tracking-tight">
                    {{ __('Why choose Freya Service') }}
                </h2>
                <p class="mt-4 text-base sm:text-lg text-brand-muted leading-relaxed">
                    {{ __('A modern Danish vikarbureau built on transparent pricing and vetted quality') }}
                </p>
            </div>

            <!-- 6 Structured Value Cards -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <!-- 1. Akut Udrykning -->
                <div class="bg-brand-surface rounded-2xl p-8 border border-brand-border shadow-sm hover:shadow-xl hover:border-brand-action/40 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-action-50 text-brand-action flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform mb-6">
                            <x-heroicon-o-bolt class="w-7 h-7 text-brand-action" />
                        </div>
                        <h3 class="text-xl font-bold text-brand-secondary mb-3 group-hover:text-brand-action transition-colors">
                            {{ __('Urgent 24/7 temp dispatch') }}
                        </h3>
                        <p class="text-sm text-brand-body leading-relaxed">
                            {{ __('When sudden illness or peak workloads hit, we dispatch experienced workers within under 2 hours across Denmark.') }}
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-brand-border/60 flex items-center gap-2 text-xs font-semibold text-brand-secondary">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" />
                        <span>{{ __('24/7 Akut vagtcentral') }}</span>
                    </div>
                </div>

                <!-- 2. Gennemtestede vikarer -->
                <div class="bg-brand-surface rounded-2xl p-8 border border-brand-border shadow-sm hover:shadow-xl hover:border-brand-secondary/40 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-navy-50 text-brand-secondary flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform mb-6">
                            <x-heroicon-o-shield-check class="w-7 h-7 text-brand-secondary" />
                        </div>
                        <h3 class="text-xl font-bold text-brand-secondary mb-3 group-hover:text-brand-secondary transition-colors">
                            {{ __('Thoroughly vetted temps') }}
                        </h3>
                        <p class="text-sm text-brand-body leading-relaxed">
                            {{ __('Every temp is interviewed personally, with verified criminal records, work permits and validated references before deployment.') }}
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-brand-border/60 flex items-center gap-2 text-xs font-semibold text-brand-secondary">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" />
                        <span>{{ __('Kvalitetsgaranti på hver opgave') }}</span>
                    </div>
                </div>

                <!-- 3. Digital time- & QR-registrering -->
                <div class="bg-brand-surface rounded-2xl p-8 border border-brand-border shadow-sm hover:shadow-xl hover:border-forest/40 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-forest-50 text-forest flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform mb-6">
                            <x-heroicon-o-qr-code class="w-7 h-7 text-forest" />
                        </div>
                        <h3 class="text-xl font-bold text-brand-secondary mb-3 group-hover:text-forest transition-colors">
                            {{ __('Digital time & QR logging') }}
                        </h3>
                        <p class="text-sm text-brand-body leading-relaxed">
                            {{ __('Accurate check-in and check-out via on-site QR code. No manual paper timesheets – only verified and approved hours.') }}
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-brand-border/60 flex items-center gap-2 text-xs font-semibold text-brand-secondary">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" />
                        <span>{{ __('Fuld gennemsigtighed på mobilen') }}</span>
                    </div>
                </div>

                <!-- 4. Overenskomstmæssige vilkår -->
                <div class="bg-brand-surface rounded-2xl p-8 border border-brand-border shadow-sm hover:shadow-xl hover:border-brand-secondary/40 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-navy-50 text-brand-secondary flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform mb-6">
                            <x-heroicon-o-document-check class="w-7 h-7 text-brand-secondary" />
                        </div>
                        <h3 class="text-xl font-bold text-brand-secondary mb-3 group-hover:text-brand-secondary transition-colors">
                            {{ __('100% collective agreement compliance') }}
                        </h3>
                        <p class="text-sm text-brand-body leading-relaxed">
                            {{ __('We strictly follow Danish collective agreements, guaranteeing proper wages, pension, holiday pay and mandatory accident insurance.') }}
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-brand-border/60 flex items-center gap-2 text-xs font-semibold text-brand-secondary">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" />
                        <span>{{ __('Lovpligtig arbejdsskadeforsikring') }}</span>
                    </div>
                </div>

                <!-- 5. Fast kontaktperson & Ingen binding -->
                <div class="bg-brand-surface rounded-2xl p-8 border border-brand-border shadow-sm hover:shadow-xl hover:border-brand-action/40 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-action-50 text-brand-action flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform mb-6">
                            <x-heroicon-o-user-group class="w-7 h-7 text-brand-action" />
                        </div>
                        <h3 class="text-xl font-bold text-brand-secondary mb-3 group-hover:text-brand-action transition-colors">
                            {{ __('Dedicated contact & no lock-in') }}
                        </h3>
                        <p class="text-sm text-brand-body leading-relaxed">
                            {{ __('Get a direct staffing consultant who understands your requirements, with full flexibility and zero hidden cancellation fees.') }}
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-brand-border/60 flex items-center gap-2 text-xs font-semibold text-brand-secondary">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" />
                        <span>{{ __('Direkte kontakt til din rådgiver') }}</span>
                    </div>
                </div>

                <!-- 6. Sikkerhed & Gennemskuelig Fakturering -->
                <div class="bg-brand-surface rounded-2xl p-8 border border-brand-border shadow-sm hover:shadow-xl hover:border-forest/40 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-forest-50 text-forest flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform mb-6">
                            <x-heroicon-o-lock-closed class="w-7 h-7 text-forest" />
                        </div>
                        <h3 class="text-xl font-bold text-brand-secondary mb-3 group-hover:text-forest transition-colors">
                            {{ __('Transparent invoicing & data security') }}
                        </h3>
                        <p class="text-sm text-brand-body leading-relaxed">
                            {{ __('Clear invoicing with 25% Danish VAT, encrypted data, GDPR compliance and zero surprise surcharges.') }}
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-brand-border/60 flex items-center gap-2 text-xs font-semibold text-brand-secondary">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" />
                        <span>{{ __('Kryptering & Ingen skjulte gebyrer') }}</span>
                    </div>
                </div>
            </div>

            <!-- Trust Bar / Key Metrics Strip (Retaining All Verified Claims) -->
            <div class="bg-brand-primary text-white rounded-3xl p-8 sm:p-10 shadow-2xl relative overflow-hidden border border-navy-800">
                <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-6 text-center relative z-10">
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-navy-950 border border-navy-800 lg:border-0 lg:bg-transparent lg:p-0">
                        <div class="text-2xl sm:text-4xl font-black text-brand-action tracking-tight">&lt; 2t</div>
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
                        <div class="text-2xl sm:text-4xl font-black text-forest-300 tracking-tight">98%</div>
                        <div class="text-[11px] sm:text-xs text-sand-200 font-medium mt-1">{{ __('Client satisfaction') }}</div>
                    </div>
                    <div class="col-span-2 lg:col-span-1 p-3.5 sm:p-4 rounded-2xl bg-navy-950 border border-navy-800 lg:border-0 lg:bg-transparent lg:p-0 lg:border-l lg:border-navy-700 lg:pl-6">
                        <div class="text-2xl sm:text-4xl font-black text-forest-300 tracking-tight">24/7</div>
                        <div class="text-[11px] sm:text-xs text-sand-200 font-medium mt-1">
                            <a href="tel:+4528260926" class="hover:text-brand-action transition-colors focus-visible:ring-2 focus-visible:ring-brand-action rounded">{{ __('Emergency dispatch') }}: +45 28 26 09 26</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Industries Section (Hotel, Restaurant, Warehouse, Office with Links and One-line Descriptions) -->
    <section id="industries" class="py-20 bg-sand-200/50 border-y border-brand-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="text-xs font-bold text-brand-action uppercase tracking-widest mb-3">{{ __('Specialized sectors') }}</div>
                <h2 class="text-3xl sm:text-4xl font-black text-brand-secondary tracking-tight">
                    {{ __('Industries we staff with qualified temps') }}
                </h2>
                <p class="mt-3 text-sm text-brand-body leading-relaxed">
                    {{ __('Freya Service provides pre-screened temporary workers across four core sectors in Denmark, matching required certifications, experience and language skills to every shift.') }}
                </p>
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
    <section id="faq" class="py-24 bg-sand-200/40 border-t border-brand-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="text-xs font-bold text-brand-action uppercase tracking-widest mb-3">{{ __('Frequently asked questions') }}</div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-secondary tracking-tight">
                    {{ __('Frequently asked questions about temp staffing in Denmark') }}
                </h2>
                <p class="mt-3 text-sm text-brand-body leading-relaxed max-w-2xl mx-auto">
                    {{ __('Factual, straightforward answers about response times, pricing, collective agreements, vetting and booking terms.') }}
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-6 max-w-5xl mx-auto">
                <!-- Q1 -->
                <div class="bg-brand-surface rounded-2xl p-6 sm:p-8 border border-brand-border shadow-xs hover:border-brand-action/30 transition flex flex-col justify-between">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-brand-secondary flex items-start gap-3">
                            <span class="w-6 h-6 rounded-lg bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">Q</span>
                            <span>{{ __('How fast can I get a temp in Denmark?') }}</span>
                        </h3>
                        <p class="mt-3 text-sm text-brand-body leading-relaxed pl-9">
                            {{ __('Freya Service dispatches qualified temps in under 2 hours for urgent staffing requests nationwide. Planned shifts can also be scheduled days or weeks ahead via our 24/7 emergency dispatch line (+45 28 26 09 26) or online client portal.') }}
                        </p>
                    </div>
                </div>

                <!-- Q2 -->
                <div class="bg-brand-surface rounded-2xl p-6 sm:p-8 border border-brand-border shadow-xs hover:border-brand-action/30 transition flex flex-col justify-between">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-brand-secondary flex items-start gap-3">
                            <span class="w-6 h-6 rounded-lg bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">Q</span>
                            <span>{{ __('Are there any lock-in periods or onboarding fees?') }}</span>
                        </h3>
                        <p class="mt-3 text-sm text-brand-body leading-relaxed pl-9">
                            {{ __('No. Freya Service operates with zero lock-in contracts, zero subscription fees, and zero onboarding fees. You only pay for the approved hours worked by the dispatched temp.') }}
                        </p>
                    </div>
                </div>

                <!-- Q3 -->
                <div class="bg-brand-surface rounded-2xl p-6 sm:p-8 border border-brand-border shadow-xs hover:border-brand-action/30 transition flex flex-col justify-between">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-brand-secondary flex items-start gap-3">
                            <span class="w-6 h-6 rounded-lg bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">Q</span>
                            <span>{{ __('Do Freya Service temps follow Danish collective agreements?') }}</span>
                        </h3>
                        <p class="mt-3 text-sm text-brand-body leading-relaxed pl-9">
                            {{ __('Yes. 100% of temporary workers dispatched by Freya Service are employed under Danish collective agreement terms (overenskomst), including statutory pension, holiday pay (feriepenge), sick pay, and mandatory workplace injury insurance.') }}
                        </p>
                    </div>
                </div>

                <!-- Q4 -->
                <div class="bg-brand-surface rounded-2xl p-6 sm:p-8 border border-brand-border shadow-xs hover:border-brand-action/30 transition flex flex-col justify-between">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-brand-secondary flex items-start gap-3">
                            <span class="w-6 h-6 rounded-lg bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">Q</span>
                            <span>{{ __('What does temp staffing cost with Freya Service?') }}</span>
                        </h3>
                        <p class="mt-3 text-sm text-brand-body leading-relaxed pl-9">
                            {{ __('Temp staffing costs depend on the industry, job role, and shift type (day, evening, night, or weekend) in compliance with collective agreement tariffs. Base rates start from [PLACEHOLDER: DKK XXX per hour ex. VAT]. Invoicing is transparent with 25% Danish VAT and no hidden surcharges.') }}
                        </p>
                    </div>
                </div>

                <!-- Q5 -->
                <div class="bg-brand-surface rounded-2xl p-6 sm:p-8 border border-brand-border shadow-xs hover:border-brand-action/30 transition flex flex-col justify-between">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-brand-secondary flex items-start gap-3">
                            <span class="w-6 h-6 rounded-lg bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">Q</span>
                            <span>{{ __('Which industries does Freya Service provide staff for?') }}</span>
                        </h3>
                        <p class="mt-3 text-sm text-brand-body leading-relaxed pl-9">
                            {{ __('Freya Service supplies vetted temp staff across four core industries in Denmark: hotels (reception, housekeeping), restaurants and catering (chefs, waiters, kitchen assistants), warehouses and logistics (forklift drivers, pick-and-pack), and offices (administrative, customer service).') }}
                        </p>
                    </div>
                </div>

                <!-- Q6 -->
                <div class="bg-brand-surface rounded-2xl p-6 sm:p-8 border border-brand-border shadow-xs hover:border-brand-action/30 transition flex flex-col justify-between">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-brand-secondary flex items-start gap-3">
                            <span class="w-6 h-6 rounded-lg bg-action-50 text-brand-action flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">Q</span>
                            <span>{{ __('How does Freya Service vet and verify temp workers?') }}</span>
                        </h3>
                        <p class="mt-3 text-sm text-brand-body leading-relaxed pl-9">
                            {{ __('Every candidate undergoes personal interviews, reference validation, verification of valid Danish work permits, and criminal background checks prior to dispatch. On-site attendance and worked hours are verified digitally via QR-code time tracking.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to action / Contact (Primary Brand: Navy 900 #14263F) -->
    <section id="contact" class="py-16 bg-brand-primary text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            <h2 class="text-3xl font-extrabold text-white">
                {{ __('Ready to order temps or need immediate staffing?') }}
            </h2>
            <p class="text-sand-200 max-w-xl mx-auto text-sm leading-relaxed">
                {{ __('Call our 24/7 emergency dispatch line directly or create your client account online in two minutes.') }}
            </p>
            <div class="flex flex-wrap justify-center gap-4 pt-4">
                <!-- Action Button: Orange 500 #E8833A, hover Orange 600 #D2702A -->
                <a href="tel:+4528260926" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-brand-action text-white font-bold text-sm hover:bg-brand-action-hover shadow-md transition focus-visible:ring-2 focus-visible:ring-brand-action focus:outline-none">
                    <x-heroicon-s-phone class="w-4 h-4 text-white" />
                    <span>{{ __('Ring +45 28 26 09 26') }}</span>
                </a>
                <a href="{{ route('register', ['role' => 'client']) }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-brand-secondary text-white font-bold text-sm hover:bg-navy-800 transition focus-visible:ring-2 focus-visible:ring-brand-action focus:outline-none">
                    <x-heroicon-o-building-office class="w-4 h-4" />
                    <span>{{ __('Opret virksomhedskonto') }}</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer (Primary Brand: Navy 900 #14263F, Border: Navy 800) -->
    <footer class="bg-brand-primary text-sand-300 py-12 border-t border-navy-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-4 gap-8">
            <div class="space-y-4">
                <a href="/" class="inline-block group focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none" aria-label="Freya Service">
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
                    <li><a href="{{ route('register', ['role' => 'client']) }}" class="hover:text-brand-action flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-sand-400" />{{ __('Bestil Vikar') }}</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-brand-action flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-sand-400" />{{ __('Timesedler') }}</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-brand-action flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-sand-400" />{{ __('Fakturaer') }}</a></li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-bold text-white uppercase tracking-wider mb-3">{{ __('Vikarer') }}</p>
                <ul class="text-xs space-y-2">
                    <li><a href="{{ route('register', ['role' => 'worker']) }}" class="hover:text-brand-action flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-sand-400" />{{ __('Tilmeld dig som vikar') }}</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-brand-action flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-sand-400" />{{ __('Ledige Vagter') }}</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-brand-action flex items-center gap-1.5 transition focus-visible:ring-2 focus-visible:ring-brand-action rounded focus:outline-none"><x-heroicon-o-chevron-right class="w-3 h-3 text-sand-400" />{{ __('QR Tjek-ind') }}</a></li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-bold text-white uppercase tracking-wider mb-3">{{ __('GDPR & Sikkerhed') }}</p>
                <ul class="text-xs space-y-2">
                    <li class="flex items-start gap-1.5">
                        <x-heroicon-s-shield-check class="w-4 h-4 text-forest shrink-0 mt-0.5" />
                        <span class="text-sand-200">{{ __('Ingen CPR-numre gemmes i systemet. Bankoplysninger krypteres med AES-256.') }}</span>
                    </li>
                    <li class="flex items-start gap-1.5">
                        <x-heroicon-s-check class="w-4 h-4 text-brand-action shrink-0 mt-0.5" />
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
