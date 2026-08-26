<div class="cek-form-card" id="formCard">
    <form id="formCekStatus" onsubmit="return false;">
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label-custom" for="nomor_pengaduan">Nomor Pengaduan</label>
                <input type="text" id="nomor_pengaduan" name="nomor_pengaduan"
                       class="form-control-custom" placeholder="Contoh: PGD-2026-00125">
            </div>
            <div class="col-12">
                <label class="form-label-custom" for="nomor_whatsapp">Nomor WhatsApp</label>
                <div class="input-group-custom">
                    <span class="input-group-prefix">+62</span>
                    <input type="tel" id="nomor_whatsapp" name="nomor_whatsapp"
                           class="form-control-custom" placeholder="8xxxxxxxxxx">
                </div>
            </div>
        </div>

        <div class="d-grid mt-4">
            <x-button type="submit" id="btnCekStatus" variant="primary" size="lg" icon="bi-search">
                Cek Status Pengaduan
            </x-button>
        </div>

        <div class="form-note-box">
            <i class="bi bi-shield-check"></i>
            <span>
                Nomor WhatsApp digunakan untuk membantu memastikan informasi
                pengaduan hanya dapat diakses oleh pelapor.
            </span>
        </div>
    </form>
</div>
