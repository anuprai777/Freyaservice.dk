<x-guest-layout>
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
        <!-- Demo Credentials Quick-Select Pill Box -->
        <div class="mb-5 p-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs space-y-2">
            <div class="flex items-center justify-between">
                <span class="font-bold text-slate-800 flex items-center gap-1.5">
                    <span>🔑</span>
                    <span>Testlogin (Fælles email)</span>
                </span>
                <span class="text-[10px] text-slate-400 font-medium">Klik for at udfylde</span>
            </div>
            <div class="text-[11px] text-slate-600 font-mono bg-white px-2.5 py-1 rounded-lg border border-slate-200/80 truncate">
                freyaservicevikar@gmail.com
            </div>
            <div class="grid grid-cols-3 gap-1.5 pt-1">
                <button type="button" @click="fill('admin')" class="px-2 py-1.5 rounded-xl border border-indigo-200 bg-white hover:bg-indigo-50 text-indigo-700 font-semibold text-[11px] transition text-center shadow-sm">
                    👑 Admin
                    <span class="block text-[9px] text-indigo-500 font-mono font-normal">admin123</span>
                </button>
                <button type="button" @click="fill('client')" class="px-2 py-1.5 rounded-xl border border-slate-300 bg-white hover:bg-slate-100 text-slate-700 font-semibold text-[11px] transition text-center shadow-sm">
                    🏢 Kunde
                    <span class="block text-[9px] text-slate-500 font-mono font-normal">client123</span>
                </button>
                <button type="button" @click="fill('worker')" class="px-2 py-1.5 rounded-xl border border-emerald-200 bg-white hover:bg-emerald-50 text-emerald-700 font-semibold text-[11px] transition text-center shadow-sm">
                    👷 Vikar
                    <span class="block text-[9px] text-emerald-600 font-mono font-normal">worker123</span>
                </button>
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" x-model="email" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                x-model="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between pt-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="rounded border-brand-border text-brand-secondary shadow-sm focus:ring-brand-secondary" name="remember">
                    <span class="ms-2 text-xs font-medium text-brand-muted">{{ __('Husk mig') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-brand-muted hover:text-brand-secondary transition underline focus:outline-none focus:ring-2 focus:ring-brand-secondary" href="{{ route('password.request') }}">
                        {{ __('Glemt adgangskode?') }}
                    </a>
                @endif
            </div>

            <div class="pt-2">
                <x-primary-button class="w-full">
                    {{ __('Log ind') }}
                </x-primary-button>
            </div>

            <div class="pt-4 text-center border-t border-brand-border">
                <p class="text-xs text-brand-muted">
                    {{ __('Har du ikke en konto endnu?') }}
                    <a href="{{ route('register') }}" class="font-bold text-brand-secondary hover:text-brand-action transition ms-1">
                        {{ __('Opret profil her') }} &rarr;
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
