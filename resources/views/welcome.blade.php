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
        .hero-pattern {
            background-color: #0b1329;
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 0);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-amber-500 selection:text-white">

    <!-- Top Danish / English Info Bar -->
    <div class="bg-slate-900 text-slate-300 text-xs py-2 px-4 border-b border-slate-800">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-1.5">
                    <x-heroicon-o-globe-europe-africa class="w-3.5 h-3.5 text-indigo-400" />
                    <span>{{ __('Landsdækkende vikarservice') }}</span>
                </span>
                <span class="hidden md:inline text-slate-700">•</span>
                <span class="flex items-center gap-1">
                    <x-heroicon-o-phone class="w-3.5 h-3.5 text-amber-400" />
                    <span>{{ __('Akut vagttelefon') }}: <a href="tel:+4570203040" class="text-white hover:text-amber-400 font-semibold">+45 70 20 30 40</a></span>
                </span>
                <span class="hidden md:inline text-slate-700">•</span>
                <span>CVR: 44556677</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-emerald-400 font-medium flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    {{ __('Vikarer klar til udrykning 24/7') }}
                </span>

                <!-- Top bar language switch -->
                <div class="flex items-center gap-1 bg-slate-800 p-0.5 rounded-lg border border-slate-700 text-[11px]">
                    <a href="{{ route('locale.switch', 'da') }}" class="px-2 py-0.5 rounded {{ app()->getLocale() === 'da' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:text-white' }} transition flex items-center gap-1">
                        <span>🇩🇰</span>
                        <span>DA</span>
                    </a>
                    <a href="{{ route('locale.switch', 'en') }}" class="px-2 py-0.5 rounded {{ app()->getLocale() === 'en' ? 'bg-indigo-600 text-white font-bold' : 'text-slate-400 hover:text-white' }} transition flex items-center gap-1">
                        <span>🇬🇧</span>
                        <span>EN</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-blue-700 via-indigo-600 to-amber-500 flex items-center justify-center text-white shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-transform">
                    <x-heroicon-s-bolt class="w-6 h-6 text-amber-300" />
                </div>
                <div>
                    <span class="text-2xl font-black tracking-tight text-slate-900">Freya<span class="text-indigo-600">Service</span></span>
                    <span class="block text-[10px] font-semibold tracking-wider text-slate-500 uppercase -mt-1">{{ __('Vikarbureau Danmark') }}</span>
                </div>
            </a>

            <!-- Nav Links -->
            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold text-slate-600">
                <a href="#services" class="hover:text-indigo-600 transition-colors flex items-center gap-1.5">
                    <x-heroicon-o-briefcase class="w-4 h-4 text-slate-400" />
                    <span>{{ __('Ydelser') }}</span>
                </a>
                <a href="#industries" class="hover:text-indigo-600 transition-colors flex items-center gap-1.5">
                    <x-heroicon-o-building-office-2 class="w-4 h-4 text-slate-400" />
                    <span>{{ __('Brancher') }}</span>
                </a>
                <a href="#how-it-works" class="hover:text-indigo-600 transition-colors flex items-center gap-1.5">
                    <x-heroicon-o-arrows-pointing-in class="w-4 h-4 text-slate-400" />
                    <span>{{ __('Sådan virker det') }}</span>
                </a>
                <a href="#contact" class="hover:text-indigo-600 transition-colors flex items-center gap-1.5">
                    <x-heroicon-o-chat-bubble-bottom-center-text class="w-4 h-4 text-slate-400" />
                    <span>{{ __('Kontakt') }}</span>
                </a>
            </nav>

            <!-- Language Switcher & Auth Buttons -->
            <div class="flex items-center gap-3">
                <!-- Language Switcher Pill -->
                <div class="flex items-center gap-1 bg-slate-100 p-1 rounded-xl border border-slate-200 text-xs">
                    <a href="{{ route('locale.switch', 'da') }}" title="Dansk" class="px-2.5 py-1 rounded-lg {{ app()->getLocale() === 'da' ? 'bg-white text-indigo-700 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900 font-medium' }} transition flex items-center gap-1">
                        <span>🇩🇰</span>
                        <span>DA</span>
                    </a>
                    <a href="{{ route('locale.switch', 'en') }}" title="English" class="px-2.5 py-1 rounded-lg {{ app()->getLocale() === 'en' ? 'bg-white text-indigo-700 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900 font-medium' }} transition flex items-center gap-1">
                        <span>🇬🇧</span>
                        <span>EN</span>
                    </a>
                </div>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm transition">
                            <x-heroicon-o-squares-2x2 class="w-4 h-4" />
                            <span>{{ __('Min Profil / Dashboard') }}</span>
                            <x-heroicon-o-arrow-right class="w-4 h-4" />
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-indigo-600 px-3 py-2 rounded-lg transition flex items-center gap-1.5">
                            <x-heroicon-o-arrow-right-end-on-rectangle class="w-4 h-4 text-slate-400" />
                            <span>{{ __('Log ind') }}</span>
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-1.5 px-5 py-2.5 rounded-lg text-sm font-semibold text-white bg-slate-900 hover:bg-indigo-600 shadow-sm transition">
                                <x-heroicon-o-user-plus class="w-4 h-4" />
                                <span>{{ __('Opret konto') }}</span>
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-pattern text-white pt-20 pb-28 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-400/30 text-indigo-300 text-xs font-semibold tracking-wide">
                    <x-heroicon-s-bolt class="w-3.5 h-3.5 text-amber-400" />
                    <span>{{ __('Akut vikardækning på under 2 timer') }}</span>
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.1]">
                    {{ __('Fleksibel og professionel vikarservice i hele Danmark') }}
                </h1>

                <p class="text-lg text-slate-300 max-w-2xl leading-relaxed">
                    {{ __('Mangler din virksomhed ekstra hænder ved spidsbelastning, sygdom eller sæson? FreyaService matcher dig lynhurtigt med godkendte og motiverede vikarer til hotel, restaurant, rengøring, lager og kontor.') }}
                </p>

                <!-- Action Bar -->
                <div class="pt-4 flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 px-7 py-4 rounded-xl text-base font-bold text-slate-950 bg-amber-400 hover:bg-amber-300 shadow-lg shadow-amber-400/20 transition transform hover:-translate-y-0.5">
                        <x-heroicon-o-briefcase class="w-5 h-5 text-slate-950" />
                        <span>{{ __('Bestil vikar nu') }}</span>
                        <x-heroicon-o-arrow-right class="w-5 h-5" />
                    </a>

                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 px-7 py-4 rounded-xl text-base font-bold text-white bg-white/10 hover:bg-white/20 border border-white/20 backdrop-blur-sm transition">
                        <x-heroicon-o-user-plus class="w-5 h-5" />
                        <span>{{ __('Tilmeld dig som vikar') }}</span>
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="pt-6 grid grid-cols-3 gap-6 border-t border-slate-800 text-slate-300">
                    <div>
                        <div class="flex items-center gap-1.5 text-2xl font-black text-white">
                            <x-heroicon-s-star class="w-5 h-5 text-amber-400" />
                            <span>98%</span>
                        </div>
                        <div class="text-xs text-slate-400 font-medium mt-1">{{ __('Tilfredse virksomheder') }}</div>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5 text-2xl font-black text-white">
                            <x-heroicon-s-user-group class="w-5 h-5 text-indigo-400" />
                            <span>2.500+</span>
                        </div>
                        <div class="text-xs text-slate-400 font-medium mt-1">{{ __('Aktive vikarer i puljen') }}</div>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5 text-2xl font-black text-white">
                            <x-heroicon-s-receipt-percent class="w-5 h-5 text-emerald-400" />
                            <span>25%</span>
                        </div>
                        <div class="text-xs text-slate-400 font-medium mt-1">{{ __('Moms (25%)') }}</div>
                    </div>
                </div>
            </div>

            <!-- Quick Demo Login Card -->
            <div class="lg:col-span-5 bg-white/10 border border-white/20 backdrop-blur-xl p-8 rounded-2xl shadow-2xl">
                <div class="flex items-center justify-between pb-6 border-b border-white/15">
                    <div>
                        <h3 class="text-xl font-bold text-white flex items-center gap-2">
                            <x-heroicon-o-sparkles class="w-5 h-5 text-amber-300" />
                            <span>{{ __('Prøv platformen med et enkelt klik') }}</span>
                        </h3>
                        <p class="text-xs text-slate-300 mt-1">{{ __('Brug en af vores forudkonfigurerede testkonti til at udforske systemet') }}</p>
                    </div>
                    <span class="px-2.5 py-1 rounded bg-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider">Demo</span>
                </div>

                <div class="space-y-4 pt-6">
                    <!-- Admin Card -->
                    <div class="p-4 rounded-xl bg-slate-900/60 border border-white/10 flex items-center justify-between hover:border-amber-400/50 transition">
                        <div>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-purple-500/20 text-purple-300 mb-1">
                                <x-heroicon-s-shield-check class="w-3 h-3 text-purple-400" />
                                <span>{{ __('Administrator') }}</span>
                            </span>
                            <div class="text-sm font-semibold text-white">admin@freyaservice.dk</div>
                            <div class="text-xs text-slate-400">{{ __('Adgangskode') }}: <code class="text-amber-300">password</code></div>
                        </div>
                        <a href="{{ route('login') }}" class="px-3.5 py-1.5 text-xs font-bold rounded-lg bg-white/20 text-white hover:bg-white/30 transition">{{ __('Log ind') }}</a>
                    </div>

                    <!-- Client Card -->
                    <div class="p-4 rounded-xl bg-slate-900/60 border border-white/10 flex items-center justify-between hover:border-amber-400/50 transition">
                        <div>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-blue-500/20 text-blue-300 mb-1">
                                <x-heroicon-s-building-office-2 class="w-3 h-3 text-blue-400" />
                                <span>{{ __('Virksomhed (Kunde)') }}</span>
                            </span>
                            <div class="text-sm font-semibold text-white">client@hotel-nordic.dk</div>
                            <div class="text-xs text-slate-400">{{ __('Adgangskode') }}: <code class="text-amber-300">password</code></div>
                        </div>
                        <a href="{{ route('login') }}" class="px-3.5 py-1.5 text-xs font-bold rounded-lg bg-white/20 text-white hover:bg-white/30 transition">{{ __('Log ind') }}</a>
                    </div>

                    <!-- Worker Card -->
                    <div class="p-4 rounded-xl bg-slate-900/60 border border-white/10 flex items-center justify-between hover:border-amber-400/50 transition">
                        <div>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-500/20 text-emerald-300 mb-1">
                                <x-heroicon-s-user class="w-3 h-3 text-emerald-400" />
                                <span>{{ __('Vikar (Arbejdstager)') }}</span>
                            </span>
                            <div class="text-sm font-semibold text-white">worker@freyaservice.dk</div>
                            <div class="text-xs text-slate-400">{{ __('Adgangskode') }}: <code class="text-amber-300">password</code></div>
                        </div>
                        <a href="{{ route('login') }}" class="px-3.5 py-1.5 text-xs font-bold rounded-lg bg-white/20 text-white hover:bg-white/30 transition">{{ __('Log ind') }}</a>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-white/10 text-center">
                    <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold shadow-md transition">
                        <span>{{ __('Log ind direkte som') }}</span>
                        <x-heroicon-o-arrow-right class="w-4 h-4" />
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 3 Core Services -->
    <section id="services" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-xs font-bold text-indigo-600 uppercase tracking-widest flex items-center justify-center gap-1.5">
                <x-heroicon-o-sparkles class="w-4 h-4 text-indigo-600" />
                <span>{{ __('Vores Bemandingsløsninger') }}</span>
            </h2>
            <p class="mt-2 text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">{{ __('Vikarer til alle behov') }}</p>
            <p class="mt-4 text-base text-slate-600">{{ __('Hvad enten du mangler en opvasker i aften eller 10 lagermedarbejdere i tre måneder, har vi den rette løsning.') }}</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- 1. Vikardækning -->
            <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-indigo-200 transition-all group">
                <div class="w-14 h-14 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-black text-xl mb-6 group-hover:scale-110 transition-transform">
                    <x-heroicon-o-clock class="w-7 h-7 text-amber-600" />
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">{{ __('Akut og kortvarig vikardækning') }}</h3>
                <p class="text-sm text-slate-600 leading-relaxed mb-6">
                    {{ __('Dækning fra dag til dag ved akut sygdom, ferie eller uventet spidsbelastning. Vores vikarer er klar med få timers varsel.') }}
                </p>
                <ul class="text-xs text-slate-600 space-y-2.5 border-t border-slate-100 pt-4">
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-emerald-500 shrink-0" />
                        <span>{{ __('Under 2 timer') }} {{ __('responstid') }}</span>
                    </li>
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-emerald-500 shrink-0" />
                        <span>{{ __('Digital time- & QR-registrering') }}</span>
                    </li>
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-emerald-500 shrink-0" />
                        <span>{{ __('Overenskomstmæssige vilkår') }}</span>
                    </li>
                </ul>
            </div>

            <!-- 2. Deltidspersonale -->
            <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-indigo-200 transition-all group">
                <div class="w-14 h-14 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-xl mb-6 group-hover:scale-110 transition-transform">
                    <x-heroicon-o-calendar-days class="w-7 h-7 text-indigo-600" />
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">{{ __('Længerevarende vikariater') }}</h3>
                <p class="text-sm text-slate-600 leading-relaxed mb-6">
                    {{ __('Stabile vikarer til projekter, barselsvikariater eller sæsonarbejde af ugers eller måneders varighed.') }}
                </p>
                <ul class="text-xs text-slate-600 space-y-2.5 border-t border-slate-100 pt-4">
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-emerald-500 shrink-0" />
                        <span>{{ __('Gennemtestede vikarer') }}</span>
                    </li>
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-emerald-500 shrink-0" />
                        <span>{{ __('Ensartet høj kvalitet') }}</span>
                    </li>
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-emerald-500 shrink-0" />
                        <span>{{ __('Månedlig samlet fakturering') }}</span>
                    </li>
                </ul>
            </div>

            <!-- 3. Rekruttering / Fastansættelse -->
            <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-indigo-200 transition-all group">
                <div class="w-14 h-14 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-xl mb-6 group-hover:scale-110 transition-transform">
                    <x-heroicon-o-user-group class="w-7 h-7 text-emerald-600" />
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">{{ __('Fast rekruttering & Try & Hire') }}</h3>
                <p class="text-sm text-slate-600 leading-relaxed mb-6">
                    {{ __('Afprøv en medarbejder i en vikarperiode før fastansættelse. Minimer ansættelsesrisikoen og find det perfekte match.') }}
                </p>
                <ul class="text-xs text-slate-600 space-y-2.5 border-t border-slate-100 pt-4">
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-emerald-500 shrink-0" />
                        <span>{{ __('Minimer ansættelsesrisiko') }}</span>
                    </li>
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-emerald-500 shrink-0" />
                        <span>{{ __('Screenede kandidater med referencer') }}</span>
                    </li>
                    <li class="flex items-center gap-2 font-medium">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-emerald-500 shrink-0" />
                        <span>{{ __('Fuld digital kontraktstyring') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Industries Section -->
    <section id="industries" class="py-20 bg-slate-100 border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs font-bold text-indigo-600 uppercase tracking-widest">{{ __('Specialiserede Brancher') }}</h2>
                <p class="mt-2 text-3xl font-extrabold text-slate-900 tracking-tight">{{ __('Branchekendskab der gør en forskel') }}</p>
                <p class="mt-3 text-sm text-slate-600">{{ __('Vi forstår din branches specifikke krav og stiller med medarbejdere, der har de nødvendige certifikater og erfaring.') }}</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 text-center hover:shadow-lg transition group">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-cake class="w-8 h-8 text-amber-500" />
                    </div>
                    <h4 class="font-bold text-slate-900">{{ __('Hotel & Restaurant') }}</h4>
                    <p class="text-xs text-slate-500 mt-1">{{ __('Tjenere, bartendere, kokke, opvaskere og housekeeping til hoteller, restauranter og store events.') }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 text-center hover:shadow-lg transition group">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-sparkles class="w-8 h-8 text-indigo-500" />
                    </div>
                    <h4 class="font-bold text-slate-900">{{ __('Rengøring & Facility') }}</h4>
                    <p class="text-xs text-slate-500 mt-1">{{ __('Erhvervsrengøring, vinduespudsning, hotelrengøring og hospitalsrengøring udført af grundige fagfolk.') }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 text-center hover:shadow-lg transition group">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-truck class="w-8 h-8 text-blue-500" />
                    </div>
                    <h4 class="font-bold text-slate-900">{{ __('Lager & Logistik') }}</h4>
                    <p class="text-xs text-slate-500 mt-1">{{ __('Truckførere, pluk-og-pak medarbejdere samt chauffører til travle distributionscentre og lagre.') }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 text-center hover:shadow-lg transition group">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-building-office class="w-8 h-8 text-emerald-500" />
                    </div>
                    <h4 class="font-bold text-slate-900">{{ __('Kontor & Administration') }}</h4>
                    <p class="text-xs text-slate-500 mt-1">{{ __('Receptionister, kundeservicemedarbejdere, bogholdere og data-entry personale til travle kontorer.') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-xs font-bold text-indigo-600 uppercase tracking-widest">{{ __('Sådan Fungerer Det') }}</h2>
            <p class="mt-2 text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">{{ __('Fra behov til bemanding på 4 enkle trin') }}</p>
        </div>

        <div class="grid md:grid-cols-4 gap-8">
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm relative">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4">
                    <x-heroicon-o-clipboard-document-check class="w-5 h-5 text-indigo-600" />
                </div>
                <h4 class="font-bold text-slate-900 mb-2">{{ __('1. Opret forespørgsel') }}</h4>
                <p class="text-xs text-slate-600 leading-relaxed">{{ __('Angiv branche, antal medarbejdere, mødetid og adresse på 2 minutter via vores digitale kundeportal.') }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm relative">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4">
                    <x-heroicon-o-cpu-chip class="w-5 h-5 text-indigo-600" />
                </div>
                <h4 class="font-bold text-slate-900 mb-2">{{ __('2. Intelligent match') }}</h4>
                <p class="text-xs text-slate-600 leading-relaxed">{{ __('Vores system og rådgivere matcher straks opgaven med de bedst egnede vikarer baseret på færdigheder og lokation.') }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm relative">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4">
                    <x-heroicon-o-qr-code class="w-5 h-5 text-indigo-600" />
                </div>
                <h4 class="font-bold text-slate-900 mb-2">{{ __('3. Vikaren møder op') }}</h4>
                <p class="text-xs text-slate-600 leading-relaxed">{{ __('Vikaren scanner virksomhedens QR-kode ved ankomst og påbegynder arbejdet punktligt og professionelt.') }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm relative">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4">
                    <x-heroicon-o-check-badge class="w-5 h-5 text-indigo-600" />
                </div>
                <h4 class="font-bold text-slate-900 mb-2">{{ __('4. Godkend & fakturér') }}</h4>
                <p class="text-xs text-slate-600 leading-relaxed">{{ __('Godkend timesedlen med ét klik. Gennemskuelig faktura med 25% dansk moms og specificerede timer fremsendes automatisk.') }}</p>
            </div>
        </div>
    </section>

    <!-- Call to action / Contact -->
    <section id="contact" class="py-16 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            <h2 class="text-3xl font-extrabold">{{ __('Klar til at få hjælp eller starte som vikar?') }}</h2>
            <p class="text-slate-300 max-w-xl mx-auto text-sm">
                {{ __('Kontakt vores døgnbemandede vagtcentral eller opret din profil online i dag.') }}
            </p>
            <div class="flex flex-wrap justify-center gap-4 pt-4">
                <a href="tel:+4570203040" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-amber-400 text-slate-950 font-bold text-sm hover:bg-amber-300 transition">
                    <x-heroicon-s-phone class="w-4 h-4 text-slate-950" />
                    <span>{{ __('Ring +45 70 20 30 40') }}</span>
                </a>
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-indigo-600 text-white font-bold text-sm hover:bg-indigo-500 transition">
                    <x-heroicon-o-building-office class="w-4 h-4" />
                    <span>{{ __('Opret virksomhedskonto') }}</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-400 py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-4 gap-8">
            <div class="space-y-4">
                <div class="text-xl font-bold text-white flex items-center gap-2">
                    <x-heroicon-s-bolt class="w-5 h-5 text-indigo-400" />
                    <span>Freya<span class="text-indigo-400">Service</span></span>
                </div>
                <p class="text-xs leading-relaxed">
                    {{ __('Dansk vikarbureau med fokus på fleksibilitet, pålidelighed og digital gennemsigtighed.') }}
                </p>
                <div class="text-xs text-slate-500">
                    CVR: 44556677 • Moms nr. DK44556677
                </div>
            </div>

            <div>
                <h5 class="text-xs font-bold text-white uppercase tracking-wider mb-3">{{ __('Virksomheder') }}</h5>
                <ul class="text-xs space-y-2">
                    <li><a href="{{ route('login') }}" class="hover:text-white flex items-center gap-1.5"><x-heroicon-o-chevron-right class="w-3 h-3 text-slate-500" />{{ __('Bestil Vikar') }}</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white flex items-center gap-1.5"><x-heroicon-o-chevron-right class="w-3 h-3 text-slate-500" />{{ __('Timesedler') }}</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white flex items-center gap-1.5"><x-heroicon-o-chevron-right class="w-3 h-3 text-slate-500" />{{ __('Fakturaer') }}</a></li>
                </ul>
            </div>

            <div>
                <h5 class="text-xs font-bold text-white uppercase tracking-wider mb-3">{{ __('Vikarer') }}</h5>
                <ul class="text-xs space-y-2">
                    <li><a href="{{ route('register') }}" class="hover:text-white flex items-center gap-1.5"><x-heroicon-o-chevron-right class="w-3 h-3 text-slate-500" />{{ __('Tilmeld dig som vikar') }}</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white flex items-center gap-1.5"><x-heroicon-o-chevron-right class="w-3 h-3 text-slate-500" />{{ __('Ledige Vagter') }}</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white flex items-center gap-1.5"><x-heroicon-o-chevron-right class="w-3 h-3 text-slate-500" />{{ __('QR Tjek-ind') }}</a></li>
                </ul>
            </div>

            <div>
                <h5 class="text-xs font-bold text-white uppercase tracking-wider mb-3">{{ __('GDPR & Sikkerhed') }}</h5>
                <ul class="text-xs space-y-2">
                    <li class="flex items-start gap-1.5">
                        <x-heroicon-s-shield-check class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5" />
                        <span>{{ __('Ingen CPR-numre gemmes i systemet. Bankoplysninger krypteres med AES-256.') }}</span>
                    </li>
                    <li class="flex items-start gap-1.5">
                        <x-heroicon-s-check class="w-4 h-4 text-indigo-400 shrink-0 mt-0.5" />
                        <span>{{ __('Alle rettigheder forbeholdes. Overholder gældende EU GDPR-lovgivning samt dansk overenskomst.') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 mt-8 border-t border-slate-900 text-center text-xs text-slate-600">
            &copy; {{ date('Y') }} FreyaService.dk — {{ __('Alle rettigheder forbeholdes. Overholder gældende EU GDPR-lovgivning samt dansk overenskomst.') }} Timezone: Europe/Copenhagen.
        </div>
    </footer>
</body>
</html>
