<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($title) && $title ? $title . ' — FreyaService | Vikarbureau i Danmark' : __('FreyaService | Vikarbureau i Danmark – Kvalitetsvikarer til Virksomheder') }}</title>
    <meta name="description" content="{{ $metaDescription ?? __('FreyaService leverer professionelle og pålidelige vikarer til hotel, restaurant, rengøring, lager og logistik samt kontor i hele Danmark.') }}">

    <!-- Favicon & Touch Icon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-icon.png') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Social Media Preview -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="FreyaService">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ isset($title) && $title ? $title . ' — FreyaService' : __('FreyaService | Vikarbureau i Danmark') }}">
    <meta property="og:description" content="{{ $metaDescription ?? __('FreyaService leverer professionelle og pålidelige vikarer til hotel, restaurant, rengøring, lager og logistik samt kontor i hele Danmark.') }}">
    <meta property="og:image" content="{{ asset('images/og-image.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="{{ app()->getLocale() === 'da' ? 'da_DK' : 'en_US' }}">

    <!-- Twitter / X Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ isset($title) && $title ? $title . ' — FreyaService' : __('FreyaService | Vikarbureau i Danmark') }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? __('FreyaService leverer professionelle og pålidelige vikarer til hotel, restaurant, rengøring, lager og logistik samt kontor i hele Danmark.') }}">
    <meta name="twitter:image" content="{{ asset('images/og-image.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }</style>
</head>
<body class="bg-brand-bg text-brand-body antialiased selection:bg-brand-secondary selection:text-white">

    <!-- Top Info Bar -->
    <div class="bg-brand-primary text-sand-100 text-xs py-2 px-4 border-b border-navy-800">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-1">
                    <x-heroicon-o-phone class="w-3.5 h-3.5 text-teal" />
                    <span>{{ __('Akut vagttelefon') }}: <a href="tel:+4528260926" class="text-white hover:text-teal font-semibold">+45 28 26 09 26</a></span>
                </span>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-1.5 text-xs font-medium" role="group" aria-label="Sprogvælger">
                    <a href="{{ route('locale.switch', ['locale' => 'da', 'return_url' => request()->getRequestUri()]) }}" class="inline-flex items-center gap-1 transition-colors px-1.5 py-0.5 rounded {{ app()->getLocale() === 'da' ? 'text-white font-bold underline underline-offset-4 decoration-2 decoration-teal' : 'text-sand-300 hover:text-white' }}" aria-label="Skift til dansk">
                        <span>🇩🇰</span><span>DA</span>
                    </a>
                    <span class="text-sand-400/60 select-none">/</span>
                    <a href="{{ route('locale.switch', ['locale' => 'en', 'return_url' => request()->getRequestUri()]) }}" class="inline-flex items-center gap-1 transition-colors px-1.5 py-0.5 rounded {{ app()->getLocale() === 'en' ? 'text-white font-bold underline underline-offset-4 decoration-2 decoration-teal' : 'text-sand-300 hover:text-white' }}" aria-label="Switch to English">
                        <span>🇬🇧</span><span>EN</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <header x-data="{ mobileOpen: false }" class="sticky top-0 z-50 bg-navy text-white border-b border-navy-800 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="/" class="flex items-center group shrink-0 focus-visible:ring-2 focus-visible:ring-burgundy rounded-lg focus:outline-none" aria-label="Freya Service">
                <img src="{{ asset('images/logo-white.png') }}" alt="Freya Service" class="h-9 sm:h-11 md:h-12 w-auto object-contain group-hover:scale-105 transition-transform">
            </a>

            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold" aria-label="Hovednavigation">
                <a href="{{ route('services') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('services') || request()->routeIs('industries') ? 'text-white border-burgundy' : 'text-sand-200 hover:text-white border-transparent hover:border-sand-300' }} focus-visible:ring-2 focus-visible:ring-burgundy rounded-sm focus:outline-none">
                    <x-heroicon-o-briefcase class="w-4 h-4 text-teal" />
                    <span>{{ __('Services & Sectors') }}</span>
                </a>
                <a href="{{ route('about') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('about') ? 'text-white border-burgundy' : 'text-sand-200 hover:text-white border-transparent hover:border-sand-300' }}">
                    <x-heroicon-o-user-group class="w-4 h-4 text-teal" /><span>{{ __('Om os') }}</span>
                </a>
                <a href="{{ route('how-it-works') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('how-it-works') ? 'text-white border-burgundy' : 'text-sand-200 hover:text-white border-transparent hover:border-sand-300' }}">
                    <x-heroicon-o-arrows-pointing-in class="w-4 h-4 text-teal" /><span>{{ __('Sådan virker det') }}</span>
                </a>
                <a href="{{ route('contact') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('contact') ? 'text-white border-burgundy' : 'text-sand-200 hover:text-white border-transparent hover:border-sand-300' }}">
                    <x-heroicon-o-chat-bubble-bottom-center-text class="w-4 h-4 text-teal" /><span>{{ __('Kontakt') }}</span>
                </a>
            </nav>

            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary border-2 border-white/35 inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-bold text-white shadow-sm transition">
                            <x-heroicon-o-squares-2x2 class="w-4 h-4" /><span>{{ __('Min Profil / Dashboard') }}</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden lg:flex text-sm font-bold text-sand-200 hover:text-white px-3 py-2 rounded-lg transition items-center gap-1.5">
                            <x-heroicon-o-arrow-right-end-on-rectangle class="w-4 h-4 text-teal" /><span>{{ __('Log ind') }}</span>
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary border-2 border-white/35 inline-flex items-center justify-center gap-1 sm:gap-1.5 px-2.5 sm:px-4 lg:px-5 py-1.5 sm:py-2 lg:py-2.5 rounded-lg text-xs sm:text-sm font-bold text-white shadow-md transition">
                                <x-heroicon-o-user-plus class="w-3.5 h-3.5 sm:w-4 sm:h-4" /><span>{{ __('Opret konto') }}</span>
                            </a>
                        @endif
                    @endauth
                @endif
                <!-- Mobile toggle -->
                <button @click="mobileOpen = !mobileOpen" type="button" class="lg:hidden inline-flex items-center justify-center p-2.5 min-h-[44px] min-w-[44px] rounded-lg text-sand-200 hover:text-white hover:bg-navy-800 focus:outline-none transition" aria-label="Menu">
                    <x-heroicon-o-bars-3 class="h-6 w-6" x-show="!mobileOpen" />
                    <x-heroicon-o-x-mark class="h-6 w-6" x-show="mobileOpen" x-cloak />
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
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
                <a href="{{ route('about') }}" class="flex items-center gap-3 px-3 py-2.5 min-h-[44px] rounded-lg text-sm font-semibold transition {{ request()->routeIs('about') ? 'bg-navy-800 text-white font-bold border-l-4 border-burgundy' : 'text-sand-200 hover:bg-navy-800 hover:text-white' }}">
                    <x-heroicon-o-user-group class="w-5 h-5 text-teal" />
                    <span>{{ __('Om os') }}</span>
                </a>
                <a href="{{ route('how-it-works') }}" class="flex items-center gap-3 px-3 py-2.5 min-h-[44px] rounded-lg text-sm font-semibold transition {{ request()->routeIs('how-it-works') ? 'bg-navy-800 text-white font-bold border-l-4 border-burgundy' : 'text-sand-200 hover:bg-navy-800 hover:text-white' }}">
                    <x-heroicon-o-arrows-pointing-in class="w-5 h-5 text-teal" />
                    <span>{{ __('Sådan virker det') }}</span>
                </a>
                <a href="{{ route('contact') }}" class="flex items-center gap-3 px-3 py-2.5 min-h-[44px] rounded-lg text-sm font-semibold transition {{ request()->routeIs('contact') ? 'bg-navy-800 text-white font-bold border-l-4 border-burgundy' : 'text-sand-200 hover:bg-navy-800 hover:text-white' }}">
                    <x-heroicon-o-chat-bubble-bottom-center-text class="w-5 h-5 text-teal" />
                    <span>{{ __('Kontakt') }}</span>
                </a>
            </div>
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

    {{ $slot }}

    <x-public-cta />
    <x-public-footer />
</body>
</html>
