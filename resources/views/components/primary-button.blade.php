<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-burgundy hover:bg-burgundy-dark active:bg-burgundy-dark text-white font-bold text-xs uppercase tracking-wider rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-burgundy focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer']) }}>
    {{ $slot }}
</button>
