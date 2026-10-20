<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-brand-surface border border-brand-border rounded-xl font-bold text-xs text-brand-secondary uppercase tracking-wider shadow-sm hover:bg-brand-bg focus:outline-none focus:ring-2 focus:ring-brand-secondary focus:ring-offset-2 disabled:opacity-30 transition ease-in-out duration-150 cursor-pointer']) }}>
    {{ $slot }}
</button>
