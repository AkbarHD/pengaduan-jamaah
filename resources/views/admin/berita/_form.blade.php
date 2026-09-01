<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Judul Berita <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                        placeholder="Contoh: Update Terbaru Layanan Jamaah"
                        value="{{ old('judul', $berita->judul ?? '') }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Singkat <span class="text-danger">*</span></label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="2" maxlength="500"
                        placeholder="Ringkasan 1-2 kalimat, tampil di kartu berita" required>{{ old('deskripsi', $berita->deskripsi ?? '') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Maksimal 500 karakter.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Konten Lengkap <span class="text-danger">*</span></label>
                    <div id="editorKonten" style="min-height: 260px; background: #fff;">
                        {!! old('konten', $berita->konten ?? '') !!}
                    </div>
                    <textarea name="konten" id="kontenInput" class="d-none @error('konten') is-invalid @enderror">{{ old('konten', $berita->konten ?? '') }}</textarea>
                    @error('konten')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Isi lengkap berita yang tampil di halaman detail.</small>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="draft"
                            {{ old('status', $berita->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published"
                            {{ old('status', $berita->status ?? '') === 'published' ? 'selected' : '' }}>Published
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror"
                        placeholder="Contoh: Tim KKN UIN Bandung" value="{{ old('penulis', $berita->penulis ?? '') }}">
                    @error('penulis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Nama yang tampil sebagai penulis berita.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Thumbnail Berita</label>

                    @isset($berita)
                        @if ($berita->thumbnail)
                            <div class="mb-2">
                                <img src="{{ asset('uploads/berita-thumbnail/' . $berita->thumbnail) }}"
                                    alt="Thumbnail saat ini" class="img-fluid rounded border" style="max-height: 140px;">
                            </div>
                        @endif
                    @endisset

                    <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png,.webp">
                    @error('thumbnail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Format JPG, PNG, atau WEBP. Maksimal 2 MB.</small>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i>
                        {{ isset($berita) ? 'Simpan Perubahan' : 'Simpan Berita' }}
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quill-table-better@1.1.6/dist/quill-table-better.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill-table-better@1.1.6/dist/quill-table-better.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Quill.register({
                'modules/table-better': QuillTableBetter
            }, true);

            const quill = new Quill('#editorKonten', {
                theme: 'snow',
                placeholder: 'Tulis isi lengkap berita di sini...',
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, 3, 4, 5, 6, false]
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
                        ['blockquote', 'code-block'],
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
                        ['link', 'image', 'video'],
                        ['table-better'],
                        ['clean'],
                    ],
                    table: false,
                    'table-better': {
                        language: 'en_US',
                        menus: ['column', 'row', 'merge', 'table', 'cell', 'wrap', 'copy', 'delete'],
                        toolbarTable: true,
                    },
                    keyboard: {
                        bindings: QuillTableBetter.keyboardBindings,
                    },
                },
            });

            const kontenInput = document.getElementById('kontenInput');
            const form = kontenInput.closest('form');

            form.addEventListener('submit', function(e) {
                kontenInput.value = quill.root.innerHTML;

                const isEmpty = quill.getText().trim().length === 0;
                if (isEmpty) {
                    e.preventDefault();
                    if (window.Swal) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Konten belum diisi',
                            text: 'Mohon isi konten berita sebelum menyimpan.',
                            confirmButtonColor: '#2563EB',
                        });
                    }
                }
            });
        });
    </script>
@endpush
