@props([
    'size' => 'default',
    'years' => '16+',
    'label' => null,
])

@php
    $displayLabel = $label ?? __('YEARS EXP.');
@endphp

<!-- Circular Experience Seal Badge (Matching Reference Design) -->
<div {{ $attributes->merge(['class' => 'inline-flex items-center justify-center select-none group']) }}>
    <div class="relative w-28 h-28 sm:w-32 sm:h-32 rounded-full bg-[#182E4B] border-4 sm:border-[5px] border-white shadow-2xl flex flex-col items-center justify-center p-2 transition-transform duration-300 group-hover:scale-105">
        <!-- Inner dashed orange circular ring -->
        <div class="absolute inset-1.5 sm:inset-2 rounded-full border-2 border-dashed border-brand-action pointer-events-none"></div>

        <!-- Center Content -->
        <div class="relative z-10 text-center flex flex-col items-center justify-center px-1">
            <span class="text-2xl sm:text-3xl font-black text-brand-action leading-none tracking-tight">
                {{ $years }}
            </span>
            <span class="mt-1 text-[9px] sm:text-[10px] font-black text-white tracking-widest uppercase leading-tight text-center">
                {{ $displayLabel }}
            </span>
        </div>
    </div>
</div>
