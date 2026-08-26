<footer class="site-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="footer-brand">
                    <img src="{{ asset('img/logo/logo.png') }}" alt="Layanan Jamaah" style="height: 32px; width: auto;">
                    <span>Layanan Jamaah</span>
                </div>
                <p class="text-muted-custom">
                    Platform informasi dan pengaduan bagi jamaah haji &amp; umroh yang
                    menghadapi kendala selama perjalanan, menghubungkan Anda dengan
                    pihak berwenang seperti KJRI secara cepat dan tepat.
                </p>
                <div class="d-flex gap-2 mt-3">
                    <a href="https://www.instagram.com/kknarabsaudi.uinbdg?utm_source=ig_web_button_share_sheet&igsi=ZDNlZDc0MzIxNw=="
                       target="_blank" rel="noopener" class="social-icon" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="https://wa.me/6281356935182" target="_blank" rel="noopener" class="social-icon" aria-label="WhatsApp">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                    <a href="https://www.tiktok.com/@kknarabsaudiuinbdg" target="_blank" rel="noopener" class="social-icon" aria-label="TikTok">
                        <i class="bi bi-tiktok"></i>
                    </a>
                </div>
            </div>

            <div class="col-6 col-lg-2">
                <div class="footer-heading">Navigasi</div>
                <ul class="footer-link-list">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('panduan') }}">Panduan &amp; Pencegahan</a></li>
                    <li><a href="{{ route('faq') }}">FAQ</a></li>
                    <li><a href="{{ route('tentang') }}">Tentang</a></li>
                </ul>
            </div>

            <div class="col-6 col-lg-3">
                <div class="footer-heading">Layanan</div>
                <ul class="footer-link-list">
                    <li><a href="{{ route('pengaduan') }}">Buat Pengaduan</a></li>
                    <li><a href="{{ route('cek-status') }}">Cek Status Pengaduan</a></li>
                </ul>
            </div>

            <div class="col-lg-3">
                <div class="footer-heading">Kontak</div>
                <ul class="footer-link-list">
                    <li>
                        <i class="bi bi-whatsapp me-2 text-primary-custom"></i>
                        <a href="https://wa.me/6281356935182" target="_blank" rel="noopener">0813-5693-5182</a>
                    </li>
                    <li>
                        <i class="bi bi-tiktok me-2 text-primary-custom"></i>
                        <a href="https://www.tiktok.com/@kknarabsaudiuinbdg" target="_blank" rel="noopener">@kknarabsaudiuinbdg</a>
                    </li>
                    <li>
                        <i class="bi bi-instagram me-2 text-primary-custom"></i>
                        <a href="https://www.instagram.com/kknarabsaudi.uinbdg" target="_blank" rel="noopener">@kknarabsaudi.uinbdg</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <span>&copy; {{ date('Y') }} Layanan Jamaah. Proyek KKN — Seluruh hak dilindungi.</span>
            <span>Dibuat untuk membantu jamaah haji &amp; umroh Indonesia.</span>
        </div>
    </div>
</footer>
