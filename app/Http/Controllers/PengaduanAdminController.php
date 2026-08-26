<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\PengaduanStatusHistory;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class PengaduanAdminController extends Controller
{
    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        $pengaduans = Pengaduan::orderByRaw("FIELD(status, 'pending', 'verifikasi', 'selesai', 'batal')")
            ->latest()
            ->get();

        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    public function show(Pengaduan $pengaduan)
    {
        $pengaduan->load(['lampiran', 'riwayat']);

        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'status'            => ['required', 'in:pending,verifikasi,selesai,batal'],
            'alasan_pembatalan' => ['nullable', 'required_if:status,batal', 'string'],
        ], [
            'alasan_pembatalan.required_if' => 'Mohon isi alasan pembatalan.',
        ]);

        $statusSebelumnya = $pengaduan->status;

        $pengaduan->update([
            'status'            => $validated['status'],
            'alasan_pembatalan' => $validated['status'] === 'batal' ? $validated['alasan_pembatalan'] : null,
        ]);

        $historyContent = match ($validated['status']) {
            'pending'    => ['judul' => 'Menunggu Verifikasi', 'catatan' => 'Pengaduan dikembalikan ke status menunggu verifikasi.'],
            'verifikasi' => ['judul' => 'Terverifikasi', 'catatan' => 'Pengaduan telah diperiksa dan diverifikasi oleh petugas.'],
            'selesai'    => ['judul' => 'Selesai', 'catatan' => 'Pengaduan telah selesai diproses.'],
            'batal'      => ['judul' => 'Dibatalkan', 'catatan' => $validated['alasan_pembatalan']],
        };

        PengaduanStatusHistory::create([
            'pengaduan_id' => $pengaduan->id,
            'status'       => $validated['status'],
            'judul'        => $historyContent['judul'],
            'catatan'      => $historyContent['catatan'],
        ]);

        // Notifikasi otomatis ke admin: pengaduan darurat yang BARU SAJA diverifikasi
        // (dicek statusSebelumnya supaya tidak kirim ulang tiap kali disimpan tanpa perubahan berarti)
        $baruTerverifikasi = $validated['status'] === 'verifikasi' && $statusSebelumnya !== 'verifikasi';

        if ($pengaduan->is_darurat && $baruTerverifikasi) {
            $this->notificationService->pengaduanDaruratTerverifikasi([
                'nomor_pengaduan'   => $pengaduan->nomor_pengaduan,
                'nama_pelapor'      => $pengaduan->nama_pelapor,
                'whatsapp_pelapor'  => $pengaduan->whatsapp_pelapor,
                'nama_jamaah'       => $pengaduan->nama_jamaah,
                'whatsapp_jamaah'   => $pengaduan->whatsapp_jamaah,
                'status_perjalanan' => str_replace('_', ' ', $pengaduan->status_perjalanan),
                'nama_travel'       => $pengaduan->nama_travel,
                'kategori_masalah'  => str_replace('_', ' ', $pengaduan->kategori_masalah),
                'lokasi_kejadian'   => $pengaduan->lokasi_kejadian,
                'ceritakan_masalah' => $pengaduan->ceritakan_masalah,
                'link_admin'        => route('admin.pengaduan.show', $pengaduan),
            ]);
        }

        return redirect()
            ->route('admin.pengaduan.show', $pengaduan)
            ->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    public function forwardKjri(Pengaduan $pengaduan)
    {
        abort_unless($pengaduan->is_darurat && $pengaduan->status === 'verifikasi', 403);

        $pengaduan->update(['kjri_forwarded_at' => now()]);

        PengaduanStatusHistory::create([
            'pengaduan_id' => $pengaduan->id,
            'status'       => $pengaduan->status,
            'judul'        => 'Diteruskan ke KJRI',
            'catatan'      => 'Pengaduan darurat diteruskan ke KJRI melalui WhatsApp oleh petugas.',
        ]);

        $nomorKjri = config('services.kjri.whatsapp', '628000000000');

        $pesan = "Assalamu'alaikum, kami menyampaikan pengaduan darurat jamaah:\n\n"
            . "Nomor Pengaduan: {$pengaduan->nomor_pengaduan}\n"
            . "Nama Jamaah: {$pengaduan->nama_jamaah}\n"
            . "WhatsApp Jamaah: {$pengaduan->whatsapp_jamaah}\n"
            . "Kategori: {$pengaduan->kategori_masalah}\n"
            . "Ringkasan: {$pengaduan->ceritakan_masalah}";

        $waLink = "https://wa.me/{$nomorKjri}?text=" . urlencode($pesan);

        return redirect()->away($waLink);
    }
}
