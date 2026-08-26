@extends('layouts.auth')
@section('title', 'Login')
@section('content')
<div class="auth-box d-flex align-items-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-6 col-md-8">

                <div class="card border-0 rounded-4">
                    <div class="card-body p-5">

                        {{-- Logo --}}
                        <div class="text-center mb-4">

                            <h3 class="fw-bold ">
                                Selamat Datang 👋
                            </h3>

                            <p class="text-muted mb-0">
                                Silakan masuk menggunakan akun Anda untuk
                                melanjutkan aktivitas di sistem.
                            </p>

                        </div>

                        {{-- Form Login --}}
                        <form action="{{ route('login.authenticate') }}" method="POST">

                            @csrf

                            {{-- Email --}}
                            <div class="mb-3">

                                <label for="email" class="form-label">
                                    Alamat Email
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light">
                                        <i class="ti ti-mail text-muted"></i>
                                    </span>

                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Masukkan alamat email"
                                        value="{{ old('email') }}"
                                        required
                                        autofocus>

                                </div>

                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Password --}}
                            <div class="mb-3">

                                <label for="password" class="form-label">
                                    Kata Sandi
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light">
                                        <i class="ti ti-lock-password text-muted"></i>
                                    </span>

                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Masukkan kata sandi"
                                        required>

                                </div>

                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Remember --}}
                            <div class="d-flex justify-content-between align-items-center mb-4">

                                <div class="form-check">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="remember"
                                        name="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Ingat saya
                                    </label>

                                </div>



                            </div>

                            {{-- Button --}}
                            <div class="d-grid">

                                <button
                                    type="submit"
                                    class="btn btn-primary py-2 fw-semibold">

                                    Masuk

                                </button>

                            </div>

                        </form>

                        {{-- Home --}}
                        <p class="text-center mb-4 mt-3">

                            <a href="{{ url('/') }}"
                                class="text-muted text-decoration-none">

                                ← Kembali ke Website

                            </a>

                        </p>

                        <hr>

                        {{-- Footer --}}
                        <p class="text-center text-muted small mb-0">

                            © {{ date('Y') }}
                            {{ config('app.name') }}.
                            Seluruh Hak Cipta Dilindungi.

                        </p>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
