@props(['disabled' => false, 'error' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border border-mist bg-white text-ink focus:border-burgundy focus:ring-2 focus:ring-burgundy rounded-lg shadow-xs text-sm placeholder:text-gray-400 transition-colors ' . ($error ? 'border-burgundy-dark ring-1 ring-burgundy-dark' : '')]) }}>
