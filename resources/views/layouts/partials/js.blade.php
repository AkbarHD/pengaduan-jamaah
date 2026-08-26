<script src="{{ asset('assets/js/vendors.min.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>

{{-- Custom Table Inspinia --}}
<script src="{{ asset('assets/js/pages/custom-table.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            timer: 1800,
            showConfirmButton: false
        });
    </script>
@endif