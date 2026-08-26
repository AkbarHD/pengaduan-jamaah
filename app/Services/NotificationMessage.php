<?php

namespace App\Services;

use Illuminate\Support\Str;

class NotificationMessage
{
    public function pesanPengaduanBaru(array $obj): string
    {
        $pesan  = "*PENGADUAN BARU MASUK*\n\n";
        $pesan .= "Ada pengaduan baru dari jamaah yang perlu diperiksa.\n\n";
        $pesan .= "*Nomor Pengaduan*  : " . $obj['nomor_pengaduan'] . "\n";
        $pesan .= "*Tipe*             : " . ($obj['is_darurat'] ? 'DARURAT' : 'Biasa') . "\n";
        $pesan .= "*Nama Pelapor*     : " . $obj['nama_pelapor'] . "\n";
        $pesan .= "*WhatsApp Pelapor* : " . $obj['whatsapp_pelapor'] . "\n";
        $pesan .= "*Nama Jamaah*      : " . $obj['nama_jamaah'] . "\n";
        $pesan .= "*Kategori*         : " . $obj['kategori_masalah'] . "\n";
        $pesan .= "*Ringkasan*        : " . Str::limit($obj['ceritakan_masalah'], 150) . "\n\n";

        if ($obj['is_darurat']) {
            $pesan .= "PENGADUAN INI BERSIFAT DARURAT — mohon segera diperiksa dan diverifikasi.\n\n";
        }

        // $pesan .= "Cek detail lengkap di panel admin:\n";
        // $pesan .= $obj['link_admin'];

        return $pesan;
    }

    public function pesanPengaduanDaruratTerverifikasi(array $obj): string
    {
        $pesan  = "*PENGADUAN DARURAT TERVERIFIKASI*\n\n";
        $pesan .= "Pengaduan darurat berikut telah diverifikasi dan siap ditindaklanjuti:\n\n";
        $pesan .= "*Nomor Pengaduan*   : " . $obj['nomor_pengaduan'] . "\n";
        $pesan .= "*Nama Pelapor*      : " . $obj['nama_pelapor'] . "\n";
        $pesan .= "*WhatsApp Pelapor*  : " . $obj['whatsapp_pelapor'] . "\n";
        $pesan .= "*Nama Jamaah*       : " . $obj['nama_jamaah'] . "\n";
        $pesan .= "*WhatsApp Jamaah*   : " . $obj['whatsapp_jamaah'] . "\n";
        $pesan .= "*Status Perjalanan* : " . $obj['status_perjalanan'] . "\n";
        $pesan .= "*Nama Travel*       : " . ($obj['nama_travel'] ?? '-') . "\n";
        $pesan .= "*Kategori Masalah*  : " . $obj['kategori_masalah'] . "\n";
        $pesan .= "*Lokasi Kejadian*   : " . ($obj['lokasi_kejadian'] ?? '-') . "\n\n";
        $pesan .= "*Kronologi*\n" . $obj['ceritakan_masalah'] . "\n\n";
        $pesan .= "Mohon segera ditindaklanjuti, termasuk koordinasi ke KJRI apabila diperlukan.\n\n";
        $pesan .= "Detail lengkap:\n" . $obj['link_admin'];

        return $pesan;
    }
}
