<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-brand-danger border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-wider hover:bg-brick-600 active:bg-brick-700 focus:outline-none focus:ring-2 focus:ring-brand-danger focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer shadow-sm']) }}>
    {{ $slot }}
</button>
