<div id="resultWrapper" class="d-none mt-4">

    {{-- ============ STATUS UTAMA ============ --}}
    <div class="result-card">
        <div class="result-label">Status Pengaduan</div>
        <div class="result-nomor" id="resultNomor">PGD-2026-00125</div>

        <span class="status-badge" id="resultBadge">
            <span class="dot"></span>
            <span id="resultBadgeText">Verifikasi</span>
        </span>

        <p class="result-status-text" id="resultStatusText">
            Pengaduan Anda sedang diperiksa oleh petugas.
        </p>

        {{-- Alasan pembatalan — hanya tampil jika status Batal --}}
        <div class="cancel-reason-box d-none" id="cancelReasonBox">
            <div class="result-label">Alasan Pembatalan</div>
            <p id="cancelReasonText">
                Data yang diberikan belum cukup untuk melanjutkan proses pengaduan.
            </p>
        </div>
    </div>

    {{-- ============ DETAIL PENGADUAN ============ --}}
    <div class="result-card">
        <div class="result-label mb-2">Detail Pengaduan</div>
        <ul class="detail-list">
            <li>
                <span class="detail-key">Kategori</span>
                <span class="detail-value">Tiket / Kepulangan</span>
            </li>
            <li>
                <span class="detail-key">Tanggal Pengaduan</span>
                <span class="detail-value">12 Agustus 2026</span>
            </li>
            <li>
                <span class="detail-key">Status</span>
                <span class="detail-value" id="resultDetailStatus">Verifikasi</span>
            </li>
        </ul>
    </div>

    {{-- ============ RIWAYAT PENGADUAN ============ --}}
    <div class="result-card">
        <div class="result-label mb-3">Riwayat Pengaduan</div>
        <div class="timeline" id="timelineList">
            {{-- Diisi otomatis oleh JavaScript sesuai status --}}
        </div>
    </div>

    <div class="text-center mt-4">
        <button type="button" class="site-btn site-btn-outline" id="btnCariLagi">
            <i class="bi bi-arrow-counterclockwise"></i> Cari Pengaduan Lain
        </button>
    </div>
</div>
