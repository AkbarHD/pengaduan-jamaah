<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pengaduan')->unique();

            // Pelapor
            $table->enum('jenis_pelapor', ['diri_sendiri', 'mewakili'])->default('diri_sendiri');
            $table->string('nama_jamaah_diwakili')->nullable();
            $table->string('hubungan_jamaah')->nullable();
            $table->string('nama_pelapor');
            $table->string('whatsapp_pelapor');
            $table->string('email_pelapor')->nullable();

            // Jamaah
            $table->string('nama_jamaah');
            $table->string('whatsapp_jamaah');

            // Perjalanan
            $table->enum('status_perjalanan', ['di_makkah', 'dalam_perjalanan', 'belum_berangkat', 'sudah_kembali']);
            $table->string('nomor_paspor')->nullable();
            $table->string('nomor_visa')->nullable();
            $table->string('nama_travel')->nullable();
            $table->date('tanggal_berangkat')->nullable();
            $table->date('tanggal_pulang')->nullable();
            $table->enum('status_tiket', ['sudah_ada', 'belum_ada', 'bermasalah', 'tidak_tahu'])->nullable();

            // Masalah
            $table->boolean('is_darurat')->default(false);
            $table->enum('kategori_masalah', [
                'tiket_kepulangan', 'travel', 'dokumen', 'penipuan', 'akomodasi', 'keuangan', 'lainnya',
            ]);
            $table->date('tanggal_kejadian')->nullable();
            $table->string('lokasi_kejadian')->nullable();
            $table->text('ceritakan_masalah');

            // Konfirmasi
            $table->boolean('bersedia_dihubungi')->default(false);

            // Status & alur admin
            $table->enum('status', ['pending', 'verifikasi', 'selesai', 'batal'])->default('pending');
            $table->text('alasan_pembatalan')->nullable();
            $table->timestamp('kjri_forwarded_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
