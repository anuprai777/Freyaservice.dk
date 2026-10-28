@props([
    'label' => '',
    'value' => '',
    'sublabel' => null,
    'trend' => null,
    'trendDirection' => 'up', // up, down, neutral
    'icon' => null,
    'accent' => 'burgundy', // burgundy, navy, teal, gold, green, amber
    'variant' => 'sand', // sand, white, surface
    'href' => null,
    'badge' => null,
])

@php
    $tag = $href ? 'a' : 'div';

    $valueColor = match($accent) {
        'navy', 'primary' => 'text-navy',
        'teal' => 'text-teal',
        'gold' => 'text-[#C9A24B]',
        'green' => 'text-emerald-700',
        'amber' => 'text-amber-700',
        'action' => 'text-burgundy',
        default => 'text-burgundy',
    };

    $iconBg = match($accent) {
        'navy', 'primary' => 'bg-navy/10 text-navy',
        'teal' => 'bg-teal/10 text-teal',
        'gold' => 'bg-amber-100/70 text-amber-800',
        'green' => 'bg-emerald-100 text-emerald-800',
        'amber' => 'bg-amber-100 text-amber-800',
        'action' => 'bg-burgundy/10 text-burgundy',
        default => 'bg-burgundy/10 text-burgundy',
    };

    $bgClasses = match($variant) {
        'white' => 'bg-white border-mist shadow-xs',
        'surface' => 'bg-brand-surface border-brand-border shadow-xs',
        default => 'bg-sand border-mist shadow-xs',
    };

    $hoverClasses = $href
        ? 'hover:-translate-y-0.5 hover:shadow-md hover:border-burgundy/40 transition-all duration-200 cursor-pointer group'
        : 'transition-all duration-150';
@endphp

<{{ $tag }}
    @if($href) href="{{ $href }}" @endif
    {{ $attributes->merge(['class' => "p-5 rounded-2xl border $bgClasses $hoverClasses flex flex-col justify-between relative overflow-hidden min-w-0"]) }}
>
    <div class="flex items-start justify-between gap-3 mb-2">
        <span class="text-[11px] font-bold text-ink/60 uppercase tracking-wider block truncate">{{ $label }}</span>
        @if($icon)
            <div class="w-8 h-8 rounded-lg {{ $iconBg }} flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                @if(is_string($icon) && !str_contains($icon, '<'))
                    <x-dynamic-component :component="'heroicon-o-' . $icon" class="w-4 h-4" />
                @else
                    {!! $icon !!}
                @endif
            </div>
        @elseif($badge)
            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-white border border-mist text-ink/70 shrink-0">
                {{ $badge }}
            </span>
        @endif
    </div>

    <div>
        <div class="text-2xl sm:text-3xl font-black {{ $valueColor }} tracking-tight tabular-nums">{{ $value }}</div>
        @if($sublabel || $trend)
            <div class="flex items-center gap-1.5 mt-1 text-[11px] text-ink/60">
                @if($trend)
                    <span class="font-bold {{ $trendDirection === 'up' ? 'text-emerald-700' : ($trendDirection === 'down' ? 'text-rose-600' : 'text-ink/70') }}">
                        {{ $trendDirection === 'up' ? '↑' : ($trendDirection === 'down' ? '↓' : '•') }} {{ $trend }}
                    </span>
                @endif
                @if($sublabel)
                    <span class="truncate">{{ $sublabel }}</span>
                @endif
            </div>
        @endif
    </div>
</{{ $tag }}>

