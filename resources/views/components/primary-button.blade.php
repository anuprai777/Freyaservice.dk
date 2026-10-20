<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-brand-action hover:bg-brand-action-hover active:bg-brand-action-hover text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-action focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer']) }}>
    {{ $slot }}
</button>
