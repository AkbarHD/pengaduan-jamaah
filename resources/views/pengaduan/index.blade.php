@extends('layouts.app')

@section('title', 'Buat Pengaduan — Layanan Jamaah Haji & Umroh')
@section('description',
    'Sampaikan kendala yang Anda alami selama perjalanan haji atau umroh agar kami dapat memberikan
    arahan yang sesuai.')

@section('content')

    {{-- ============ HEADER ============ --}}
    <section class="form-hero">
        <div class="container">
            <span class="section-eyebrow">
                <i class="bi bi-megaphone"></i>
                Formulir Pengaduan
            </span>
            <h1>Sampaikan Pengaduan Anda</h1>
            <p class="text-muted-custom">
                Ceritakan kendala yang Anda alami agar kami dapat memberikan arahan
                yang sesuai.
            </p>

            @include('pengaduan.partials._progress')
        </div>
    </section>

    {{-- ============ FORM ============ --}}
    <section class="section-sm">
        <div class="container">
            <div class="container-narrow">

                <form id="formPengaduan" action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @include('pengaduan.partials._pelapor')
                    @include('pengaduan.partials._jamaah')
                    @include('pengaduan.partials._perjalanan')
                    @include('pengaduan.partials._masalah')
                    @include('pengaduan.partials._bukti')
                    @include('pengaduan.partials._konfirmasi')

                    <div class="submit-bar">
                        <div class="d-grid">
                            <x-button type="submit" variant="primary" size="lg" icon="bi-send">
                                Kirim Pengaduan
                            </x-button>
                        </div>
                        <p class="form-hint">
                            Dengan mengirim formulir ini, Anda menyetujui data yang
                            diberikan digunakan untuk keperluan penanganan pengaduan.
                        </p>
                    </div>

                </form>

            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('js/pengaduan.js') }}"></script>
@endpush
