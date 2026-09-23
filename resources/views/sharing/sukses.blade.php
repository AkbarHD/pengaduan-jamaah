@extends('layouts.app')

@section('title', 'Cerita Terkirim — Layanan Jamaah Haji & Umroh')

@section('content')
<section class="section">
    <div class="container">
        <div class="container-narrow">
            <div class="result-card text-center">
                <div class="empty-icon mx-auto mb-3" style="background-color: var(--color-primary-soft); color: var(--color-primary);">
                    <i class="bi bi-check-lg"></i>
                </div>

                <h1 class="section-title">Terima Kasih Telah Berbagi!</h1>
                <p class="text-muted-custom mb-4">
                    Cerita Anda <strong>"{{ $berita->judul }}"</strong> sedang
                    ditinjau oleh tim kami. Setelah disetujui, cerita ini akan
                    tayang di halaman Berita agar bisa dibaca jamaah lain.
                </p>

                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                    <x-button href="{{ route('berita') }}" variant="outline" icon="bi-journal-text">
                        Baca Cerita Lainnya
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        icon: 'success',
        title: 'Cerita Terkirim',
        text: 'Terima kasih! Cerita Anda akan tayang setelah ditinjau oleh tim kami.',
        confirmButtonText: 'Oke, Mengerti',
        confirmButtonColor: '#2563EB',
    });
});
</script>
@endpush
