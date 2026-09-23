@extends('layouts.app')

@section('title', 'Beranda — Layanan Jamaah Haji & Umroh')

@section('content')

    {{-- ============ HERO ============ --}}
    <section class="site-hero">
        <div class="container">
            <div class="row align-items-center g-5">

                <div class="col-lg-7">
                    <span class="hero-badge">
                        <i class="bi bi-book-half"></i>
                        Cerita dari Tanah Suci
                    </span>
                    <h1 class="hero-title">
                        Berbagi Kisah dan Pengalaman Selama di Tanah Suci
                    </h1>
                    <p class="hero-description">
                        Ceritakan pengalaman ibadah haji dan umroh Anda, atau baca
                        kisah nyata jamaah lain seputar perjalanan di Mekkah dan
                        Arab Saudi.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <x-button href="{{ route('sharing.create') }}" variant="primary" size="lg"
                            icon="bi-pencil-square">
                            Bagikan Pengalaman Anda
                        </x-button>
                        <x-button href="{{ route('berita') }}" variant="outline-primary" size="lg"
                            icon="bi-journal-text">
                            Baca Kisah Jamaah Lain
                        </x-button>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="hero-popular-panel">
                        <div class="hero-popular-header">
                            <h3><i class="bi bi-fire text-danger me-1"></i> Artikel Terbaru</h3>
                            <div class="hero-popular-scroll-btns">
                                <button type="button" id="btnScrollUp" aria-label="Scroll ke atas">
                                    <i class="bi bi-chevron-up"></i>
                                </button>
                                <button type="button" id="btnScrollDown" aria-label="Scroll ke bawah">
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                            </div>
                        </div>

                        <div class="hero-popular-list" id="heroPopularList">
                            @forelse ($artikelTerbaru as $index => $artikel)
                                <a href="{{ route('panduan.detail', $artikel->slug) }}" class="hero-popular-item">
                                    <span class="hero-popular-thumb">
                                        @if ($artikel->thumbnail)
                                            <img src="{{ asset('uploads/artikel-thumbnail/' . $artikel->thumbnail) }}"
                                                alt="{{ $artikel->judul }}">
                                        @else
                                            <i class="bi bi-file-earmark-text"></i>
                                        @endif
                                        <span class="hero-popular-number">{{ $index + 1 }}</span>
                                    </span>
                                    <span class="hero-popular-text">
                                        <h5>{{ $artikel->judul }}</h5>
                                        <span class="hero-popular-category">{{ ucfirst($artikel->kategori) }}</span>
                                    </span>
                                </a>
                            @empty
                                <p class="text-muted-custom mb-0 fs-sm">Belum ada artikel yang dipublikasikan.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ============ DUA PILIHAN UTAMA ============ --}}
    <section class="section">
    <div class="container">
        <x-section-heading
            align="center"
            eyebrow="Statistik"
            title="Informasi Terkini Seputar Arab Saudi"
            subtitle="Data dan tren kasus yang dialami jemaah selama pelaksanaan ibadah haji dan umroh."
        />

        @php
            // Data sementara — nanti diganti hasil query dari database saat sumber data resmi tersedia.
            $chartDampak = [
                'labels' => [
                    'Masalah dokumen perjalanan (paspor/visa)',
                    'Tiket kepulangan tidak tersedia',
                    'Tiket kepulangan dibatalkan sepihak (fraud dummy ticket)',
                    'Akomodasi hotel tidak tersedia',
                    'Penerbangan dibatalkan maskapai',
                    'Masalah kesehatan jemaah',
                    'Jemaah terpisah tanpa atribut PPIU',
                ],
                'data' => [961, 333, 195, 36, 16, 2, 1],
            ];

            $chartKasus = [
                'labels' => [
                    'Tiket kepulangan dibatalkan sepihak (fraud dummy ticket)',
                    'Tiket kepulangan tidak tersedia',
                    'Masalah dokumen perjalanan (paspor/visa)',
                    'Akomodasi hotel tidak tersedia',
                    'Masalah kesehatan jemaah',
                    'Penerbangan dibatalkan maskapai',
                    'Sengketa bisnis antarpihak (LA)',
                    'Jemaah terpisah tanpa atribut PPIU',
                ],
                'data' => [6, 4, 3, 2, 2, 1, 1, 1],
            ];
        @endphp

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="form-card mb-0">
                    <div class="form-section-title">
                        <span class="icon-box"><i class="bi bi-people"></i></span>
                        <span>Jumlah Jemaah Terdampak</span>
                    </div>
                    <p class="form-section-desc">Berdasarkan kategori permasalahan yang dilaporkan.</p>
                    <canvas id="chartDampak" height="280"></canvas>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-card mb-0">
                    <div class="form-section-title">
                        <span class="icon-box"><i class="bi bi-clipboard-data"></i></span>
                        <span>Jumlah Kasus</span>
                    </div>
                    <p class="form-section-desc">Frekuensi kasus per kategori permasalahan.</p>
                    <canvas id="chartKasus" height="280"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

    {{-- ============ CARA KERJA ============ --}}
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const list = document.getElementById('heroPopularList');
    const btnUp = document.getElementById('btnScrollUp');
    const btnDown = document.getElementById('btnScrollDown');

    if (list && btnUp && btnDown) {
        btnUp.addEventListener('click', () => list.scrollBy({ top: -160, behavior: 'smooth' }));
        btnDown.addEventListener('click', () => list.scrollBy({ top: 160, behavior: 'smooth' }));
    }

    const chartDampakEl = document.getElementById('chartDampak');
    if (chartDampakEl) {
        new Chart(chartDampakEl, {
            type: 'bar',
            data: {
                labels: @json($chartDampak['labels']),
                datasets: [{
                    label: 'Jumlah jemaah terdampak (orang)',
                    data: @json($chartDampak['data']),
                    backgroundColor: '#C2570C',
                    borderRadius: 4,
                }],
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: { callbacks: { label: (ctx) => `${ctx.parsed.x} orang` } },
                },
                scales: {
                    x: { beginAtZero: true, title: { display: true, text: 'Jumlah jemaah terdampak (orang)' } },
                    y: { ticks: { autoSkip: false, font: { size: 11 } } },
                },
            },
        });
    }

    const chartKasusEl = document.getElementById('chartKasus');
    if (chartKasusEl) {
        new Chart(chartKasusEl, {
            type: 'bar',
            data: {
                labels: @json($chartKasus['labels']),
                datasets: [{
                    label: 'Jumlah kasus',
                    data: @json($chartKasus['data']),
                    backgroundColor: '#2563EB',
                    borderRadius: 4,
                }],
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: { callbacks: { label: (ctx) => `${ctx.parsed.x} kasus` } },
                },
                scales: {
                    x: { beginAtZero: true, title: { display: true, text: 'Jumlah kasus' } },
                    y: { ticks: { autoSkip: false, font: { size: 11 } } },
                },
            },
        });
    }

});
</script>
@endpush
