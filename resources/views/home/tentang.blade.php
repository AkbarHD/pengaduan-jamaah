@extends('layouts.app')

@section('title', 'Tentang Program — Layanan Jamaah Haji & Umroh')
@section('description', 'Mengenal lebih dekat tujuan dan cara kerja layanan informasi dan pengaduan bagi jamaah haji dan
    umroh.')

@section('content')

    {{-- ============ HERO SPLIT ============ --}}
    <section class="about-hero-v2">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 order-2 order-lg-1">
                    <span class="section-eyebrow">
                        <i class="bi bi-info-circle"></i>
                        Tentang Program
                    </span>
                    <h1 class="section-title">Jembatan Informasi dan Pengaduan untuk Jamaah</h1>
                    <p class="text-muted-custom fs-5">
                        Layanan ini dibuat untuk membantu jamaah mendapatkan informasi dan
                        menyampaikan permasalahan selama perjalanan ibadah.
                    </p>
                    <div class="d-flex gap-3 mt-4">
                        <x-button href="{{ route('pengaduan') }}" variant="primary" icon="bi-megaphone">
                            Buat Pengaduan
                        </x-button>
                        <x-button href="{{ route('panduan') }}" variant="outline-primary" icon="bi-book">
                            Lihat Panduan
                        </x-button>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="hero-image-frame">
                        <div class="hero-image-wrapper">
                            <img src="{{ asset('img/logo/hero-section.jpeg') }}" alt="Jamaah Haji dan Umroh">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ TENTANG LAYANAN — DUA KOLOM ============ --}}
    <section class="section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <x-section-heading eyebrow="Latar Belakang" title="Kenapa Layanan Ini Dibuat?" />
                    <p class="text-muted-custom fs-5" style="line-height: 1.8;">
                        Website ini dibuat sebagai sarana informasi dan pengaduan bagi
                        jamaah haji dan umroh yang mengalami kendala selama perjalanan.
                        Layanan ini membantu jamaah menyampaikan permasalahan dan
                        mendapatkan arahan kepada pihak yang sesuai.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="about-highlight-card">
                        <ul class="about-highlight-list">
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Tanpa perlu membuat akun untuk menyampaikan pengaduan.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Panduan dan informasi pencegahan tersedia sebelum keberangkatan.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Status pengaduan dapat dipantau kapan saja secara mandiri.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Pengaduan darurat diprioritaskan dan diteruskan ke KJRI.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ TUJUAN PROGRAM ============ --}}
    <section class="section section-sm"
        style="background-color: var(--color-surface); border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border);">
        <div class="container">
            <x-section-heading align="center" eyebrow="Fokus Kami" title="Tujuan Program" />
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="goal-card">
                        <span class="goal-number">01</span>
                        <h4>Memudahkan</h4>
                        <p>Memudahkan jamaah menyampaikan permasalahan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="goal-card">
                        <span class="goal-number">02</span>
                        <h4>Mengarahkan</h4>
                        <p>Membantu jamaah mengetahui langkah yang dapat dilakukan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="goal-card">
                        <span class="goal-number">03</span>
                        <h4>Menghubungkan</h4>
                        <p>Menjembatani jamaah dengan pihak yang sesuai.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ BAGAIMANA LAYANAN BEKERJA — TIMELINE ============ --}}
    <section class="section">
        <div class="container">
            <x-section-heading align="center" eyebrow="Alur Layanan" title="Bagaimana Layanan Ini Bekerja?" />
            <div class="row g-4 steps-row">
                <div class="col-md-4">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <h4>Sampaikan Pengaduan</h4>
                        <p>Jamaah menyampaikan pengaduan melalui formulir yang tersedia.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <h4>Verifikasi</h4>
                        <p>Pengaduan diterima dan diverifikasi oleh tim.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <h4>Arahan &amp; Tindak Lanjut</h4>
                        <p>Jamaah mendapatkan arahan atau diteruskan kepada pihak terkait.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ CATATAN PENTING ============ --}}
    <section class="section-sm">
        <div class="container">
            <div class="container-narrow">
                <div class="note-box-v2">
                    <div class="note-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
                    <div>
                        <h4 class="mb-1" style="font-size: 1rem;">Catatan Penting</h4>
                        <p class="mb-0" style="color: #7F1D1D; font-size: 0.92rem;">
                            Layanan ini bukan pengganti lembaga resmi atau layanan darurat.
                            Untuk kondisi darurat, jamaah akan diarahkan untuk menghubungi
                            pihak yang berwenang.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ CTA ============ --}}
    <section class="section-sm pt-0">
        <div class="container">
            <div class="site-cta d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4">
                <div>
                    <h2>Sedang Mengalami Kendala?</h2>
                    <p>Sampaikan permasalahan Anda dan dapatkan arahan yang tepat.</p>
                </div>
                <x-button href="{{ route('pengaduan') }}" variant="primary" size="lg" icon="bi-megaphone">
                    Buat Pengaduan
                </x-button>
            </div>
        </div>
    </section>

@endsection
