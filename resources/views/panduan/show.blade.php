@extends('layouts.app')

@section('title', $artikel->judul . ' — Layanan Jamaah Haji & Umroh')
@section('description', $artikel->deskripsi)

@section('content')

<section class="article-detail-hero">
    <div class="container">
        <div class="container-narrow">
            <nav class="mb-3">
                <a href="{{ route('panduan') }}" class="text-decoration-none fs-sm fw-semibold" style="color: var(--color-muted);">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Panduan &amp; Pencegahan
                </a>
            </nav>

            <span class="article-badge badge-{{ $artikel->kategori }}">{{ ucfirst($artikel->kategori) }}</span>
            <h1 class="section-title mt-2">{{ $artikel->judul }}</h1>

            <div class="d-flex align-items-center gap-3 text-muted-custom fs-sm mb-4">
                <span><i class="bi bi-clock me-1"></i>{{ $artikel->waktu_baca ?? '5 menit baca' }}</span>
                <span><i class="bi bi-calendar3 me-1"></i>{{ $artikel->updated_at->translatedFormat('d F Y') }}</span>
            </div>
        </div>
    </div>
</section>

<section class="section-sm pt-0">
    <div class="container">
        <div class="container-narrow">

            @if ($artikel->thumbnail)
                <div class="article-detail-thumb">
                    <img src="{{ asset('uploads/artikel-thumbnail/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}">
                </div>
            @endif

            <div class="article-detail-body">
                {!! $artikel->konten !!}
            </div>

            {{-- ============ SHARE & DOWNLOAD ============ --}}
            <div class="share-box">
                <span class="share-label">Bagikan:</span>

                <a href="https://wa.me/?text={{ urlencode($artikel->judul . ' - ' . url()->current()) }}"
                   target="_blank" rel="noopener" class="share-btn" aria-label="Bagikan ke WhatsApp">
                    <i class="bi bi-whatsapp"></i>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                   target="_blank" rel="noopener" class="share-btn" aria-label="Bagikan ke Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($artikel->judul) }}"
                   target="_blank" rel="noopener" class="share-btn" aria-label="Bagikan ke X">
                    <i class="bi bi-twitter-x"></i>
                </a>
                <button type="button" class="share-btn" id="btnCopyLink" aria-label="Salin tautan">
                    <i class="bi bi-link-45deg"></i>
                </button>

                <div class="ms-auto">
                    <x-button href="{{ route('panduan.download', $artikel->slug) }}" variant="outline" icon="bi-file-earmark-pdf">
                        Download PDF
                    </x-button>
                </div>
            </div>

        </div>
    </div>
</section>

@if ($artikelTerkait->isNotEmpty())
<section class="section-sm pt-0">
    <div class="container">
        <div class="container-narrow">
            <x-section-heading title="Artikel Terkait" />
            <div class="row g-4 related-article-list">
                @foreach ($artikelTerkait as $terkait)
                    <div class="col-md-4">
                        <a href="{{ route('panduan.detail', $terkait->slug) }}" class="text-decoration-none">
                            <div class="article-card">
                                <div class="article-thumb">
                                    @if ($terkait->thumbnail)
                                        <img src="{{ asset('uploads/artikel-thumbnail/' . $terkait->thumbnail) }}" alt="{{ $terkait->judul }}" class="article-thumb-img">
                                    @else
                                        <i class="bi bi-file-earmark-text"></i>
                                    @endif
                                </div>
                                <div class="article-body">
                                    <h4>{{ $terkait->judul }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

@push('scripts')
<script>
    document.getElementById('btnCopyLink').addEventListener('click', function () {
        navigator.clipboard.writeText(window.location.href).then(() => {
            this.classList.add('copy-active');
            this.innerHTML = '<i class="bi bi-check-lg"></i>';
            setTimeout(() => {
                this.classList.remove('copy-active');
                this.innerHTML = '<i class="bi bi-link-45deg"></i>';
            }, 2000);
        });
    });
</script>
@endpush
@endsection