@php
    $initialToasts = [];

    if (session()->has('success')) {
        $initialToasts[] = [
            'id' => uniqid('t_'),
            'type' => 'success',
            'title' => __('Succes'),
            'message' => session('success'),
            'duration' => 5000,
        ];
    }

    if (session()->has('status')) {
        $statusKey = session('status');
        $statusMsg = match ($statusKey) {
            'profile-updated' => __('Profil opdateret!'),
            'password-updated' => __('Adgangskode opdateret!'),
            'verification-link-sent' => __('Bekræftelseslink sendt!'),
            default => __($statusKey),
        };
        $initialToasts[] = [
            'id' => uniqid('t_'),
            'type' => 'success',
            'title' => __('Gennemført'),
            'message' => $statusMsg,
            'duration' => 5000,
        ];
    }

    if (session()->has('warning')) {
        $initialToasts[] = [
            'id' => uniqid('t_'),
            'type' => 'warning',
            'title' => __('Advarsel'),
            'message' => session('warning'),
            'duration' => 6000,
        ];
    }

    if (session()->has('info')) {
        $initialToasts[] = [
            'id' => uniqid('t_'),
            'type' => 'info',
            'title' => __('Information'),
            'message' => session('info'),
            'duration' => 5000,
        ];
    }

    if (session()->has('error')) {
        $initialToasts[] = [
            'id' => uniqid('t_'),
            'type' => 'error',
            'title' => __('Fejl'),
            'message' => session('error'),
            'duration' => 7000,
        ];
    }
@endphp

<div
    x-data="{
        toasts: {!! json_encode($initialToasts, JSON_UNESCAPED_UNICODE) !!},
        addToast(toast) {
            const id = 't_' + Math.random().toString(36).substring(2, 9);
            const newToast = {
                id: id,
                type: toast.type || 'success',
                title: toast.title || (toast.type === 'error' ? '{{ __('Fejl') }}' : (toast.type === 'warning' ? '{{ __('Advarsel') }}' : '{{ __('Succes') }}')),
                message: toast.message || '',
                duration: toast.duration || 5000,
                progress: 100,
                interval: null,
                isPaused: false
            };
            this.toasts.push(newToast);
            this.$nextTick(() => {
                this.startTimer(newToast);
            });
        },
        removeToast(id) {
            const index = this.toasts.findIndex(t => t.id === id);
            if (index !== -1) {
                if (this.toasts[index].interval) {
                    clearInterval(this.toasts[index].interval);
                }
                this.toasts.splice(index, 1);
            }
        },
        startTimer(toast) {
            const step = 50;
            const decrement = (step / toast.duration) * 100;
            toast.progress = 100;
            toast.interval = setInterval(() => {
                if (!toast.isPaused) {
                    toast.progress -= decrement;
                    if (toast.progress <= 0) {
                        this.removeToast(toast.id);
                    }
                }
            }, step);
        },
        init() {
            this.toasts.forEach(toast => {
                toast.progress = 100;
                toast.isPaused = false;
                this.startTimer(toast);
            });

            window.addEventListener('notify', (e) => {
                if (e.detail) {
                    this.addToast(e.detail);
                }
            });
        }
    }"
    class="fixed top-5 right-5 z-50 flex flex-col gap-3 max-w-sm sm:max-w-md w-full pointer-events-none px-4 sm:px-0"
    role="region"
    aria-label="{{ __('Meddelelser') }}"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="true"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-3 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
            @mouseenter="toast.isPaused = true"
            @mouseleave="toast.isPaused = false"
            class="pointer-events-auto relative overflow-hidden rounded-2xl bg-white/95 dark:bg-[#131F33]/95 backdrop-blur-md shadow-xl border border-brand-border/80 dark:border-[#1E2F4A] p-4 flex gap-3 items-start transition-all"
            :class="{
                'border-l-4 border-l-emerald-500': toast.type === 'success',
                'border-l-4 border-l-amber-500': toast.type === 'warning',
                'border-l-4 border-l-rose-500': toast.type === 'error',
                'border-l-4 border-l-blue-500': toast.type === 'info',
            }"
        >
            <!-- Toast Icon -->
            <div class="shrink-0 pt-0.5">
                <!-- Success Icon -->
                <template x-if="toast.type === 'success'">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </span>
                </template>

                <!-- Warning Icon -->
                <template x-if="toast.type === 'warning'">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-amber-100 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </span>
                </template>

                <!-- Error Icon -->
                <template x-if="toast.type === 'error'">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-rose-100 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                    </span>
                </template>

                <!-- Info Icon -->
                <template x-if="toast.type === 'info'">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-blue-100 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                    </span>
                </template>
            </div>

            <!-- Toast Content -->
            <div class="flex-1 min-w-0 pr-2">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-slate-100" x-text="toast.title"></h4>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-300 leading-relaxed break-words" x-text="toast.message"></p>
            </div>

            <!-- Dismiss Button -->
            <button
                type="button"
                @click="removeToast(toast.id)"
                aria-label="{{ __('Luk meddelelse') }}"
                class="shrink-0 p-1 rounded-lg text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10 transition-colors"
            >
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Countdown Progress Bar -->
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-slate-100 dark:bg-slate-800/80">
                <div
                    class="h-full transition-all ease-linear"
                    :style="`width: ${toast.progress}%`"
                    :class="{
                        'bg-emerald-500': toast.type === 'success',
                        'bg-amber-500': toast.type === 'warning',
                        'bg-rose-500': toast.type === 'error',
                        'bg-blue-500': toast.type === 'info',
                    }"
                ></div>
            </div>
        </div>
    </template>
</div>
