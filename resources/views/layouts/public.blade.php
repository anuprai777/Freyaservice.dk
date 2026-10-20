<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'FreyaService') }} — FreyaService</title>
    <meta name="description" content="{{ $metaDescription ?? __('FreyaService leverer professionelle og pålidelige vikarer til hotel, restaurant, rengøring, lager og logistik samt kontor i hele Danmark.') }}">
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
                <span class="flex items-center gap-1.5">
                    <x-heroicon-o-globe-europe-africa class="w-3.5 h-3.5 text-sand-300" />
                    <span>{{ __('Landsdækkende vikarservice') }}</span>
                </span>
                <span class="hidden md:inline text-navy-700">•</span>
                <span class="flex items-center gap-1">
                    <x-heroicon-o-phone class="w-3.5 h-3.5 text-brand-action" />
                    <span>{{ __('Akut vagttelefon') }}: <a href="tel:+4570203040" class="text-white hover:text-brand-action font-semibold">+45 70 20 30 40</a></span>
                </span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-forest-100 font-medium flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-forest animate-pulse"></span>
                    <span>{{ __('Vikarer klar til udrykning 24/7') }}</span>
                </span>
                <div class="flex items-center gap-1.5 text-xs font-medium" role="group">
                    <a href="{{ route('locale.switch', 'da') }}" class="inline-flex items-center gap-1 transition-colors px-1.5 py-0.5 rounded {{ app()->getLocale() === 'da' ? 'text-white font-bold underline underline-offset-4 decoration-2 decoration-brand-action' : 'text-sand-300 hover:text-white' }}">
                        <span>🇩🇰</span><span>DA</span>
                    </a>
                    <span class="text-navy-700 select-none">/</span>
                    <a href="{{ route('locale.switch', 'en') }}" class="inline-flex items-center gap-1 transition-colors px-1.5 py-0.5 rounded {{ app()->getLocale() === 'en' ? 'text-white font-bold underline underline-offset-4 decoration-2 decoration-brand-action' : 'text-sand-300 hover:text-white' }}">
                        <span>🇬🇧</span><span>EN</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <header x-data="{ mobileOpen: false }" class="sticky top-0 z-50 bg-brand-surface/95 backdrop-blur-md border-b border-brand-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="/" class="flex items-center group">
                <img src="{{ asset('images/logo.png') }}" alt="ProService Vikar" class="h-11 sm:h-12 w-auto object-contain group-hover:scale-105 transition-transform">
            </a>

            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold">
                <a href="{{ route('services') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('services') ? 'text-brand-secondary border-brand-action' : 'text-brand-muted hover:text-brand-secondary border-transparent' }}">
                    <x-heroicon-o-briefcase class="w-4 h-4" /><span>{{ __('Ydelser') }}</span>
                </a>
                <a href="{{ route('industries') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('industries') ? 'text-brand-secondary border-brand-action' : 'text-brand-muted hover:text-brand-secondary border-transparent' }}">
                    <x-heroicon-o-building-office-2 class="w-4 h-4" /><span>{{ __('Brancher') }}</span>
                </a>
                <a href="{{ route('how-it-works') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('how-it-works') ? 'text-brand-secondary border-brand-action' : 'text-brand-muted hover:text-brand-secondary border-transparent' }}">
                    <x-heroicon-o-arrows-pointing-in class="w-4 h-4" /><span>{{ __('Sådan virker det') }}</span>
                </a>
                <a href="{{ route('contact') }}" class="flex items-center gap-1.5 transition-colors px-1 pb-0.5 border-b-2 {{ request()->routeIs('contact') ? 'text-brand-secondary border-brand-action' : 'text-brand-muted hover:text-brand-secondary border-transparent' }}">
                    <x-heroicon-o-chat-bubble-bottom-center-text class="w-4 h-4" /><span>{{ __('Kontakt') }}</span>
                </a>
            </nav>

            <div class="flex items-center gap-3">
                <div class="hidden sm:flex items-center gap-1 bg-brand-bg p-1 rounded-xl border border-brand-border text-xs">
                    <a href="{{ route('locale.switch', 'da') }}" title="Dansk" class="px-2.5 py-1 rounded-lg transition flex items-center gap-1 {{ app()->getLocale() === 'da' ? 'bg-brand-surface text-brand-secondary shadow-sm font-bold underline underline-offset-4 decoration-2 decoration-brand-action' : 'text-brand-muted hover:text-brand-secondary font-medium' }}">
                        <span>🇩🇰</span><span>DA</span>
                    </a>
                    <a href="{{ route('locale.switch', 'en') }}" title="English" class="px-2.5 py-1 rounded-lg transition flex items-center gap-1 {{ app()->getLocale() === 'en' ? 'bg-brand-surface text-brand-secondary shadow-sm font-bold underline underline-offset-4 decoration-2 decoration-brand-action' : 'text-brand-muted hover:text-brand-secondary font-medium' }}">
                        <span>🇬🇧</span><span>EN</span>
                    </a>
                </div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-brand-action hover:bg-brand-action-hover shadow-sm transition">
                            <x-heroicon-o-squares-2x2 class="w-4 h-4" /><span>{{ __('Min Profil / Dashboard') }}</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden lg:flex text-sm font-bold text-brand-secondary hover:text-brand-action px-3 py-2 rounded-lg transition items-center gap-1.5">
                            <x-heroicon-o-arrow-right-end-on-rectangle class="w-4 h-4 text-brand-muted" /><span>{{ __('Log ind') }}</span>
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="hidden lg:inline-flex items-center justify-center gap-1.5 px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-brand-action hover:bg-brand-action-hover shadow-md transition">
                                <x-heroicon-o-user-plus class="w-4 h-4" /><span>{{ __('Opret konto') }}</span>
                            </a>
                        @endif
                    @endauth
                @endif
                <!-- Mobile toggle -->
                <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-md text-brand-muted hover:text-brand-secondary hover:bg-brand-bg focus:outline-none transition">
                    <x-heroicon-o-bars-3 class="h-6 w-6" x-show="!mobileOpen" />
                    <x-heroicon-o-x-mark class="h-6 w-6" x-show="mobileOpen" x-cloak />
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileOpen" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="lg:hidden border-t border-brand-border bg-brand-surface shadow-lg">
            <div class="px-4 py-4 space-y-1">
                <a href="{{ route('services') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('services') ? 'bg-navy-50 text-brand-secondary' : 'text-brand-muted hover:bg-brand-bg hover:text-brand-secondary' }}">
                    <x-heroicon-o-briefcase class="w-4 h-4" />{{ __('Ydelser') }}
                </a>
                <a href="{{ route('industries') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('industries') ? 'bg-navy-50 text-brand-secondary' : 'text-brand-muted hover:bg-brand-bg hover:text-brand-secondary' }}">
                    <x-heroicon-o-building-office-2 class="w-4 h-4" />{{ __('Brancher') }}
                </a>
                <a href="{{ route('how-it-works') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('how-it-works') ? 'bg-navy-50 text-brand-secondary' : 'text-brand-muted hover:bg-brand-bg hover:text-brand-secondary' }}">
                    <x-heroicon-o-arrows-pointing-in class="w-4 h-4" />{{ __('Sådan virker det') }}
                </a>
                <a href="{{ route('contact') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-semibold transition {{ request()->routeIs('contact') ? 'bg-navy-50 text-brand-secondary' : 'text-brand-muted hover:bg-brand-bg hover:text-brand-secondary' }}">
                    <x-heroicon-o-chat-bubble-bottom-center-text class="w-4 h-4" />{{ __('Kontakt') }}
                </a>
            </div>
            <div class="px-4 pb-4 pt-2 border-t border-brand-border flex gap-2">
                <a href="{{ route('login') }}" class="flex-1 text-center text-sm font-bold text-brand-secondary border border-brand-border px-3 py-2 rounded-lg hover:bg-brand-bg transition">{{ __('Log ind') }}</a>
                <a href="{{ route('register') }}" class="flex-1 text-center text-sm font-bold text-white bg-brand-action px-3 py-2 rounded-lg hover:bg-brand-action-hover transition">{{ __('Opret konto') }}</a>
            </div>
        </div>
    </header>

    {{ $slot }}

    <!-- Footer -->
    <footer class="bg-brand-primary text-sand-300 py-12 border-t border-navy-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-4 gap-8">
            <div class="space-y-4">
                <a href="/" class="inline-block group">
                    <img src="{{ asset('images/logo-white.png') }}" alt="ProService Vikar" class="h-10 w-auto object-contain group-hover:opacity-90 transition">
                </a>
                <p class="text-xs leading-relaxed text-sand-200">{{ __('Dansk vikarbureau med fokus på fleksibilitet, pålidelighed og digital gennemsigtighed.') }}</p>
                <div class="text-xs text-sand-400">CVR: 44556677 • Moms nr. DK44556677</div>
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
                    <li class="flex items-start gap-1.5"><x-heroicon-s-shield-check class="w-4 h-4 text-forest shrink-0 mt-0.5" /><span class="text-sand-200">{{ __('Ingen CPR-numre gemmes i systemet. Bankoplysninger krypteres med AES-256.') }}</span></li>
                    <li class="flex items-start gap-1.5"><x-heroicon-s-check class="w-4 h-4 text-brand-action shrink-0 mt-0.5" /><span class="text-sand-200">{{ __('Alle rettigheder forbeholdes. Overholder gældende EU GDPR-lovgivning samt dansk overenskomst.') }}</span></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 mt-8 border-t border-navy-800 text-center text-xs text-sand-400">
            &copy; {{ date('Y') }} FreyaService.dk — {{ __('Alle rettigheder forbeholdes. Overholder gældende EU GDPR-lovgivning samt dansk overenskomst.') }}
        </div>
    </footer>
</body>
</html>
