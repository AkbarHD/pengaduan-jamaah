@extends('layouts.layout')

@section('title', 'Panduan & Pencegahan')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="page-title-head d-flex align-items-center mb-3">
                <div class="flex-grow-1">
                    <h4 class="mb-0">Panduan &amp; Pencegahan</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div data-table data-table-rows-per-page="10" class="card">
                            <div class="card-header border-light justify-content-between">
                                <div class="d-flex gap-2">
                                    <div class="app-search">
                                        <input data-table-search type="search" class="form-control"
                                            placeholder="Cari artikel...">
                                        <i data-lucide="search" class="app-search-icon text-muted"></i>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <div>
                                        <select data-table-set-rows-per-page class="form-select form-control my-1 my-md-0">
                                            <option value="5">5</option>
                                            <option value="10" selected>10</option>
                                            <option value="20">20</option>
                                        </select>
                                    </div>
                                    <div class="app-search">
                                        <select data-table-filter="kategori" class="form-select form-control my-1 my-md-0">
                                            <option value="">Semua Kategori</option>
                                            <option value="Panduan">Panduan</option>
                                            <option value="Pencegahan">Pencegahan</option>
                                        </select>
                                        <i data-lucide="filter" class="app-search-icon text-muted"></i>
                                    </div>
                                    <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary ms-1">
                                        <i data-lucide="plus" class="fs-sm me-2"></i> Tambah Artikel
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-custom table-centered table-hover w-100 mb-0">
                                        <thead class="bg-light align-middle bg-opacity-25 thead-sm">
                                            <tr class="text-uppercase fs-xxs">
                                                <th data-table-sort="judul">Judul</th>
                                                <th data-table-sort data-column="kategori">Kategori</th>
                                                <th data-table-sort>PDF</th>
                                                <th data-table-sort>Waktu Baca</th>
                                                <th data-table-sort data-column="status">Status</th>
                                                <th data-table-sort>Terakhir Diubah</th>
                                                <th class="text-center" style="width: 1%;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($artikels as $artikel)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-md me-3">
                                                                @if ($artikel->thumbnail)
                                                                    <img src="{{ asset('uploads/artikel-thumbnail/' . $artikel->thumbnail) }}"
                                                                        alt="{{ $artikel->judul }}" class="rounded"
                                                                        style="width: 48px; height: 48px; object-fit: cover;">
                                                                @else
                                                                    <span
                                                                        class="avatar-title bg-primary-subtle text-primary rounded fs-20">
                                                                        <i class="ti ti-photo"></i>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <h5 class="mb-0">
                                                                    <a data-sort="judul" href="#"
                                                                        class="link-reset">{{ $artikel->judul }}</a>
                                                                </h5>
                                                                <small class="text-muted">{{ $artikel->deskripsi }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($artikel->kategori === 'panduan')
                                                            <span class="badge badge-soft-primary fs-xxs">Panduan</span>
                                                        @else
                                                            <span class="badge badge-soft-warning fs-xxs">Pencegahan</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.artikel.download', $artikel) }}"
                                                            class="badge badge-soft-success fs-xxs">
                                                            <i class="ti ti-file-type-pdf me-1"></i> Download
                                                        </a>
                                                    </td>
                                                    <td>{{ $artikel->waktu_baca ?? '-' }}</td>
                                                    <td>
                                                        @if ($artikel->status === 'published')
                                                            <span class="badge badge-soft-success fs-xxs">Published</span>
                                                        @else
                                                            <span class="badge badge-soft-secondary fs-xxs">Draft</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $artikel->updated_at->translatedFormat('d M Y') }}
                                                        <small
                                                            class="text-muted">{{ $artikel->updated_at->format('H:i') }}</small>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center gap-1">
                                                            <a href="{{ route('admin.artikel.edit', $artikel) }}"
                                                                class="btn btn-light btn-icon btn-sm rounded-circle">
                                                                <i class="ti ti-edit fs-lg"></i>
                                                            </a>
                                                            <form action="{{ route('admin.artikel.destroy', $artikel) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Hapus artikel ini?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-light btn-icon btn-sm rounded-circle">
                                                                    <i class="ti ti-trash fs-lg text-danger"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-muted py-4">
                                                        Belum ada artikel. Klik "Tambah Artikel" untuk membuat yang pertama.
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
