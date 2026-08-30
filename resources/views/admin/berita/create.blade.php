@extends('layouts.layout')

@section('title', 'Tambah Berita')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="page-title-head d-flex align-items-center mb-3">
            <div class="flex-grow-1">
                <h4 class="mb-0">Tambah Berita</h4>
            </div>
            <a href="{{ route('admin.berita.index') }}" class="btn btn-light">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.berita._form')
        </form>
    </div>
</div>
@endsection