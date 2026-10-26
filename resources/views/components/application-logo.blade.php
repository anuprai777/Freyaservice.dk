@props(['white' => false])

@if($white)
    <img src="{{ asset('images/logo-white.png') }}" alt="Freya Service" {{ $attributes->merge(['class' => 'h-10 w-auto object-contain']) }}>
@else
    <img src="{{ asset('images/logo.png') }}" alt="Freya Service" {{ $attributes->merge(['class' => 'h-10 w-auto object-contain']) }}>
@endif
