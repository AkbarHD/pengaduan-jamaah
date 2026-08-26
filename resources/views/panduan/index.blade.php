@extends('layouts.app')

@section('title', 'Panduan & Pencegahan — Layanan Jamaah Haji & Umroh')
@section('description', 'Informasi untuk membantu Anda mempersiapkan perjalanan dan menghadapi berbagai kendala selama ibadah haji dan umroh.')

@section('content')

    @include('panduan.partials._header')

    <section class="section-sm pt-0">
        <div class="container">
            @include('panduan.partials._filter')
            @include('panduan.partials._artikel')
        </div>
    </section>

    @include('panduan.partials._cta')

@endsection
