<nav x-data="{ open: false }" class="bg-navy text-white border-b border-navy-800 sticky top-0 z-40 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 sm:h-18 items-center gap-4">
            <div class="flex items-center gap-3 md:gap-4 shrink-0">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center group focus:outline-none focus-visible:ring-2 focus-visible:ring-burgundy rounded-lg" aria-label="Freya Service">
                    <img src="{{ asset('images/logo-white.png') }}" alt="Freya Service" class="h-8 sm:h-9 w-auto object-contain group-hover:scale-105 transition-transform">
                </a>

                <!-- Portal Context Badge -->
                <div class="hidden sm:block h-5 w-px bg-white/15"></div>
                <span class="hidden sm:inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold tracking-wide shadow-xs
                    @if(Auth::user()->isAdmin()) bg-white/10 text-sand-100 border border-white/15
                    @elseif(Auth::user()->isClient()) bg-[#C9A24B]/15 text-[#C9A24B] border border-[#C9A24B]/30
                    @else bg-emerald-500/15 text-emerald-300 border border-emerald-500/30 @endif">
                    <span class="w-1.5 h-1.5 rounded-full
                        @if(Auth::user()->isAdmin()) bg-sand-200
                        @elseif(Auth::user()->isClient()) bg-[#C9A24B]
                        @else bg-emerald-400 animate-pulse @endif"></span>
                    <span>
                        @if(Auth::user()->isAdmin()) {{ __('Admin Portal') }}
                        @elseif(Auth::user()->isClient()) {{ __('Virksomhedsportal') }}
                        @else {{ __('Vikarportal') }} @endif
                    </span>
                </span>
            </div>

            <!-- Navigation Links by Role (Desktop) -->
            <div class="hidden lg:flex items-center space-x-1 xl:space-x-2 -my-px">
                @if(Auth::user()->isAdmin())
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        <x-heroicon-o-squares-2x2 class="w-4 h-4 mr-1.5 text-sand-300" />
                        <span>{{ __('Oversigt') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('admin.requests.index')" :active="request()->routeIs('admin.requests.*') || request()->routeIs('admin.matching.*')">
                        <x-heroicon-o-clipboard-document-list class="w-4 h-4 mr-1.5 text-sand-300" />
                        <span>{{ __('Forespørgsler') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('admin.workers.index')" :active="request()->routeIs('admin.workers.*')">
                        <x-heroicon-o-users class="w-4 h-4 mr-1.5 text-sand-300" />
                        <span>{{ __('Vikarer (CRM)') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('admin.clients.index')" :active="request()->routeIs('admin.clients.*')">
                        <x-heroicon-o-building-office-2 class="w-4 h-4 mr-1.5 text-sand-300" />
                        <span>{{ __('Virksomheder') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('admin.timesheets.index')" :active="request()->routeIs('admin.timesheets.*')">
                        <x-heroicon-o-clock class="w-4 h-4 mr-1.5 text-sand-300" />
                        <span>{{ __('Timesedler') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('admin.invoices.index')" :active="request()->routeIs('admin.invoices.*')">
                        <x-heroicon-o-document-currency-dollar class="w-4 h-4 mr-1.5 text-sand-300" />
                        <span>{{ __('Fakturaer') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('admin.audit.index')" :active="request()->routeIs('admin.audit.*')">
                        <x-heroicon-o-shield-check class="w-4 h-4 mr-1.5 text-sand-300" />
                        <span>{{ __('Audit Log') }}</span>
                    </x-nav-link>
                @elseif(Auth::user()->isClient())
                    <x-nav-link :href="route('client.dashboard')" :active="request()->routeIs('client.dashboard')">
                        <x-heroicon-o-squares-2x2 class="w-4 h-4 mr-1.5 text-sand-300" />
                        <span>{{ __('Dashboard') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('client.invoices.index')" :active="request()->routeIs('client.invoices.*')">
                        <x-heroicon-o-document-text class="w-4 h-4 mr-1.5 text-sand-300" />
                        <span>{{ __('Fakturaer') }}</span>
                    </x-nav-link>
                @elseif(Auth::user()->isWorker())
                    <x-nav-link :href="route('worker.dashboard')" :active="request()->routeIs('worker.dashboard')">
                        <x-heroicon-o-squares-2x2 class="w-4 h-4 mr-1.5 text-sand-300" />
                        <span>{{ __('Dashboard') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('worker.offers.index')" :active="request()->routeIs('worker.offers.*')">
                        <x-heroicon-o-briefcase class="w-4 h-4 mr-1.5 text-sand-300" />
                        <span>{{ __('Ledige Vagter') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('worker.availability.index')" :active="request()->routeIs('worker.availability.*')">
                        <x-heroicon-o-calendar-days class="w-4 h-4 mr-1.5 text-sand-300" />
                        <span>{{ __('Rådighedskalender') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('worker.earnings.index')" :active="request()->routeIs('worker.earnings.*')">
                        <x-heroicon-o-banknotes class="w-4 h-4 mr-1.5 text-sand-300" />
                        <span>{{ __('Indtjening') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('worker.documents.index')" :active="request()->routeIs('worker.documents.*')">
                        <x-heroicon-o-folder-open class="w-4 h-4 mr-1.5 text-sand-300" />
                        <span>{{ __('Dokumenter') }}</span>
                    </x-nav-link>
                @endif
            </div>

            <!-- Right Controls: Useful Role Actions & User Profile Dropdown -->
            <div class="hidden sm:flex sm:items-center gap-3">
                <!-- Useful Quick Action Button by Role -->
                @if(Auth::user()->isClient())
                    <a href="{{ route('client.requests.create') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-bold bg-[#C9A24B] hover:bg-[#B08A37] text-navy shadow-sm transition hover:shadow-md transform active:scale-95 focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
                        <x-heroicon-s-plus class="w-4 h-4" />
                        <span>{{ __('Bestil Vikar') }}</span>
                    </a>
                @elseif(Auth::user()->isWorker())
                    <a href="{{ route('worker.shifts.scan') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-white/10 hover:bg-white/20 text-white border border-white/20 shadow-xs transition hover:border-[#C9A24B] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#C9A24B]">
                        <x-heroicon-o-qr-code class="w-4 h-4 text-[#C9A24B]" />
                        <span>{{ __('QR Tjek-ind') }}</span>
                    </a>
                @elseif(Auth::user()->isAdmin())
                    <a href="{{ route('admin.requests.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-white/10 hover:bg-white/15 text-sand-200 border border-white/15 shadow-xs transition">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>{{ __('Bemandingscenter') }}</span>
                    </a>
                @endif

                <!-- User Dropdown Menu -->
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-2.5 py-1.5 border border-navy-700 hover:border-navy-600 text-sm font-semibold rounded-xl text-white bg-navy-800/90 hover:bg-navy-700/90 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#C9A24B] transition ease-in-out duration-150 cursor-pointer shadow-xs">
                            <!-- Initials Avatar -->
                            <div class="w-7 h-7 rounded-lg bg-burgundy flex items-center justify-center font-bold text-xs text-white border border-white/20 shadow-xs">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="hidden md:flex flex-col text-left">
                                <span class="text-xs font-bold leading-tight truncate max-w-[120px]">{{ Auth::user()->name }}</span>
                                <span class="text-[10px] text-sand-300 font-normal leading-tight">
                                    @if(Auth::user()->isAdmin()) {{ __('Admin') }}
                                    @elseif(Auth::user()->isClient()) {{ __('Virksomhed') }}
                                    @else {{ __('Vikar') }} @endif
                                </span>
                            </div>
                            <x-heroicon-o-chevron-down class="h-3.5 w-3.5 text-sand-400" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- User Card inside Dropdown -->
                        <div class="px-4 py-3 border-b border-mist bg-brand-surface/40">
                            <div class="font-bold text-sm text-ink truncate">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-brand-muted truncate">{{ Auth::user()->email }}</div>
                            <div class="mt-2 flex items-center justify-between text-[11px] text-brand-muted pt-1 border-t border-mist/50">
                                <span class="font-medium">{{ __('Aktivt sprog') }}:</span>
                                <span class="font-semibold text-navy">{{ app()->getLocale() === 'da' ? '🇩🇰 Dansk' : '🇬🇧 English' }}</span>
                            </div>
                        </div>

                        @if(Auth::user()->isWorker())
                            <x-dropdown-link :href="route('worker.profile')">
                                <div class="flex items-center gap-2">
                                    <x-heroicon-o-user-circle class="w-4 h-4 text-ink/60" />
                                    <span>{{ __('Vikarprofil & Bank') }}</span>
                                </div>
                            </x-dropdown-link>
                        @endif

                        <x-dropdown-link :href="route('profile.edit')">
                            <div class="flex items-center gap-2">
                                <x-heroicon-o-cog-6-tooth class="w-4 h-4 text-ink/60" />
                                <span>{{ __('Brugerindstillinger') }}</span>
                            </div>
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('gdpr.export')">
                            <div class="flex items-center gap-2 text-navy">
                                <x-heroicon-o-arrow-down-tray class="w-4 h-4 text-teal" />
                                <span>{{ __('Eksportér GDPR-data') }}</span>
                            </div>
                        </x-dropdown-link>

                        <div class="border-t border-mist"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();" class="text-burgundy-dark hover:text-burgundy">
                                <div class="flex items-center gap-2">
                                    <x-heroicon-o-arrow-left-on-rectangle class="w-4 h-4 text-burgundy-dark" />
                                    <span>{{ __('Log ud') }}</span>
                                </div>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Controls & Hamburger (No language switcher) -->
            <div class="-me-2 flex items-center gap-2 lg:hidden">
                <!-- Mobile Quick Action Button -->
                @if(Auth::user()->isClient())
                    <a href="{{ route('client.requests.create') }}" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-bold bg-[#C9A24B] text-navy shadow-xs" aria-label="{{ __('Bestil Vikar') }}">
                        <x-heroicon-s-plus class="w-3.5 h-3.5" />
                        <span class="text-[11px]">{{ __('Bestil') }}</span>
                    </a>
                @elseif(Auth::user()->isWorker())
                    <a href="{{ route('worker.shifts.scan') }}" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-semibold bg-white/10 text-white border border-white/20" aria-label="{{ __('QR Tjek-ind') }}">
                        <x-heroicon-o-qr-code class="w-3.5 h-3.5 text-[#C9A24B]" />
                        <span class="text-[11px]">{{ __('QR') }}</span>
                    </a>
                @endif

                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-sand-300 hover:text-white hover:bg-navy-800 focus:outline-none transition" aria-label="Menu">
                    <x-heroicon-o-bars-3 class="h-6 w-6" ::class="{'hidden': open, 'inline-flex': ! open }" />
                    <x-heroicon-o-x-mark class="h-6 w-6" ::class="{'hidden': ! open, 'inline-flex': open }" />
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile Drawer) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden bg-navy border-t border-navy-800 shadow-xl">
        <!-- User Information Card in Mobile Menu (Clean, no switcher) -->
        <div class="px-4 py-3 border-b border-navy-800 bg-navy-900/80 flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-burgundy flex items-center justify-center font-bold text-sm text-white border border-white/20 shadow-xs shrink-0">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <div class="font-bold text-sm text-white truncate">{{ Auth::user()->name }}</div>
                <div class="font-medium text-xs text-sand-400 truncate">{{ Auth::user()->email }}</div>
            </div>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider shrink-0
                @if(Auth::user()->isAdmin()) bg-white/10 text-sand-100 border border-white/20
                @elseif(Auth::user()->isClient()) bg-[#C9A24B]/20 text-[#C9A24B] border border-[#C9A24B]/40
                @else bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 @endif">
                @if(Auth::user()->isAdmin()) {{ __('Admin') }}
                @elseif(Auth::user()->isClient()) {{ __('Virksomhed') }}
                @else {{ __('Vikar') }} @endif
            </span>
        </div>

        <!-- Navigation Links -->
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->isAdmin())
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-squares-2x2 class="w-4 h-4 text-sand-300" />
                        <span>{{ __('Oversigt') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.requests.index')" :active="request()->routeIs('admin.requests.*') || request()->routeIs('admin.matching.*')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-clipboard-document-list class="w-4 h-4 text-sand-300" />
                        <span>{{ __('Forespørgsler') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.workers.index')" :active="request()->routeIs('admin.workers.*')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-users class="w-4 h-4 text-sand-300" />
                        <span>{{ __('Vikarer (CRM)') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.clients.index')" :active="request()->routeIs('admin.clients.*')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-building-office-2 class="w-4 h-4 text-sand-300" />
                        <span>{{ __('Virksomheder') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.timesheets.index')" :active="request()->routeIs('admin.timesheets.*')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-clock class="w-4 h-4 text-sand-300" />
                        <span>{{ __('Timesedler') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.invoices.index')" :active="request()->routeIs('admin.invoices.*')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-document-currency-dollar class="w-4 h-4 text-sand-300" />
                        <span>{{ __('Fakturaer') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.audit.index')" :active="request()->routeIs('admin.audit.*')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-shield-check class="w-4 h-4 text-sand-300" />
                        <span>{{ __('Audit Log') }}</span>
                    </span>
                </x-responsive-nav-link>
            @elseif(Auth::user()->isClient())
                <x-responsive-nav-link :href="route('client.dashboard')" :active="request()->routeIs('client.dashboard')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-squares-2x2 class="w-4 h-4 text-sand-300" />
                        <span>{{ __('Dashboard') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('client.requests.create')" :active="request()->routeIs('client.requests.create')">
                    <span class="flex items-center gap-2 text-[#C9A24B] font-bold">
                        <x-heroicon-s-plus-circle class="w-4 h-4 text-[#C9A24B]" />
                        <span>{{ __('+ Bestil Vikar') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('client.invoices.index')" :active="request()->routeIs('client.invoices.*')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-document-text class="w-4 h-4 text-sand-300" />
                        <span>{{ __('Fakturaer') }}</span>
                    </span>
                </x-responsive-nav-link>
            @elseif(Auth::user()->isWorker())
                <x-responsive-nav-link :href="route('worker.dashboard')" :active="request()->routeIs('worker.dashboard')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-squares-2x2 class="w-4 h-4 text-sand-300" />
                        <span>{{ __('Dashboard') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('worker.offers.index')" :active="request()->routeIs('worker.offers.*')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-briefcase class="w-4 h-4 text-sand-300" />
                        <span>{{ __('Ledige Vagter') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('worker.shifts.scan')" :active="request()->routeIs('worker.shifts.*')">
                    <span class="flex items-center gap-2 text-[#C9A24B] font-bold">
                        <x-heroicon-o-qr-code class="w-4 h-4 text-[#C9A24B]" />
                        <span>{{ __('QR Tjek-ind') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('worker.availability.index')" :active="request()->routeIs('worker.availability.*')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-calendar-days class="w-4 h-4 text-sand-300" />
                        <span>{{ __('Rådighedskalender') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('worker.earnings.index')" :active="request()->routeIs('worker.earnings.*')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-banknotes class="w-4 h-4 text-sand-300" />
                        <span>{{ __('Indtjening') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('worker.documents.index')" :active="request()->routeIs('worker.documents.*')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-folder-open class="w-4 h-4 text-sand-300" />
                        <span>{{ __('Dokumenter') }}</span>
                    </span>
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-3 border-t border-navy-800 px-4">
            <div class="space-y-1">
                @if(Auth::user()->isWorker())
                    <x-responsive-nav-link :href="route('worker.profile')">
                        <span class="flex items-center gap-2">
                            <x-heroicon-o-user-circle class="w-4 h-4 text-sand-300" />
                            <span>{{ __('Vikarprofil & Bank') }}</span>
                        </span>
                    </x-responsive-nav-link>
                @endif
                <x-responsive-nav-link :href="route('profile.edit')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-cog-6-tooth class="w-4 h-4 text-sand-300" />
                        <span>{{ __('Brugerindstillinger') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('gdpr.export')">
                    <span class="flex items-center gap-2 text-teal">
                        <x-heroicon-o-arrow-down-tray class="w-4 h-4 text-teal" />
                        <span>{{ __('Eksportér GDPR-data') }}</span>
                    </span>
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        <span class="flex items-center gap-2 text-sand-200 hover:text-white">
                            <x-heroicon-o-arrow-left-on-rectangle class="w-4 h-4 text-burgundy" />
                            <span>{{ __('Log ud') }}</span>
                        </span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
