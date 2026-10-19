<nav x-data="{ open: false }" class="bg-white border-b border-slate-200 sticky top-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-black text-sm shadow-sm">
                            FS
                        </div>
                        <span class="font-black text-lg tracking-tight text-slate-900 hidden sm:inline">Freya<span class="text-indigo-600">Service</span></span>
                    </a>
                </div>

                <!-- Navigation Links by Role -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-8 md:flex">
                    @if(Auth::user()->isAdmin())
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Oversigt') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.requests.index')" :active="request()->routeIs('admin.requests.*') || request()->routeIs('admin.matching.*')">
                            {{ __('Forespørgsler') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.workers.index')" :active="request()->routeIs('admin.workers.*')">
                            {{ __('Vikarer (CRM)') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.clients.index')" :active="request()->routeIs('admin.clients.*')">
                            {{ __('Virksomheder') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.timesheets.index')" :active="request()->routeIs('admin.timesheets.*')">
                            {{ __('Timesedler') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.invoices.index')" :active="request()->routeIs('admin.invoices.*')">
                            {{ __('Fakturaer') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.audit.index')" :active="request()->routeIs('admin.audit.*')">
                            {{ __('Audit Log') }}
                        </x-nav-link>
                    @elseif(Auth::user()->isClient())
                        <x-nav-link :href="route('client.dashboard')" :active="request()->routeIs('client.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('client.requests.create')" :active="request()->routeIs('client.requests.create')">
                            <span class="text-indigo-600 font-bold">+ {{ __('Bestil Vikar') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('client.invoices.index')" :active="request()->routeIs('client.invoices.*')">
                            {{ __('Fakturaer') }}
                        </x-nav-link>
                    @elseif(Auth::user()->isWorker())
                        <x-nav-link :href="route('worker.dashboard')" :active="request()->routeIs('worker.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('worker.offers.index')" :active="request()->routeIs('worker.offers.*')">
                            {{ __('Ledige Vagter') }}
                        </x-nav-link>
                        <x-nav-link :href="route('worker.shifts.scan')" :active="request()->routeIs('worker.shifts.*')">
                            <span class="text-indigo-600 font-bold">📷 {{ __('QR Tjek-ind') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('worker.availability.index')" :active="request()->routeIs('worker.availability.*')">
                            {{ __('Rådighedskalender') }}
                        </x-nav-link>
                        <x-nav-link :href="route('worker.earnings.index')" :active="request()->routeIs('worker.earnings.*')">
                            {{ __('Indtjening') }}
                        </x-nav-link>
                        <x-nav-link :href="route('worker.documents.index')" :active="request()->routeIs('worker.documents.*')">
                            {{ __('Dokumenter') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings & Role Badge -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                <!-- Role Tag -->
                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider
                    @if(Auth::user()->isAdmin()) bg-purple-100 text-purple-800 border border-purple-200
                    @elseif(Auth::user()->isClient()) bg-blue-100 text-blue-800 border border-blue-200
                    @else bg-emerald-100 text-emerald-800 border border-emerald-200 @endif">
                    @if(Auth::user()->isAdmin()) Admin
                    @elseif(Auth::user()->isClient()) Virksomhed
                    @else Vikar @endif
                </span>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-slate-200 text-sm leading-4 font-semibold rounded-lg text-slate-700 bg-white hover:bg-slate-50 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if(Auth::user()->isWorker())
                            <x-dropdown-link :href="route('worker.profile')">
                                {{ __('Vikarprofil & Bank') }}
                            </x-dropdown-link>
                        @endif

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Brugerindstillinger') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('gdpr.export')">
                            📥 {{ __('Eksportér GDPR-data') }}
                        </x-dropdown-link>

                        <div class="border-t border-slate-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();" class="text-rose-600 hover:text-rose-700">
                                {{ __('Log ud') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-500 hover:text-slate-700 hover:bg-slate-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-50 border-t border-slate-200">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->isAdmin())
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">{{ __('Oversigt') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.requests.index')">{{ __('Forespørgsler') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.workers.index')">{{ __('Vikarer') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.clients.index')">{{ __('Virksomheder') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.timesheets.index')">{{ __('Timesedler') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.invoices.index')">{{ __('Fakturaer') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.audit.index')">{{ __('Audit Log') }}</x-responsive-nav-link>
            @elseif(Auth::user()->isClient())
                <x-responsive-nav-link :href="route('client.dashboard')" :active="request()->routeIs('client.dashboard')">{{ __('Dashboard') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('client.requests.create')">{{ __('+ Bestil Vikar') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('client.invoices.index')">{{ __('Fakturaer') }}</x-responsive-nav-link>
            @elseif(Auth::user()->isWorker())
                <x-responsive-nav-link :href="route('worker.dashboard')" :active="request()->routeIs('worker.dashboard')">{{ __('Dashboard') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('worker.offers.index')">{{ __('Ledige Vagter') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('worker.shifts.scan')">{{ __('📷 QR Tjek-ind') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('worker.availability.index')">{{ __('Rådighedskalender') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('worker.earnings.index')">{{ __('Indtjening') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('worker.documents.index')">{{ __('Dokumenter') }}</x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-slate-200 px-4">
            <div class="font-medium text-base text-slate-800">{{ Auth::user()->name }}</div>
            <div class="font-medium text-xs text-slate-500">{{ Auth::user()->email }}</div>

            <div class="mt-3 space-y-1">
                @if(Auth::user()->isWorker())
                    <x-responsive-nav-link :href="route('worker.profile')">{{ __('Vikarprofil & Bank') }}</x-responsive-nav-link>
                @endif
                <x-responsive-nav-link :href="route('profile.edit')">{{ __('Brugerindstillinger') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('gdpr.export')">{{ __('Eksportér GDPR-data') }}</x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log ud') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
