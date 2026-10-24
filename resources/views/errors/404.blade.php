<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('404 — Siden blev ikke fundet') }} — FreyaService | Vikarbureau i Danmark</title>
    <meta name="description" content="{{ __('Den side du leder efter findes desværre ikke eller er blevet flyttet.') }}">
    <meta name="robots" content="noindex, follow">

    <!-- Favicon & Touch Icon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-icon.png') }}">

    <!-- Open Graph / Link Preview -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="FreyaService">
    <meta property="og:title" content="{{ __('404 — Siden blev ikke fundet') }} — FreyaService">
    <meta property="og:description" content="{{ __('Den side du leder efter findes desværre ikke eller er blevet flyttet.') }}">
    <meta property="og:image" content="{{ asset('images/og-image.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="{{ app()->getLocale() === 'da' ? 'da_DK' : 'en_US' }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ __('404 — Siden blev ikke fundet') }} — FreyaService">
    <meta name="twitter:image" content="{{ asset('images/og-image.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
        .hero-pattern {
            background-color: #14263F;
            background-image: radial-gradient(rgba(247, 246, 242, 0.08) 1.5px, transparent 0);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="bg-brand-bg text-brand-body min-h-full flex flex-col antialiased selection:bg-brand-secondary selection:text-white">

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
                    <span>{{ __('Akut vagttelefon') }}: <a href="tel:+4528260926" class="text-white hover:text-brand-action font-semibold">+45 28 26 09 26</a></span>
                </span>
            </div>
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

    <!-- Navigation Header -->
    <header class="bg-brand-surface border-b border-brand-border sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 sm:h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center group">
                <img src="{{ asset('images/logo.png') }}" alt="Freya Service" class="h-9 sm:h-11 w-auto object-contain group-hover:scale-105 transition-transform">
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('services') }}" class="hidden sm:inline-flex text-xs font-semibold text-brand-muted hover:text-brand-secondary transition">{{ __('Ydelser') }}</a>
                <a href="{{ route('contact') }}" class="hidden sm:inline-flex text-xs font-semibold text-brand-muted hover:text-brand-secondary transition">{{ __('Kontakt') }}</a>
                <a href="{{ route('login') }}" class="text-xs font-bold text-brand-secondary border border-brand-border px-3.5 py-2 rounded-xl hover:bg-brand-bg transition">{{ __('Log ind') }}</a>
                <a href="{{ route('home') }}" class="text-xs font-bold text-white bg-brand-action hover:bg-brand-action-hover px-4 py-2 rounded-xl transition">{{ __('Til forsiden') }}</a>
            </div>
        </div>
    </header>

    <!-- Main 404 Hero Card -->
    <main class="flex-1 flex items-center justify-center py-16 sm:py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full text-center">
            <!-- 404 Badge with Brand Styling -->
            <div class="inline-flex items-center justify-center w-24 h-24 sm:w-28 sm:h-28 rounded-3xl bg-action-50 border border-brand-action/20 text-brand-action mb-8 shadow-sm">
                <span class="text-4xl sm:text-5xl font-black tracking-tight">404</span>
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-brand-secondary tracking-tight mb-4">
                {{ __('Siden blev ikke fundet') }}
            </h1>

            <p class="text-base sm:text-lg text-brand-body max-w-lg mx-auto leading-relaxed mb-8">
                {{ __('Beklager, vi kunne ikke finde den side du leder efter. Adressen kan være tastet forkert, eller siden kan være flyttet til et nyt sted.') }}
            </p>

            <!-- Navigation Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4 mb-12">
                <a href="{{ route('home') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl text-sm font-bold text-white bg-brand-action hover:bg-brand-action-hover shadow-md hover:shadow-lg transition">
                    <x-heroicon-o-home class="w-4 h-4" />
                    <span>{{ __('Gå til Forsiden') }}</span>
                </a>
                <a href="{{ route('services') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl text-sm font-bold text-brand-secondary bg-brand-surface hover:bg-brand-bg border border-brand-border shadow-xs transition">
                    <x-heroicon-o-briefcase class="w-4 h-4" />
                    <span>{{ __('Se vores Ydelser') }}</span>
                </a>
                <a href="{{ route('contact') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl text-sm font-bold text-brand-secondary bg-brand-surface hover:bg-brand-bg border border-brand-border shadow-xs transition">
                    <x-heroicon-o-chat-bubble-bottom-center-text class="w-4 h-4" />
                    <span>{{ __('Kontakt os') }}</span>
                </a>
            </div>

            <!-- Helpful Emergency Staffing Box -->
            <div class="p-6 rounded-2xl bg-brand-surface border border-brand-border text-left shadow-xs max-w-lg mx-auto">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-forest-50 text-forest flex items-center justify-center shrink-0">
                        <x-heroicon-o-phone class="w-5 h-5 text-forest" />
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-brand-secondary">{{ __('Brug for akut vikarbemanding?') }}</h4>
                        <p class="text-xs text-brand-muted mt-1 leading-relaxed">
                            {{ __('Vores vagttelefon er åben 24/7 med vikarer klar med kort varsel.') }}
                        </p>
                        <a href="tel:+4528260926" class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-action hover:underline mt-2">
                            <span>+45 28 26 09 26</span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-brand-primary text-sand-300 py-8 border-t border-navy-800 text-center text-xs text-sand-400">
        <div class="max-w-7xl mx-auto px-4">
            &copy; {{ date('Y') }} FreyaService.dk — {{ __('Alle rettigheder forbeholdes.') }}
        </div>
    </footer>
</body>
</html>
