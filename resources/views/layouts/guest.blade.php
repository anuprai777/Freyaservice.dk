<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FreyaService') }}</title>

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
    <body class="font-sans text-brand-body antialiased bg-brand-bg selection:bg-brand-secondary selection:text-white">
        <!-- Language Switcher in top right corner -->
        <div class="w-full max-w-5xl mx-auto flex justify-between items-center px-4 pt-6">
            <a href="/" class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-brand-primary flex items-center justify-center text-white font-black text-sm shadow-sm">
                    FS
                </div>
                <span class="font-black text-lg tracking-tight text-brand-primary">Freya<span class="text-brand-action">Service</span></span>
            </a>

            <!-- Language Switcher -->
            <div class="flex items-center gap-1 bg-brand-surface p-1 rounded-xl shadow-sm border border-brand-border text-xs">
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
            <div class="w-full sm:max-w-md bg-brand-surface shadow-xl shadow-brand-primary/5 overflow-hidden rounded-2xl border border-brand-border p-6 sm:p-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
