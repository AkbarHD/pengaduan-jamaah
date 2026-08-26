<x-section-heading
    title="Informasi untuk Jamaah"
    subtitle="Panduan dan informasi yang dapat membantu selama persiapan dan perjalanan."
/>

<div class="row g-4">
    @forelse ($artikels as $artikel)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('panduan.detail', $artikel->slug) }}" class="article-card-link">
                <div class="article-card">
                    <div class="article-thumb">
                        @if ($artikel->thumbnail)
                            <img src="{{ asset('uploads/artikel-thumbnail/' . $artikel->thumbnail) }}"
                                 alt="{{ $artikel->judul }}" class="article-thumb-img">
                        @else
                            <i class="bi bi-file-earmark-text"></i>
                        @endif
                    </div>
                    <div class="article-body">
                        <span class="article-badge badge-{{ $artikel->kategori }}">
                            {{ ucfirst($artikel->kategori) }}
                        </span>
                        <h4>{{ $artikel->judul }}</h4>
                        <p>{{ $artikel->deskripsi }}</p>
                        <div class="article-meta">
                            <span class="read-time">
                                <i class="bi bi-clock"></i> {{ $artikel->waktu_baca ?? '5 menit baca' }}
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
                        Tidak ada artikel yang cocok dengan pencarian "{{ $search }}".
                    @else
                        Belum ada artikel untuk kategori ini.
                    @endif
                </p>
            </div>
        </div>
    @endforelse
</div>

@if ($artikels->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $artikels->onEachSide(1)->links('vendor.pagination.custom') }}
    </div>
@endif