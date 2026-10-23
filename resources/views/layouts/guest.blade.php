@props(['maxWidth' => 'sm:max-w-md', 'title' => null])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) && $title ? $title . ' — FreyaService | Vikarbureau i Danmark' : __('FreyaService | Vikarbureau i Danmark – Kvalitetsvikarer til Virksomheder') }}</title>

        <!-- Favicon & Touch Icon -->
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/logo-icon.png') }}">

        <!-- Canonical URL -->
        <link rel="canonical" href="{{ url()->current() }}">

        <!-- Open Graph / Link Preview -->
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="FreyaService">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="{{ isset($title) && $title ? $title . ' — FreyaService | Vikarbureau i Danmark' : __('FreyaService | Vikarbureau i Danmark') }}">
        <meta property="og:image" content="{{ asset('images/og-image.png') }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:locale" content="{{ app()->getLocale() === 'da' ? 'da_DK' : 'en_US' }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ isset($title) && $title ? $title . ' — FreyaService | Vikarbureau i Danmark' : __('FreyaService | Vikarbureau i Danmark') }}">
        <meta name="twitter:image" content="{{ asset('images/og-image.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            }
        </style>
    </head>
    <body class="font-sans text-brand-body antialiased bg-brand-bg selection:bg-brand-secondary selection:text-white relative" style="background-image: radial-gradient(rgba(20, 38, 63, 0.04) 1.5px, transparent 0); background-size: 24px 24px;">
        <!-- Floating Toast Notifications for Form Success & Alerts -->
        <x-notification-toast />

        <!-- Controls in top right corner -->
        <div class="w-full max-w-5xl mx-auto flex justify-between items-center px-4 pt-6">
            <a href="/" class="flex items-center group">
                <img src="{{ asset('images/logo.png') }}" alt="Freya Service" class="h-10 w-auto object-contain group-hover:scale-105 transition-transform">
            </a>

            <!-- Language Switcher -->
            <div class="flex items-center gap-1 bg-brand-surface p-1 rounded-xl shadow-xs border border-brand-border text-xs">
                <a href="{{ route('locale.switch', 'da') }}" class="px-2.5 py-1 rounded-lg transition flex items-center gap-1.5 {{ app()->getLocale() === 'da' ? 'bg-brand-secondary text-white font-bold underline underline-offset-4 decoration-2 decoration-brand-action shadow-xs' : 'text-brand-muted hover:text-brand-secondary font-medium' }}">
                    <span>🇩🇰</span>
                    <span>Dansk</span>
                </a>
                <a href="{{ route('locale.switch', 'en') }}" class="px-2.5 py-1 rounded-lg transition flex items-center gap-1.5 {{ app()->getLocale() === 'en' ? 'bg-brand-secondary text-white font-bold underline underline-offset-4 decoration-2 decoration-brand-action shadow-xs' : 'text-brand-muted hover:text-brand-secondary font-medium' }}">
                    <span>🇬🇧</span>
                    <span>English</span>
                </a>
            </div>
        </div>

        <div class="min-h-[calc(100vh-80px)] flex flex-col justify-center items-center py-8 px-4 sm:px-6">
            <div class="w-full {{ $maxWidth }} bg-brand-surface shadow-xl shadow-brand-primary/5 overflow-hidden rounded-2xl border border-brand-border p-6 sm:p-8">
                {{ $slot }}
            </div>
        </div>

        <!-- Back to Top Button -->
        <x-back-to-top />
    </body>
</html>
