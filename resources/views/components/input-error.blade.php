@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-xs text-burgundy-dark space-y-1 font-semibold mt-1.5']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center gap-1">
                <span class="text-burgundy">&bull;</span>
                <span>{{ $message }}</span>
            </li>
        @endforeach
    </ul>
@endif
