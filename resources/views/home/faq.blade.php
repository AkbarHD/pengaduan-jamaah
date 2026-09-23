@extends('layouts.app')

@section('title', 'FAQ — Layanan Jamaah Haji & Umroh')
@section('description', 'Pertanyaan yang sering ditanyakan seputar layanan pengaduan jamaah haji dan umroh.')

@section('content')

  <section class="faq-hero">
    <div class="container">
        <div class="container-narrow">
            <span class="section-eyebrow">
                <i class="bi bi-question-circle"></i>
                Bantuan
            </span>
            <h1 class="section-title">Pertanyaan yang Sering Ditanyakan</h1>
            <p class="section-subtitle mx-auto">
                Temukan jawaban seputar cara berbagi pengalaman dan membaca
                kisah jamaah lain di Layanan Jamaah.
            </p>
        </div>
    </div>
</section>

<section class="section-sm">
    <div class="container">
        <div class="container-narrow">

            @php
                $faqs = [
                    [
                        'question' => 'Bagaimana cara membagikan pengalaman saya?',
                        'answer' => 'Klik tombol "Bagikan Pengalaman", isi judul, ringkasan singkat, dan ceritakan pengalaman Anda selengkap mungkin. Anda tidak perlu membuat akun untuk mengirimkannya.',
                    ],
                    [
                        'question' => 'Apakah cerita saya langsung tayang setelah dikirim?',
                        'answer' => 'Belum. Setiap cerita akan ditinjau terlebih dahulu oleh tim kami untuk memastikan kelayakan konten sebelum dipublikasikan di halaman Berita.',
                    ],
                    [
                        'question' => 'Berapa lama proses peninjauan cerita saya?',
                        'answer' => 'Proses peninjauan umumnya berlangsung dalam beberapa hari kerja, tergantung jumlah cerita yang masuk.',
                    ],
                    [
                        'question' => 'Apakah saya bisa menggunakan nama samaran?',
                        'answer' => 'Ya. Anda bebas mengisi nama panggilan atau nama samaran pada kolom "Nama Anda" saat mengirimkan cerita.',
                    ],
                    [
                        'question' => 'Apakah saya bisa menyertakan foto pada cerita saya?',
                        'answer' => 'Ya, Anda dapat mengunggah satu foto pendukung berformat JPG, PNG, atau WEBP dengan ukuran maksimal 2 MB.',
                    ],
                    [
                        'question' => 'Di mana saya bisa membaca kisah jamaah lain?',
                        'answer' => 'Seluruh cerita yang telah disetujui dapat dibaca melalui halaman "Berita".',
                    ],
                ];
            @endphp

            <div class="accordion faq-accordion" id="faqAccordion">
                @foreach ($faqs as $index => $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqHeading{{ $index }}">
                            <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faqCollapse{{ $index }}"
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-controls="faqCollapse{{ $index }}">
                                {{ $faq['question'] }}
                            </button>
                        </h2>
                        <div id="faqCollapse{{ $index }}"
                            class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                            aria-labelledby="faqHeading{{ $index }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {{ $faq['answer'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</section>

    {{-- ============ CTA KECIL ============ --}}
    <section class="section-sm">
        <div class="container">
            <div class="site-cta d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4">
                <div>
                    <h2>Punya Pengalaman Menarik di Tanah Suci?</h2>
                    <p>Bagikan kisah Anda agar dapat menginspirasi dan membantu jamaah lain.</p>
                </div>
                <x-button href="{{ route('sharing.create') }}" variant="primary" size="lg" icon="bi-pencil-square">
                    Bagikan Pengalaman Anda
                </x-button>
            </div>
        </div>
    </section>

@endsection
