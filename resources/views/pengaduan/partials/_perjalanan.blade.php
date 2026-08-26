<div class="form-card" id="section-perjalanan">
    <div class="form-section-title">
        <span class="icon-box"><i class="bi bi-airplane"></i></span>
        <span>Informasi Perjalanan</span>
    </div>
    <p class="form-section-desc">Detail perjalanan ibadah jamaah saat ini.</p>

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label-custom" for="status_perjalanan">Status Perjalanan</label>
            <select id="status_perjalanan" name="status_perjalanan" class="form-select-custom">
                <option value="" selected disabled>Pilih status</option>
                <option value="di_makkah">Sudah berada di Makkah</option>
                <option value="dalam_perjalanan">Sedang dalam perjalanan</option>
                <option value="belum_berangkat">Belum berangkat</option>
                <option value="sudah_kembali">Sudah kembali</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label-custom" for="nomor_paspor">
                Nomor Paspor <span class="form-label-optional">(opsional)</span>
            </label>
            <input type="text" id="nomor_paspor" name="nomor_paspor"
                   class="form-control-custom" placeholder="Contoh: A1234567">
        </div>
        <div class="col-md-6">
            <label class="form-label-custom" for="nomor_visa">Nomor Visa</label>
            <input type="text" id="nomor_visa" name="nomor_visa"
                   class="form-control-custom" placeholder="Nomor visa">
        </div>
        <div class="col-md-6">
            <label class="form-label-custom" for="nama_travel">Nama Travel / Biro Perjalanan</label>
            <input type="text" id="nama_travel" name="nama_travel"
                   class="form-control-custom" placeholder="Nama travel">
        </div>
        <div class="col-md-6">
            <label class="form-label-custom" for="tanggal_berangkat">Tanggal Keberangkatan</label>
            <input type="date" id="tanggal_berangkat" name="tanggal_berangkat"
                   class="form-control-custom">
        </div>
        <div class="col-md-6">
            <label class="form-label-custom" for="tanggal_pulang">Tanggal Rencana Kepulangan</label>
            <input type="date" id="tanggal_pulang" name="tanggal_pulang"
                   class="form-control-custom">
        </div>
        <div class="col-12">
            <label class="form-label-custom" for="status_tiket">Status Tiket Pulang</label>
            <select id="status_tiket" name="status_tiket" class="form-select-custom">
                <option value="" selected disabled>Pilih status tiket</option>
                <option value="sudah_ada">Sudah memiliki tiket</option>
                <option value="belum_ada">Belum memiliki tiket</option>
                <option value="bermasalah">Tiket bermasalah</option>
                <option value="tidak_tahu">Tidak tahu</option>
            </select>
        </div>
    </div>
</div>
