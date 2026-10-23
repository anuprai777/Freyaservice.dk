<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('FreyaService | Vikarbureau i Danmark – Kvalitetsvikarer til Virksomheder') }}</title>
    <meta name="description" content="{{ __('FreyaService leverer professionelle og pålidelige vikarer til hotel, restaurant, rengøring, lager og logistik samt kontor i hele Danmark.') }}">

    <!-- Favicon & Touch Icon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-icon.png') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook / LinkedIn / WhatsApp -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="FreyaService">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ __('FreyaService | Vikarbureau i Danmark – Kvalitetsvikarer til Virksomheder') }}">
    <meta property="og:description" content="{{ __('FreyaService leverer professionelle og pålidelige vikarer til hotel, restaurant, rengøring, lager og logistik samt kontor i hele Danmark.') }}">
    <meta property="og:image" content="{{ asset('images/og-image.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="{{ app()->getLocale() === 'da' ? 'da_DK' : 'en_US' }}">

    <!-- Twitter / X Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ __('FreyaService | Vikarbureau i Danmark – Kvalitetsvikarer til Virksomheder') }}">
    <meta name="twitter:description" content="{{ __('FreyaService leverer professionelle og pålidelige vikarer til hotel, restaurant, rengøring, lager og logistik samt kontor i hele Danmark.') }}">
    <meta name="twitter:image" content="{{ asset('images/og-image.png') }}">

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
                    <span>{{ __('Akut vagttelefon') }}: <a href="tel:+4570203040" class="text-white hover:text-brand-action font-semibold">+45 70 20 30 40</a></span>
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
            <a href="/" class="flex items-center group shrink-0">
                <img src="{{ asset('images/logo.png') }}" alt="Freya Service" class="h-9 sm:h-11 md:h-12 w-auto object-contain group-hover:scale-105 transition-transform">
            </a>

            <!-- Nav Links (Secondary Brand Navy 700 on hover, Muted Text Cool Slate #6B7686) -->
            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold text-brand-muted">
                <a href="{{ route('services') }}" class="hover:text-brand-secondary transition-colors flex items-center gap-1.5">
                    <x-heroicon-o-briefcase class="w-4 h-4 text-brand-muted" />
                    <span>{{ __('Ydelser') }}</span>
                </a>
                <a href="{{ route('industries') }}" class="hover:text-brand-secondary transition-colors flex items-center gap-1.5">
                    <x-heroicon-o-building-office-2 class="w-4 h-4 text-brand-muted" />
                    <span>{{ __('Brancher') }}</span>
                </a>
                <a href="{{ route('how-it-works') }}" class="hover:text-brand-secondary transition-colors flex items-center gap-1.5">
                    <x-heroicon-o-arrows-pointing-in class="w-4 h-4 text-brand-muted" />
                    <span>{{ __('Sådan virker det') }}</span>
                </a>
                <a href="{{ route('contact') }}" class="hover:text-brand-secondary transition-colors flex items-center gap-1.5">
                    <x-heroicon-o-chat-bubble-bottom-center-text class="w-4 h-4 text-brand-muted" />
                    <span>{{ __('Kontakt') }}</span>
                </a>
            </nav>

            <!-- Language Switcher & Auth Buttons -->
            <div class="flex items-center gap-2 sm:gap-3">
                <!-- Desktop Language Switcher Pill -->
                <div class="hidden sm:flex items-center gap-1 bg-brand-bg p-1 rounded-xl border border-brand-border text-xs">
                    <a href="{{ route('locale.switch', 'da') }}" title="Dansk" class="px-2.5 py-1 rounded-lg transition flex items-center gap-1 {{ app()->getLocale() === 'da' ? 'bg-brand-surface text-brand-secondary shadow-sm font-bold underline underline-offset-4 decoration-2 decoration-brand-action' : 'text-brand-muted hover:text-brand-secondary font-medium' }}">
                        <span>🇩🇰</span>
                        <span>DA</span>
                    </a>
                    <a href="{{ route('locale.switch', 'en') }}" title="English" class="px-2.5 py-1 rounded-lg transition flex items-center gap-1 {{ app()->getLocale() === 'en' ? 'bg-brand-surface text-brand-secondary shadow-sm font-bold underline underline-offset-4 decoration-2 decoration-brand-action' : 'text-brand-muted hover:text-brand-secondary font-medium' }}">
                        <span>🇬🇧</span>
                        <span>EN</span>
                    </a>
                </div>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 px-3.5 sm:px-5 py-2 sm:py-2.5 rounded-xl text-xs sm:text-sm font-bold text-white bg-brand-action hover:bg-brand-action-hover shadow-sm transition">
                            <x-heroicon-o-squares-2x2 class="w-4 h-4 shrink-0" />
                            <span class="hidden sm:inline">{{ __('Min Profil / Dashboard') }}</span>
                            <span class="sm:hidden">{{ __('Dashboard') }}</span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5 hidden sm:inline shrink-0" />
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden lg:flex text-sm font-bold text-brand-secondary hover:text-brand-action px-3 py-2 rounded-lg transition items-center gap-1.5">
                            <x-heroicon-o-arrow-right-end-on-rectangle class="w-4 h-4 text-brand-muted" />
                            <span>{{ __('Log ind') }}</span>
                        </a>

                        @if (Route::has('register'))
                            <!-- Primary CTA Button: Action / Accent Orange 500 #E8833A, hover Orange 600 #D2702A -->
                            <a href="{{ route('register') }}" class="hidden lg:inline-flex items-center justify-center gap-1.5 px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-brand-action hover:bg-brand-action-hover shadow-md transition">
                                <x-heroicon-o-user-plus class="w-4 h-4" />
                                <span>{{ __('Opret konto') }}</span>
                            </a>
                        @endif
                    @endauth
                @endif

                <!-- Mobile Hamburger Toggle Button -->
                <button @click="mobileOpen = !mobileOpen" type="button" class="lg:hidden inline-flex items-center justify-center p-2.5 min-h-[44px] min-w-[44px] rounded-xl text-brand-muted hover:text-brand-secondary hover:bg-brand-bg focus:outline-none transition" aria-label="Menu">
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
                <a href="{{ route('services') }}" class="flex items-center gap-3 px-3 py-2.5 min-h-[44px] rounded-xl text-sm font-semibold transition text-brand-body hover:bg-brand-bg hover:text-brand-secondary">
                    <x-heroicon-o-briefcase class="w-5 h-5 text-brand-action" />
                    <span>{{ __('Ydelser') }}</span>
                </a>
                <a href="{{ route('industries') }}" class="flex items-center gap-3 px-3 py-2.5 min-h-[44px] rounded-xl text-sm font-semibold transition text-brand-body hover:bg-brand-bg hover:text-brand-secondary">
                    <x-heroicon-o-building-office-2 class="w-5 h-5 text-brand-action" />
                    <span>{{ __('Brancher') }}</span>
                </a>
                <a href="{{ route('how-it-works') }}" class="flex items-center gap-3 px-3 py-2.5 min-h-[44px] rounded-xl text-sm font-semibold transition text-brand-body hover:bg-brand-bg hover:text-brand-secondary">
                    <x-heroicon-o-arrows-pointing-in class="w-5 h-5 text-brand-action" />
                    <span>{{ __('Sådan virker det') }}</span>
                </a>
                <a href="{{ route('contact') }}" class="flex items-center gap-3 px-3 py-2.5 min-h-[44px] rounded-xl text-sm font-semibold transition text-brand-body hover:bg-brand-bg hover:text-brand-secondary">
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
        $words1 = $isEn ? ['Temp', 'Full-time', 'Part-time'] : ['Vikar', 'Fuldtid', 'Deltid'];
        $words2 = $isEn ? ['Temps', 'Full-timers', 'Part-timers'] : ['Vikarer', 'Fuldtidsansatte', 'Deltidsansatte'];
    @endphp

    <!-- Hero Section (Centered Design: 3D Flip Headline & Clean Stats) -->
    <section id="heroSection" class="hero-pattern text-white pt-16 pb-20 sm:pt-24 sm:pb-28 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="max-w-6xl mx-auto w-full relative z-10 flex flex-col items-center text-center">
            
            <!-- Headline (H1): 3D Flipping Headline with clamp(2rem, 5.6vw, 4rem) and aria-live="polite" -->
            <h1 
                id="heroHeadline" 
                class="font-black tracking-tight leading-[1.18] text-white max-w-4xl mx-auto"
                style="font-size: clamp(2rem, 5.6vw, 4rem);"
                aria-live="polite"
                data-words1='@json($words1)'
                data-words2='@json($words2)'
            >
                @if($isEn)
                    <span class="hero-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span id="flipWord1" class="hero-flip-word" style="color:#5a9e78; display:inline-block; white-space:nowrap; transform-origin:50% 50%;">Temp</span></span> Staffing in Denmark: Qualified <span class="hero-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span id="flipWord2" class="hero-flip-word" style="color:#5a9e78; display:inline-block; white-space:nowrap; transform-origin:50% 50%;">Temps</span></span> in Under 2 Hours
                @else
                    <span class="hero-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span id="flipWord1" class="hero-flip-word" style="color:#5a9e78; display:inline-block; white-space:nowrap; transform-origin:50% 50%;">Vikar</span></span> bemanding i Danmark: Kvalificerede <span class="hero-flip-container" style="display:inline-block; white-space:nowrap; perspective:600px;"><span id="flipWord2" class="hero-flip-word" style="color:#5a9e78; display:inline-block; white-space:nowrap; transform-origin:50% 50%;">Vikarer</span></span> på under 2 timer
                @endif
            </h1>

            <!-- Subtext -->
            <p class="mt-6 text-base sm:text-lg lg:text-xl text-sand-100/90 max-w-3xl mx-auto leading-relaxed">
                {{ __('Hotels, restaurants, warehouses and offices across Denmark use Freya Service to find vetted workers fast, with no lock-in or onboarding fees.') }}
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

            <!-- Trust reassurance checkmarks -->
            <div class="mt-5 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-xs sm:text-sm text-sand-300">
                <div class="flex items-center gap-1.5">
                    <x-heroicon-s-check-circle class="w-4 h-4 text-forest-400 shrink-0" />
                    <span>{{ __('Ingen binding eller oprettelsesgebyr') }}</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <x-heroicon-s-check-circle class="w-4 h-4 text-forest-400 shrink-0" />
                    <span>{{ __('Akut responstid under 2 timer') }}</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <x-heroicon-s-check-circle class="w-4 h-4 text-forest-400 shrink-0" />
                    <span>{{ __('100% overenskomstsikret') }}</span>
                </div>
            </div>

            <!-- Trust Badges (Centered) -->
            <div class="mt-10 sm:mt-12 pt-8 sm:pt-10 grid grid-cols-3 gap-4 sm:gap-10 border-t border-navy-800 text-sand-100 max-w-2xl mx-auto w-full">
                <div>
                    <div class="flex items-center justify-center gap-1 sm:gap-1.5 text-xl sm:text-3xl font-black text-white">
                        <x-heroicon-s-star class="w-5 h-5 text-brand-action shrink-0" />
                        <span>98%</span>
                    </div>
                    <div class="text-[11px] sm:text-xs text-sand-300 font-medium mt-1">{{ __('Tilfredse virksomheder') }}</div>
                </div>
                <div>
                    <div class="flex items-center justify-center gap-1 sm:gap-1.5 text-xl sm:text-3xl font-black text-white">
                        <x-heroicon-s-user-group class="w-5 h-5 text-sand-100 shrink-0" />
                        <span>{{ $isEn ? '2,500+' : '2.500+' }}</span>
                    </div>
                    <div class="text-[11px] sm:text-xs text-sand-300 font-medium mt-1">{{ __('Aktive vikarer i puljen') }}</div>
                </div>
                <div>
                    <div class="flex items-center justify-center gap-1 sm:gap-1.5 text-xl sm:text-3xl font-black text-white">
                        <x-heroicon-s-clock class="w-5 h-5 text-[#5a9e78] shrink-0" />
                        <span>{{ $isEn ? '< 2 Hours' : '< 2 timer' }}</span>
                    </div>
                    <div class="text-[11px] sm:text-xs text-sand-300 font-medium mt-1">{{ __('Gennemsnitlig responstid') }}</div>
                </div>
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

    <!-- Why Choose FreyaService Section (Comprehensive Makeover: Premium, Structured & Trust-Building) -->
    <section id="why-choose" class="py-24 bg-gradient-to-b from-brand-bg via-brand-surface to-brand-bg border-y border-brand-border relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#14263F 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="text-xs font-bold text-brand-action uppercase tracking-widest mb-3">{{ __('Vores Værdier & Fordele') }}</div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-brand-secondary tracking-tight">
                    {{ __('Hvorfor vælge FreyaService?') }}
                </h2>
                <p class="mt-4 text-base sm:text-lg text-brand-muted leading-relaxed">
                    {{ __('Et moderne vikarbureau bygget på gennemsigtighed og kvalitet') }}
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
                            {{ __('Akut vikardækning døgnet rundt') }}
                        </h3>
                        <p class="text-sm text-brand-body leading-relaxed">
                            {{ __('Når sygdom eller uventet travlhed rammer, stiller vi med erfarne vikarer med få timers varsel i hele landet.') }}
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
                            {{ __('Gennemtestede vikarer') }}
                        </h3>
                        <p class="text-sm text-brand-body leading-relaxed">
                            {{ __('Alle vikarer screenes personligt, straffeattest og arbejdstilladelser tjekkes, og referencer indhentes før udsendelse.') }}
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
                            {{ __('Digital time- & QR-registrering') }}
                        </h3>
                        <p class="text-sm text-brand-body leading-relaxed">
                            {{ __('Præcis tjek-ind og tjek-ud via QR-kode på arbejdspladsen. Ingen manuelle papirsedler – kun godkendte timer.') }}
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
                            {{ __('Overenskomstmæssige vilkår') }}
                        </h3>
                        <p class="text-sm text-brand-body leading-relaxed">
                            {{ __('Vi følger gældende overenskomster, sikrer ordnede lønforhold, feriepenge og arbejdsskadeforsikring til alle vikarer.') }}
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
                            {{ __('Fast kontaktperson & Ingen binding') }}
                        </h3>
                        <p class="text-sm text-brand-body leading-relaxed">
                            {{ __('Få en dedikeret rådgiver tilknyttet, som kender jeres krav, med fuld fleksibilitet og uden skjulte opsigelsesgebyrer.') }}
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
                            {{ __('Sikkerhed & Gennemskuelig Fakturering') }}
                        </h3>
                        <p class="text-sm text-brand-body leading-relaxed">
                            {{ __('Gennemskuelige priser med 25% moms, krypterede data, overholdelse af EU GDPR og ingen ubehagelige overraskelser.') }}
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-brand-border/60 flex items-center gap-2 text-xs font-semibold text-brand-secondary">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" />
                        <span>{{ __('Kryptering & Ingen skjulte gebyrer') }}</span>
                    </div>
                </div>
            </div>

            <!-- Trust Bar / Key Metrics Strip -->
            <div class="bg-brand-primary text-white rounded-3xl p-8 sm:p-10 shadow-2xl relative overflow-hidden border border-navy-800">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6 text-center relative z-10">
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-navy-950 border border-navy-800 md:border-0 md:bg-transparent md:p-0">
                        <div class="text-2xl sm:text-4xl font-black text-brand-action tracking-tight">&lt; 2t</div>
                        <div class="text-[11px] sm:text-xs text-sand-200 font-medium mt-1">{{ __('Gennemsnitlig responstid') }}</div>
                    </div>
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-navy-950 border border-navy-800 md:border-0 md:bg-transparent md:p-0 md:border-l md:border-navy-700 md:pl-6">
                        <div class="text-2xl sm:text-4xl font-black text-white tracking-tight">100%</div>
                        <div class="text-[11px] sm:text-xs text-sand-200 font-medium mt-1">{{ __('Overenskomstdækning') }}</div>
                    </div>
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-navy-950 border border-navy-800 md:border-0 md:bg-transparent md:p-0 md:border-l md:border-navy-700 md:pl-6">
                        <div class="text-2xl sm:text-4xl font-black text-white tracking-tight">2.500+</div>
                        <div class="text-[11px] sm:text-xs text-sand-200 font-medium mt-1">{{ __('Kvalificerede vikarer') }}</div>
                    </div>
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-navy-950 border border-navy-800 md:border-0 md:bg-transparent md:p-0 md:border-l md:border-navy-700 md:pl-6">
                        <div class="text-2xl sm:text-4xl font-black text-forest-300 tracking-tight">24/7</div>
                        <div class="text-[11px] sm:text-xs text-sand-200 font-medium mt-1">{{ __('Bemandet vagtcentral') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Industries Section -->
    <section id="industries" class="py-20 bg-sand-200/50 border-y border-brand-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs font-bold text-brand-action uppercase tracking-widest">{{ __('Specialiserede Brancher') }}</h2>
                <p class="mt-2 text-3xl font-extrabold text-brand-secondary tracking-tight">{{ __('Branchekendskab der gør en forskel') }}</p>
                <p class="mt-3 text-sm text-brand-body">{{ __('Vi forstår din branches specifikke krav og stiller med medarbejdere, der har de nødvendige certifikater og erfaring.') }}</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-brand-surface p-6 rounded-2xl border border-brand-border text-center hover:shadow-lg transition group">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-action-50 text-brand-action flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-cake class="w-8 h-8 text-brand-action" />
                    </div>
                    <h4 class="font-bold text-brand-secondary">{{ __('Hotel & Restaurant') }}</h4>
                    <p class="text-xs text-brand-muted mt-1">{{ __('Tjenere, bartendere, kokke, opvaskere og housekeeping til hoteller, restauranter og store events.') }}</p>
                </div>
                <div class="bg-brand-surface p-6 rounded-2xl border border-brand-border text-center hover:shadow-lg transition group">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-navy-50 text-brand-secondary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-sparkles class="w-8 h-8 text-brand-secondary" />
                    </div>
                    <h4 class="font-bold text-brand-secondary">{{ __('Rengøring & Facility') }}</h4>
                    <p class="text-xs text-brand-muted mt-1">{{ __('Erhvervsrengøring, vinduespudsning, hotelrengøring og hospitalsrengøring udført af grundige fagfolk.') }}</p>
                </div>
                <div class="bg-brand-surface p-6 rounded-2xl border border-brand-border text-center hover:shadow-lg transition group">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-navy-100 text-brand-primary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-truck class="w-8 h-8 text-brand-primary" />
                    </div>
                    <h4 class="font-bold text-brand-secondary">{{ __('Lager & Logistik') }}</h4>
                    <p class="text-xs text-brand-muted mt-1">{{ __('Truckførere, pluk-og-pak medarbejdere samt chauffører til travle distributionscentre og lagre.') }}</p>
                </div>
                <div class="bg-brand-surface p-6 rounded-2xl border border-brand-border text-center hover:shadow-lg transition group">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-forest-50 text-forest flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-building-office class="w-8 h-8 text-forest" />
                    </div>
                    <h4 class="font-bold text-brand-secondary">{{ __('Kontor & Administration') }}</h4>
                    <p class="text-xs text-brand-muted mt-1">{{ __('Receptionister, kundeservicemedarbejdere, bogholdere og data-entry personale til travle kontorer.') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-xs font-bold text-brand-action uppercase tracking-widest">{{ __('Sådan Fungerer Det') }}</h2>
            <p class="mt-2 text-3xl sm:text-4xl font-extrabold text-brand-secondary tracking-tight">{{ __('Fra behov til bemanding på 4 enkle trin') }}</p>
        </div>

        <div class="grid md:grid-cols-4 gap-8">
            <div class="bg-brand-surface p-6 rounded-2xl border border-brand-border shadow-sm relative">
                <div class="w-10 h-10 rounded-xl bg-navy-50 text-brand-secondary flex items-center justify-center mb-4">
                    <x-heroicon-o-clipboard-document-check class="w-5 h-5 text-brand-secondary" />
                </div>
                <h4 class="font-bold text-brand-secondary mb-2">{{ __('1. Opret forespørgsel') }}</h4>
                <p class="text-xs text-brand-body leading-relaxed">{{ __('Angiv branche, antal medarbejdere, mødetid og adresse på 2 minutter via vores digitale kundeportal.') }}</p>
            </div>
            <div class="bg-brand-surface p-6 rounded-2xl border border-brand-border shadow-sm relative">
                <div class="w-10 h-10 rounded-xl bg-action-50 text-brand-action flex items-center justify-center mb-4">
                    <x-heroicon-o-cpu-chip class="w-5 h-5 text-brand-action" />
                </div>
                <h4 class="font-bold text-brand-secondary mb-2">{{ __('2. Intelligent match') }}</h4>
                <p class="text-xs text-brand-body leading-relaxed">{{ __('Vores system og rådgivere matcher straks opgaven med de bedst egnede vikarer baseret på færdigheder og lokation.') }}</p>
            </div>
            <div class="bg-brand-surface p-6 rounded-2xl border border-brand-border shadow-sm relative">
                <div class="w-10 h-10 rounded-xl bg-navy-50 text-brand-secondary flex items-center justify-center mb-4">
                    <x-heroicon-o-qr-code class="w-5 h-5 text-brand-secondary" />
                </div>
                <h4 class="font-bold text-brand-secondary mb-2">{{ __('3. Vikaren møder op') }}</h4>
                <p class="text-xs text-brand-body leading-relaxed">{{ __('Vikaren scanner virksomhedens QR-kode ved ankomst og påbegynder arbejdet punktligt og professionelt.') }}</p>
            </div>
            <div class="bg-brand-surface p-6 rounded-2xl border border-brand-border shadow-sm relative">
                <div class="w-10 h-10 rounded-xl bg-forest-50 text-forest flex items-center justify-center mb-4">
                    <x-heroicon-o-check-badge class="w-5 h-5 text-forest" />
                </div>
                <h4 class="font-bold text-brand-secondary mb-2">{{ __('4. Godkend & fakturér') }}</h4>
                <p class="text-xs text-brand-body leading-relaxed">{{ __('Godkend timesedlen med ét klik. Gennemskuelig faktura med 25% dansk moms og specificerede timer fremsendes automatisk.') }}</p>
            </div>
        </div>
    </section>

    <!-- Call to action / Contact (Primary Brand: Navy 900 #14263F) -->
    <section id="contact" class="py-16 bg-brand-primary text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            <h2 class="text-3xl font-extrabold text-white">{{ __('Klar til at få hjælp eller starte som vikar?') }}</h2>
            <p class="text-sand-200 max-w-xl mx-auto text-sm">
                {{ __('Kontakt vores døgnbemandede vagtcentral eller opret din profil online i dag.') }}
            </p>
            <div class="flex flex-wrap justify-center gap-4 pt-4">
                <!-- Action Button: Orange 500 #E8833A, hover Orange 600 #D2702A -->
                <a href="tel:+4570203040" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-brand-action text-white font-bold text-sm hover:bg-brand-action-hover shadow-md transition">
                    <x-heroicon-s-phone class="w-4 h-4 text-white" />
                    <span>{{ __('Ring +45 70 20 30 40') }}</span>
                </a>
                <a href="{{ route('register', ['role' => 'client']) }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-brand-secondary text-white font-bold text-sm hover:bg-navy-800 transition">
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
                <a href="/" class="inline-block group">
                    <img src="{{ asset('images/logo-white.png') }}" alt="Freya Service" class="h-10 w-auto object-contain group-hover:opacity-90 transition">
                </a>
                <p class="text-xs leading-relaxed text-sand-200">
                    {{ __('Dansk vikarbureau med fokus på fleksibilitet, pålidelighed og digital gennemsigtighed.') }}
                </p>
                <div class="text-xs text-sand-400">
                    CVR: 44556677 • Moms nr. DK44556677
                </div>
            </div>

            <div>
                <h5 class="text-xs font-bold text-white uppercase tracking-wider mb-3">{{ __('Virksomheder') }}</h5>
                <ul class="text-xs space-y-2">
                    <li><a href="{{ route('register', ['role' => 'client']) }}" class="hover:text-brand-action flex items-center gap-1.5 transition"><x-heroicon-o-chevron-right class="w-3 h-3 text-sand-400" />{{ __('Bestil Vikar') }}</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-brand-action flex items-center gap-1.5 transition"><x-heroicon-o-chevron-right class="w-3 h-3 text-sand-400" />{{ __('Timesedler') }}</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-brand-action flex items-center gap-1.5 transition"><x-heroicon-o-chevron-right class="w-3 h-3 text-sand-400" />{{ __('Fakturaer') }}</a></li>
                </ul>
            </div>

            <div>
                <h5 class="text-xs font-bold text-white uppercase tracking-wider mb-3">{{ __('Vikarer') }}</h5>
                <ul class="text-xs space-y-2">
                    <li><a href="{{ route('register', ['role' => 'worker']) }}" class="hover:text-brand-action flex items-center gap-1.5 transition"><x-heroicon-o-chevron-right class="w-3 h-3 text-sand-400" />{{ __('Tilmeld dig som vikar') }}</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-brand-action flex items-center gap-1.5 transition"><x-heroicon-o-chevron-right class="w-3 h-3 text-sand-400" />{{ __('Ledige Vagter') }}</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-brand-action flex items-center gap-1.5 transition"><x-heroicon-o-chevron-right class="w-3 h-3 text-sand-400" />{{ __('QR Tjek-ind') }}</a></li>
                </ul>
            </div>

            <div>
                <h5 class="text-xs font-bold text-white uppercase tracking-wider mb-3">{{ __('GDPR & Sikkerhed') }}</h5>
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
