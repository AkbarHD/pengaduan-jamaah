@extends('layouts.layout')

@section('title', 'Pengaduan')

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="page-title-head d-flex align-items-center mb-3">
            <div class="flex-grow-1">
                <h4 class="mb-0">Pengaduan Jamaah</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div data-table data-table-rows-per-page="10" class="card">
                        <div class="card-header border-light justify-content-between">
                            <div class="d-flex gap-2">
                                <div class="app-search">
                                    <input data-table-search type="search" class="form-control" placeholder="Cari nomor / nama...">
                                    <i data-lucide="search" class="app-search-icon text-muted"></i>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <div>
                                    <select data-table-set-rows-per-page class="form-select form-control my-1 my-md-0">
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                    </select>
                                </div>
                                <div class="app-search">
                                    <select data-table-filter="status" class="form-select form-control my-1 my-md-0">
                                        <option value="">Semua Status</option>
                                        <option value="Menunggu Verifikasi">Menunggu Verifikasi</option>
                                        <option value="Terverifikasi">Terverifikasi</option>
                                        <option value="Selesai">Selesai</option>
                                        <option value="Dibatalkan">Dibatalkan</option>
                                    </select>
                                    <i data-lucide="filter" class="app-search-icon text-muted"></i>
                                </div>
                                <div class="app-search">
                                    <select data-table-filter="darurat" class="form-select form-control my-1 my-md-0">
                                        <option value="">Semua Tipe</option>
                                        <option value="Darurat">Darurat</option>
                                        <option value="Biasa">Biasa</option>
                                    </select>
                                    <i data-lucide="alert-triangle" class="app-search-icon text-muted"></i>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-custom table-centered table-hover w-100 mb-0">
                                    <thead class="bg-light align-middle bg-opacity-25 thead-sm">
                                        <tr class="text-uppercase fs-xxs">
                                            <th data-table-sort="nomor">Nomor Pengaduan</th>
                                            <th data-table-sort>Pelapor / Jamaah</th>
                                            <th data-table-sort>Kategori</th>
                                            <th data-table-sort data-column="darurat">Tipe</th>
                                            <th data-table-sort data-column="status">Status</th>
                                            <th data-table-sort>Tanggal</th>
                                            <th class="text-center" style="width: 1%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pengaduans as $pengaduan)
                                            <tr>
                                                <td>
                                                    <h5 class="mb-0">
                                                        <a data-sort="nomor" href="{{ route('admin.pengaduan.show', $pengaduan) }}" class="link-reset">
                                                            {{ $pengaduan->nomor_pengaduan }}
                                                        </a>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <div>{{ $pengaduan->nama_pelapor }}</div>
                                                    <small class="text-muted">Jamaah: {{ $pengaduan->nama_jamaah }}</small>
                                                </td>
                                                <td>{{ $pengaduan->kategori_label }}</td>
                                                <td>
                                                    @if ($pengaduan->is_darurat)
                                                        <span class="badge badge-soft-danger fs-xxs">
                                                            <i class="ti ti-alert-triangle me-1"></i> Darurat
                                                        </span>
                                                    @else
                                                        <span class="badge badge-soft-secondary fs-xxs">Biasa</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge {{ $pengaduan->status_badge_class }} fs-xxs">
                                                        {{ $pengaduan->status_label }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $pengaduan->created_at->translatedFormat('d M Y') }}
                                                    <small class="text-muted">{{ $pengaduan->created_at->format('H:i') }}</small>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-1">
                                                        <a href="{{ route('admin.pengaduan.show', $pengaduan) }}"
                                                           class="btn btn-light btn-icon btn-sm rounded-circle">
                                                            <i class="ti ti-eye fs-lg"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-4">
                                                    Belum ada pengaduan yang masuk.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div data-table-pagination-info></div>
                                    <div data-table-pagination></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection