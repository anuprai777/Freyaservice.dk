<x-public-layout>
    <x-slot name="title">{{ __('Sådan virker det') }}</x-slot>

    <!-- Hero Header (Cream Background #FAF5F2) -->
    <section class="bg-[#FAF5F2] text-ink py-16 sm:py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden border-b border-[#EADBCC]" style="background-image:radial-gradient(rgba(90,20,41,0.035) 1.5px,transparent 0);background-size:24px 24px;">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-4xl sm:text-5xl font-black tracking-tight mb-4 text-[#5A1429]">{{ __('Fra behov til bemanding på 4 enkle trin') }}</h1>
            <p class="text-base sm:text-lg text-ink/80 max-w-2xl mx-auto leading-relaxed">{{ __('Simpel, digital og gennemsigtig proces — fra du opretter en forespørgsel til vikaren møder op.') }}</p>
        </div>
    </section>

    <section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @php
            $isEn = app()->getLocale() === 'en';
        @endphp

        <!-- HOW IT WORKS / 4 Steps Staggered Zigzag Workflow (Matching Uploaded Reference UI) -->
        <div class="mb-24 py-12 sm:py-16 lg:py-20 px-4 sm:px-8 lg:px-12 bg-[#FAF7F2] rounded-3xl border border-[#EBE4D8] shadow-xs relative overflow-hidden">
            <!-- Subtle Radial Texture Background -->
            <div class="absolute inset-0 opacity-[0.035] pointer-events-none" style="background-image: radial-gradient(#D97746 1.5px, transparent 1.5px); background-size: 28px 28px;"></div>

            <!-- Header -->
            <div class="text-center max-w-xl mx-auto mb-14 sm:mb-20 relative z-10">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-navy uppercase tracking-tight font-sans">
                    {{ __('HOW IT WORKS') }}
                </h2>
                <p class="font-serif italic text-lg sm:text-xl md:text-2xl text-burgundy font-normal mt-1.5 tracking-wide">
                    ( {{ __('trin for trin') }} )
                </p>
            </div>

            <!-- Staggered Workflow Container -->
            <div class="relative max-w-5xl mx-auto px-2 sm:px-4">
                <!-- STEP 1 (Left Side) -->
                <div class="relative flex justify-start z-10">
                    <div class="w-full md:w-[49%] lg:w-[47%] bg-white rounded-3xl p-6 sm:p-8 pt-9 sm:pt-10 pl-8 sm:pl-10 shadow-[0_8px_30px_rgba(0,0,0,0.03)] border border-stone-200/70 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 relative group">
                        <!-- Concentric Ripple Badge (Top Left) -->
                        <div class="absolute -top-6 -left-4 sm:-top-7 sm:-left-6 z-20 flex items-center justify-center pointer-events-none" aria-hidden="true">
                            <div class="absolute w-28 h-28 sm:w-32 sm:h-32 rounded-full border border-[#D97746]/20 bg-[#D97746]/[0.02]"></div>
                            <div class="absolute w-20 h-20 sm:w-24 sm:h-24 rounded-full border border-[#D97746]/30 bg-[#D97746]/[0.04]"></div>
                            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-white shadow-md border border-[#D97746]/35 flex items-center justify-center relative z-10 group-hover:scale-105 transition-transform pointer-events-auto">
                                <!-- Hand Pressing Button Icon -->
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-[#D97746]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10 11V5.5a1.5 1.5 0 0 1 3 0V11" />
                                    <path d="M13 8.5a1.5 1.5 0 0 1 3 0V11" />
                                    <path d="M16 10a1.5 1.5 0 0 1 3 0v3.5a5.5 5.5 0 0 1-5.5 5.5h-2a5.5 5.5 0 0 1-4.8-2.8L8 13.5a1.5 1.5 0 0 1 2.6-1.5L10 13" />
                                    <path d="M8.5 2.5a4 4 0 0 1 6 0" />
                                </svg>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <h3 class="text-base sm:text-lg lg:text-xl font-extrabold text-navy mb-2 tracking-tight group-hover:text-[#D97746] transition-colors">
                            {{ $isEn ? 'Press a button' : 'Tryk på en knap' }}
                        </h3>
                        <p class="text-xs sm:text-sm text-ink/75 leading-relaxed">
                            {{ $isEn
                                ? 'Choose which shifts or staff you need. If you have recurring staffing needs in the schedule, you can set up automatic processes.'
                                : 'Vælg hvilke vagter og vikarer du vil have dækket. Har du faste ugentlige bemandingsbehov, kan du nemt opsætte automatiske processer.' }}
                        </p>
                    </div>
                </div>

                <!-- Connector Step 1 -> Step 2 (Desktop SVG) -->
                <div class="hidden md:block relative h-16 sm:h-20 -my-3 z-0 pointer-events-none" aria-hidden="true">
                    <svg class="w-full h-full overflow-visible" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <path d="M 47 15 H 73 Q 76 15 76 22 V 90" fill="none" stroke="#D97746" stroke-width="2.2" stroke-dasharray="4 4" stroke-linecap="round" />
                    </svg>
                </div>
                <!-- Connector for mobile -->
                <div class="md:hidden flex justify-center py-4" aria-hidden="true">
                    <div class="w-px h-8 border-l-2 border-dashed border-[#D97746]"></div>
                </div>

                <!-- STEP 2 (Right Side) -->
                <div class="relative flex justify-end z-10">
                    <div class="w-full md:w-[49%] lg:w-[47%] bg-white rounded-3xl p-6 sm:p-8 pt-9 sm:pt-10 pr-8 sm:pr-10 shadow-[0_8px_30px_rgba(0,0,0,0.03)] border border-stone-200/70 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 relative group">
                        <!-- Concentric Ripple Badge (Top Right) -->
                        <div class="absolute -top-6 -right-4 sm:-top-7 sm:-right-6 z-20 flex items-center justify-center pointer-events-none" aria-hidden="true">
                            <div class="absolute w-28 h-28 sm:w-32 sm:h-32 rounded-full border border-[#D97746]/20 bg-[#D97746]/[0.02]"></div>
                            <div class="absolute w-20 h-20 sm:w-24 sm:h-24 rounded-full border border-[#D97746]/30 bg-[#D97746]/[0.04]"></div>
                            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-white shadow-md border border-[#D97746]/35 flex items-center justify-center relative z-10 group-hover:scale-105 transition-transform pointer-events-auto">
                                <!-- Discussion / Consultation Icon -->
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-[#D97746]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="6" cy="8" r="2.5" />
                                    <path d="M2.5 18a3.5 3.5 0 0 1 7 0" />
                                    <circle cx="18" cy="8" r="2.5" />
                                    <path d="M14.5 18a3.5 3.5 0 0 1 7 0" />
                                    <path d="M9.5 14h5v4h-5z" />
                                    <path d="M8 4h.01M16 4h.01" />
                                </svg>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <h3 class="text-base sm:text-lg lg:text-xl font-extrabold text-navy mb-2 tracking-tight group-hover:text-[#D97746] transition-colors">
                            {{ $isEn ? 'We start discussing with the client' : 'Vi afstemmer og finder rette vikar' }}
                        </h3>
                        <p class="text-xs sm:text-sm text-ink/75 leading-relaxed">
                            {{ $isEn
                                ? 'You should be confident that Freya Service always solves the case in the best possible way. Using phone, email and SMS, we start a meaningful dialogue to confirm every detail.'
                                : 'Du kan være helt tryg ved, at Freya Service altid løser opgaven bedst muligt. Via telefon, e-mail og SMS starter vi en god dialog for at afklare alle detaljer.' }}
                        </p>
                    </div>
                </div>

                <!-- Connector Step 2 -> Step 3 (Desktop SVG) -->
                <div class="hidden md:block relative h-16 sm:h-20 -my-3 z-0 pointer-events-none" aria-hidden="true">
                    <svg class="w-full h-full overflow-visible" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <path d="M 53 15 H 27 Q 24 15 24 22 V 90" fill="none" stroke="#D97746" stroke-width="2.2" stroke-dasharray="4 4" stroke-linecap="round" />
                    </svg>
                </div>
                <!-- Connector for mobile -->
                <div class="md:hidden flex justify-center py-4" aria-hidden="true">
                    <div class="w-px h-8 border-l-2 border-dashed border-[#D97746]"></div>
                </div>

                <!-- STEP 3 (Left Side) -->
                <div class="relative flex justify-start z-10">
                    <div class="w-full md:w-[49%] lg:w-[47%] bg-white rounded-3xl p-6 sm:p-8 pt-9 sm:pt-10 pl-8 sm:pl-10 shadow-[0_8px_30px_rgba(0,0,0,0.03)] border border-stone-200/70 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 relative group">
                        <!-- Concentric Ripple Badge (Top Left) -->
                        <div class="absolute -top-6 -left-4 sm:-top-7 sm:-left-6 z-20 flex items-center justify-center pointer-events-none" aria-hidden="true">
                            <div class="absolute w-28 h-28 sm:w-32 sm:h-32 rounded-full border border-[#D97746]/20 bg-[#D97746]/[0.02]"></div>
                            <div class="absolute w-20 h-20 sm:w-24 sm:h-24 rounded-full border border-[#D97746]/30 bg-[#D97746]/[0.04]"></div>
                            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-white shadow-md border border-[#D97746]/35 flex items-center justify-center relative z-10 group-hover:scale-105 transition-transform pointer-events-auto">
                                <!-- Insight / Lightbulb Dashboard Icon -->
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-[#D97746]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 18h6" />
                                    <path d="M10 21h4" />
                                    <path d="M12 2a6 6 0 0 0-4.24 10.24c.76.76 1.24 1.78 1.24 2.88V16h6v-.88c0-1.1.48-2.12 1.24-2.88A6 6 0 0 0 12 2z" />
                                    <path d="M12 7v3l2 2" />
                                </svg>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <h3 class="text-base sm:text-lg lg:text-xl font-extrabold text-navy mb-2 tracking-tight group-hover:text-[#D97746] transition-colors">
                            {{ $isEn ? 'Full insight and control along the way' : 'Fuld indsigt og kontrol undervejs' }}
                        </h3>
                        <p class="text-xs sm:text-sm text-ink/75 leading-relaxed">
                            {{ $isEn
                                ? 'You have a full overview and control and follow all contact points, live QR check-ins and approved hours in a common Dashboard.'
                                : 'Du har fuldt overblik og kontrol og følger alle kontaktpunkter, live QR-tjek ind og godkendte timer i et fælles, overskueligt Dashboard.' }}
                        </p>
                    </div>
                </div>

                <!-- Connector Step 3 -> Step 4 (Desktop SVG) -->
                <div class="hidden md:block relative h-16 sm:h-20 -my-3 z-0 pointer-events-none" aria-hidden="true">
                    <svg class="w-full h-full overflow-visible" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <path d="M 47 15 H 73 Q 76 15 76 22 V 90" fill="none" stroke="#D97746" stroke-width="2.2" stroke-dasharray="4 4" stroke-linecap="round" />
                    </svg>
                </div>
                <!-- Connector for mobile -->
                <div class="md:hidden flex justify-center py-4" aria-hidden="true">
                    <div class="w-px h-8 border-l-2 border-dashed border-[#D97746]"></div>
                </div>

                <!-- STEP 4 (Right Side) -->
                <div class="relative flex justify-end z-10">
                    <div class="w-full md:w-[49%] lg:w-[47%] bg-white rounded-3xl p-6 sm:p-8 pt-9 sm:pt-10 pr-8 sm:pr-10 shadow-[0_8px_30px_rgba(0,0,0,0.03)] border border-stone-200/70 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 relative group">
                        <!-- Concentric Ripple Badge (Top Right) -->
                        <div class="absolute -top-6 -right-4 sm:-top-7 sm:-right-6 z-20 flex items-center justify-center pointer-events-none" aria-hidden="true">
                            <div class="absolute w-28 h-28 sm:w-32 sm:h-32 rounded-full border border-[#D97746]/20 bg-[#D97746]/[0.02]"></div>
                            <div class="absolute w-20 h-20 sm:w-24 sm:h-24 rounded-full border border-[#D97746]/30 bg-[#D97746]/[0.04]"></div>
                            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-white shadow-md border border-[#D97746]/35 flex items-center justify-center relative z-10 group-hover:scale-105 transition-transform pointer-events-auto">
                                <!-- Banknotes / Payout Icon -->
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-[#D97746]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="6" width="18" height="11" rx="2" />
                                    <circle cx="11" cy="11.5" r="2.5" />
                                    <path d="M5 10h.01M17 13h.01" />
                                    <path d="M6 6V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2" />
                                </svg>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <h3 class="text-base sm:text-lg lg:text-xl font-extrabold text-navy mb-2 tracking-tight group-hover:text-[#D97746] transition-colors">
                            {{ $isEn ? 'Money is in your account' : 'Pengene er på din konto' }}
                        </h3>
                        <p class="text-xs sm:text-sm text-ink/75 leading-relaxed">
                            {{ $isEn
                                ? 'As soon as money is in the account, smart integrations will ensure that vouchers, collective agreements and itemized invoices are entered automatically or sent for approval.'
                                : 'Så snart timerne er godkendt, sørger smarte integrationer for, at overenskomstmæssig løn, feriepenge og fakturaer bogføres automatisk og sendes til godkendelse.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- For Companies vs Workers -->
        <div class="grid md:grid-cols-2 gap-8 mb-16">
            <x-card variant="navy" padding="lg" hover="true">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-navy-800 border border-navy-700 flex items-center justify-center">
                        <x-heroicon-o-building-office class="w-5 h-5 text-teal" />
                    </div>
                    <h2 class="text-lg font-bold text-white">{{ __('Virksomhed (Kunde)') }}</h2>
                </div>
                <ul class="space-y-3 text-sm text-sand-200">
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Opret en forespørgsel via portalen på under 2 min') }}</span></li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Modtag bekræftelse med vikarens navn og profil') }}</span></li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Generer QR-kode til virksomheden én gang') }}</span></li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Godkend timer med ét klik — ingen papirarbejde') }}</span></li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Modtag faktura automatisk med specifikation') }}</span></li>
                </ul>
                <a href="{{ route('register', ['role' => 'client']) }}" class="btn-primary border-2 border-white/35 mt-6 inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-burgundy hover:bg-burgundy-dark text-white text-sm font-bold transition">
                    {{ __('Bestil Vikar') }} <x-heroicon-o-arrow-right class="w-4 h-4" />
                </a>
            </x-card>

            <x-card variant="white" padding="lg" hover="true">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-mist flex items-center justify-center">
                        <x-heroicon-o-user class="w-5 h-5 text-teal" />
                    </div>
                    <h2 class="text-lg font-bold text-navy">{{ __('Vikar (Arbejdstager)') }}</h2>
                </div>
                <ul class="space-y-3 text-sm text-ink/80">
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Opret din profil og vælg kompetencer') }}</span></li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Angiv dine ledige dage i rådighedskalenderen') }}</span></li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Modtag vagt-tilbud og accepter med ét klik') }}</span></li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Scan QR-kode ved ankomst og afgang') }}</span></li>
                    <li class="flex items-start gap-2"><x-heroicon-s-check-circle class="w-4 h-4 text-teal mt-0.5 shrink-0" /><span>{{ __('Se din indtjening og download lønsedler') }}</span></li>
                </ul>
                <a href="{{ route('register', ['role' => 'worker']) }}" class="btn-secondary border-2 border-teal bg-transparent hover:bg-teal/10 mt-6 inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-navy text-sm font-bold transition">
                    {{ __('Tilmeld dig som vikar') }} <x-heroicon-o-arrow-right class="w-4 h-4 text-teal" />
                </a>
            </x-card>
        </div>

        <div class="text-center">
            <a href="{{ route('contact') }}" class="btn-primary inline-flex items-center gap-2 px-8 py-4 rounded-lg bg-burgundy hover:bg-burgundy-dark text-white font-bold text-base shadow-lg transition transform hover:-translate-y-0.5">
                <x-heroicon-o-phone class="w-5 h-5 text-white" /><span>{{ __('Ring +45 28 26 09 26') }}</span>
            </a>
        </div>
    </section>
</x-public-layout>
