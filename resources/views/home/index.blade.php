@extends('layouts.app')

@section('title', 'Beranda — Layanan Jamaah Haji & Umroh')

@section('content')

    {{-- ============ HERO ============ --}}
    <section class="site-hero">
        <div class="container">
            <div class="row align-items-center g-5">

                <div class="col-lg-6 order-2 order-lg-2">
                    <div class="hero-image-frame">
                        <div class="hero-image-wrapper">
                            <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel"
                                data-bs-interval="4000">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0"
                                        class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"
                                        aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"
                                        aria-label="Slide 3"></button>
                                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"
                                        aria-label="Slide 4"></button>
                                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4"
                                        aria-label="Slide 5"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('img/logo/mekah.jpeg') }}" alt="Masjidil Haram, Mekkah">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('img/logo/mekah2.jpeg') }}" alt="Masjidil Haram, Mekkah">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('img/logo/mekah3.jpeg') }}" alt="Masjidil Haram, Mekkah">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('img/logo/mekah4.jpeg') }}" alt="Masjidil Haram, Mekkah">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('img/logo/mekah5.jpeg') }}" alt="Masjidil Haram, Mekkah">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Sebelumnya</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Selanjutnya</span>
                                </button>
                            </div>
                        </div>
                        <div class="hero-badge-floating">
                            <span class="icon-box"><i class="bi bi-patch-check-fill"></i></span>
                            <div>
                                <span class="text-title">Terhubung KJRI</span>
                                <span class="text-sub">Respon cepat & terpercaya</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 order-1 order-lg-1">
                    <span class="hero-badge">
                        <i class="bi bi-patch-check-fill"></i>
                        Terhubung langsung dengan KJRI
                    </span>
                    <h1 class="hero-title">
                        Bantuan Cepat untuk Jamaah Haji &amp; Umroh yang Mengalami Masalah
                    </h1>
                    <p class="hero-description">
                        Sampaikan kendala Anda selama perjalanan ibadah, dan kami akan
                        membantu mengarahkan Anda ke pihak yang tepat — mulai dari
                        panduan mandiri hingga jalur pengaduan resmi.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <x-button href="{{ route('pengaduan') }}" variant="primary" size="lg" icon="bi-megaphone">
                            Buat Pengaduan Sekarang
                        </x-button>
                        <x-button href="{{ route('panduan') }}" variant="outline-primary" size="lg" icon="bi-book">
                            Lihat Panduan
                        </x-button>
                    </div>

                    <div class="hero-kjri-contact">
                        <span class="icon-box"><i class="bi bi-telephone-fill"></i></span>
                        <div>
                            <span class="label">Kontak Darurat KJRI</span>
                            <a href="tel:+9665059666623" class="number-link">
                                <span class="number">+966 50 596 6623</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ============ DUA PILIHAN UTAMA ============ --}}
    <section class="section">
        <div class="container">
            <x-section-heading align="center" eyebrow="Mulai Dari Sini" title="Apa yang Sedang Anda Butuhkan?"
                subtitle="Pilih salah satu opsi di bawah ini sesuai kondisi Anda saat ini." />

            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <a href="{{ url('/pengaduan') }}" class="text-decoration-none">
                        <div class="choice-card choice-urgent">
                            <div class="choice-icon">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <h3>Saya Sedang Ada Masalah</h3>
                            <p>
                                Sedang mengalami kendala selama perjalanan haji/umroh?
                                Sampaikan pengaduan Anda agar segera diarahkan ke pihak
                                yang berwenang.
                            </p>
                            <span class="choice-link">
                                Buat Pengaduan <i class="bi bi-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-lg-5">
                    <a href="{{ url('/panduan-pencegahan') }}" class="text-decoration-none">
                        <div class="choice-card choice-prepare">
                            <div class="choice-icon">
                                <i class="bi bi-journal-check"></i>
                            </div>
                            <h3>Persiapan Sebelum Berangkat</h3>
                            <p>
                                Belum berangkat? Pelajari panduan dan langkah pencegahan
                                agar perjalanan ibadah Anda lebih aman dan lancar.
                            </p>
                            <span class="choice-link">
                                Lihat Panduan <i class="bi bi-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ CARA KERJA ============ --}}
    <section class="section section-sm"
        style="background-color: var(--color-surface); border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border);">
        <div class="container">
            <x-section-heading align="center" eyebrow="Alur Layanan" title="Cara Kerja Layanan Ini"
                subtitle="Proses sederhana dari pengaduan hingga tindak lanjut." />

            <div class="row g-4">
                <div class="col-6 col-lg-3">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <h4>Isi Pengaduan</h4>
                        <p>Ceritakan masalah yang Anda alami melalui formulir sederhana.</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <h4>Verifikasi Data</h4>
                        <p>Tim kami memeriksa dan memastikan detail pengaduan Anda.</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <h4>Diarahkan ke Pihak Tepat</h4>
                        <p>Pengaduan diteruskan ke instansi terkait, seperti KJRI.</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="step-item">
                        <div class="step-number">4</div>
                        <h4>Pantau Perkembangan</h4>
                        <p>Anda dapat mengikuti perkembangan status pengaduan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ PANDUAN TERBARU ============ --}}
    <section class="section">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 mb-lg-5">
                <x-section-heading eyebrow="Edukasi" title="Panduan Terbaru"
                    subtitle="Informasi dan tips terbaru seputar keamanan perjalanan haji & umroh." />
                <x-button href="{{ route('panduan') }}" variant="ghost" icon="bi-arrow-right">
                    Lihat Semua
                </x-button>
            </div>

            @if ($artikelTerbaru->isNotEmpty())
                <div class="row g-4">
                    @foreach ($artikelTerbaru as $artikel)
                        <div class="col-md-6 col-lg-4">
                            <a href="{{ route('panduan.detail', $artikel->slug) }}" class="guide-card-link">
                                <div class="guide-card">
                                    <div class="guide-card-thumb">
                                        @if ($artikel->thumbnail)
                                            <img src="{{ asset('uploads/artikel-thumbnail/' . $artikel->thumbnail) }}"
                                                alt="{{ $artikel->judul }}" class="article-thumb-img">
                                        @else
                                            <i class="bi bi-file-earmark-text"></i>
                                        @endif
                                    </div>
                                    <div class="guide-card-body">
                                        <span class="guide-badge">{{ ucfirst($artikel->kategori) }}</span>
                                        <h4>{{ $artikel->judul }}</h4>
                                        <p>{{ $artikel->deskripsi }}</p>
                                        <div class="guide-meta">
                                            <i class="bi bi-clock"></i> {{ $artikel->waktu_baca ?? '5 menit baca' }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted-custom text-center py-4 mb-0">Belum ada panduan yang dipublikasikan.</p>
            @endif
        </div>
    </section>

    {{-- ============ CTA ============ --}}
    <section class="section-sm">
        <div class="container">
            <div class="site-cta d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4">
                <div>
                    <h2>Sedang Mengalami Kendala Sekarang?</h2>
                    <p>Jangan tunda, laporkan masalah Anda agar segera ditindaklanjuti.</p>
                </div>
                <x-button href="{{ url('/pengaduan') }}" variant="primary" size="lg" icon="bi-megaphone">
                    Buat Pengaduan
                </x-button>
            </div>
        </div>
    </section>

@endsection
