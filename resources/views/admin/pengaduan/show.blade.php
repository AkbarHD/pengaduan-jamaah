@extends('layouts.layout')

@section('title', 'Detail Pengaduan')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="page-title-head d-flex align-items-center mb-3">
                <div class="flex-grow-1">
                    <h4 class="mb-0">{{ $pengaduan->nomor_pengaduan }}</h4>
                    <p class="text-muted mb-0 fs-sm">
                        Dikirim {{ $pengaduan->created_at->translatedFormat('d F Y, H:i') }}
                    </p>
                </div>
                <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="row">
                {{-- ============ KOLOM KIRI: DETAIL ============ --}}
                <div class="col-lg-8">

                    @if ($pengaduan->is_darurat)
                        <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
                            <i class="ti ti-alert-triangle fs-20"></i>
                            <div>
                                <strong>Pengaduan Darurat</strong> — mohon diprioritaskan pemeriksaannya.
                                @if ($pengaduan->kjri_forwarded_at)
                                    <div class="fs-sm mt-1">
                                        Sudah diteruskan ke KJRI pada
                                        {{ $pengaduan->kjri_forwarded_at->translatedFormat('d F Y, H:i') }}.
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="card mb-3">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="ti ti-user me-2"></i>Informasi Pelapor</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="text-muted fs-xs text-uppercase">Dibuat Untuk</div>
                                    <div class="fw-semibold">
                                        {{ $pengaduan->jenis_pelapor === 'mewakili' ? 'Mewakili Orang Lain' : 'Diri Sendiri' }}
                                    </div>
                                </div>
                                @if ($pengaduan->jenis_pelapor === 'mewakili')
                                    <div class="col-md-6">
                                        <div class="text-muted fs-xs text-uppercase">Hubungan</div>
                                        <div class="fw-semibold text-capitalize">
                                            {{ str_replace('_', ' ', $pengaduan->hubungan_jamaah) }}</div>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="text-muted fs-xs text-uppercase">Nama Pelapor</div>
                                    <div class="fw-semibold">{{ $pengaduan->nama_pelapor }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted fs-xs text-uppercase">WhatsApp Pelapor</div>
                                    <div class="fw-semibold">{{ $pengaduan->whatsapp_pelapor }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted fs-xs text-uppercase">Email</div>
                                    <div class="fw-semibold">{{ $pengaduan->email_pelapor ?? '-' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted fs-xs text-uppercase">WhatsApp Pelapor</div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-semibold">{{ $pengaduan->whatsapp_pelapor }}</span>
                                        <a href="{{ $pengaduan->whatsapp_pelapor_link }}" target="_blank"
                                            class="btn btn-success btn-icon btn-sm rounded-circle"
                                            title="Chat via WhatsApp">
                                            <i class="ti ti-brand-whatsapp"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="ti ti-user-check me-2"></i>Informasi Jamaah</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="text-muted fs-xs text-uppercase">Nama Jamaah</div>
                                    <div class="fw-semibold">{{ $pengaduan->nama_jamaah }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted fs-xs text-uppercase">WhatsApp Jamaah</div>
                                    <div class="fw-semibold">{{ $pengaduan->whatsapp_jamaah }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="ti ti-plane me-2"></i>Informasi Perjalanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="text-muted fs-xs text-uppercase">Status Perjalanan</div>
                                    <div class="fw-semibold text-capitalize">
                                        {{ str_replace('_', ' ', $pengaduan->status_perjalanan) }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted fs-xs text-uppercase">Status Tiket</div>
                                    <div class="fw-semibold text-capitalize">
                                        {{ str_replace('_', ' ', $pengaduan->status_tiket ?? '-') }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted fs-xs text-uppercase">Nomor Paspor</div>
                                    <div class="fw-semibold">{{ $pengaduan->nomor_paspor ?? '-' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted fs-xs text-uppercase">Nomor Visa</div>
                                    <div class="fw-semibold">{{ $pengaduan->nomor_visa ?? '-' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted fs-xs text-uppercase">Nama Travel</div>
                                    <div class="fw-semibold">{{ $pengaduan->nama_travel ?? '-' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted fs-xs text-uppercase">Keberangkatan / Kepulangan</div>
                                    <div class="fw-semibold">
                                        {{ optional($pengaduan->tanggal_berangkat)->translatedFormat('d M Y') ?? '-' }}
                                        &mdash;
                                        {{ optional($pengaduan->tanggal_pulang)->translatedFormat('d M Y') ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="ti ti-alert-circle me-2"></i>Detail Permasalahan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <div class="text-muted fs-xs text-uppercase">Kategori</div>
                                    <div class="fw-semibold text-capitalize">
                                        {{ str_replace('_', ' ', $pengaduan->kategori_masalah) }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted fs-xs text-uppercase">Tanggal Kejadian</div>
                                    <div class="fw-semibold">
                                        {{ optional($pengaduan->tanggal_kejadian)->translatedFormat('d M Y') ?? '-' }}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="text-muted fs-xs text-uppercase">Lokasi Kejadian</div>
                                    <div class="fw-semibold">{{ $pengaduan->lokasi_kejadian ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="text-muted fs-xs text-uppercase mb-1">Kronologi</div>
                            <p class="mb-0">{{ $pengaduan->ceritakan_masalah }}</p>
                        </div>
                    </div>

                    @if ($pengaduan->lampiran->isNotEmpty())
                        <div class="card mb-3">
                            <div class="card-header bg-transparent">
                                <h5 class="mb-0"><i class="ti ti-paperclip me-2"></i>Bukti Pendukung</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($pengaduan->lampiran as $file)
                                        <a href="{{ asset('uploads/pengaduan-bukti/' . $file->file_name) }}"
                                            target="_blank" class="btn btn-light btn-sm">
                                            <i class="ti ti-file me-1"></i> {{ $file->original_name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="ti ti-history me-2"></i>Riwayat Status</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                @foreach ($pengaduan->riwayat as $item)
                                    <li class="d-flex gap-3 pb-3 mb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                        <div class="flex-shrink-0">
                                            <span class="avatar-sm">
                                                <span class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                    <i class="ti ti-point-filled"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">{{ $item->judul }}</h6>
                                            <p class="text-muted mb-1 fs-sm">{{ $item->catatan }}</p>
                                            <small
                                                class="text-muted">{{ $item->created_at->translatedFormat('d F Y, H:i') }}</small>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>

                {{-- ============ KOLOM KANAN: AKSI ============ --}}
                <div class="col-lg-4">

                    <div class="card mb-3">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0">Status Saat Ini</h5>
                        </div>
                        <div class="card-body text-center">
                            <span class="badge {{ $pengaduan->status_badge_class }} fs-sm px-3 py-2 mb-2">
                                {{ $pengaduan->status_label }}
                            </span>
                            <p class="text-muted mb-0 fs-sm">{{ $pengaduan->status_description }}</p>
                        </div>
                    </div>

                    @if ($pengaduan->is_darurat && $pengaduan->status === 'verifikasi' && !$pengaduan->kjri_forwarded_at)
                        <div class="card mb-3 border-danger">
                            <div class="card-body">
                                <h6 class="mb-2"><i class="ti ti-brand-whatsapp text-danger me-1"></i> Teruskan ke KJRI
                                </h6>
                                <p class="text-muted fs-sm mb-3">
                                    Pengaduan ini darurat dan sudah terverifikasi. Teruskan ke
                                    WhatsApp KJRI agar dapat segera ditindaklanjuti.
                                </p>
                                <form action="{{ route('admin.pengaduan.forward-kjri', $pengaduan) }}" method="POST"
                                    onsubmit="return confirm('Teruskan pengaduan ini ke WhatsApp KJRI?');">
                                    @csrf
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="ti ti-brand-whatsapp me-1"></i> Teruskan ke WhatsApp KJRI
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0">Ubah Status</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.pengaduan.update-status', $pengaduan) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Status Baru</label>
                                    <select name="status" id="statusSelect" class="form-select" required>
                                        <option value="pending" {{ $pengaduan->status === 'pending' ? 'selected' : '' }}>
                                            Menunggu Verifikasi</option>
                                        <option value="verifikasi"
                                            {{ $pengaduan->status === 'verifikasi' ? 'selected' : '' }}>Terverifikasi
                                        </option>
                                        <option value="selesai" {{ $pengaduan->status === 'selesai' ? 'selected' : '' }}>
                                            Selesai</option>
                                        <option value="batal" {{ $pengaduan->status === 'batal' ? 'selected' : '' }}>
                                            Dibatalkan</option>
                                    </select>
                                </div>

                                <div class="mb-3 d-none" id="alasanBatalWrapper">
                                    <label class="form-label">Alasan Pembatalan</label>
                                    <textarea name="alasan_pembatalan" class="form-control @error('alasan_pembatalan') is-invalid @enderror"
                                        rows="3" placeholder="Jelaskan alasan pengaduan dibatalkan">{{ old('alasan_pembatalan', $pengaduan->alasan_pembatalan) }}</textarea>
                                    @error('alasan_pembatalan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-1"></i> Simpan Status
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('statusSelect');
            const alasanWrapper = document.getElementById('alasanBatalWrapper');

            function toggleAlasan() {
                alasanWrapper.classList.toggle('d-none', statusSelect.value !== 'batal');
            }

            statusSelect.addEventListener('change', toggleAlasan);
            toggleAlasan();
        });
    </script>
@endpush
