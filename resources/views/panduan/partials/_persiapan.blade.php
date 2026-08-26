<section class="section">
    <div class="container">
        <x-section-heading
            title="Persiapan Perjalanan"
            subtitle="Simpan informasi penting perjalanan Anda agar lebih mudah ditemukan saat dibutuhkan."
        />

        <div class="persiapan-card">
            <div class="row g-0">
                <div class="col-lg-5">
                    <div class="persiapan-preview">
                        <img src="https://via.placeholder.com/320x220?text=Template+Jemaah+Umrah"
                             alt="Contoh template data jemaah umrah">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="persiapan-content">
                        <h3>Simpan Data Perjalanan Anda</h3>
                        <p>
                            Catat informasi penting perjalanan dalam satu tempat agar
                            mudah diakses saat dibutuhkan.
                        </p>

                        <ul class="data-field-list">
                            <li><i class="bi bi-check-circle"></i> Nama</li>
                            <li><i class="bi bi-check-circle"></i> Asal Travel</li>
                            <li><i class="bi bi-check-circle"></i> Nomor Pembimbing</li>
                            <li><i class="bi bi-check-circle"></i> Hotel Makkah</li>
                            <li><i class="bi bi-check-circle"></i> Hotel Madinah</li>
                        </ul>

                        <p class="persiapan-note">
                            <i class="bi bi-info-circle"></i>
                            Semua data bersifat opsional.
                        </p>

                        <div class="persiapan-actions">
                            {{-- Nantinya mengarah ke form isi data perjalanan --}}
                            <x-button href="#" variant="primary" icon="bi-pencil-square">
                                Isi Data Perjalanan
                            </x-button>
                            <x-button href="#" variant="outline" icon="bi-download">
                                Download Template PDF
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
