document.addEventListener('DOMContentLoaded', function () {

    /* ==========================================================
       1. TOGGLE: Diri Sendiri / Mewakili Orang Lain
       ========================================================== */
    const radioDiriSendiri = document.querySelector('input[name="jenis_pelapor"][value="diri_sendiri"]');
    const radioMewakili = document.querySelector('input[name="jenis_pelapor"][value="mewakili"]');
    const cardDiriSendiri = document.getElementById('cardDiriSendiri');
    const cardMewakili = document.getElementById('cardMewakili');
    const wakilFields = document.getElementById('wakilFields');
    const reuseDataBox = document.getElementById('reuseDataBox');
    const reuseCheckbox = document.getElementById('samaCekPelapor');
    const reuseHint = reuseDataBox.querySelector('.form-hint');

    function setRadioCardState(activeCard, inactiveCard) {
        activeCard.classList.add('is-checked');
        inactiveCard.classList.remove('is-checked');
    }

    function handleJenisPelaporChange() {
        if (radioMewakili.checked) {
            setRadioCardState(cardMewakili, cardDiriSendiri);
            wakilFields.classList.remove('d-none');
            reuseHint.textContent = 'Aktifkan jika data jamaah sama dengan data pelapor.';
            reuseCheckbox.disabled = false;
        } else {
            setRadioCardState(cardDiriSendiri, cardMewakili);
            wakilFields.classList.add('d-none');
            reuseHint.textContent = 'Aktif karena pengaduan ini dibuat untuk diri sendiri.';
            reuseCheckbox.checked = true;
            reuseCheckbox.disabled = true;
            syncJamaahData();
        }
    }

    radioDiriSendiri.addEventListener('change', handleJenisPelaporChange);
    radioMewakili.addEventListener('change', handleJenisPelaporChange);

    /* ==========================================================
       2. GUNAKAN DATA PELAPOR UNTUK JAMAAH
       ========================================================== */
    const namaPelapor = document.getElementById('nama_pelapor');
    const whatsappPelapor = document.getElementById('whatsapp_pelapor');
    const namaJamaah = document.getElementById('nama_jamaah');
    const whatsappJamaah = document.getElementById('whatsapp_jamaah');

    function syncJamaahData() {
    if (reuseCheckbox.checked) {
        namaJamaah.value = namaPelapor.value;
        whatsappJamaah.value = whatsappPelapor.value;
        namaJamaah.readOnly = true;
        whatsappJamaah.readOnly = true;
    } else {
        namaJamaah.readOnly = false;
        whatsappJamaah.readOnly = false;
    }
}

    reuseCheckbox.addEventListener('change', syncJamaahData);
    namaPelapor.addEventListener('input', syncJamaahData);
    whatsappPelapor.addEventListener('input', syncJamaahData);

    // Inisialisasi kondisi awal (default: diri sendiri, reuse aktif)
    syncJamaahData();

    /* ==========================================================
       3. TOGGLE KONDISI DARURAT
       ========================================================== */
    const radioDarurat = document.querySelector('input[name="tingkat_urgensi"][value="darurat"]');
    const radioTidakDarurat = document.querySelector('input[name="tingkat_urgensi"][value="tidak_darurat"]');
    const cardDarurat = document.getElementById('cardDarurat');
    const cardTidakDarurat = document.getElementById('cardTidakDarurat');
    const alertDarurat = document.getElementById('alertDarurat');

    function handleUrgensiChange() {
        if (radioDarurat.checked) {
            setRadioCardState(cardDarurat, cardTidakDarurat);
            alertDarurat.classList.remove('d-none');
        } else {
            setRadioCardState(cardTidakDarurat, cardDarurat);
            alertDarurat.classList.add('d-none');
        }
    }

    radioDarurat.addEventListener('change', handleUrgensiChange);
    radioTidakDarurat.addEventListener('change', handleUrgensiChange);

    /* ==========================================================
       4. UPLOAD BUKTI PENDUKUNG (preview & remove)
       ========================================================== */
    const uploadZone = document.getElementById('uploadZone');
const fileInput = document.getElementById('fileInput');
const fileList = document.getElementById('fileList');
const maxSizeBytes = 5 * 1024 * 1024; // 5 MB
const maxFiles = 5;
let selectedFiles = [];

uploadZone.addEventListener('click', () => fileInput.click());

uploadZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadZone.classList.add('is-dragover');
});

uploadZone.addEventListener('dragleave', () => {
    uploadZone.classList.remove('is-dragover');
});

uploadZone.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadZone.classList.remove('is-dragover');
    handleFiles(e.dataTransfer.files);
});

fileInput.addEventListener('change', () => {
    handleFiles(fileInput.files);
});

function handleFiles(files) {
    Array.from(files).forEach((file) => {
        const isValidType = ['image/jpeg', 'image/png', 'application/pdf'].includes(file.type);
        const isValidSize = file.size <= maxSizeBytes;

        if (selectedFiles.length >= maxFiles) {
            alertInvalid('Maksimal 5 file dapat diunggah.');
            return;
        }
        if (!isValidType) {
            alertInvalid('Format file tidak didukung. Gunakan JPG, PNG, atau PDF.');
            return;
        }
        if (!isValidSize) {
            alertInvalid('Ukuran file melebihi batas maksimal 5 MB.');
            return;
        }

        selectedFiles.push(file);
    });
    syncFileInput();
    renderFileList();
}

// Sinkronkan array selectedFiles ke elemen <input type="file"> asli
// supaya file dari drag-and-drop ikut ter-submit ke server.
function syncFileInput() {
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach((file) => dataTransfer.items.add(file));
    fileInput.files = dataTransfer.files;
}

function alertInvalid(message) {
    if (window.Swal) {
        Swal.fire({
            icon: 'warning',
            title: 'File tidak valid',
            text: message,
            confirmButtonColor: '#2563EB',
        });
    } else {
        alert(message);
    }
}

function formatFileSize(bytes) {
    if (bytes < 1024) return bytes + ' B';
    if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
    return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
}

function getFileIcon(file) {
    if (file.type === 'application/pdf') return 'bi-file-earmark-pdf';
    return 'bi-file-earmark-image';
}

function renderFileList() {
    fileList.innerHTML = '';
    selectedFiles.forEach((file, index) => {
        const item = document.createElement('div');
        item.className = 'file-item';
        item.innerHTML = `
            <div class="file-icon"><i class="bi ${getFileIcon(file)}"></i></div>
            <div class="file-info">
                <div class="file-name">${file.name}</div>
                <div class="file-size">${formatFileSize(file.size)}</div>
            </div>
            <button type="button" class="file-remove" data-index="${index}" aria-label="Hapus file">
                <i class="bi bi-x-lg"></i>
            </button>
        `;
        fileList.appendChild(item);
    });

    fileList.querySelectorAll('.file-remove').forEach((btn) => {
        btn.addEventListener('click', () => {
            const idx = parseInt(btn.getAttribute('data-index'), 10);
            selectedFiles.splice(idx, 1);
            syncFileInput();
            renderFileList();
        });
    });
}

    /* ==========================================================
       5. PROGRESS INDICATOR (highlight sesuai scroll)
       ========================================================== */
   const steps = document.querySelectorAll('.progress-step');
const sections = ['section-pelapor', 'section-perjalanan', 'section-masalah', 'section-konfirmasi']
    .map((id) => document.getElementById(id))
    .filter(Boolean);

if ('IntersectionObserver' in window && sections.length) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                steps.forEach((step) => {
                    step.classList.toggle('is-active', step.dataset.target === entry.target.id);
                });
            }
        });
    }, { rootMargin: '-40% 0px -50% 0px', threshold: 0 });

    sections.forEach((section) => observer.observe(section));
}

   const form = document.getElementById('formPengaduan');
form.addEventListener('submit', function (e) {
    const konfirmasiData = document.getElementById('konfirmasi_data').checked;

    if (!konfirmasiData) {
        e.preventDefault();
        alertInvalid('Mohon centang konfirmasi kesesuaian data sebelum mengirim.');
        return;
    }

    // Tampilkan loading & kunci tombol supaya tidak double-submit.
    // Form tetap lanjut submit asli ke server (tidak ada e.preventDefault()).
    const submitBtn = form.querySelector('button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Mengirim Pengaduan...
        `;
    }
});

});
