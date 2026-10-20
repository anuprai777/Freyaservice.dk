@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-xs text-brand-danger space-y-1 font-medium mt-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center gap-1">
                <span>&bull;</span>
                <span>{{ $message }}</span>
            </li>
        @endforeach
    </ul>
@endif
