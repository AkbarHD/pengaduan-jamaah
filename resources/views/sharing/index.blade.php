@extends('layouts.app')

@section('title', 'Bagikan Pengalaman — Layanan Jamaah Haji & Umroh')
@section('description', 'Ceritakan pengalaman ibadah haji dan umroh Anda untuk menginspirasi jamaah lain.')

@section('content')

    <section class="form-hero">
        <div class="container">
            <span class="section-eyebrow">
                <i class="bi bi-pencil-square"></i>
                Sharing Pengalaman
            </span>
            <h1>Bagikan Pengalaman Anda</h1>
            <p class="text-muted-custom">
                Ceritakan kisah, momen berkesan, atau tips yang Anda alami selama
                beribadah di Tanah Suci. Cerita Anda akan ditinjau tim kami
                sebelum tayang di halaman Berita.
            </p>
        </div>
    </section>

    <section class="section-sm">
        <div class="container">
            <div class="container-narrow">

                <form id="formSharing" action="{{ route('sharing.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-card">
                        <div class="form-section-title">
                            <span class="icon-box"><i class="bi bi-person"></i></span>
                            <span>Data Anda</span>
                        </div>
                        <p class="form-section-desc">Nama ini akan ditampilkan sebagai penulis cerita.</p>

                        <label class="form-label-custom" for="penulis">
                            Nama Anda <span class="form-label-optional">(opsional, boleh nama panggilan)</span>
                        </label>
                        <input type="text" id="penulis" name="penulis" class="form-control-custom"
                            placeholder="Contoh: Siti dari Bandung">
                    </div>

                    <div class="form-card">
                        <div class="form-section-title">
                            <span class="icon-box"><i class="bi bi-journal-text"></i></span>
                            <span>Cerita Anda</span>
                        </div>
                        <p class="form-section-desc">Tulis dengan bahasa Anda sendiri, sesantai bercerita ke teman.</p>

                        <div class="mb-3">
                            <label class="form-label-custom" for="judul">Judul Cerita</label>
                            <input type="text" id="judul" name="judul" class="form-control-custom"
                                placeholder="Contoh: Momen Haru Pertama Kali Melihat Ka'bah">
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom" for="deskripsi">Ringkasan Singkat</label>
                            <textarea id="deskripsi" name="deskripsi" class="form-control-custom" rows="2" maxlength="500"
                                placeholder="1-2 kalimat yang menggambarkan cerita Anda"></textarea>
                            <p class="form-hint">Akan tampil sebagai cuplikan di halaman Berita.</p>
                        </div>

                        <div>
                            <label class="form-label-custom" for="editorKonten">Ceritakan Pengalaman Anda</label>
                            <div id="editorKonten" style="min-height: 220px; background: #fff;"></div>
                            <textarea name="konten" id="kontenInput" class="d-none"></textarea>
                            <p class="form-hint">Gunakan toolbar untuk mengatur format tulisan, tambah foto, atau tautan.
                            </p>
                        </div>
                    </div>

                    <div class="form-card">
                        <div class="form-section-title">
                            <span class="icon-box"><i class="bi bi-image"></i></span>
                            <span>Foto Pendukung</span>
                        </div>
                        <p class="form-section-desc">Opsional — tambahkan foto yang berkaitan dengan cerita Anda.</p>

                        <div class="upload-zone" id="uploadZone">
                            <div class="upload-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                            <p>Klik atau seret foto ke sini untuk mengunggah</p>
                            <span>Format JPG, PNG, WEBP — Maksimal 2 MB</span>
                            <input type="file" id="thumbnailInput" name="thumbnail" class="d-none"
                                accept=".jpg,.jpeg,.png,.webp">
                        </div>

                        <div id="thumbnailPreviewWrapper" class="mt-3 d-none">
                            <img id="thumbnailPreview" src="" alt="Preview foto" class="img-fluid rounded border"
                                style="max-height: 220px;">
                        </div>
                    </div>

                    <div class="form-card">
                        <div class="confirm-check">
                            <input type="checkbox" id="konfirmasi" name="konfirmasi">
                            <label for="konfirmasi">
                                Saya memastikan cerita ini benar merupakan pengalaman saya sendiri.
                            </label>
                        </div>
                    </div>

                    <div class="submit-bar">
                        <div class="d-grid">
                            <x-button type="submit" variant="primary" size="lg" icon="bi-send">
                                Kirim Cerita Saya
                            </x-button>
                        </div>
                        <p class="form-hint">
                            Cerita Anda akan ditinjau tim kami terlebih dahulu sebelum
                            tayang di halaman Berita.
                        </p>
                    </div>

                </form>

            </div>
        </div>
    </section>

@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* ===== Quill Editor — Full Toolbar ===== */
            const quill = new Quill('#editorKonten', {
                theme: 'snow',
                placeholder: 'Tulis cerita Anda di sini...',
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, 3, false]
                        }],
                        [{
                            font: []
                        }],
                        [{
                            size: ['small', false, 'large', 'huge']
                        }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{
                            color: []
                        }, {
                            background: []
                        }],
                        [{
                            script: 'sub'
                        }, {
                            script: 'super'
                        }],
                        ['blockquote'],
                        [{
                            list: 'ordered'
                        }, {
                            list: 'bullet'
                        }],
                        [{
                            indent: '-1'
                        }, {
                            indent: '+1'
                        }],
                        [{
                            align: []
                        }],
                        ['link', 'image'],
                        ['clean'],
                    ],
                },
            });

            const kontenInput = document.getElementById('kontenInput');
            const form = document.getElementById('formSharing');

            /* ===== Upload & Preview Foto ===== */
            const uploadZone = document.getElementById('uploadZone');
            const thumbnailInput = document.getElementById('thumbnailInput');
            const thumbnailPreview = document.getElementById('thumbnailPreview');
            const thumbnailPreviewWrapper = document.getElementById('thumbnailPreviewWrapper');

            uploadZone.addEventListener('click', () => thumbnailInput.click());
            uploadZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadZone.classList.add('is-dragover');
            });
            uploadZone.addEventListener('dragleave', () => uploadZone.classList.remove('is-dragover'));
            uploadZone.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadZone.classList.remove('is-dragover');
                thumbnailInput.files = e.dataTransfer.files;
                showPreview();
            });
            thumbnailInput.addEventListener('change', showPreview);

            function showPreview() {
                const file = thumbnailInput.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = (e) => {
                    thumbnailPreview.src = e.target.result;
                    thumbnailPreviewWrapper.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }

            /* ===== Submit: sinkron Quill ke textarea + loading state ===== */
            form.addEventListener('submit', function(e) {
                kontenInput.value = quill.root.innerHTML;

                if (quill.getText().trim().length === 0) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Cerita belum diisi',
                        text: 'Mohon ceritakan pengalaman Anda terlebih dahulu.',
                        confirmButtonColor: '#2563EB',
                    });
                    return;
                }

                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML =
                        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim Cerita...`;
                }
            });

        });
    </script>
@endpush
