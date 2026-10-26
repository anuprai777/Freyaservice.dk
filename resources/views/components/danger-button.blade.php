<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-burgundy-dark border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-wider hover:bg-[#64172E] active:bg-[#4D1022] focus:outline-none focus:ring-2 focus:ring-burgundy-dark focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer shadow-sm']) }}>
    {{ $slot }}
</button>
