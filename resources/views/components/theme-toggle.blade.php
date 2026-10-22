@props(['class' => ''])

<div x-data="{
    isDark: false,
    init() {
        this.isDark = document.documentElement.classList.contains('dark') ||
            localStorage.getItem('theme') === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
        this.apply();

        window.addEventListener('storage', (e) => {
            if (e.key === 'theme') {
                this.isDark = e.newValue === 'dark';
                this.apply();
            }
        });
    },
    toggle() {
        this.isDark = !this.isDark;
        localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
        this.apply();
    },
    apply() {
        if (this.isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
}" class="inline-flex items-center {{ $class }}">
    <button
        type="button"
        @click="toggle()"
        :aria-label="isDark ? '{{ __('Skift til lys tilstand') }}' : '{{ __('Skift til mørk tilstand') }}'"
        :title="isDark ? '{{ __('Skift til lys tilstand') }}' : '{{ __('Skift til mørk tilstand') }}'"
        class="relative inline-flex items-center justify-center p-2 rounded-xl text-brand-muted hover:text-brand-action hover:bg-black/5 dark:hover:bg-white/10 border border-brand-border/60 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-brand-action/40"
    >
        <!-- Sun icon (visible in dark mode) -->
        <svg
            x-show="isDark"
            x-cloak
            class="w-4 h-4 text-amber-400 transition-transform duration-300 hover:rotate-45"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
        </svg>

        <!-- Moon icon (visible in light mode) -->
        <svg
            x-show="!isDark"
            class="w-4 h-4 text-brand-secondary transition-transform duration-300 hover:-rotate-12"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
        </svg>
    </button>
</div>
