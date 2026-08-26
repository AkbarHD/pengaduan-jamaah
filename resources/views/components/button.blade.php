@props([
    'variant' => 'primary',   // primary | outline | ghost | danger
    'size'    => 'md',        // sm | md | lg
    'href'    => null,
    'icon'    => null,        // contoh: 'bi-arrow-right'
    'iconPosition' => 'end',  // start | end
    'type'    => 'button',
])

@php
    $variantClass = match ($variant) {
    'outline'         => 'site-btn-outline',
    'outline-primary' => 'site-btn-outline-primary',
    'ghost'           => 'site-btn-ghost',
    'danger'          => 'site-btn-danger',
    default           => 'site-btn-primary',
};

    $sizeClass = match ($size) {
        'sm' => 'site-btn-sm',
        'lg' => 'site-btn-lg',
        default => '',
    };

    $classes = trim("site-btn {$variantClass} {$sizeClass}");
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon && $iconPosition === 'start')
            <i class="bi {{ $icon }}"></i>
        @endif
        {{ $slot }}
        @if ($icon && $iconPosition === 'end')
            <i class="bi {{ $icon }}"></i>
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon && $iconPosition === 'start')
            <i class="bi {{ $icon }}"></i>
        @endif
        {{ $slot }}
        @if ($icon && $iconPosition === 'end')
            <i class="bi {{ $icon }}"></i>
        @endif
    </button>
@endif
