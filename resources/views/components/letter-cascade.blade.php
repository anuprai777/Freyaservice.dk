@props([
    'text' => '',
    'class' => '',
    'letterClass' => '',
    'staggerFrom' => 'first',
    'staggerDuration' => 0.04,
    'triggerOnClick' => false,
    'group' => null,
])

<span
    data-letter-cascade="{{ $text }}"
    data-cascade-class="{{ $class }}"
    data-letter-class="{{ $letterClass }}"
    data-stagger-from="{{ $staggerFrom }}"
    data-stagger-duration="{{ $staggerDuration }}"
    @if($group) data-cascade-group="{{ $group }}" @endif
    {{ $triggerOnClick ? 'data-trigger-click' : '' }}
    {{ $attributes->merge(['class' => 'inline-flex ' . $class]) }}
>{{ $text }}</span>
