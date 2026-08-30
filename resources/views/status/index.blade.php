@extends('layouts.app')

@section('title', 'Cek Status Pengaduan — Layanan Jamaah Haji & Umroh')
@section('description', 'Periksa perkembangan pengaduan yang telah Anda buat dengan memasukkan nomor pengaduan dan nomor
    WhatsApp.')

@section('content')

    <section class="cek-status-hero">
        <div class="container">
            <span class="section-eyebrow">
                <i class="bi bi-search"></i>
                Layanan Pelapor
            </span>
            <h1>Cek Status Pengaduan</h1>
            <p class="text-muted-custom">
                Masukkan nomor pengaduan dan nomor WhatsApp untuk melihat
                perkembangan pengaduan Anda.
            </p>
        </div>
    </section>

    <section class="section-sm pt-0">
        <div class="container">
            <div class="container-narrow">

                @include('status.partials._form')
                @include('status.partials._hasil')
                @include('status.partials._empty')

            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('js/status.js') }}"></script>
@endpush
