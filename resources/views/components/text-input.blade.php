@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-brand-border bg-brand-surface text-brand-body focus:border-brand-secondary focus:ring-brand-secondary rounded-xl shadow-sm text-sm placeholder:text-brand-muted']) }}>
