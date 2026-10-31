<!-- Call to action (matches the section background across the site) -->
<section id="contact" class="py-12 sm:py-14 bg-[#FAF5F2] border-t border-brand-border relative overflow-hidden">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-brand-secondary tracking-tight text-balance">
            {{ __('Ready to book staff: temp, part-time or full-time?') }}
        </h2>
        <p class="mt-3 text-brand-muted max-w-xl mx-auto text-xs sm:text-sm leading-relaxed">
            {{ __('Whether you need urgent temp cover, part-time support or a full-time hire, call our 24/7 dispatch line or create your client account online in two minutes.') }}
        </p>
        <div class="mt-6 flex flex-wrap justify-center items-center gap-3 sm:gap-3.5">
            <!-- Primary Action Button: Burgundy #7B1E3A -->
            <a href="tel:+4528260926" class="btn-primary inline-flex items-center justify-center gap-2 px-4 sm:px-5 py-2.5 sm:py-3 rounded-lg text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5 focus-visible:ring-2 focus-visible:ring-burgundy focus:outline-none">
                <x-heroicon-s-phone class="w-4 h-4 text-white shrink-0" />
                <span>{{ __('Ring +45 28 26 09 26') }}</span>
            </a>
            <!-- Client Action Button: Champagne gold border, burgundy text -->
            <a href="{{ route('register', ['role' => 'client']) }}" class="btn-secondary inline-flex items-center justify-center gap-2 px-4 sm:px-5 py-2.5 sm:py-3 rounded-lg font-bold text-xs sm:text-sm transition-all duration-200 transform hover:-translate-y-0.5 focus-visible:ring-2 focus-visible:ring-teal focus:outline-none">
                <x-heroicon-o-building-office class="w-4 h-4 text-teal shrink-0" />
                <span>{{ __('Opret virksomhedskonto') }}</span>
            </a>
            <!-- Worker Action Button: Champagne gold border, burgundy text -->
            <a href="{{ route('register', ['role' => 'worker']) }}" class="btn-secondary inline-flex items-center justify-center gap-2 px-4 sm:px-5 py-2.5 sm:py-3 rounded-lg font-bold text-xs sm:text-sm transition-all duration-200 transform hover:-translate-y-0.5 focus-visible:ring-2 focus-visible:ring-[#C9A24B] focus:outline-none">
                <x-heroicon-o-user-plus class="w-4 h-4 text-[#C9A24B] shrink-0" />
                <span>{{ __('Opret vikarprofil') }}</span>
            </a>
        </div>
    </div>
</section>
