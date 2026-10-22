<div
    x-data="{
        visible: false,
        checkScroll() {
            this.visible = window.scrollY > 280;
        },
        scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    }"
    x-init="checkScroll()"
    @scroll.window="checkScroll()"
    class="fixed bottom-6 right-6 z-40 pointer-events-none"
>
    <button
        type="button"
        x-show="visible"
        x-cloak
        @click="scrollToTop()"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-6 scale-75"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-6 scale-75"
        aria-label="{{ __('Tilbage til toppen') }}"
        title="{{ __('Tilbage til toppen') }}"
        class="pointer-events-auto flex items-center justify-center w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-brand-primary text-white shadow-xl hover:bg-brand-action hover:shadow-brand-action/30 border border-white/20 transition-all duration-300 hover:-translate-y-1 active:translate-y-0 focus:outline-none focus:ring-2 focus:ring-brand-action focus:ring-offset-2 dark:focus:ring-offset-slate-900 group"
    >
        <svg
            class="w-5 h-5 transition-transform duration-300 group-hover:-translate-y-0.5"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="2.5"
            stroke="currentColor"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
        </svg>
    </button>
</div>
