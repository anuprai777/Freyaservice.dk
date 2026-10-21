@props([
    'text' => '',
    'class' => '',
    'letterClass' => '',
    'staggerFrom' => 'first',
    'staggerDuration' => 0.04,
    'triggerOnClick' => false,
])

<span
    data-letter-cascade="{{ $text }}"
    data-cascade-class="{{ $class }}"
    data-letter-class="{{ $letterClass }}"
    data-stagger-from="{{ $staggerFrom }}"
    data-stagger-duration="{{ $staggerDuration }}"
    {{ $triggerOnClick ? 'data-trigger-click' : '' }}
    {{ $attributes->merge(['class' => 'inline-flex ' . $class]) }}
>{{ $text }}</span>
