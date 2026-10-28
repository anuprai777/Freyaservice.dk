@props([
    'years' => '16+',
    'label' => null,
])

@php
    $displayLabel = $label ?? __('YEARS EXP.');
@endphp

<!-- Giant Outline 16+ Experience Element -->
<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center text-center select-none']) }}>
    <span class="hero-outline-number text-[50px] sm:text-[64px] lg:text-[80px]"
          style="font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif; font-weight: 800; color: transparent; -webkit-text-fill-color: transparent; -webkit-text-stroke: 2px #c9a45c; text-stroke: 2px #c9a45c; line-height: 0.9;">
        {{ $years }}
    </span>
    <span class="text-[11px] sm:text-[12px] md:text-[13px] font-bold text-white uppercase tracking-[0.18em] sm:tracking-[0.2em] mt-1 sm:mt-1.5 leading-none">
        {{ $displayLabel }}
    </span>
</div>
