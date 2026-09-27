@extends('layouts.layout')

@section('title', 'Berita')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="page-title-head d-flex align-items-center mb-3">
                <div class="flex-grow-1">
                    <h4 class="mb-0">Berita</h4>
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
                                            placeholder="Cari berita...">
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
                                    <a href="{{ route('admin.berita.create') }}" class="btn btn-primary ms-1">
                                        <i data-lucide="plus" class="fs-sm me-2"></i> Tambah Berita
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-custom table-centered table-hover w-100 mb-0">
                                        <thead class="bg-light align-middle bg-opacity-25 thead-sm">
                                            <tr class="text-uppercase fs-xxs">
                                                <th data-table-sort="judul">Judul</th>
                                                <th data-table-sort data-column="status">Status</th>
                                                <th data-table-sort>Terakhir Diubah</th>
                                                <th class="text-center" style="width: 1%;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($beritas as $berita)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-md me-3">
                                                                @if ($berita->thumbnail)
                                                                    <img src="{{ asset('uploads/berita-thumbnail/' . $berita->thumbnail) }}"
                                                                        alt="{{ $berita->judul }}" class="rounded"
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
                                                                        class="link-reset">{{ $berita->judul }}</a>
                                                                </h5>
                                                                <small class="text-muted">{{ $berita->deskripsi }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($berita->status === 'published')
                                                            <span class="badge badge-soft-success fs-xxs">Published</span>
                                                        @elseif ($berita->status === 'rejected')
                                                            <span class="badge badge-soft-danger fs-xxs"
                                                                title="{{ $berita->alasan_penolakan }}">Ditolak</span>
                                                        @else
                                                            <span class="badge badge-soft-secondary fs-xxs">Draft</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $berita->updated_at->translatedFormat('d M Y') }}
                                                        <small
                                                            class="text-muted">{{ $berita->updated_at->format('H:i') }}</small>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center gap-1">
                                                            @if ($berita->status !== 'published')
                                                                <button type="button"
                                                                    class="btn btn-soft-success btn-icon btn-sm rounded-circle btn-publish-berita"
                                                                    data-url="{{ route('admin.berita.publish', $berita) }}"
                                                                    title="Publikasikan">
                                                                    <i class="ti ti-check fs-lg"></i>
                                                                </button>
                                                            @endif

                                                            @if ($berita->status !== 'rejected')
                                                                <button type="button"
                                                                    class="btn btn-soft-danger btn-icon btn-sm rounded-circle btn-reject-berita"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalRejectBerita"
                                                                    data-url="{{ route('admin.berita.reject', $berita) }}"
                                                                    data-title="{{ $berita->judul }}" title="Tolak">
                                                                    <i class="ti ti-x fs-lg"></i>
                                                                </button>
                                                            @endif

                                                            <a href="{{ route('admin.berita.edit', $berita) }}"
                                                                class="btn btn-light btn-icon btn-sm rounded-circle">
                                                                <i class="ti ti-edit fs-lg"></i>
                                                            </a>
                                                            <form action="{{ route('admin.berita.destroy', $berita) }}"
                                                                method="POST" class="d-inline form-delete"
                                                                data-name="{{ $berita->judul }}">
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
                                                    <td colspan="4" class="text-center text-muted py-4">
                                                        Belum ada berita. Klik "Tambah Berita" untuk membuat yang pertama.
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

    {{-- ============ MODAL TOLAK BERITA ============ --}}
    <div class="modal fade" id="modalRejectBerita" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formRejectBerita" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tolak Cerita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted mb-3" id="rejectBeritaTitle"></p>
                        <label class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea name="alasan_penolakan" id="alasanPenolakan" class="form-control" rows="3"
                            placeholder="Contoh: Konten tidak sesuai, mengandung informasi yang tidak dapat diverifikasi." required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="ti ti-x me-1"></i> Tolak Cerita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const formReject = document.getElementById('formRejectBerita');
                const rejectTitle = document.getElementById('rejectBeritaTitle');

                document.querySelectorAll('.btn-reject-berita').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        formReject.action = this.dataset.url;
                        rejectTitle.textContent = 'Menolak cerita: "' + this.dataset.title + '"';
                    });
                });

                document.querySelectorAll('.btn-publish-berita').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const url = this.dataset.url;

                        Swal.fire({
                            icon: 'question',
                            title: 'Publikasikan cerita ini?',
                            text: 'Cerita akan langsung tayang di halaman Berita publik.',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, Publikasikan',
                            cancelButtonText: 'Batal',
                            confirmButtonColor: '#16A34A',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const form = document.createElement('form');
                                form.method = 'POST';
                                form.action = url;
                                form.innerHTML = `@csrf`;
                                document.body.appendChild(form);
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush

@endsection
