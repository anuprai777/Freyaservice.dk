@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center whitespace-nowrap shrink-0 px-1.5 xl:px-2 pt-1 border-b-2 border-burgundy text-[13px] font-bold leading-5 text-white focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center whitespace-nowrap shrink-0 px-1.5 xl:px-2 pt-1 border-b-2 border-transparent text-[13px] font-medium leading-5 text-sand-200 hover:text-white hover:border-sand-300 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
