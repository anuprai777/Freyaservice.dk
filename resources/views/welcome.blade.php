<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('FreyaService | Vikarbureau i Danmark – Kvalitetsvikarer til Virksomheder') }}</title>
    <meta name="description" content="{{ __('FreyaService leverer professionelle og pålidelige vikarer til hotel, restaurant, rengøring, lager og logistik samt kontor i hele Danmark.') }}">

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
    </style>
</head>
<body class="bg-brand-bg text-brand-body antialiased selection:bg-brand-secondary selection:text-white">

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

    <!-- Navigation (Surface: Pure White #FFFFFF, Border: Muted Sand #E3E0D8) -->
    <header x-data="{ mobileOpen: false }" class="sticky top-0 z-50 bg-brand-surface/95 backdrop-blur-md border-b border-brand-border">
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
                <button @click="mobileOpen = !mobileOpen" type="button" class="lg:hidden inline-flex items-center justify-center p-2 rounded-xl text-brand-muted hover:text-brand-secondary hover:bg-brand-bg focus:outline-none transition" aria-label="Menu">
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
                    <a href="{{ route('locale.switch', 'da') }}" class="px-3 py-1 rounded-lg transition flex items-center gap-1.5 {{ app()->getLocale() === 'da' ? 'bg-brand-bg text-brand-secondary font-bold underline underline-offset-4 decoration-2 decoration-brand-action shadow-sm' : 'text-brand-muted font-medium' }}">
                        <span>🇩🇰</span><span>Dansk</span>
                    </a>
                    <a href="{{ route('locale.switch', 'en') }}" class="px-3 py-1 rounded-lg transition flex items-center gap-1.5 {{ app()->getLocale() === 'en' ? 'bg-brand-bg text-brand-secondary font-bold underline underline-offset-4 decoration-2 decoration-brand-action shadow-sm' : 'text-brand-muted font-medium' }}">
                        <span>🇬🇧</span><span>English</span>
                    </a>
                </div>
            </div>

            <!-- Mobile Navigation Links -->
            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('services') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition text-brand-body hover:bg-brand-bg hover:text-brand-secondary">
                    <x-heroicon-o-briefcase class="w-5 h-5 text-brand-action" />
                    <span>{{ __('Ydelser') }}</span>
                </a>
                <a href="{{ route('industries') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition text-brand-body hover:bg-brand-bg hover:text-brand-secondary">
                    <x-heroicon-o-building-office-2 class="w-5 h-5 text-brand-action" />
                    <span>{{ __('Brancher') }}</span>
                </a>
                <a href="{{ route('how-it-works') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition text-brand-body hover:bg-brand-bg hover:text-brand-secondary">
                    <x-heroicon-o-arrows-pointing-in class="w-5 h-5 text-brand-action" />
                    <span>{{ __('Sådan virker det') }}</span>
                </a>
                <a href="{{ route('contact') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition text-brand-body hover:bg-brand-bg hover:text-brand-secondary">
                    <x-heroicon-o-chat-bubble-bottom-center-text class="w-5 h-5 text-brand-action" />
                    <span>{{ __('Kontakt') }}</span>
                </a>
            </div>

            <!-- Mobile Auth / CTA -->
            <div class="p-4 border-t border-brand-border">
                @auth
                    <a href="{{ url('/dashboard') }}" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-bold text-white bg-brand-action hover:bg-brand-action-hover shadow-md transition">
                        <x-heroicon-o-squares-2x2 class="w-5 h-5" />
                        <span>{{ __('Gå til Dashboard') }}</span>
                        <x-heroicon-o-arrow-right class="w-4 h-4" />
                    </a>
                @else
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl text-sm font-bold text-brand-secondary bg-brand-bg hover:bg-slate-100 border border-brand-border transition">
                            <x-heroicon-o-arrow-right-end-on-rectangle class="w-4 h-4 text-brand-muted" />
                            <span>{{ __('Log ind') }}</span>
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl text-sm font-bold text-white bg-brand-action hover:bg-brand-action-hover shadow-sm transition">
                            <x-heroicon-o-user-plus class="w-4 h-4" />
                            <span>{{ __('Opret konto') }}</span>
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Section with Clear Background Video: Chefs Cooking (Original Brand Styling & Mobile/Desktop Compatible) -->
    <section id="heroSection" class="relative bg-navy-950 text-white pt-16 pb-20 sm:pt-20 sm:pb-28 px-4 sm:px-6 lg:px-8 overflow-hidden min-h-[580px] sm:min-h-[640px] flex items-center">
        <!-- Background Video Layer: Pure Clear Chef Cooking Video -->
        <div class="absolute inset-0 w-full h-full overflow-hidden pointer-events-none select-none z-0">
            <video
                id="heroBgVideo"
                autoplay
                muted
                loop
                playsinline
                webkit-playsinline
                x5-playsinline="true"
                x5-video-player-type="h5-page"
                preload="auto"
                disablePictureInPicture
                disableRemotePlayback
                src="{{ asset('videos/chefs-cooking.mp4') }}"
                poster="{{ asset('images/chefs-cooking-poster.jpg') }}"
                class="absolute inset-0 w-full h-full object-cover object-center pointer-events-none select-none filter contrast-[1.06] saturate-[1.15] brightness-[1.02]"
            >
                <source src="{{ asset('videos/chefs-cooking.mp4') }}" type="video/mp4">
                <source src="{{ asset('videos/chefs-cooking-3.mp4') }}" type="video/mp4">
                <source src="{{ asset('videos/chefs-cooking-2.mp4') }}" type="video/mp4">
            </video>
        </div>

        <div class="max-w-7xl mx-auto grid lg:grid-cols-12 gap-8 lg:gap-12 items-center relative z-10 w-full">
            <div class="lg:col-span-7 space-y-6">
                <!-- Highlight badge: Action Orange 500 border & accent -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-brand-action/40 text-sand-100 text-xs font-semibold tracking-wide backdrop-blur-sm">
                    <x-heroicon-s-bolt class="w-3.5 h-3.5 text-brand-action shrink-0" />
                    <span>{{ __('Akut vikardækning på under 2 timer') }}</span>
                </div>

                <!-- High-contrast headings with LetterCascade animation -->
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.1] text-white">
                    <x-letter-cascade :text="__('Fleksibel & professionel')" class="text-brand-action inline-block cursor-pointer select-none" />
                    <span class="block mt-1 sm:mt-2">
                        <x-letter-cascade :text="__('vikarservice i hele Danmark')" class="text-white inline-block cursor-pointer select-none" />
                    </span>
                </h1>

                <p class="text-base sm:text-lg text-sand-100/90 max-w-2xl leading-relaxed">
                    {{ __('Mangler din virksomhed ekstra hænder ved spidsbelastning, sygdom eller sæson? FreyaService matcher dig lynhurtigt med godkendte og motiverede vikarer til hotel, restaurant, rengøring, lager og kontor.') }}
                </p>

                <!-- Action Bar -->
                <div class="pt-4 flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                    <!-- Primary CTA Button: Orange 500 #E8833A, hover Orange 600 #D2702A -->
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 px-7 py-4 rounded-xl text-base font-extrabold text-white bg-brand-action hover:bg-brand-action-hover shadow-lg shadow-brand-action/30 transition transform hover:-translate-y-0.5">
                        <x-heroicon-o-briefcase class="w-5 h-5 text-white shrink-0" />
                        <span>{{ __('Bestil vikar nu') }}</span>
                        <x-heroicon-o-arrow-right class="w-5 h-5 shrink-0" />
                    </a>

                    <!-- Secondary CTA Button: Surface / Outline -->
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 px-7 py-4 rounded-xl text-base font-bold text-white bg-white/10 hover:bg-white/20 border border-brand-border/40 backdrop-blur-sm transition">
                        <x-heroicon-o-user-plus class="w-5 h-5 shrink-0" />
                        <span>{{ __('Tilmeld dig som vikar') }}</span>
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="pt-6 grid grid-cols-3 gap-2 sm:gap-6 border-t border-navy-800 text-sand-100">
                    <div>
                        <div class="flex items-center gap-1 sm:gap-1.5 text-lg sm:text-2xl font-black text-white">
                            <x-heroicon-s-star class="w-4 h-4 sm:w-5 sm:h-5 text-brand-action shrink-0" />
                            <span>98%</span>
                        </div>
                        <div class="text-[10px] sm:text-xs text-sand-300 font-medium mt-1 leading-tight">{{ __('Tilfredse virksomheder') }}</div>
                    </div>
                    <div>
                        <div class="flex items-center gap-1 sm:gap-1.5 text-lg sm:text-2xl font-black text-white">
                            <x-heroicon-s-user-group class="w-4 h-4 sm:w-5 sm:h-5 text-sand-100 shrink-0" />
                            <span>2.500+</span>
                        </div>
                        <div class="text-[10px] sm:text-xs text-sand-300 font-medium mt-1 leading-tight">{{ __('Aktive vikarer i puljen') }}</div>
                    </div>
                    <div>
                        <div class="flex items-center gap-1 sm:gap-1.5 text-lg sm:text-2xl font-black text-white">
                            <!-- Success indicator: Forest Green #2F7D5B -->
                            <x-heroicon-s-receipt-percent class="w-4 h-4 sm:w-5 sm:h-5 text-forest shrink-0" />
                            <span>25%</span>
                        </div>
                        <div class="text-[10px] sm:text-xs text-sand-300 font-medium mt-1 leading-tight">{{ __('Moms (25%)') }}</div>
                    </div>
                </div>
            </div>

            <!-- Secure Portal Access Card -->
            <div class="lg:col-span-5 bg-white/10 border border-white/20 backdrop-blur-xl p-6 sm:p-8 rounded-2xl shadow-2xl">
                <div class="flex items-center justify-between pb-6 border-b border-white/15">
                    <div>
                        <h3 class="text-xl font-bold text-white flex items-center gap-2">
                            <x-heroicon-o-lock-closed class="w-5 h-5 text-brand-action shrink-0" />
                            <span>{{ __('Sikker Portal Adgang') }}</span>
                        </h3>
                        <p class="text-xs text-sand-200 mt-1">{{ __('Vælg din portal for at logge ind sikkert') }}</p>
                    </div>
                    <span class="px-2.5 py-1 rounded bg-forest/80 text-white font-black text-xs uppercase tracking-wider flex items-center gap-1">
                        <x-heroicon-s-shield-check class="w-3.5 h-3.5" />
                        SSL
                    </span>
                </div>

                <div class="space-y-4 pt-6">
                    <!-- Admin Card -->
                    <div class="p-4 rounded-xl bg-brand-primary/80 border border-white/15 flex items-center justify-between hover:border-brand-action transition group">
                        <div>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-navy-700 text-sand-100 mb-1">
                                <x-heroicon-s-shield-check class="w-3 h-3 text-sand-300" />
                                <span>{{ __('Administrator') }}</span>
                            </span>
                            <div class="text-xs text-sand-200">{{ __('Adgangskontrol, CRM, match & fakturering') }}</div>
                            <div class="text-[11px] text-sand-300 flex items-center gap-1 mt-1 font-mono">
                                <x-heroicon-s-lock-closed class="w-3 h-3 text-sand-400" />
                                <span>{{ __('Adgangskode beskyttet') }}:</span>
                                <span class="tracking-widest">••••••••</span>
                            </div>
                        </div>
                        <a href="{{ route('login') }}" class="px-3.5 py-1.5 text-xs font-bold rounded-lg bg-white/20 text-white group-hover:bg-brand-action group-hover:text-white transition">{{ __('Log ind') }}</a>
                    </div>

                    <!-- Client Card -->
                    <div class="p-4 rounded-xl bg-brand-primary/80 border border-white/15 flex items-center justify-between hover:border-brand-action transition group">
                        <div>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-navy-700 text-sand-100 mb-1">
                                <x-heroicon-s-building-office-2 class="w-3 h-3 text-sand-300" />
                                <span>{{ __('Virksomhed (Kunde)') }}</span>
                            </span>
                            <div class="text-xs text-sand-200">{{ __('Bestil vikarer & godkend timer digitalt') }}</div>
                            <div class="text-[11px] text-sand-300 flex items-center gap-1 mt-1 font-mono">
                                <x-heroicon-s-lock-closed class="w-3 h-3 text-sand-400" />
                                <span>{{ __('Adgangskode beskyttet') }}:</span>
                                <span class="tracking-widest">••••••••</span>
                            </div>
                        </div>
                        <a href="{{ route('login') }}" class="px-3.5 py-1.5 text-xs font-bold rounded-lg bg-white/20 text-white group-hover:bg-brand-action group-hover:text-white transition">{{ __('Log ind') }}</a>
                    </div>

                    <!-- Worker Card -->
                    <div class="p-4 rounded-xl bg-brand-primary/80 border border-white/15 flex items-center justify-between hover:border-brand-action transition group">
                        <div>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-forest-700/60 text-sand-100 mb-1">
                                <x-heroicon-s-user class="w-3 h-3 text-forest-100" />
                                <span>{{ __('Vikar (Arbejdstager)') }}</span>
                            </span>
                            <div class="text-xs text-sand-200">{{ __('Vagtplan, QR-tjek ind & lønoversigt') }}</div>
                            <div class="text-[11px] text-sand-300 flex items-center gap-1 mt-1 font-mono">
                                <x-heroicon-s-lock-closed class="w-3 h-3 text-sand-400" />
                                <span>{{ __('Adgangskode beskyttet') }}:</span>
                                <span class="tracking-widest">••••••••</span>
                            </div>
                        </div>
                        <a href="{{ route('login') }}" class="px-3.5 py-1.5 text-xs font-bold rounded-lg bg-white/20 text-white group-hover:bg-brand-action group-hover:text-white transition">{{ __('Log ind') }}</a>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-white/10 text-center">
                    <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-xl bg-brand-action hover:bg-brand-action-hover text-white text-sm font-bold shadow-md transition">
                        <x-heroicon-o-lock-closed class="w-4 h-4" />
                        <span>{{ __('Gå til login') }}</span>
                        <x-heroicon-o-arrow-right class="w-4 h-4" />
                    </a>
                </div>
            </div>
        </div>

        <!-- Live Kitchen Video Status Badge (Mobile & Desktop friendly) -->
        <div class="absolute bottom-3 right-3 sm:bottom-4 sm:right-6 z-20 select-none pointer-events-none">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-navy-950/70 border border-white/20 text-xs text-sand-200 backdrop-blur-md shadow-md">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="font-medium">{{ __('Køkken i aktion') }}</span>
            </div>
        </div>
    </section>

    <!-- Hero Background Video Cross-Device Autoplay Engine -->
    <script>
        (function () {
            const video = document.getElementById('heroBgVideo');
            const heroSection = document.getElementById('heroSection');
            if (!video) return;

            // Strictly enforce muted, inline and infinite loop attributes across iOS/Android/desktop
            video.muted = true;
            video.defaultMuted = true;
            video.playsInline = true;
            video.loop = true;
            video.setAttribute('muted', '');
            video.setAttribute('playsinline', '');
            video.setAttribute('webkit-playsinline', '');
            video.setAttribute('x5-playsinline', 'true');
            video.setAttribute('x5-video-player-type', 'h5-page');
            video.setAttribute('loop', '');

            let isHeroVisible = true;

            function startInfinitePlayback() {
                if (!isHeroVisible) return;
                video.muted = true;
                video.loop = true;
                const playPromise = video.play();

                if (playPromise !== undefined) {
                    playPromise.catch(function () {
                        // iOS Low Power Mode or browser policy deferral:
                        // Trigger immediate play on any micro-gesture anywhere on screen
                        const unlock = function () {
                            video.muted = true;
                            video.play().catch(function () {});
                        };
                        ['click', 'touchstart', 'touchend', 'scroll', 'keydown', 'pointerdown'].forEach(function (evt) {
                            window.addEventListener(evt, unlock, { once: true, passive: true });
                        });
                    });
                }
            }

            // Continuous playback recovery on mobile & desktop
            video.addEventListener('pause', function () {
                if (isHeroVisible) {
                    setTimeout(function () {
                        if (video.paused && isHeroVisible) {
                            video.play().catch(function () {});
                        }
                    }, 100);
                }
            });

            // Ensure infinite loop without stalling on the last frame
            video.addEventListener('ended', function () {
                video.currentTime = 0;
                startInfinitePlayback();
            });

            video.addEventListener('loadeddata', startInfinitePlayback);
            video.addEventListener('canplay', startInfinitePlayback);

            // Visibility change (tab switch, app switch, screen lock/unlock)
            document.addEventListener('visibilitychange', function () {
                if (!document.hidden && isHeroVisible && video.paused) {
                    startInfinitePlayback();
                }
            });

            // iOS Safari bfcache (back/forward navigation)
            window.addEventListener('pageshow', function () {
                if (isHeroVisible && video.paused) {
                    startInfinitePlayback();
                }
            });

            // Focus and orientation change on mobile phones and tablets
            window.addEventListener('focus', function () {
                if (isHeroVisible && video.paused) {
                    startInfinitePlayback();
                }
            });
            window.addEventListener('orientationchange', function () {
                setTimeout(startInfinitePlayback, 200);
            });

            // Battery & Performance Optimization:
            // When hero section scrolls off-screen on mobile, pause to save battery; resume when visible
            if ('IntersectionObserver' in window && heroSection) {
                const observer = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        isHeroVisible = entry.isIntersecting;
                        if (isHeroVisible) {
                            startInfinitePlayback();
                        } else if (!video.paused) {
                            video.pause();
                        }
                    });
                }, { threshold: 0.1 });
                observer.observe(heroSection);
            }

            // Immediate execution across page load lifecycle
            startInfinitePlayback();

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', startInfinitePlayback);
            }
            window.addEventListener('load', startInfinitePlayback);
        })();
    </script>

    <!-- 3 Core Services (Page Background: Warm Off-White #F7F6F2, Surfaces: Pure White #FFFFFF) -->
    <section id="services" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-xs font-bold text-brand-action uppercase tracking-widest flex items-center justify-center gap-1.5">
                <x-heroicon-o-sparkles class="w-4 h-4 text-brand-action" />
                <span>{{ __('Vores Bemandingsløsninger') }}</span>
            </h2>
            <p class="mt-2 text-3xl sm:text-4xl font-extrabold text-brand-secondary tracking-tight">{{ __('Vikarer til alle behov') }}</p>
            <p class="mt-4 text-base text-brand-body">{{ __('Hvad enten du mangler en opvasker i aften eller 10 lagermedarbejdere i tre måneder, har vi den rette løsning.') }}</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- 1. Vikardækning -->
            <div class="bg-brand-surface rounded-2xl p-8 border border-brand-border shadow-sm hover:shadow-xl hover:border-brand-secondary transition-all group">
                <div class="w-14 h-14 rounded-xl bg-action-50 text-brand-action flex items-center justify-center font-black text-xl mb-6 group-hover:scale-110 transition-transform">
                    <x-heroicon-o-clock class="w-7 h-7 text-brand-action" />
                </div>
                <h3 class="text-xl font-bold text-brand-secondary mb-3">{{ __('Akut og kortvarig vikardækning') }}</h3>
                <p class="text-sm text-brand-body leading-relaxed mb-6">
                    {{ __('Dækning fra dag til dag ved akut sygdom, ferie eller uventet spidsbelastning. Vores vikarer er klar med få timers varsel.') }}
                </p>
                <ul class="text-xs text-brand-body space-y-2.5 border-t border-brand-border pt-4">
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" />
                        <span>{{ __('Under 2 timer') }} {{ __('responstid') }}</span>
                    </li>
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" />
                        <span>{{ __('Digital time- & QR-registrering') }}</span>
                    </li>
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" />
                        <span>{{ __('Overenskomstmæssige vilkår') }}</span>
                    </li>
                </ul>
            </div>

            <!-- 2. Deltidspersonale -->
            <div class="bg-brand-surface rounded-2xl p-8 border border-brand-border shadow-sm hover:shadow-xl hover:border-brand-secondary transition-all group">
                <div class="w-14 h-14 rounded-xl bg-navy-50 text-brand-secondary flex items-center justify-center font-black text-xl mb-6 group-hover:scale-110 transition-transform">
                    <x-heroicon-o-calendar-days class="w-7 h-7 text-brand-secondary" />
                </div>
                <h3 class="text-xl font-bold text-brand-secondary mb-3">{{ __('Længerevarende vikariater') }}</h3>
                <p class="text-sm text-brand-body leading-relaxed mb-6">
                    {{ __('Stabile vikarer til projekter, barselsvikariater eller sæsonarbejde af ugers eller måneders varighed.') }}
                </p>
                <ul class="text-xs text-brand-body space-y-2.5 border-t border-brand-border pt-4">
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" />
                        <span>{{ __('Gennemtestede vikarer') }}</span>
                    </li>
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" />
                        <span>{{ __('Ensartet høj kvalitet') }}</span>
                    </li>
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" />
                        <span>{{ __('Månedlig samlet fakturering') }}</span>
                    </li>
                </ul>
            </div>

            <!-- 3. Rekruttering / Fastansættelse -->
            <div class="bg-brand-surface rounded-2xl p-8 border border-brand-border shadow-sm hover:shadow-xl hover:border-brand-secondary transition-all group">
                <div class="w-14 h-14 rounded-xl bg-forest-50 text-forest flex items-center justify-center font-black text-xl mb-6 group-hover:scale-110 transition-transform">
                    <x-heroicon-o-user-group class="w-7 h-7 text-forest" />
                </div>
                <h3 class="text-xl font-bold text-brand-secondary mb-3">{{ __('Fast rekruttering & Try & Hire') }}</h3>
                <p class="text-sm text-brand-body leading-relaxed mb-6">
                    {{ __('Afprøv en medarbejder i en vikarperiode før fastansættelse. Minimer ansættelsesrisikoen og find det perfekte match.') }}
                </p>
                <ul class="text-xs text-brand-body space-y-2.5 border-t border-brand-border pt-4">
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" />
                        <span>{{ __('Minimer ansættelsesrisiko') }}</span>
                    </li>
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" />
                        <span>{{ __('Screenede kandidater med referencer') }}</span>
                    </li>
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-forest shrink-0" />
                        <span>{{ __('Fuld digital kontraktstyring') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Why Choose FreyaService Section (Comprehensive Makeover: Premium, Structured & Trust-Building) -->
    <section id="why-choose" class="py-24 bg-gradient-to-b from-brand-bg via-brand-surface to-brand-bg border-y border-brand-border relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#14263F 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-action/10 border border-brand-action/30 text-brand-action text-xs font-bold mb-4 shadow-xs">
                    <x-heroicon-o-shield-check class="w-4 h-4 text-brand-action" />
                    <span>{{ __('Vores Værdier & Fordele') }}</span>
                </div>
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
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-14 h-14 rounded-2xl bg-action-50 text-brand-action flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                <x-heroicon-o-bolt class="w-7 h-7 text-brand-action" />
                            </div>
                            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-action-50 text-brand-action border border-brand-action/20">
                                {{ __('Under 2 timer') }}
                            </span>
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
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-14 h-14 rounded-2xl bg-navy-50 text-brand-secondary flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                <x-heroicon-o-shield-check class="w-7 h-7 text-brand-secondary" />
                            </div>
                            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-navy-50 text-brand-secondary border border-brand-secondary/20">
                                {{ __('100% Screenet') }}
                            </span>
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
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-14 h-14 rounded-2xl bg-forest-50 text-forest flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                <x-heroicon-o-qr-code class="w-7 h-7 text-forest" />
                            </div>
                            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-forest-50 text-forest border border-forest/20">
                                {{ __('Digital & Præcis') }}
                            </span>
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
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-14 h-14 rounded-2xl bg-navy-50 text-brand-secondary flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                <x-heroicon-o-document-check class="w-7 h-7 text-brand-secondary" />
                            </div>
                            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-navy-50 text-brand-secondary border border-brand-secondary/20">
                                {{ __('Ordnede Forhold') }}
                            </span>
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
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-14 h-14 rounded-2xl bg-action-50 text-brand-action flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                <x-heroicon-o-user-group class="w-7 h-7 text-brand-action" />
                            </div>
                            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-action-50 text-brand-action border border-brand-action/20">
                                {{ __('Personlig Service') }}
                            </span>
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
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-14 h-14 rounded-2xl bg-forest-50 text-forest flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                <x-heroicon-o-lock-closed class="w-7 h-7 text-forest" />
                            </div>
                            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-forest-50 text-forest border border-forest/20">
                                {{ __('GDPR & Sikkerhed') }}
                            </span>
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
            <div class="bg-brand-primary text-white rounded-3xl p-8 sm:p-10 shadow-2xl relative overflow-hidden">
                <div class="absolute right-0 top-0 bottom-0 w-1/3 bg-radial from-white/10 to-transparent pointer-events-none"></div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6 text-center relative z-10">
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-white/5 border border-white/10 md:border-0 md:bg-transparent md:p-0">
                        <div class="text-2xl sm:text-4xl font-black text-brand-action tracking-tight">&lt; 2t</div>
                        <div class="text-[11px] sm:text-xs text-sand-200 font-medium mt-1">{{ __('Gennemsnitlig responstid') }}</div>
                    </div>
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-white/5 border border-white/10 md:border-0 md:bg-transparent md:p-0 md:border-l md:border-white/15 md:pl-6">
                        <div class="text-2xl sm:text-4xl font-black text-white tracking-tight">100%</div>
                        <div class="text-[11px] sm:text-xs text-sand-200 font-medium mt-1">{{ __('Overenskomstdækning') }}</div>
                    </div>
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-white/5 border border-white/10 md:border-0 md:bg-transparent md:p-0 md:border-l md:border-white/15 md:pl-6">
                        <div class="text-2xl sm:text-4xl font-black text-white tracking-tight">2.500+</div>
                        <div class="text-[11px] sm:text-xs text-sand-200 font-medium mt-1">{{ __('Kvalificerede vikarer') }}</div>
                    </div>
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-white/5 border border-white/10 md:border-0 md:bg-transparent md:p-0 md:border-l md:border-white/15 md:pl-6">
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
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-brand-secondary text-white font-bold text-sm hover:bg-navy-800 transition">
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
                    <li><a href="{{ route('login') }}" class="hover:text-brand-action flex items-center gap-1.5 transition"><x-heroicon-o-chevron-right class="w-3 h-3 text-sand-400" />{{ __('Bestil Vikar') }}</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-brand-action flex items-center gap-1.5 transition"><x-heroicon-o-chevron-right class="w-3 h-3 text-sand-400" />{{ __('Timesedler') }}</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-brand-action flex items-center gap-1.5 transition"><x-heroicon-o-chevron-right class="w-3 h-3 text-sand-400" />{{ __('Fakturaer') }}</a></li>
                </ul>
            </div>

            <div>
                <h5 class="text-xs font-bold text-white uppercase tracking-wider mb-3">{{ __('Vikarer') }}</h5>
                <ul class="text-xs space-y-2">
                    <li><a href="{{ route('register') }}" class="hover:text-brand-action flex items-center gap-1.5 transition"><x-heroicon-o-chevron-right class="w-3 h-3 text-sand-400" />{{ __('Tilmeld dig som vikar') }}</a></li>
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
</body>
</html>
