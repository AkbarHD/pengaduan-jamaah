@extends('layouts.layout')

@section('title', 'Dashboard')

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="page-title-head d-flex align-items-center mb-3">
            <div class="flex-grow-1">
                <h4 class="mb-0">Dashboard</h4>
            </div>
        </div>

        {{-- Welcome Card --}}
        <div class="card mb-3">
            <div class="card-body d-flex align-items-center gap-3 flex-wrap">
                <div class="avatar-lg flex-shrink-0">
                    <span class="avatar-title bg-primary-subtle text-primary rounded-circle fs-24">
                        <i class="ti ti-user-check"></i>
                    </span>
                </div>
                <div>
                    <h5 class="mb-1">Selamat Datang, {{ Auth::user()->name }}</h5>
                    <p class="text-muted mb-0">
                        Berikut ringkasan aktivitas layanan informasi dan pengaduan jamaah hari ini.
                    </p>
                </div>
            </div>
        </div>

        {{-- Stat Cards --}}
        <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-3 mb-1">

            <div class="col">
                <div class="card mb-1">
                    <div class="card-body">
                        <h5 title="Total Artikel">Total Artikel</h5>
                        <div class="d-flex align-items-center gap-2 my-3">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title text-bg-primary rounded-circle fs-22">
                                    <i class="ti ti-notebook"></i>
                                </span>
                            </div>
                            <h3 class="mb-0">{{ $totalArtikel }}</h3>
                        </div>
                        <p class="mb-0">
                            <span class="text-primary"><i class="ti ti-point-filled"></i></span>
                            <span class="text-nowrap text-muted">Dipublikasikan</span>
                            <span class="float-end"><b>{{ $totalPublished }}</b></span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card mb-1">
                    <div class="card-body">
                        <h5 title="Artikel Panduan">Panduan</h5>
                        <div class="d-flex align-items-center gap-2 my-3">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title text-bg-secondary rounded-circle fs-22">
                                    <i class="ti ti-book"></i>
                                </span>
                            </div>
                            <h3 class="mb-0">{{ $totalPanduan }}</h3>
                        </div>
                        <p class="mb-0">
                            <span class="text-secondary"><i class="ti ti-point-filled"></i></span>
                            <span class="text-nowrap text-muted">Kategori Panduan</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card mb-1">
                    <div class="card-body">
                        <h5 title="Artikel Pencegahan">Pencegahan</h5>
                        <div class="d-flex align-items-center gap-2 my-3">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title text-bg-warning rounded-circle fs-22">
                                    <i class="ti ti-shield-check"></i>
                                </span>
                            </div>
                            <h3 class="mb-0">{{ $totalPencegahan }}</h3>
                        </div>
                        <p class="mb-0">
                            <span class="text-warning"><i class="ti ti-point-filled"></i></span>
                            <span class="text-nowrap text-muted">Kategori Pencegahan</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card mb-1">
                    <div class="card-body">
                        <h5 title="Total Pengaduan">Total Pengaduan</h5>
                        <div class="d-flex align-items-center gap-2 my-3">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title text-bg-danger rounded-circle fs-22">
                                    <i class="ti ti-message-report"></i>
                                </span>
                            </div>
                            <h3 class="mb-0">{{ $totalPengaduan ?? '-' }}</h3>
                        </div>
                        <p class="mb-0">
                            <span class="text-nowrap text-muted fs-xs">
                                @if (is_null($totalPengaduan))
                                    Modul pengaduan segera hadir
                                @else
                                    Seluruh status
                                @endif
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card mb-1">
                    <div class="card-body">
                        <h5 title="Pengaduan Pending">Pending</h5>
                        <div class="d-flex align-items-center gap-2 my-3">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title text-bg-info rounded-circle fs-22">
                                    <i class="ti ti-clock"></i>
                                </span>
                            </div>
                            <h3 class="mb-0">{{ $pengaduanPending ?? '-' }}</h3>
                        </div>
                        <p class="mb-0">
                            <span class="text-nowrap text-muted fs-xs">
                                @if (is_null($pengaduanPending))
                                    Modul pengaduan segera hadir
                                @else
                                    Menunggu verifikasi
                                @endif
                            </span>
                        </p>
                    </div>
                </div>
            </div>

        </div>

        {{-- ============ CHART FILTER ============ --}}
<div class="d-flex justify-content-between align-items-center mb-3 mt-4">
    <h5 class="mb-0">Statistik Pengaduan</h5>
    <form method="GET" action="{{ route('dashboard') }}">
        <select name="range" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="7" {{ $range === '7' ? 'selected' : '' }}>7 Hari Terakhir</option>
            <option value="30" {{ $range === '30' ? 'selected' : '' }}>30 Hari Terakhir</option>
            <option value="90" {{ $range === '90' ? 'selected' : '' }}>90 Hari Terakhir</option>
            <option value="all" {{ $range === 'all' ? 'selected' : '' }}>Semua Waktu</option>
        </select>
    </form>
</div>

<div class="row g-3 mb-3">
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header bg-transparent">
                <h6 class="mb-0">Pengaduan per Kategori</h6>
            </div>
            <div class="card-body">
                @if (count($kategoriChart['labels']) > 0)
                    <canvas id="chartKategori" height="240"></canvas>
                @else
                    <p class="text-muted text-center py-5 mb-0">Belum ada data pengaduan pada rentang ini.</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header bg-transparent">
                <h6 class="mb-0">Tren Pengaduan Harian</h6>
            </div>
            <div class="card-body">
                @if (array_sum($trendChart['data']) > 0)
                    <canvas id="chartTrend" height="240"></canvas>
                @else
                    <p class="text-muted text-center py-5 mb-0">Belum ada data pengaduan pada rentang ini.</p>
                @endif
            </div>
        </div>
    </div>
</div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kategoriLabels = @json($kategoriChart['labels']);
        const kategoriData   = @json($kategoriChart['data']);
        const trendLabels    = @json($trendChart['labels']);
        const trendData      = @json($trendChart['data']);

        if (kategoriLabels.length > 0) {
            new Chart(document.getElementById('chartKategori'), {
                type: 'bar',
                data: {
                    labels: kategoriLabels,
                    datasets: [{
                        label: 'Jumlah Pengaduan',
                        data: kategoriData,
                        backgroundColor: '#2563EB',
                        borderRadius: 6,
                    }],
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } },
                },
            });
        }

        if (trendData.some(v => v > 0)) {
            new Chart(document.getElementById('chartTrend'), {
                type: 'line',
                data: {
                    labels: trendLabels,
                    datasets: [{
                        label: 'Pengaduan Masuk',
                        data: trendData,
                        borderColor: '#2563EB',
                        backgroundColor: 'rgba(37, 99, 235, 0.08)',
                        fill: true,
                        tension: 0.3,
                        pointRadius: 3,
                    }],
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } },
                },
            });
        }
    });
</script>
@endpush
@endsection
