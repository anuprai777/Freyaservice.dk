<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#C9A24B]"></span>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ __('Handlingslog (Audit Trail)') }}</h1>
                </div>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Uforanderlig GDPR-log over systemhandlinger, godkendelser og dataændringer.') }}</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>{{ __('Tilbage til Dashboard') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Search Bar -->
        <x-card padding="sm" class="flex flex-col md:flex-row gap-4 justify-between items-stretch md:items-center">
            <form method="GET" action="{{ route('admin.audit.index') }}" class="flex flex-wrap gap-2.5 items-center flex-1">
                <div class="relative w-full sm:w-80">
                    <x-heroicon-o-magnifying-glass class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none" />
                    <input type="text" name="search" value="{{ $search }}" placeholder="{{ __('Søg handling, bruger, IP-adresse...') }}" class="text-xs rounded-xl border-slate-300 pl-9 w-full focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                </div>
                <button type="submit" class="inline-flex items-center gap-1.5 bg-[#7B1E3A] hover:bg-[#5A1429] text-white font-bold text-xs px-4 py-2 rounded-xl transition shadow-xs">
                    <x-heroicon-o-magnifying-glass class="w-3.5 h-3.5" />
                    <span>{{ __('Søg') }}</span>
                </button>
                @if($search)
                    <a href="{{ route('admin.audit.index') }}" class="text-xs text-slate-500 hover:text-slate-800 py-2">
                        {{ __('Nulstil') }}
                    </a>
                @endif
            </form>
            <div class="text-xs text-slate-500 font-medium flex items-center gap-1.5">
                <x-heroicon-o-shield-check class="w-4 h-4 text-emerald-600" />
                <span>{{ __('Viser') }} {{ $auditLogs->total() }} {{ __('hændelser i loggen') }}</span>
            </div>
        </x-card>

        <!-- Logs Table -->
        <x-card padding="none">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-500 font-bold uppercase border-b border-slate-200 text-[11px]">
                        <tr>
                            <th class="px-6 py-4">{{ __('Tidspunkt') }}</th>
                            <th class="px-6 py-4">{{ __('Bruger') }}</th>
                            <th class="px-6 py-4">{{ __('Handling') }}</th>
                            <th class="px-6 py-4">{{ __('Entitet') }}</th>
                            <th class="px-6 py-4">{{ __('IP & Klient') }}</th>
                            <th class="px-6 py-4">{{ __('Detaljer') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($auditLogs as $log)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-slate-500 font-mono text-[11px]">
                                    {{ $log->created_at->setTimezone('Europe/Copenhagen')->format('d/m/Y H:i:s') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($log->user)
                                        <div class="font-bold text-slate-900 flex items-center gap-1.5">
                                            <div class="w-5 h-5 rounded-full bg-[#FAF5F2] border border-[#7B1E3A]/20 text-[#7B1E3A] font-bold flex items-center justify-center text-[9px] shrink-0">
                                                {{ strtoupper(substr($log->user->name, 0, 1)) }}
                                            </div>
                                            <span>{{ $log->user->name }}</span>
                                        </div>
                                        <div class="text-[11px] text-slate-500 pl-6.5">{{ $log->user->email }} ({{ ucfirst($log->user->role) }})</div>
                                    @else
                                        <span class="text-slate-400 italic">{{ __('System / Gæst') }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold 
                                        @if(str_contains($log->action, 'delete') || str_contains($log->action, 'reject')) bg-rose-50 text-rose-700 border border-rose-200
                                        @elseif(str_contains($log->action, 'create') || str_contains($log->action, 'approve')) bg-emerald-50 text-emerald-700 border border-emerald-200
                                        @elseif(str_contains($log->action, 'update') || str_contains($log->action, 'clock')) bg-sky-50 text-sky-700 border border-sky-200
                                        @else bg-slate-100 text-slate-700 border border-slate-200
                                        @endif">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-mono text-[11px] text-slate-600">
                                    @if($log->entity_type)
                                        <div>{{ class_basename($log->entity_type) }}</div>
                                        <div class="text-slate-400">{{ __('ID:') }} #{{ $log->entity_id }}</div>
                                    @else
                                        <span class="text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-mono text-[11px] text-slate-500">
                                    <div>{{ $log->ip_address ?? '127.0.0.1' }}</div>
                                    <div class="truncate max-w-xs text-slate-400 text-[10px]" title="{{ $log->user_agent }}">
                                        {{ $log->user_agent ? Str::limit($log->user_agent, 30) : '' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    @if($log->payload)
                                        <details class="cursor-pointer">
                                            <summary class="text-xs font-bold text-[#7B1E3A] hover:underline">{{ __('Vis payload') }}</summary>
                                            <pre class="mt-2 text-[10px] bg-slate-900 text-slate-200 p-3 rounded-lg overflow-x-auto max-w-xs sm:max-w-md font-mono">{{ json_encode($log->payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) }}</pre>
                                        </details>
                                    @else
                                        <span class="text-slate-400 text-xs">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-400 text-sm">
                                    {{ __('Ingen hændelser fundet i audit-loggen.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($auditLogs->hasPages())
                <div class="p-4 border-t border-slate-200">
                    {{ $auditLogs->links() }}
                </div>
            @endif
        </x-card>

    </div>
</x-app-layout>