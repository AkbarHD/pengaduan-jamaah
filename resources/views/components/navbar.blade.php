<header class="site-navbar">
    <nav class="navbar navbar-expand-lg py-0">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('img/logo/logo.png') }}" alt="Layanan Jamaah" class="navbar-logo">
                <span>Layanan Jamaah</span>
            </a>

            <button class="navbar-toggler site-toggler d-lg-none" type="button"
                    data-bs-toggle="collapse" data-bs-target="#siteNavbarCollapse"
                    aria-controls="siteNavbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                <i class="bi bi-list fs-4"></i>
            </button>

            <div class="collapse navbar-collapse" id="siteNavbarCollapse">
                <ul class="navbar-nav mx-lg-auto my-3 my-lg-0 gap-lg-1">
                    <li class="nav-item">
                        <a class="nav-link site-nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                           href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link site-nav-link {{ request()->routeIs('panduan') ? 'active' : '' }}"
                           href="{{ route('panduan') }}">Panduan &amp; Pencegahan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link site-nav-link {{ request()->routeIs('cek-status') ? 'active' : '' }}"
                           href="{{ route('cek-status') }}">Cek Status Pengaduan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link site-nav-link {{ request()->routeIs('faq') ? 'active' : '' }}"
                           href="{{ route('faq') }}">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link site-nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}"
                           href="{{ route('tentang') }}">Tentang</a>
                    </li>
                </ul>

                <div class="d-grid d-lg-block">
                    <x-button href="{{ route('pengaduan') }}" variant="primary" size="md" icon="bi-megaphone">
                        Buat Pengaduan
                    </x-button>
                </div>
            </div>
        </div>
    </nav>
</header>
