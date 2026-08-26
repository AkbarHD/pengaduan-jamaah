<div class="form-card" id="section-pelapor">
    <div class="form-section-title">
        <span class="icon-box"><i class="bi bi-person-lines-fill"></i></span>
        <span>Informasi Pelapor</span>
    </div>
    <p class="form-section-desc">Data diri Anda sebagai pihak yang membuat pengaduan.</p>

    {{-- Pengaduan untuk siapa --}}
    <label class="form-label-custom mb-2">Pengaduan ini dibuat untuk:</label>
    <div class="radio-card-group mb-4">
        <label class="radio-card is-checked" id="cardDiriSendiri">
            <input type="radio" name="jenis_pelapor" value="diri_sendiri" checked>
            <span class="radio-dot"></span>
            <span class="radio-text">
                <strong>Diri Sendiri</strong>
                <span>Saya yang mengalami masalah ini</span>
            </span>
        </label>
        <label class="radio-card" id="cardMewakili">
            <input type="radio" name="jenis_pelapor" value="mewakili">
            <span class="radio-dot"></span>
            <span class="radio-text">
                <strong>Mewakili Orang Lain</strong>
                <span>Melaporkan atas nama jamaah lain</span>
            </span>
        </label>
    </div>

    {{-- Field tambahan jika mewakili --}}
    <div id="wakilFields" class="row g-3 mb-2 d-none">
        <div class="col-md-7">
            <label class="form-label-custom" for="nama_jamaah_diwakili">Nama Jamaah yang Diwakili</label>
            <input type="text" id="nama_jamaah_diwakili" name="nama_jamaah_diwakili"
                   class="form-control-custom" placeholder="Contoh: Siti Aminah">
        </div>
        <div class="col-md-5">
            <label class="form-label-custom" for="hubungan_jamaah">Hubungan dengan Jamaah</label>
            <select id="hubungan_jamaah" name="hubungan_jamaah" class="form-select-custom">
                <option value="" selected disabled>Pilih hubungan</option>
                <option value="anak">Anak</option>
                <option value="orang_tua">Orang Tua</option>
                <option value="cucu">Cucu</option>
                <option value="saudara">Saudara</option>
                <option value="kerabat">Kerabat</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>
    </div>

    <hr class="my-4" style="border-color: var(--color-border);">

    {{-- Data pelapor --}}
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label-custom" for="nama_pelapor">Nama Lengkap</label>
            <input type="text" id="nama_pelapor" name="nama_pelapor"
                   class="form-control-custom" placeholder="Nama lengkap Anda">
        </div>
        <div class="col-md-6">
            <label class="form-label-custom" for="whatsapp_pelapor">Nomor WhatsApp</label>
            <input type="tel" id="whatsapp_pelapor" name="whatsapp_pelapor"
                   class="form-control-custom" placeholder="08xxxxxxxxxx">
        </div>
        <div class="col-md-6">
            <label class="form-label-custom" for="email_pelapor">
                Email <span class="form-label-optional">(opsional)</span>
            </label>
            <input type="email" id="email_pelapor" name="email_pelapor"
                   class="form-control-custom" placeholder="nama@email.com">
        </div>
    </div>
</div>
