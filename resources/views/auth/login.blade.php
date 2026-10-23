<x-guest-layout>
    <x-slot name="title">{{ __('Log ind') }}</x-slot>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div x-data="{
        email: '{{ old('email', 'freyaservicevikar@gmail.com') }}',
        password: '',
        fill(role) {
            this.email = 'freyaservicevikar@gmail.com';
            if (role === 'admin') this.password = 'admin123';
            if (role === 'client') this.password = 'client123';
            if (role === 'worker') this.password = 'worker123';
        }
    }">
        <!-- Header -->
        <div class="mb-5 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-bg border border-brand-border text-xs font-semibold text-brand-secondary mb-3">
                <span class="w-2 h-2 rounded-full bg-brand-action"></span>
                <span>{{ __('FreyaService Portal') }}</span>
            </div>
            <h2 class="text-2xl font-black text-brand-primary tracking-tight">{{ __('Log ind på din profil') }}</h2>
            <p class="text-xs text-brand-muted mt-1">{{ __('Få adgang til din virksomheds- eller vikarportal') }}</p>
        </div>

        <!-- Demo Credentials Quick-Select Pill Box -->
        <div class="mb-5 p-3.5 bg-brand-bg border border-brand-border rounded-2xl text-xs space-y-2">
            <div class="flex items-center justify-between">
                <span class="font-bold text-brand-secondary flex items-center gap-1.5">
                    <x-heroicon-s-key class="w-4 h-4 text-brand-action" />
                    <span>{{ __('Testlogin (Fælles email)') }}</span>
                </span>
                <span class="text-[10px] text-brand-muted font-medium">{{ __('Klik for at udfylde') }}</span>
            </div>
            <div class="text-[11px] text-brand-body font-mono bg-brand-surface px-2.5 py-1 rounded-lg border border-brand-border truncate">
                freyaservicevikar@gmail.com
            </div>
            <div class="grid grid-cols-3 gap-1.5 pt-1">
                <button type="button" @click="fill('admin')" class="px-2 py-1.5 rounded-xl border border-brand-border bg-brand-surface hover:bg-navy-50 text-brand-secondary font-semibold text-[11px] transition text-center shadow-xs cursor-pointer">
                    👑 {{ __('Admin') }}
                    <span class="block text-[9px] text-brand-muted font-mono font-normal">admin123</span>
                </button>
                <button type="button" @click="fill('client')" class="px-2 py-1.5 rounded-xl border border-action-300 bg-action-50/70 hover:bg-action-100 text-brand-action font-semibold text-[11px] transition text-center shadow-xs cursor-pointer">
                    🏢 {{ __('Kunde') }}
                    <span class="block text-[9px] text-brand-action/80 font-mono font-normal">client123</span>
                </button>
                <button type="button" @click="fill('worker')" class="px-2 py-1.5 rounded-xl border border-forest-200 bg-forest-50/70 hover:bg-forest-100 text-forest font-semibold text-[11px] transition text-center shadow-xs cursor-pointer">
                    👷 {{ __('Vikar') }}
                    <span class="block text-[9px] text-forest/80 font-mono font-normal">worker123</span>
                </button>
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" x-model="email" required autofocus autocomplete="username" placeholder="navn@virksomhed.dk" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                x-model="password"
                                required autocomplete="current-password"
                                placeholder="••••••••" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between pt-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="rounded border-brand-border text-brand-action shadow-xs focus:ring-brand-action" name="remember">
                    <span class="ms-2 text-xs font-medium text-brand-muted">{{ __('Husk mig') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-brand-muted hover:text-brand-secondary transition underline focus:outline-none focus:ring-2 focus:ring-brand-action" href="{{ route('password.request') }}">
                        {{ __('Glemt adgangskode?') }}
                    </a>
                @endif
            </div>

            <div class="pt-2">
                <x-primary-button class="w-full py-3 text-sm">
                    {{ __('Log ind') }} &rarr;
                </x-primary-button>
            </div>

            <div class="pt-4 text-center border-t border-brand-border">
                <p class="text-xs text-brand-muted">
                    {{ __('Har du ikke en konto endnu?') }}
                    <a href="{{ route('register') }}" class="font-bold text-brand-action hover:text-brand-action-hover transition ms-1 underline">
                        {{ __('Opret profil her') }} &rarr;
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
