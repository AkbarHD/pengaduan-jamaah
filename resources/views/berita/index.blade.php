@extends('layouts.app')

@section('title', 'Berita — Layanan Jamaah Haji & Umroh')
@section('description', 'Informasi dan berita terbaru seputar layanan jamaah haji dan umroh.')

@section('content')

    <section class="panduan-header">
        <div class="container">
            <span class="section-eyebrow">
                <i class="bi bi-newspaper"></i>
                Informasi Terkini
            </span>
            <h1>Berita</h1>
            <p class="text-muted-custom">
                Update dan informasi terbaru seputar layanan jamaah haji dan umroh.
            </p>
        </div>
    </section>

    <section class="section-sm pt-0">
        <div class="container">

            <div class="d-flex flex-column flex-md-row justify-content-end align-items-md-center gap-3 mb-4">
                <div class="d-flex align-items-center gap-2">
                    <form action="{{ route('berita') }}" method="GET" class="search-form">
                        <div class="app-search-custom">
                            <input type="text" name="search" value="{{ $search }}"
                                   class="form-control-custom" placeholder="Cari berita...">
                            <button type="submit" class="btn-search-icon" aria-label="Cari">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>

                    @if ($search)
                        <a href="{{ route('berita') }}" class="search-reset-btn">
                            <i class="bi bi-x-lg"></i> Reset
                        </a>
                    @endif
                </div>
            </div>

            <div class="row g-4">
                @forelse ($beritas as $berita)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('berita.detail', $berita->slug) }}" class="article-card-link">
                            <div class="article-card">
                                <div class="article-thumb">
                                    @if ($berita->thumbnail)
                                        <img src="{{ asset('uploads/berita-thumbnail/' . $berita->thumbnail) }}"
                                             alt="{{ $berita->judul }}" class="article-thumb-img">
                                    @else
                                        <i class="bi bi-newspaper"></i>
                                    @endif
                                </div>
                                <div class="article-body">
                                    <h4>{{ $berita->judul }}</h4>
                                    <p>{{ $berita->deskripsi }}</p>
                                    <div class="article-meta">
                                        <span class="read-time">
                                            <i class="bi bi-calendar3"></i> {{ $berita->created_at->translatedFormat('d M Y') }}
                                        </span>
                                        <span class="read-link">
                                            Baca <i class="bi bi-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <p class="text-muted-custom mb-0">
                                @if ($search)
                                    Tidak ada berita yang cocok dengan pencarian "{{ $search }}".
                                @else
                                    Belum ada berita yang dipublikasikan.
                                @endif
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($beritas->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $beritas->onEachSide(1)->links('vendor.pagination.custom') }}
                </div>
            @endif

        </div>
    </section>

@endsection