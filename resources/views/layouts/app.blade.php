<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Layanan Pengaduan Jamaah Haji & Umroh')</title>
    <meta name="description" content="@yield('description', 'Platform informasi dan pengaduan bagi jamaah haji dan umroh yang mengalami masalah selama perjalanan.')">

    {{-- Google Fonts: Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="{{ asset('img/logo/logo.png') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:wght@500;600;700&display=swap"
        rel="stylesheet">
    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Custom App CSS (design tokens & override) --}}
    <link rel="stylesheet" href="{{ asset('css/front.css') }}">

    @stack('styles')
</head>

<body>

    <x-navbar />

    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <x-footer />

    {{-- Bootstrap Bundle (includes Popper) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Custom App JS --}}
    <script src="{{ asset('js/front.js') }}"></script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: @json(session('success')),
                    confirmButtonColor: '#2563EB',
                });
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Periksa Kembali Data Anda',
                    html: @json(implode('<br>', $errors->all())),
                    confirmButtonColor: '#2563EB',
                });
            });
        </script>
    @endif

    @stack('scripts')
</body>

</html>
