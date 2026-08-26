<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengaduan extends Model
{
    use HasFactory;

    public const STATUS_LABELS = [
        'pending'    => 'Menunggu Verifikasi',
        'verifikasi' => 'Terverifikasi',
        'selesai'    => 'Selesai',
        'batal'      => 'Dibatalkan',
    ];

    public const STATUS_DESCRIPTIONS = [
        'pending'    => 'Pengaduan telah diterima dan sedang menunggu proses pemeriksaan.',
        'verifikasi' => 'Pengaduan telah diperiksa dan diverifikasi oleh petugas.',
        'selesai'    => 'Pengaduan telah selesai diproses.',
        'batal'      => 'Pengaduan tidak dapat dilanjutkan.',
    ];

    protected $fillable = [
        'nomor_pengaduan',
        'jenis_pelapor',
        'nama_jamaah_diwakili',
        'hubungan_jamaah',
        'nama_pelapor',
        'whatsapp_pelapor',
        'email_pelapor',
        'nama_jamaah',
        'whatsapp_jamaah',
        'status_perjalanan',
        'nomor_paspor',
        'nomor_visa',
        'nama_travel',
        'tanggal_berangkat',
        'tanggal_pulang',
        'status_tiket',
        'is_darurat',
        'kategori_masalah',
        'tanggal_kejadian',
        'lokasi_kejadian',
        'ceritakan_masalah',
        'bersedia_dihubungi',
        'status',
        'alasan_pembatalan',
        'kjri_forwarded_at',
    ];

    protected $casts = [
        'is_darurat'         => 'boolean',
        'bersedia_dihubungi' => 'boolean',
        'tanggal_berangkat'  => 'date',
        'tanggal_pulang'     => 'date',
        'tanggal_kejadian'   => 'date',
        'kjri_forwarded_at'  => 'datetime',
    ];

    public const KATEGORI_LABELS = [
    'tiket_kepulangan' => 'Tiket / Kepulangan',
    'travel'           => 'Travel',
    'dokumen'          => 'Dokumen',
    'penipuan'         => 'Penipuan',
    'akomodasi'        => 'Akomodasi',
    'keuangan'         => 'Keuangan',
    'lainnya'          => 'Lainnya',
];

public function getKategoriLabelAttribute(): string
{
    return self::KATEGORI_LABELS[$this->kategori_masalah] ?? $this->kategori_masalah;
}

    public static function generateNomorPengaduan(): string
    {
        $year = now()->year;

        $latest = DB::table('pengaduans')
            ->where('nomor_pengaduan', 'like', "PGD-{$year}-%")
            ->orderByDesc('id')
            ->lockForUpdate()
            ->first();

        $next = $latest ? ((int) substr($latest->nomor_pengaduan, -5)) + 1 : 1;

        return sprintf('PGD-%s-%05d', $year, $next);
    }

    public const STATUS_BADGE_CLASS = [
        'pending'    => 'badge-soft-warning',
        'verifikasi' => 'badge-soft-primary',
        'selesai'    => 'badge-soft-success',
        'batal'      => 'badge-soft-danger',
    ];

    public function getStatusBadgeClassAttribute(): string
    {
        return self::STATUS_BADGE_CLASS[$this->status] ?? 'badge-soft-secondary';
    }

    public function lampiran()
    {
        return $this->hasMany(PengaduanLampiran::class);
    }

    public function riwayat()
    {
        return $this->hasMany(PengaduanStatusHistory::class)->orderBy('created_at');
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }

    public function getStatusDescriptionAttribute(): string
    {
        return self::STATUS_DESCRIPTIONS[$this->status] ?? '';
    }

    public function scopeDarurat($query)
    {
        return $query->where('is_darurat', true);
    }
    public function getWhatsappJamaahLinkAttribute(): string
    {
        return 'https://wa.me/' . $this->normalizeWhatsapp($this->whatsapp_jamaah);
    }

    public function getWhatsappPelaporLinkAttribute(): string
    {
        return 'https://wa.me/' . $this->normalizeWhatsapp($this->whatsapp_pelapor);
    }

    private function normalizeWhatsapp(?string $number): string
    {
        $number = preg_replace('/[^0-9]/', '', (string) $number);

        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        } elseif (! str_starts_with($number, '62')) {
            $number = '62' . $number;
        }

        return $number;
    }
}
