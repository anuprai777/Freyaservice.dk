@props([
    'years' => '16',
    'label' => null,
])

@php
    $displayLabel = $label ?? (app()->getLocale() === 'en' ? 'YEARS EXP.' : 'ÅRS ERFARING');
@endphp

<!-- Circular 16+ Experience Badge with Gold Arc -->
<div {{ $attributes->merge(['class' => 'relative flex items-center justify-center select-none group']) }}>
    <!-- Accessible text for SEO & automated tests -->
    <span class="sr-only">16+ {{ $displayLabel }}</span>

    <!-- Circular Badge Frame -->
    <div class="relative w-24 h-24 sm:w-28 sm:h-28 lg:w-32 lg:h-32 flex items-center justify-center">
        <!-- SVG Ring: ~85% Bright Gold (#C9A45C) starting at 12 o'clock, with ~15% Dark Burgundy (#663732) at top-left -->
        <svg class="w-full h-full transform -rotate-90 pointer-events-none" viewBox="0 0 100 100" fill="none" aria-hidden="true">
            <!-- Full background circle in muted dark track -->
            <circle
                cx="50"
                cy="50"
                r="43"
                stroke="#663732"
                stroke-width="2.75"
                class="opacity-70"
            />
            <!-- Active gold arc: 85% of circumference (230 out of 270.17) -->
            <circle
                cx="50"
                cy="50"
                r="43"
                stroke="#C9A45C"
                stroke-width="2.75"
                stroke-linecap="butt"
                stroke-dasharray="230 270.17"
                stroke-dashoffset="0"
                class="transition-all duration-500 ease-out group-hover:stroke-[#DFC28A]"
            />
        </svg>

        <!-- Inner Content: 16 (white) + (gold) and YEARS EXP. / ÅRS ERFARING (gold) -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center leading-none" aria-hidden="true">
            <div class="flex items-baseline justify-center">
                <span class="text-2xl sm:text-3xl lg:text-[34px] font-black text-white tracking-tight" style="font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;">
                    16
                </span>
                <span class="text-xl sm:text-2xl lg:text-[26px] font-black text-[#C9A45C] ml-0.5 leading-none">
                    +
                </span>
            </div>
            <span class="text-[8.5px] sm:text-[9.5px] lg:text-[10.5px] font-extrabold text-[#C9A45C] uppercase tracking-[0.18em] sm:tracking-[0.2em] mt-1 sm:mt-1.5 leading-none">
                {{ $displayLabel }}
            </span>
        </div>
    </div>
</div>
