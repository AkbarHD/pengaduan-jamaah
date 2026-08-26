<div class="form-card" id="section-masalah">
    <div class="form-section-title">
        <span class="icon-box"><i class="bi bi-exclamation-diamond"></i></span>
        <span>Detail Permasalahan</span>
    </div>
    <p class="form-section-desc">Jelaskan kondisi dan permasalahan yang Anda alami.</p>

    <label class="form-label-custom mb-2">Apakah kondisi ini darurat?</label>
    <div class="radio-card-group mb-3">
        <label class="radio-card radio-card-danger" id="cardDarurat">
            <input type="radio" name="tingkat_urgensi" value="darurat">
            <span class="radio-dot"></span>
            <span class="radio-text">
                <span class="icon-badge d-block"><i class="bi bi-exclamation-triangle-fill"></i></span>
                <strong>Ya, Ini Darurat</strong>
                <span>Saya membutuhkan bantuan segera</span>
            </span>
        </label>
        <label class="radio-card is-checked" id="cardTidakDarurat">
            <input type="radio" name="tingkat_urgensi" value="tidak_darurat" checked>
            <span class="radio-dot"></span>
            <span class="radio-text">
                <span class="icon-badge d-block"><i class="bi bi-chat-square-text"></i></span>
                <strong>Tidak, Bukan Darurat</strong>
                <span>Saya ingin menyampaikan permasalahan</span>
            </span>
        </label>
    </div>

    <div id="alertDarurat" class="alert-emergency d-none">
        <div class="icon-box"><i class="bi bi-info-circle-fill"></i></div>
        <div>
            <h5>Pengaduan darurat akan diprioritaskan</h5>
            <p>
                Setelah pengaduan dikirim, Anda akan diarahkan untuk menghubungi
                KJRI melalui WhatsApp agar dapat segera ditindaklanjuti.
            </p>
        </div>
    </div>

    <hr class="my-4" style="border-color: var(--color-border);">

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label-custom" for="kategori_masalah">Kategori Masalah</label>
            <select id="kategori_masalah" name="kategori_masalah" class="form-select-custom">
                <option value="" selected disabled>Pilih kategori</option>
                <option value="tiket_kepulangan">Tiket / Kepulangan</option>
                <option value="travel">Travel</option>
                <option value="dokumen">Dokumen</option>
                <option value="penipuan">Penipuan</option>
                <option value="akomodasi">Akomodasi</option>
                <option value="keuangan">Keuangan</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label-custom" for="tanggal_kejadian">Tanggal Kejadian</label>
            <input type="date" id="tanggal_kejadian" name="tanggal_kejadian"
                   class="form-control-custom">
        </div>
        <div class="col-12">
            <label class="form-label-custom" for="lokasi_kejadian">Lokasi Kejadian</label>
            <input type="text" id="lokasi_kejadian" name="lokasi_kejadian"
                   class="form-control-custom" placeholder="Contoh: Hotel di Makkah, Bandara Jeddah">
        </div>
        <div class="col-12">
            <label class="form-label-custom" for="ceritakan_masalah">Ceritakan Permasalahan</label>
            <textarea id="ceritakan_masalah" name="ceritakan_masalah" class="form-control-custom"
                      placeholder="Jelaskan kronologi dan kendala yang Anda alami secara rinci"></textarea>
        </div>
    </div>
</div>