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
            <x-section-heading align="center" eyebrow="Statistik" title="Informasi Terkini Seputar Arab Saudi"
                subtitle="Data dan tren kasus yang dialami jemaah selama pelaksanaan ibadah haji dan umroh." />

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

@push('styles')
    <style>
        .hero-popular-panel {
  background-color: #F1F5F9;
  border-radius: var(--radius-lg);
  padding: 1.25rem;
}

.hero-popular-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 1rem;
}

.hero-popular-header h3 {
  font-size: 1.05rem;
  margin-bottom: 0;
}

.hero-popular-scroll-btns {
  display: flex;
  gap: 0.4rem;
}

.hero-popular-scroll-btns button {
  width: 32px;
  height: 32px;
  border: 1px solid var(--color-border);
  background-color: #fff;
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-navy);
  transition: var(--transition-base);
  cursor: pointer;
}

.hero-popular-scroll-btns button:hover {
  border-color: var(--color-primary);
  color: var(--color-primary);
}

.hero-popular-list {
  max-height: 480px;
  overflow-y: auto;
  scroll-behavior: smooth;
  padding-right: 0.25rem;
}

.hero-popular-list::-webkit-scrollbar {
  width: 5px;
}

.hero-popular-list::-webkit-scrollbar-thumb {
  background-color: #CBD5E1;
  border-radius: 999px;
}

.hero-popular-item {
  display: flex;
  gap: 0.9rem;
  background-color: #fff;
  padding: 0.85rem;
  border-radius: var(--radius-sm);
  border-bottom: 3px solid var(--color-primary);
  margin-bottom: 0.75rem;
  text-decoration: none;
  color: inherit;
  transition: var(--transition-base);
}

.hero-popular-item:last-child {
  margin-bottom: 0;
}

.hero-popular-item:hover {
  transform: translateX(2px);
  box-shadow: var(--shadow-sm);
}

.hero-popular-thumb {
  position: relative;
  width: 88px;
  height: 68px;
  border-radius: 6px;
  overflow: hidden;
  flex-shrink: 0;
  background-color: var(--color-primary-soft);
  display: flex;
  align-items: center;
  justify-content: center;
}

.hero-popular-thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.hero-popular-thumb i {
  color: var(--color-primary);
  font-size: 1.3rem;
}

.hero-popular-number {
  position: absolute;
  bottom: 0;
  left: 0;
  background-color: var(--color-primary);
  color: #fff;
  font-weight: 700;
  font-size: 0.72rem;
  padding: 0.15rem 0.5rem;
}

.hero-popular-text {
  min-width: 0;
}

.hero-popular-text h5 {
  font-size: 0.9rem;
  margin-bottom: 0.35rem;
  line-height: 1.35;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.hero-popular-category {
  font-size: 0.7rem;
  font-weight: 700;
  color: var(--color-primary);
  text-transform: uppercase;
  letter-spacing: 0.03em;
}
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const list = document.getElementById('heroPopularList');
            const btnUp = document.getElementById('btnScrollUp');
            const btnDown = document.getElementById('btnScrollDown');

            if (list && btnUp && btnDown) {
                btnUp.addEventListener('click', () => list.scrollBy({
                    top: -160,
                    behavior: 'smooth'
                }));
                btnDown.addEventListener('click', () => list.scrollBy({
                    top: 160,
                    behavior: 'smooth'
                }));
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
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: (ctx) => `${ctx.parsed.x} orang`
                                }
                            },
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah jemaah terdampak (orang)'
                                }
                            },
                            y: {
                                ticks: {
                                    autoSkip: false,
                                    font: {
                                        size: 11
                                    }
                                }
                            },
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
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: (ctx) => `${ctx.parsed.x} kasus`
                                }
                            },
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah kasus'
                                }
                            },
                            y: {
                                ticks: {
                                    autoSkip: false,
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                        },
                    },
                });
            }

        });
    </script>
@endpush
