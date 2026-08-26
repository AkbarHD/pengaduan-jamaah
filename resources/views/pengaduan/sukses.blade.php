@extends('layouts.app')

@section('title', 'Pengaduan Terkirim — Layanan Jamaah Haji & Umroh')

@section('content')
<section class="section">
    <div class="container">
        <div class="container-narrow">
            <div class="result-card text-center">
                <div class="empty-icon mx-auto mb-3" style="background-color: var(--color-primary-soft); color: var(--color-primary);">
                    <i class="bi bi-check-lg"></i>
                </div>

                <h1 class="section-title">Pengaduan Berhasil Dikirim</h1>
                <p class="text-muted-custom mb-4">
                    Simpan nomor pengaduan Anda untuk memeriksa status perkembangannya.
                </p>

                <div class="result-nomor mb-1" style="font-size: 1.4rem;">
                    {{ $pengaduan->nomor_pengaduan }}
                </div>
                <span class="status-badge status-pending mb-4">
                    <span class="dot"></span> {{ $pengaduan->status_label }}
                </span>

                @if ($pengaduan->is_darurat)
                    <div class="alert-emergency text-start mt-4">
                        <div class="icon-box"><i class="bi bi-info-circle-fill"></i></div>
                        <div>
                            <h5>Pengaduan darurat Anda akan diprioritaskan</h5>
                            <p>
                                Tim kami akan segera memverifikasi laporan Anda. Setelah
                                terverifikasi, kami akan menghubungkan Anda dengan KJRI
                                sesegera mungkin.
                            </p>
                        </div>
                    </div>
                @endif

                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 mt-4">
                    <x-button href="{{ route('cek-status') }}" variant="outline" icon="bi-search">
                        Cek Status Pengaduan
                    </x-button>
                    <x-button href="{{ route('home') }}" variant="primary" icon="bi-house">
                        Kembali ke Beranda
                    </x-button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
