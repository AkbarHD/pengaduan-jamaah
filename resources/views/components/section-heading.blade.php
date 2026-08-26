@props([
    'eyebrow' => null,
    'title',
    'subtitle' => null,
    'align' => 'left',   // left | center
    'icon' => null,
])

@php
    $alignClass = $align === 'center' ? 'text-center' : 'text-start';
@endphp

<div class="section-heading {{ $alignClass }} mb-4 mb-lg-5">
    @if ($eyebrow)
        <span class="section-eyebrow">
            @if ($icon)<i class="bi {{ $icon }}"></i>@endif
            {{ $eyebrow }}
        </span>
    @endif

    <h2 class="section-title">{{ $title }}</h2>

    @if ($subtitle)
        <p class="section-subtitle">{{ $subtitle }}</p>
    @endif
</div>