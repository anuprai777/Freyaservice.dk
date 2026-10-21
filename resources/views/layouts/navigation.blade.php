<nav x-data="{ open: false }" class="bg-brand-surface border-b border-brand-border sticky top-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center group">
                        <img src="{{ asset('images/logo.png') }}" alt="Freya Service" class="h-9 w-auto object-contain group-hover:scale-105 transition-transform">
                    </a>
                </div>

                <!-- Navigation Links by Role -->
                <div class="hidden space-x-4 sm:-my-px sm:ms-8 lg:flex items-center">
                    @if(Auth::user()->isAdmin())
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            <x-heroicon-o-squares-2x2 class="w-4 h-4 mr-1.5" />
                            <span>{{ __('Oversigt') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('admin.requests.index')" :active="request()->routeIs('admin.requests.*') || request()->routeIs('admin.matching.*')">
                            <x-heroicon-o-clipboard-document-list class="w-4 h-4 mr-1.5" />
                            <span>{{ __('Forespørgsler') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('admin.workers.index')" :active="request()->routeIs('admin.workers.*')">
                            <x-heroicon-o-users class="w-4 h-4 mr-1.5" />
                            <span>{{ __('Vikarer (CRM)') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('admin.clients.index')" :active="request()->routeIs('admin.clients.*')">
                            <x-heroicon-o-building-office-2 class="w-4 h-4 mr-1.5" />
                            <span>{{ __('Virksomheder') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('admin.timesheets.index')" :active="request()->routeIs('admin.timesheets.*')">
                            <x-heroicon-o-clock class="w-4 h-4 mr-1.5" />
                            <span>{{ __('Timesedler') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('admin.invoices.index')" :active="request()->routeIs('admin.invoices.*')">
                            <x-heroicon-o-document-currency-dollar class="w-4 h-4 mr-1.5" />
                            <span>{{ __('Fakturaer') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('admin.audit.index')" :active="request()->routeIs('admin.audit.*')">
                            <x-heroicon-o-shield-check class="w-4 h-4 mr-1.5" />
                            <span>{{ __('Audit Log') }}</span>
                        </x-nav-link>
                    @elseif(Auth::user()->isClient())
                        <x-nav-link :href="route('client.dashboard')" :active="request()->routeIs('client.dashboard')">
                            <x-heroicon-o-squares-2x2 class="w-4 h-4 mr-1.5" />
                            <span>{{ __('Dashboard') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('client.requests.create')" :active="request()->routeIs('client.requests.create')" class="text-brand-action font-bold">
                            <x-heroicon-o-plus-circle class="w-4 h-4 mr-1.5 text-brand-action" />
                            <span>{{ __('Bestil Vikar') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('client.invoices.index')" :active="request()->routeIs('client.invoices.*')">
                            <x-heroicon-o-document-text class="w-4 h-4 mr-1.5" />
                            <span>{{ __('Fakturaer') }}</span>
                        </x-nav-link>
                    @elseif(Auth::user()->isWorker())
                        <x-nav-link :href="route('worker.dashboard')" :active="request()->routeIs('worker.dashboard')">
                            <x-heroicon-o-squares-2x2 class="w-4 h-4 mr-1.5" />
                            <span>{{ __('Dashboard') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('worker.offers.index')" :active="request()->routeIs('worker.offers.*')">
                            <x-heroicon-o-briefcase class="w-4 h-4 mr-1.5" />
                            <span>{{ __('Ledige Vagter') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('worker.shifts.scan')" :active="request()->routeIs('worker.shifts.*')" class="text-brand-action font-bold">
                            <x-heroicon-o-qr-code class="w-4 h-4 mr-1.5 text-brand-action" />
                            <span>{{ __('QR Tjek-ind') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('worker.availability.index')" :active="request()->routeIs('worker.availability.*')">
                            <x-heroicon-o-calendar-days class="w-4 h-4 mr-1.5" />
                            <span>{{ __('Rådighedskalender') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('worker.earnings.index')" :active="request()->routeIs('worker.earnings.*')">
                            <x-heroicon-o-banknotes class="w-4 h-4 mr-1.5" />
                            <span>{{ __('Indtjening') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('worker.documents.index')" :active="request()->routeIs('worker.documents.*')">
                            <x-heroicon-o-folder-open class="w-4 h-4 mr-1.5" />
                            <span>{{ __('Dokumenter') }}</span>
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings, Language Switcher & Role Badge -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">

                <!-- Language Switcher -->
                <div class="flex items-center gap-1 bg-brand-bg p-1 rounded-xl border border-brand-border text-xs">
                    <a href="{{ route('locale.switch', 'da') }}" title="Dansk" class="px-2.5 py-1 rounded-lg transition flex items-center gap-1 {{ app()->getLocale() === 'da' ? 'bg-brand-surface text-brand-secondary shadow-sm font-bold underline underline-offset-4 decoration-2 decoration-brand-action' : 'text-brand-muted hover:text-brand-secondary font-medium' }}">
                        <span>🇩🇰</span>
                        <span>DA</span>
                    </a>
                    <a href="{{ route('locale.switch', 'en') }}" title="English" class="px-2.5 py-1 rounded-lg transition flex items-center gap-1 {{ app()->getLocale() === 'en' ? 'bg-brand-surface text-brand-secondary shadow-sm font-bold underline underline-offset-4 decoration-2 decoration-brand-action' : 'text-brand-muted hover:text-brand-secondary font-medium' }}">
                        <span>🇬🇧</span>
                        <span>EN</span>
                    </a>
                </div>

                <!-- Role Tag -->
                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider
                    @if(Auth::user()->isAdmin()) bg-navy-900/10 text-navy-900 border border-navy-900/20
                    @elseif(Auth::user()->isClient()) bg-navy-700/10 text-navy-700 border border-navy-700/20
                    @else bg-forest/15 text-forest border border-forest/30 @endif">
                    @if(Auth::user()->isAdmin()) {{ __('Admin') }}
                    @elseif(Auth::user()->isClient()) {{ __('Virksomhed') }}
                    @else {{ __('Vikar') }} @endif
                </span>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-brand-border text-sm leading-4 font-semibold rounded-lg text-brand-body bg-brand-surface hover:bg-brand-bg focus:outline-none transition ease-in-out duration-150 cursor-pointer">
                            <x-heroicon-o-user class="w-4 h-4 mr-2 text-brand-muted" />
                            <div>{{ Auth::user()->name }}</div>
                            <x-heroicon-o-chevron-down class="ms-1.5 h-4 w-4 text-brand-muted" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if(Auth::user()->isWorker())
                            <x-dropdown-link :href="route('worker.profile')">
                                <div class="flex items-center gap-2">
                                    <x-heroicon-o-user-circle class="w-4 h-4 text-brand-muted" />
                                    <span>{{ __('Vikarprofil & Bank') }}</span>
                                </div>
                            </x-dropdown-link>
                        @endif

                        <x-dropdown-link :href="route('profile.edit')">
                            <div class="flex items-center gap-2">
                                <x-heroicon-o-cog-6-tooth class="w-4 h-4 text-brand-muted" />
                                <span>{{ __('Brugerindstillinger') }}</span>
                            </div>
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('gdpr.export')">
                            <div class="flex items-center gap-2 text-brand-secondary">
                                <x-heroicon-o-arrow-down-tray class="w-4 h-4 text-brand-secondary" />
                                <span>{{ __('Eksportér GDPR-data') }}</span>
                            </div>
                        </x-dropdown-link>

                        <div class="border-t border-brand-border"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();" class="text-brand-danger hover:text-brick-600">
                                <div class="flex items-center gap-2">
                                    <x-heroicon-o-arrow-left-on-rectangle class="w-4 h-4 text-brand-danger" />
                                    <span>{{ __('Log ud') }}</span>
                                </div>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-brand-muted hover:text-brand-secondary hover:bg-brand-bg focus:outline-none transition">
                    <x-heroicon-o-bars-3 class="h-6 w-6" ::class="{'hidden': open, 'inline-flex': ! open }" />
                    <x-heroicon-o-x-mark class="h-6 w-6" ::class="{'hidden': ! open, 'inline-flex': open }" />
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden bg-brand-bg border-t border-brand-border">
        <!-- Language Switcher in Mobile Menu -->
        <div class="px-4 py-3 flex items-center justify-between border-b border-brand-border bg-brand-surface">
            <span class="text-xs font-bold text-brand-muted uppercase">{{ __('Sprog') }}</span>
            <div class="flex items-center gap-1 bg-brand-bg p-1 rounded-lg border border-brand-border text-xs">
                <a href="{{ route('locale.switch', 'da') }}" class="px-3 py-1 rounded-md transition flex items-center gap-1 {{ app()->getLocale() === 'da' ? 'bg-brand-surface text-brand-secondary font-bold underline underline-offset-4 decoration-2 decoration-brand-action shadow-sm' : 'text-brand-body font-medium' }}">
                    <span>🇩🇰</span> Dansk
                </a>
                <a href="{{ route('locale.switch', 'en') }}" class="px-3 py-1 rounded-md transition flex items-center gap-1 {{ app()->getLocale() === 'en' ? 'bg-brand-surface text-brand-secondary font-bold underline underline-offset-4 decoration-2 decoration-brand-action shadow-sm' : 'text-brand-body font-medium' }}">
                    <span>🇬🇧</span> English
                </a>
            </div>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->isAdmin())
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-squares-2x2 class="w-4 h-4" />
                        <span>{{ __('Oversigt') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.requests.index')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-clipboard-document-list class="w-4 h-4" />
                        <span>{{ __('Forespørgsler') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.workers.index')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-users class="w-4 h-4" />
                        <span>{{ __('Vikarer (CRM)') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.clients.index')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-building-office-2 class="w-4 h-4" />
                        <span>{{ __('Virksomheder') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.timesheets.index')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-clock class="w-4 h-4" />
                        <span>{{ __('Timesedler') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.invoices.index')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-document-currency-dollar class="w-4 h-4" />
                        <span>{{ __('Fakturaer') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.audit.index')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-shield-check class="w-4 h-4" />
                        <span>{{ __('Audit Log') }}</span>
                    </span>
                </x-responsive-nav-link>
            @elseif(Auth::user()->isClient())
                <x-responsive-nav-link :href="route('client.dashboard')" :active="request()->routeIs('client.dashboard')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-squares-2x2 class="w-4 h-4" />
                        <span>{{ __('Dashboard') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('client.requests.create')">
                    <span class="flex items-center gap-2 text-brand-action font-bold">
                        <x-heroicon-o-plus-circle class="w-4 h-4 text-brand-action" />
                        <span>{{ __('+ Bestil Vikar') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('client.invoices.index')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-document-text class="w-4 h-4" />
                        <span>{{ __('Fakturaer') }}</span>
                    </span>
                </x-responsive-nav-link>
            @elseif(Auth::user()->isWorker())
                <x-responsive-nav-link :href="route('worker.dashboard')" :active="request()->routeIs('worker.dashboard')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-squares-2x2 class="w-4 h-4" />
                        <span>{{ __('Dashboard') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('worker.offers.index')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-briefcase class="w-4 h-4" />
                        <span>{{ __('Ledige Vagter') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('worker.shifts.scan')">
                    <span class="flex items-center gap-2 text-brand-action font-bold">
                        <x-heroicon-o-qr-code class="w-4 h-4 text-brand-action" />
                        <span>{{ __('QR Tjek-ind') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('worker.availability.index')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-calendar-days class="w-4 h-4" />
                        <span>{{ __('Rådighedskalender') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('worker.earnings.index')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-banknotes class="w-4 h-4" />
                        <span>{{ __('Indtjening') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('worker.documents.index')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-folder-open class="w-4 h-4" />
                        <span>{{ __('Dokumenter') }}</span>
                    </span>
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-3 border-t border-brand-border px-4">
            <div class="font-medium text-base text-brand-primary">{{ Auth::user()->name }}</div>
            <div class="font-medium text-xs text-brand-muted">{{ Auth::user()->email }}</div>

            <div class="mt-3 space-y-1">
                @if(Auth::user()->isWorker())
                    <x-responsive-nav-link :href="route('worker.profile')">
                        <span class="flex items-center gap-2">
                            <x-heroicon-o-user-circle class="w-4 h-4 text-brand-muted" />
                            <span>{{ __('Vikarprofil & Bank') }}</span>
                        </span>
                    </x-responsive-nav-link>
                @endif
                <x-responsive-nav-link :href="route('profile.edit')">
                    <span class="flex items-center gap-2">
                        <x-heroicon-o-cog-6-tooth class="w-4 h-4 text-brand-muted" />
                        <span>{{ __('Brugerindstillinger') }}</span>
                    </span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('gdpr.export')">
                    <span class="flex items-center gap-2 text-brand-secondary">
                        <x-heroicon-o-arrow-down-tray class="w-4 h-4 text-brand-secondary" />
                        <span>{{ __('Eksportér GDPR-data') }}</span>
                    </span>
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        <span class="flex items-center gap-2 text-brand-danger">
                            <x-heroicon-o-arrow-left-on-rectangle class="w-4 h-4 text-brand-danger" />
                            <span>{{ __('Log ud') }}</span>
                        </span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
