<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn-secondary inline-flex items-center justify-center px-4 py-2 bg-transparent border-2 border-teal rounded-lg font-bold text-xs text-navy uppercase tracking-wider shadow-sm hover:bg-teal/10 focus:outline-none focus:ring-2 focus:ring-teal focus:ring-offset-2 disabled:opacity-30 transition ease-in-out duration-150 cursor-pointer']) }}>
    {{ $slot }}
</button>
