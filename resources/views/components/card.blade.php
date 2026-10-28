@props([
    'as' => 'div',
    'href' => null,
    'variant' => 'default', // default (white), sand, surface, navy, outline, highlight
    'padding' => 'normal', // none, sm, normal, lg
    'hover' => false,
    'title' => null,
    'description' => null,
    'eyebrow' => null,
    'icon' => null,
    'badge' => null,
    'badgeColor' => 'burgundy', // burgundy, navy, teal, gold, green, amber, slate
    'accent' => null, // burgundy, navy, teal, gold
])

@php
    $tag = $href ? 'a' : $as;

    // SaaS Kit surface variants (Linear / Vercel / Stripe inspired)
    $variantClasses = match($variant) {
        'sand' => 'bg-sand border border-mist text-ink',
        'surface' => 'bg-brand-surface border border-brand-border text-ink',
        'navy' => 'bg-navy border border-navy-800 text-white',
        'outline' => 'bg-transparent border border-mist text-ink',
        'highlight' => 'bg-white border border-mist text-ink border-t-4 border-t-burgundy',
        default => 'bg-white border border-mist shadow-xs text-ink',
    };

    // Accent top border
    $accentClasses = match($accent) {
        'burgundy' => 'border-t-4 border-t-burgundy',
        'navy' => 'border-t-4 border-t-navy',
        'teal' => 'border-t-4 border-t-teal',
        'gold' => 'border-t-4 border-t-[#C9A24B]',
        default => '',
    };

    // Smooth elevation & hover lift (Linear-style micro-interaction)
    $hoverClasses = ($hover || $href)
        ? 'transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md hover:border-burgundy/40 group cursor-pointer'
        : 'transition-all duration-150';

    // Body padding
    $paddingClasses = match($padding) {
        'none' => '',
        'sm' => 'p-4 sm:p-5',
        'lg' => 'p-6 sm:p-8',
        default => 'p-5 sm:p-6',
    };

    // Badge styling
    $badgeClasses = match($badgeColor) {
        'navy' => 'bg-navy/10 text-navy border border-navy/20',
        'teal' => 'bg-teal/10 text-teal border border-teal/20',
        'gold' => 'bg-amber-50 text-amber-800 border border-amber-200',
        'green' => 'bg-emerald-50 text-emerald-800 border border-emerald-200',
        'amber' => 'bg-amber-50 text-amber-800 border border-amber-200',
        'slate' => 'bg-slate-100 text-slate-700 border border-slate-200',
        default => 'bg-burgundy/10 text-burgundy border border-burgundy/20',
    };

    $hasHeader = isset($header) || $title || $eyebrow || $icon;
@endphp

<{{ $tag }}
    @if($href) href="{{ $href }}" @endif
    {{ $attributes->merge(['class' => "rounded-2xl relative overflow-hidden $variantClasses $accentClasses $hoverClasses"]) }}
>
    @if($hasHeader)
        <div class="px-5 sm:px-6 pt-5 sm:pt-6 pb-4 border-b border-mist/70 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            @if(isset($header))
                {{ $header }}
            @else
                <div class="flex items-start gap-3 flex-1 min-w-0">
                    @if(isset($iconSlot))
                        <div class="shrink-0 mt-0.5">{{ $iconSlot }}</div>
                    @elseif($icon)
                        <div class="w-10 h-10 rounded-xl bg-burgundy/10 text-burgundy flex items-center justify-center shrink-0">
                            <x-dynamic-component :component="'heroicon-o-' . $icon" class="w-5 h-5 text-burgundy" />
                        </div>
                    @endif
                    <div class="min-w-0 flex-1">
                        @if($eyebrow)
                            <span class="text-[10px] font-bold uppercase tracking-wider text-burgundy block mb-0.5">{{ $eyebrow }}</span>
                        @endif
                        @if($title)
                            <h3 class="text-base sm:text-lg font-bold text-navy truncate tracking-tight">{{ $title }}</h3>
                        @endif
                        @if($description)
                            <p class="text-xs text-ink/70 mt-0.5 leading-relaxed">{{ $description }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    @if($badge)
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $badgeClasses }}">
                            {{ $badge }}
                        </span>
                    @endif
                    @if(isset($action))
                        {{ $action }}
                    @endif
                </div>
            @endif
        </div>
    @endif

    <div class="{{ $paddingClasses }}">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="px-5 sm:px-6 py-3.5 sm:py-4 bg-sand-50/50 border-t border-mist/70 text-xs text-ink/70 flex items-center justify-between">
            {{ $footer }}
        </div>
    @endif
</{{ $tag }}>

