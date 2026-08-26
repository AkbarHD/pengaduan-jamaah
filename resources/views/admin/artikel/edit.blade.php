@extends('layouts.layout')

@section('title', 'Edit Artikel')

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="page-title-head d-flex align-items-center mb-3">
            <div class="flex-grow-1">
                <h4 class="mb-0">Edit Artikel</h4>
            </div>
            <a href="{{ route('admin.artikel.index') }}" class="btn btn-light">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.artikel.update', $artikel) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.artikel._form')
        </form>

    </div>
</div>
@endsection
