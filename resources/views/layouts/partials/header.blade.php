<header class="app-topbar">
    <div class="container-fluid topbar-menu">
        <div class="d-flex align-items-center gap-2">
            <button class="sidenav-toggle-button btn btn-primary btn-icon">
                <i class="ti ti-menu-4 fs-22"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="ti ti-menu-4 fs-22"></i>
            </button>
        </div> <!-- .d-flex-->

        <div class="d-flex align-items-center gap-2">

            <!-- Notification Dropdown -->
            <div class="topbar-item">
                <div class="dropdown">
                    @php
                        $notifPending = \App\Models\Pengaduan::where('status', 'pending')->latest()->take(5)->get();
                        $notifCount = \App\Models\Pengaduan::where('status', 'pending')->count();
                    @endphp

                    <button class="topbar-link dropdown-toggle drop-arrow-none" data-bs-toggle="dropdown"
                        data-bs-offset="0,22" type="button" data-bs-auto-close="outside" aria-haspopup="false"
                        aria-expanded="false">
                        <i data-lucide="bell" class="fs-xxl"></i>
                        @if ($notifCount > 0)
                            <span class="badge badge-square text-bg-warning topbar-badge">{{ $notifCount }}</span>
                        @endif
                    </button>

                    <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
                        <div class="px-3 py-2 border-bottom">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fs-md fw-semibold">Notifikasi</h6>
                                </div>
                                <div class="col text-end">
                                    <span class="badge text-bg-light badge-label py-1">{{ $notifCount }}
                                        Menunggu</span>
                                </div>
                            </div>
                        </div>

                        <div style="max-height: 320px;" data-simplebar>
                            @forelse ($notifPending as $item)
                                <a href="{{ route('admin.pengaduan.show', $item) }}"
                                    class="dropdown-item notification-item py-2 text-wrap">
                                    <span class="d-flex gap-2">
                                        <span class="avatar-md flex-shrink-0">
                                            <span
                                                class="avatar-title {{ $item->is_darurat ? 'bg-danger-subtle text-danger' : 'bg-primary-subtle text-primary' }} rounded fs-22">
                                                <i data-lucide="{{ $item->is_darurat ? 'alert-triangle' : 'message-circle' }}"
                                                    class="fs-xl"></i>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1 text-muted">
                                            <span class="fw-medium text-body">
                                                {{ $item->nomor_pengaduan }}
                                                @if ($item->is_darurat)
                                                    <span
                                                        class="badge bg-danger-subtle text-danger fs-xxs ms-1">Darurat</span>
                                                @endif
                                            </span>
                                            <br>
                                            <span class="fs-xs">{{ $item->nama_pelapor }} —
                                                {{ $item->kategori_label }}</span>
                                            <br>
                                            <span
                                                class="fs-xs text-muted">{{ $item->created_at->diffForHumans() }}</span>
                                        </span>
                                    </span>
                                </a>
                            @empty
                                <div class="px-3 py-4 text-center text-muted fs-sm">
                                    Tidak ada pengaduan yang menunggu verifikasi.
                                </div>
                            @endforelse
                        </div>

                        @if ($notifPending->isNotEmpty())
                            <a href="{{ route('admin.pengaduan.index') }}"
                                class="dropdown-item text-center text-reset text-decoration-underline link-offset-2 fw-bold notify-item border-top border-light py-2">
                                Lihat Semua Pengaduan
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Light/Dark Mode Button -->
            <div class="topbar-item d-none d-sm-flex">
                <button class="topbar-link" id="light-dark-mode" type="button">
                    <i data-lucide="moon" class="fs-xxl mode-light-moon"></i>
                    <i data-lucide="sun" class="fs-xxl mode-light-sun"></i>
                </button>
            </div>

            <!-- User Dropdown -->
            <div class="topbar-item nav-user">
                <div class="dropdown">
                    <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown"
                        data-bs-offset="0,16" href="#!" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('img/logo/logo-kokit.jpg') }}" width="32"
                            class="rounded-circle me-lg-2 d-flex" alt="user-image">
                        <div class="d-lg-flex align-items-center gap-1 d-none">
                            <h5 class="my-0">{{ Auth::user()->name }}</h5>
                            <i class="ti ti-chevron-down align-middle"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- Logout -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="javascript:void(0);" class="dropdown-item text-danger fw-semibold"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ti ti-logout-2 me-2 fs-17 align-middle"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>
<!-- Topbar End -->
