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
    <!-- Floating Toast Notifications for Form Success & Alerts -->
    <x-notification-toast />

    <!-- Top Info Bar -->
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
                <span class="text-forest-100 font-medium flex items-center gap-1.5 text-[11px] sm:text-xs">
                    <span class="w-2 h-2 rounded-full bg-forest animate-pulse shrink-0"></span>
                    <span>{{ __('Vikarer klar til udrykning 24/7') }}</span>
                </span>
                <div class="flex items-center gap-1 text-xs font-medium" role="group">
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
    <header x-data="{ mobileOpen: false }" class="sticky top-0 z-50 bg-brand-surface border-b border-brand-border shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 sm:h-20 flex items-center justify-between">
            <a href="/" class="flex items-center group shrink-0">
                <img src="{{ asset('images/logo.png') }}" alt="Freya Service" class="h-9 sm:h-11 md:h-12 w-auto object-contain group-hover:scale-105 transition-transform">
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

            <div class="flex items-center gap-2 sm:gap-3">
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
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 px-3.5 sm:px-5 py-2 sm:py-2.5 rounded-xl text-xs sm:text-sm font-bold text-white bg-brand-action hover:bg-brand-action-hover shadow-sm transition">
                            <x-heroicon-o-squares-2x2 class="w-4 h-4 shrink-0" />
                            <span class="hidden sm:inline">{{ __('Min Profil / Dashboard') }}</span>
                            <span class="sm:hidden">{{ __('Dashboard') }}</span>
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
                <button @click="mobileOpen = !mobileOpen" type="button" class="lg:hidden p-2 rounded-xl text-brand-muted hover:text-brand-secondary hover:bg-brand-bg focus:outline-none transition" aria-label="Menu">
                    <x-heroicon-o-bars-3 class="h-6 w-6" x-show="!mobileOpen" />
                    <x-heroicon-o-x-mark class="h-6 w-6" x-show="mobileOpen" x-cloak />
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileOpen" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="lg:hidden border-t border-brand-border bg-brand-surface shadow-lg">
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

            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('services') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('services') ? 'bg-navy-50 text-brand-secondary' : 'text-brand-body hover:bg-brand-bg hover:text-brand-secondary' }}">
                    <x-heroicon-o-briefcase class="w-5 h-5 text-brand-action" />{{ __('Ydelser') }}
                </a>
                <a href="{{ route('industries') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('industries') ? 'bg-navy-50 text-brand-secondary' : 'text-brand-body hover:bg-brand-bg hover:text-brand-secondary' }}">
                    <x-heroicon-o-building-office-2 class="w-5 h-5 text-brand-action" />{{ __('Brancher') }}
                </a>
                <a href="{{ route('how-it-works') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('how-it-works') ? 'bg-navy-50 text-brand-secondary' : 'text-brand-body hover:bg-brand-bg hover:text-brand-secondary' }}">
                    <x-heroicon-o-arrows-pointing-in class="w-5 h-5 text-brand-action" />{{ __('Sådan virker det') }}
                </a>
                <a href="{{ route('contact') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('contact') ? 'bg-navy-50 text-brand-secondary' : 'text-brand-body hover:bg-brand-bg hover:text-brand-secondary' }}">
                    <x-heroicon-o-chat-bubble-bottom-center-text class="w-5 h-5 text-brand-action" />{{ __('Kontakt') }}
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

    {{ $slot }}

    <!-- Footer -->
    <footer class="bg-brand-primary text-sand-300 py-12 border-t border-navy-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-4 gap-8">
            <div class="space-y-4">
                <a href="/" class="inline-block group">
                    <img src="{{ asset('images/logo-white.png') }}" alt="Freya Service" class="h-10 w-auto object-contain group-hover:opacity-90 transition">
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

    <!-- Back to Top Button -->
    <x-back-to-top />
</body>
</html>
