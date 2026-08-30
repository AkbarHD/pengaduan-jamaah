document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('formCekStatus');
    const formCard = document.getElementById('formCard');
    const resultWrapper = document.getElementById('resultWrapper');
    const emptyResultWrapper = document.getElementById('emptyResultWrapper');

    const statusClassMap = {
        pending: 'status-pending',
        verifikasi: 'status-verifikasi',
        selesai: 'status-selesai',
        batal: 'status-batal',
    };

    function renderTimeline(riwayat) {
        const timelineList = document.getElementById('timelineList');
        timelineList.innerHTML = '';

        riwayat.forEach((item) => {
            const el = document.createElement('div');
            el.className = 'timeline-item';
            el.innerHTML = `
                <div class="timeline-date">${item.tanggal}</div>
                <h5>${item.judul}</h5>
                <p class="text-muted-custom">${item.catatan ?? ''}</p>
            `;
            timelineList.appendChild(el);
        });
    }

    function showResult(data) {
        document.getElementById('resultNomor').textContent = data.nomor_pengaduan;

        const badge = document.getElementById('resultBadge');
        badge.className = 'status-badge ' + (statusClassMap[data.status] ?? '');
        document.getElementById('resultBadgeText').textContent = data.status_label;
        document.getElementById('resultStatusText').textContent = data.status_description;
        document.getElementById('resultDetailStatus').textContent = data.status_label;

        const cancelBox = document.getElementById('cancelReasonBox');
        if (data.status === 'batal' && data.alasan_pembatalan) {
            cancelBox.classList.remove('d-none');
            document.getElementById('cancelReasonText').textContent = data.alasan_pembatalan;
        } else {
            cancelBox.classList.add('d-none');
        }

        renderTimeline(data.riwayat);

        formCard.classList.add('d-none');
        emptyResultWrapper.classList.add('d-none');
        resultWrapper.classList.remove('d-none');
        resultWrapper.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }

    function showEmptyState() {
        formCard.classList.add('d-none');
        resultWrapper.classList.add('d-none');
        emptyResultWrapper.classList.remove('d-none');
        emptyResultWrapper.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }

    function resetForm() {
        formCard.classList.remove('d-none');
        resultWrapper.classList.add('d-none');
        emptyResultWrapper.classList.add('d-none');
        form.reset();
        formCard.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const nomorPengaduan = document.getElementById('nomor_pengaduan').value.trim();
        const whatsapp = document.getElementById('nomor_whatsapp').value.trim();

        if (!nomorPengaduan || !whatsapp) {
            Swal.fire({
                icon: 'warning',
                title: 'Data belum lengkap',
                text: 'Mohon isi nomor pengaduan dan nomor WhatsApp terlebih dahulu.',
                confirmButtonColor: '#2563EB',
            });
            return;
        }

        const submitBtn = document.getElementById('btnCekStatus');
        const originalHtml = submitBtn.innerHTML;

        submitBtn.disabled = true;
        submitBtn.classList.add('is-loading');
        submitBtn.innerHTML = `
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Memeriksa Status...
    `;

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/cek-status/check', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    nomor_pengaduan: nomorPengaduan,
                    whatsapp: whatsapp,
                }),
            })
            .then((res) => res.json())
            .then((res) => {
                if (res.found) {
                    showResult(res.data);
                } else {
                    showEmptyState();
                }
            })
            .catch(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Tidak dapat memeriksa status saat ini. Silakan coba lagi.',
                    confirmButtonColor: '#2563EB',
                });
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.classList.remove('is-loading');
                submitBtn.innerHTML = originalHtml;
            });
    });

    document.getElementById('btnCariLagi').addEventListener('click', resetForm);
    document.getElementById('btnCobaLagi').addEventListener('click', resetForm);

});
