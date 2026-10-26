@props([
    'size' => 'default',
    'years' => '16+',
    'label' => null,
])

@php
    $displayLabel = $label ?? __('YEARS EXP.');
@endphp

<!-- Sleek Experience Trust Badge (No Rounded Circle) -->
<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5 px-4 py-2 rounded-xl bg-navy-950/80 border border-[#C9A24B]/40 shadow-sm text-white select-none transition-all duration-200 hover:border-[#C9A24B] group']) }}>
    <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-md font-black text-xs text-[#C9A24B] bg-[#C9A24B]/15 border border-[#C9A24B]/30 tracking-tight">
        {{ $years }}
    </span>
    <span class="w-1 h-1 rounded-full bg-[#C9A24B] opacity-60"></span>
    <span class="text-xs font-bold uppercase tracking-wider text-sand-100">
        {{ $displayLabel }}
    </span>
    <x-heroicon-s-shield-check class="w-4 h-4 text-[#C9A24B] shrink-0" />
</div>
