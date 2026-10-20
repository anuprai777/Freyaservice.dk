@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-brand-secondary text-sm font-bold leading-5 text-brand-secondary focus:outline-none focus:border-brand-primary transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-brand-muted hover:text-brand-secondary hover:border-brand-border focus:outline-none focus:text-brand-secondary focus:border-brand-border transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
