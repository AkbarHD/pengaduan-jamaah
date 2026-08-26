@extends('layouts.app')

@section('title', 'FAQ — Layanan Jamaah Haji & Umroh')
@section('description', 'Pertanyaan yang sering ditanyakan seputar layanan pengaduan jamaah haji dan umroh.')

@section('content')

    {{-- ============ JUDUL ============ --}}
    <section class="faq-hero">
        <div class="container">
            <div class="container-narrow">
                {{-- <span class="section-eyebrow">
                    <i class="bi bi-question-circle"></i>
                    Bantuan
                </span> --}}
                <h1 class="section-title">Pertanyaan yang Sering Ditanyakan</h1>
                <p class="section-subtitle mx-auto">
                    Temukan jawaban atas pertanyaan umum seputar layanan pengaduan
                    dan alur bantuan bagi jamaah haji &amp; umroh.
                </p>
            </div>
        </div>
    </section>

    {{-- ============ FAQ ACCORDION ============ --}}
    <section class="section-sm">
        <div class="container">
            <div class="container-narrow">

                @php
                    $faqs = [
                        [
                            'question' => 'Bagaimana cara membuat pengaduan?',
                            'answer'   => 'Isi formulir pengaduan tanpa perlu membuat akun. Setelah dikirim, Anda akan mendapatkan nomor pengaduan.',
                        ],
                        [
                            'question' => 'Apakah saya bisa melaporkan orang lain?',
                            'answer'   => 'Ya. Pilih opsi mewakili orang lain, lalu isi nama dan hubungan Anda dengan orang tersebut.',
                        ],
                        [
                            'question' => 'Apa yang harus dilakukan jika kondisi darurat?',
                            'answer'   => 'Pilih opsi "Darurat" saat membuat pengaduan. Setelah dikirim, Anda akan diarahkan untuk menghubungi KJRI melalui WhatsApp.',
                        ],
                        [
                            'question' => 'Bagaimana cara mengecek pengaduan?',
                            'answer'   => 'Gunakan menu "Cek Status Pengaduan" dengan memasukkan nomor pengaduan dan nomor WhatsApp.',
                        ],
                        [
                            'question' => 'Apa arti status pengaduan?',
                            'answer'   => 'Pending berarti menunggu pemeriksaan, Verifikasi berarti sedang diperiksa, Selesai berarti telah selesai diproses, dan Batal berarti pengaduan tidak dilanjutkan.',
                        ],
                        [
                            'question' => 'Apakah saya akan dihubungi setelah membuat pengaduan?',
                            'answer'   => 'Jika diperlukan, petugas dapat menghubungi pelapor melalui nomor WhatsApp yang diberikan.',
                        ],
                        [
                            'question' => 'Di mana saya bisa mendapatkan panduan sebelum berangkat?',
                            'answer'   => 'Informasi tersedia di halaman "Panduan & Pencegahan".',
                        ],
                        [
                            'question' => 'Apakah panduan dapat diunduh?',
                            'answer'   => 'Ya, panduan tertentu tersedia dalam format PDF untuk diunduh.',
                        ],
                    ];
                @endphp

                <div class="accordion faq-accordion" id="faqAccordion">
                    @foreach ($faqs as $index => $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading{{ $index }}">
                                <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#faqCollapse{{ $index }}"
                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-controls="faqCollapse{{ $index }}">
                                    {{ $faq['question'] }}
                                </button>
                            </h2>
                            <div id="faqCollapse{{ $index }}"
                                 class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                 aria-labelledby="faqHeading{{ $index }}"
                                 data-bs-parent="#faqAccordion">
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
    <section class="section-sm pt-0">
        <div class="container">
            <div class="container-narrow">
                <div class="faq-cta-box">
                    <h3>Tidak menemukan jawaban yang Anda cari?</h3>
                    <p>Sampaikan langsung kendala Anda melalui halaman pengaduan.</p>
                    <x-button href="{{ url('/pengaduan') }}" variant="primary" size="lg" icon="bi-megaphone">
                        Buat Pengaduan
                    </x-button>
                </div>
            </div>
        </div>
    </section>

@endsection