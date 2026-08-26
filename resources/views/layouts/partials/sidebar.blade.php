<div class="sidenav-menu">
    <div class="mb-3">
        <button class="button-on-hover">
            <i class="ti ti-menu-4 fs-22 align-middle"></i>
        </button>
    </div>

    <button class="button-close-offcanvas">
        <i class="ti ti-x align-middle"></i>
    </button>

    <div class="scrollbar" data-simplebar>

        <div class="sidenav-user">
            <div class="d-flex justify-content-between align-items-center">
                <a href="#!" class="link-reset d-flex align-items-center">
                    <img src="{{ asset('img/logo/logo-kokit.jpg') }}" alt="user"
                        class="rounded-circle me-2 avatar-md">
                    <div class="d-flex flex-column">
                        <span class="sidenav-user-name fw-bold">{{ Auth::user()->name }}</span>
                        <span class="fs-12 fw-semibold">Admin</span>
                    </div>
                </a>
            </div>
        </div>

        <ul class="side-nav">
            <li class="side-nav-title">Menu</li>

            <li class="side-nav-item">
                <a href="{{ route('dashboard') }}"
                    class="side-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="ti ti-layout-dashboard"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            <li class="side-nav-title">Konten</li>

            <li class="side-nav-item">
                <a href="{{ route('admin.artikel.index') }}"
                    class="side-nav-link {{ request()->routeIs('admin.artikel.*') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="ti ti-notebook"></i></span>
                    <span class="menu-text">Panduan &amp; Pencegahan</span>
                </a>
            </li>
            <li class="side-nav-item">
    <a href="{{ route('admin.pengaduan.index') }}"
       class="side-nav-link {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">
        <span class="menu-icon"><i class="ti ti-message-report"></i></span>
        <span class="menu-text">Pengaduan</span>
    </a>
</li>
        </ul>
    </div>
</div>
