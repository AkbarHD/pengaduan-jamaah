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
                    <h1 class="section-title">Ruang Berbagi Kisah dan Informasi untuk Jamaah</h1>
                    <p class="text-muted-custom fs-5">
                        Layanan ini dibuat agar jamaah dapat berbagi pengalaman, membaca
                        kisah nyata dari jamaah lain, dan mendapatkan informasi seputar
                        perjalanan ibadah ke Tanah Suci.
                    </p>
                    <div class="d-flex gap-3 mt-4">
                        <x-button href="{{ route('sharing.create') }}" variant="primary" icon="bi-pencil-square">
                            Bagikan Pengalaman
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

    <section class="section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <x-section-heading eyebrow="Latar Belakang" title="Kenapa Layanan Ini Dibuat?" />
                    <p class="text-muted-custom fs-5" style="line-height: 1.8;">
                        Website ini hadir sebagai ruang bagi jamaah haji dan umroh untuk
                        berbagi kisah, pengalaman, serta informasi seputar perjalanan
                        ibadah. Setiap cerita yang masuk akan ditinjau tim kami sebelum
                        dipublikasikan, agar informasi yang tersaji tetap bermanfaat dan
                        dapat dipercaya.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="about-highlight-card">
                        <ul class="about-highlight-list">
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Tanpa perlu membuat akun untuk membagikan pengalaman.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Panduan dan manasik tersedia sebelum keberangkatan.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Setiap cerita ditinjau tim kami sebelum tayang di halaman Berita.</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Kontak darurat KJRI tersedia bagi jamaah yang membutuhkan bantuan segera.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-sm"
        style="background-color: var(--color-surface); border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border);">
        <div class="container">
            <x-section-heading align="center" eyebrow="Fokus Kami" title="Tujuan Program" />
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="goal-card">
                        <span class="goal-number">01</span>
                        <h4>Menginspirasi</h4>
                        <p>Menghadirkan kisah nyata yang dapat menginspirasi jamaah lain.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="goal-card">
                        <span class="goal-number">02</span>
                        <h4>Mengedukasi</h4>
                        <p>Membantu jamaah mempersiapkan perjalanan lewat panduan dan cerita nyata.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="goal-card">
                        <span class="goal-number">03</span>
                        <h4>Menghubungkan</h4>
                        <p>Menjembatani jamaah untuk saling berbagi cerita dan pengalaman.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ BAGAIMANA LAYANAN BEKERJA — TIMELINE ============ --}}
    <section class="section section-sm"
        style="background-color: var(--color-surface); border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border);">
        <div class="container">
            <x-section-heading align="center" eyebrow="Alur Sharing" title="Bagaimana Cara Berbagi Pengalaman?"
                subtitle="Proses sederhana dari menulis cerita hingga tayang untuk dibaca jamaah lain." />

            <div class="row g-4">
                <div class="col-6 col-lg-3">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <h4>Tuliskan Cerita Anda</h4>
                        <p>Ceritakan pengalaman, tips, atau momen berkesan selama di Tanah Suci.</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <h4>Kirim Cerita</h4>
                        <p>Isi formulir sederhana tanpa perlu membuat akun.</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <h4>Ditinjau Tim Kami</h4>
                        <p>Cerita Anda diperiksa terlebih dahulu sebelum dipublikasikan.</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="step-item">
                        <div class="step-number">4</div>
                        <h4>Tayang di Berita</h4>
                        <p>Cerita yang disetujui akan tampil di halaman Berita untuk dibaca jamaah lain.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    {{-- ============ CTA ============ --}}
    <section class="section-sm">
        <div class="container">
            <div class="site-cta d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4">
                <div>
                    <h2>Punya Pengalaman Menarik di Tanah Suci?</h2>
                    <p>Bagikan kisah Anda agar dapat menginspirasi dan membantu jamaah lain.</p>
                </div>
                <x-button href="{{ route('sharing.create') }}" variant="primary" size="lg" icon="bi-pencil-square">
                    Bagikan Pengalaman Anda
                </x-button>
            </div>
        </div>
    </section>

@endsection
