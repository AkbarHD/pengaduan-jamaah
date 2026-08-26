<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div class="filter-pills mb-0">
        <a href="{{ route('panduan', array_filter(['search' => $search])) }}"
           class="filter-pill {{ !$kategori ? 'is-active' : '' }}">Semua</a>
        <a href="{{ route('panduan', array_filter(['kategori' => 'panduan', 'search' => $search])) }}"
           class="filter-pill {{ $kategori === 'panduan' ? 'is-active' : '' }}">Panduan</a>
        <a href="{{ route('panduan', array_filter(['kategori' => 'pencegahan', 'search' => $search])) }}"
           class="filter-pill {{ $kategori === 'pencegahan' ? 'is-active' : '' }}">Pencegahan</a>
    </div>

    <div class="d-flex align-items-center gap-2">
        <form action="{{ route('panduan') }}" method="GET" class="search-form">
            @if ($kategori)
                <input type="hidden" name="kategori" value="{{ $kategori }}">
            @endif
            <div class="app-search-custom">
                <input type="text" name="search" value="{{ $search }}"
                       class="form-control-custom" placeholder="Cari artikel...">
                <button type="submit" class="btn-search-icon" aria-label="Cari">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>

        @if ($search)
            <a href="{{ route('panduan', array_filter(['kategori' => $kategori])) }}" class="search-reset-btn">
                <i class="bi bi-x-lg"></i> Reset
            </a>
        @endif
    </div>
</div>