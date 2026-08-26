<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\PengaduanLampiran;
use App\Models\PengaduanStatusHistory;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
{
    private string $lampiranDirectory = 'uploads/pengaduan-bukti';
    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function create()
    {
        return view('pengaduan.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_pelapor'         => ['required', 'in:diri_sendiri,mewakili'],
            'nama_jamaah_diwakili'  => ['nullable', 'required_if:jenis_pelapor,mewakili', 'string', 'max:255'],
            'hubungan_jamaah'       => ['nullable', 'required_if:jenis_pelapor,mewakili', 'string', 'max:50'],

            'nama_pelapor'          => ['required', 'string', 'max:255'],
            'whatsapp_pelapor'      => ['required', 'string', 'max:20'],
            'email_pelapor'         => ['nullable', 'email', 'max:255'],

            'nama_jamaah'           => ['required', 'string', 'max:255'],
            'whatsapp_jamaah'       => ['required', 'string', 'max:20'],

            'status_perjalanan'     => ['required', 'in:di_makkah,dalam_perjalanan,belum_berangkat,sudah_kembali'],
            'nomor_paspor'          => ['nullable', 'string', 'max:50'],
            'nomor_visa'            => ['nullable', 'string', 'max:50'],
            'nama_travel'           => ['nullable', 'string', 'max:255'],
            'tanggal_berangkat'     => ['nullable', 'date'],
            'tanggal_pulang'        => ['nullable', 'date'],
            'status_tiket'          => ['nullable', 'in:sudah_ada,belum_ada,bermasalah,tidak_tahu'],

            'tingkat_urgensi'       => ['required', 'in:darurat,tidak_darurat'],
            'kategori_masalah'      => ['required', 'in:tiket_kepulangan,travel,dokumen,penipuan,akomodasi,keuangan,lainnya'],
            'tanggal_kejadian'      => ['nullable', 'date'],
            'lokasi_kejadian'       => ['nullable', 'string', 'max:255'],
            'ceritakan_masalah'     => ['required', 'string'],

            'konfirmasi_data'       => ['accepted'],
            'konfirmasi_whatsapp'   => ['nullable'],

            'bukti'                 => ['nullable', 'array', 'max:5'],
            'bukti.*'               => ['file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'], // 5 MB
        ], [
            'konfirmasi_data.accepted' => 'Mohon centang konfirmasi kesesuaian data sebelum mengirim.',
        ]);

        $pengaduan = DB::transaction(function () use ($request, $validated) {

            $pengaduan = Pengaduan::create([
                'nomor_pengaduan'      => Pengaduan::generateNomorPengaduan(),
                'jenis_pelapor'        => $validated['jenis_pelapor'],
                'nama_jamaah_diwakili' => $validated['nama_jamaah_diwakili'] ?? null,
                'hubungan_jamaah'      => $validated['hubungan_jamaah'] ?? null,
                'nama_pelapor'         => $validated['nama_pelapor'],
                'whatsapp_pelapor'     => $validated['whatsapp_pelapor'],
                'email_pelapor'        => $validated['email_pelapor'] ?? null,
                'nama_jamaah'          => $validated['nama_jamaah'],
                'whatsapp_jamaah'      => $validated['whatsapp_jamaah'],
                'status_perjalanan'    => $validated['status_perjalanan'],
                'nomor_paspor'         => $validated['nomor_paspor'] ?? null,
                'nomor_visa'           => $validated['nomor_visa'] ?? null,
                'nama_travel'          => $validated['nama_travel'] ?? null,
                'tanggal_berangkat'    => $validated['tanggal_berangkat'] ?? null,
                'tanggal_pulang'       => $validated['tanggal_pulang'] ?? null,
                'status_tiket'         => $validated['status_tiket'] ?? null,
                'is_darurat'           => $validated['tingkat_urgensi'] === 'darurat',
                'kategori_masalah'     => $validated['kategori_masalah'],
                'tanggal_kejadian'     => $validated['tanggal_kejadian'] ?? null,
                'lokasi_kejadian'      => $validated['lokasi_kejadian'] ?? null,
                'ceritakan_masalah'    => $validated['ceritakan_masalah'],
                'bersedia_dihubungi'   => $request->boolean('konfirmasi_whatsapp'),
                'status'               => 'pending',
            ]);

            if ($request->hasFile('bukti')) {
                foreach ($request->file('bukti') as $file) {
                    $directory = public_path($this->lampiranDirectory);

                    if (! file_exists($directory)) {
                        mkdir($directory, 0755, true);
                    }

                    $filename = uniqid('bukti_') . '.' . $file->getClientOriginalExtension();
                    $file->move($directory, $filename);

                    PengaduanLampiran::create([
                        'pengaduan_id'  => $pengaduan->id,
                        'file_name'     => $filename,
                        'original_name' => $file->getClientOriginalName(),
                    ]);
                }
            }

            PengaduanStatusHistory::create([
                'pengaduan_id' => $pengaduan->id,
                'status'       => 'pending',
                'judul'        => 'Pengaduan Diterima',
                'catatan'      => 'Laporan berhasil diterima oleh sistem.',
            ]);

            return $pengaduan;
        });

        // $this->notificationService->pengaduanBaru([
        //     'nomor_pengaduan'   => $pengaduan->nomor_pengaduan,
        //     'is_darurat'        => $pengaduan->is_darurat,
        //     'nama_pelapor'      => $pengaduan->nama_pelapor,
        //     'whatsapp_pelapor'  => $pengaduan->whatsapp_pelapor,
        //     'nama_jamaah'       => $pengaduan->nama_jamaah,
        //     'kategori_masalah'  => str_replace('_', ' ', $pengaduan->kategori_masalah),
        //     'ceritakan_masalah' => $pengaduan->ceritakan_masalah,
        //     'link_admin'        => route('admin.pengaduan.show', $pengaduan),
        // ]);

        return redirect()
            ->route('pengaduan.sukses', $pengaduan->nomor_pengaduan)
            ->with('success', 'Pengaduan berhasil dikirim.');
    }

    public function sukses(string $nomor)
    {
        $pengaduan = Pengaduan::where('nomor_pengaduan', $nomor)->firstOrFail();

        return view('pengaduan.sukses', compact('pengaduan'));
    }

    /**
     * Endpoint AJAX untuk halaman Cek Status Pengaduan.
     */
    public function cekStatus(Request $request)
    {
        $validated = $request->validate([
            'nomor_pengaduan' => ['required', 'string'],
            'whatsapp'        => ['required', 'string'],
        ]);

        $whatsapp = preg_replace('/[^0-9]/', '', $validated['whatsapp']);

        $pengaduan = Pengaduan::where('nomor_pengaduan', $validated['nomor_pengaduan'])
            ->where(function ($query) use ($whatsapp) {
                $query->where('whatsapp_pelapor', 'like', "%{$whatsapp}")
                    ->orWhere('whatsapp_pelapor', 'like', "%{$whatsapp}%");
            })
            ->with('riwayat')
            ->first();

        if (! $pengaduan) {
            return response()->json(['found' => false]);
        }

        return response()->json([
            'found' => true,
            'data' => [
                'nomor_pengaduan'    => $pengaduan->nomor_pengaduan,
                'status'             => $pengaduan->status,
                'status_label'       => $pengaduan->status_label,
                'status_description' => $pengaduan->status_description,
                'kategori_masalah'   => $pengaduan->kategori_masalah,
                'tanggal_pengaduan'  => $pengaduan->created_at->translatedFormat('d F Y'),
                'alasan_pembatalan'  => $pengaduan->alasan_pembatalan,
                'riwayat'            => $pengaduan->riwayat->map(fn ($item) => [
                    'tanggal' => $item->created_at->translatedFormat('d F Y — H:i'),
                    'judul'   => $item->judul,
                    'catatan' => $item->catatan,
                ]),
            ],
        ]);
    }
}
