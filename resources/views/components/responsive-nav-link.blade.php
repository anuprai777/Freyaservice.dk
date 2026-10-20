@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-brand-secondary text-start text-base font-bold text-brand-secondary bg-navy-50 focus:outline-none focus:text-brand-primary focus:bg-navy-100 focus:border-brand-primary transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-brand-muted hover:text-brand-secondary hover:bg-brand-bg hover:border-brand-border focus:outline-none focus:text-brand-secondary focus:bg-brand-bg focus:border-brand-border transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
