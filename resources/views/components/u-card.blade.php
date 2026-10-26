@props([
    'variant' => 'maroon', // 'maroon' or 'green'
    'eyebrow' => '',
    'title' => '',
    'body' => '',
    'badge' => '',
    'tagStrong' => '',
    'tagSmall' => '',
    'icon' => null,
])

<article {{ $attributes->merge(['class' => 'u-card u-card--' . $variant]) }}>
    <div class="u-card__top">
        <div class="u-card__text">
            @if($eyebrow)
                <span class="u-card__eyebrow">{{ $eyebrow }}</span>
            @endif
            <h3 class="u-card__title">{{ $title }}</h3>
            <p class="u-card__body">{{ $body }}</p>
        </div>
        <div class="u-card__media">
            @if(isset($iconSlot))
                {{ $iconSlot }}
            @elseif($icon)
                @switch($icon)
                    @case('bolt')
                        <x-heroicon-o-bolt class="u-card__icon" aria-hidden="true" />
                        @break
                    @case('shield-check')
                        <x-heroicon-o-shield-check class="u-card__icon" aria-hidden="true" />
                        @break
                    @case('qr-code')
                        <x-heroicon-o-qr-code class="u-card__icon" aria-hidden="true" />
                        @break
                    @case('document-check')
                        <x-heroicon-o-document-check class="u-card__icon" aria-hidden="true" />
                        @break
                    @case('user-group')
                        <x-heroicon-o-user-group class="u-card__icon" aria-hidden="true" />
                        @break
                    @case('lock-closed')
                        <x-heroicon-o-lock-closed class="u-card__icon" aria-hidden="true" />
                        @break
                    @default
                        <x-dynamic-component :component="'heroicon-o-' . $icon" class="u-card__icon" aria-hidden="true" />
                @endswitch
            @endif

            @if($badge)
                <span class="u-card__badge">{{ $badge }}</span>
            @endif
        </div>
    </div>
    <footer class="u-card__tag">
        <strong>{{ $tagStrong }}</strong>
        @if($tagSmall)
            <small>{{ $tagSmall }}</small>
        @endif
    </footer>
</article>
