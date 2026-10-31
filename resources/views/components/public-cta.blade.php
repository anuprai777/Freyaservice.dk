<!-- Call to action (matches the section background across the site) -->
<section id="contact" class="py-14 sm:py-20 bg-[#FAF5F2] border-t border-brand-border relative overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-5xl mx-auto">
            <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-[#5A1429] tracking-tight sm:whitespace-nowrap">
                {{ __('Ready to book staff: temp, part-time or full-time?') }}
            </h2>
            <p class="mt-3.5 text-[#5A4E47] text-xs sm:text-sm md:text-base leading-relaxed max-w-3xl mx-auto">
                {{ __('Need urgent cover, or looking for shifts yourself? Call our 24/7 dispatch line or create your account online in two minutes.') }}
            </p>
        </div>

        <div class="mt-10 sm:mt-12 grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 items-stretch">
            <!-- Left Card: For Companies (Deep Burgundy) -->
            <div class="rounded-3xl bg-[#5A1429] p-7 sm:p-9 md:p-10 text-white flex flex-col justify-between shadow-xl relative overflow-hidden">
                <div>
                    <!-- Top Icon Badge -->
                    <div class="w-12 h-12 rounded-2xl bg-white/10 border border-white/15 flex items-center justify-center shadow-xs">
                        <x-heroicon-o-building-office class="w-6 h-6 text-[#C9A24B]" />
                    </div>

                    <!-- Eyebrow -->
                    <p class="mt-6 text-[11px] sm:text-xs font-black tracking-wider uppercase text-[#C9A24B]">
                        {{ __('FOR COMPANIES') }}
                    </p>

                    <!-- Title -->
                    <h3 class="mt-2 text-2xl sm:text-3xl font-black text-white tracking-tight">
                        {{ __('Need staff today?') }}
                    </h3>

                    <!-- Description -->
                    <p class="mt-3 text-white/80 text-xs sm:text-sm leading-relaxed max-w-md">
                        {{ __('Waiters, kitchen and event crew, booked in minutes. No lock-in periods.') }}
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex flex-col items-start gap-3 w-full">
                    <!-- Primary Gold Phone Button -->
                    <a href="tel:+4528260926" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-6 py-3.5 rounded-xl bg-[#C9A24B] hover:bg-[#B8913E] text-navy font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5 focus-visible:ring-2 focus-visible:ring-white focus:outline-none min-h-[46px]">
                        <x-heroicon-s-phone class="w-4 h-4 text-navy shrink-0" />
                        <span>{{ __('Ring +45 28 26 09 26') }}</span>
                    </a>

                    <!-- Secondary White-Border Company Register Button -->
                    <a href="{{ route('register', ['role' => 'client']) }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-6 py-3.5 rounded-xl border-2 border-white/80 hover:bg-white/10 text-white font-bold text-xs sm:text-sm transition-all duration-200 transform hover:-translate-y-0.5 focus-visible:ring-2 focus-visible:ring-white focus:outline-none min-h-[46px]">
                        <x-heroicon-o-building-office class="w-4 h-4 text-white shrink-0" />
                        <span>{{ __('Opret virksomhedskonto') }}</span>
                    </a>
                </div>
            </div>

            <!-- Right Card: For Workers (Clean Off-White with Subtle Gold/Burgundy Accents) -->
            <div class="rounded-3xl bg-white border-2 border-[#EADBCC] p-7 sm:p-9 md:p-10 flex flex-col justify-between shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
                <div>
                    <!-- Top Icon Badge -->
                    <div class="w-12 h-12 rounded-2xl bg-[#FAF5F2] border border-[#EADBCC] flex items-center justify-center shadow-xs">
                        <x-heroicon-o-user-plus class="w-6 h-6 text-[#997328]" />
                    </div>

                    <!-- Eyebrow -->
                    <p class="mt-6 text-[11px] sm:text-xs font-black tracking-wider uppercase text-[#997328]">
                        {{ __('FOR WORKERS') }}
                    </p>

                    <!-- Title -->
                    <h3 class="mt-2 text-2xl sm:text-3xl font-black text-navy tracking-tight">
                        {{ __('Looking for shifts?') }}
                    </h3>

                    <!-- Description -->
                    <p class="mt-3 text-[#5A4E47] text-xs sm:text-sm leading-relaxed max-w-md">
                        {{ __('Pick up available shifts, clock in with a QR code and get paid with full transparency.') }}
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex flex-col items-start gap-3 w-full">
                    <!-- Primary Burgundy Worker Register Button -->
                    <a href="{{ route('register', ['role' => 'worker']) }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-6 py-3.5 rounded-xl bg-[#5A1429] hover:bg-[#480F20] text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5 focus-visible:ring-2 focus-visible:ring-burgundy focus:outline-none min-h-[46px]">
                        <x-heroicon-o-user-plus class="w-4 h-4 text-white shrink-0" />
                        <span>{{ __('Opret vikarprofil') }}</span>
                    </a>

                    <!-- Secondary Burgundy-Border Browse Shifts Button -->
                    <a href="{{ auth()->check() && auth()->user()->isWorker() ? route('worker.offers.index') : route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-6 py-3.5 rounded-xl border-2 border-[#5A1429] hover:bg-[#5A1429]/5 text-[#5A1429] font-bold text-xs sm:text-sm transition-all duration-200 transform hover:-translate-y-0.5 focus-visible:ring-2 focus-visible:ring-burgundy focus:outline-none min-h-[46px]">
                        <span>{{ __('Browse available shifts') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
