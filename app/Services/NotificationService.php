<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    protected NotificationMessage $notificationMessage;

    public function __construct(NotificationMessage $notificationMessage)
    {
        $this->notificationMessage = $notificationMessage;
    }

    private function curlFonte(array $obj)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => config('services.fonnte.token'),
            ])->post(config('services.fonnte.url'), [
                'target'      => $obj['nohp'],
                'message'     => $obj['message'],
                'countryCode' => '62',
            ]);

            if (! $response->successful()) {
                Log::channel('daily')->warning('Fonnte gagal mengirim pesan', [
                    'response' => $response->body(),
                    'target'   => $obj['nohp'],
                ]);
            }

            return $response;
        } catch (\Exception $e) {
            // Kegagalan kirim WA tidak boleh menggagalkan proses utama (simpan pengaduan/ubah status).
            Log::channel('daily')->error('Fonnte error: ' . $e->getMessage());

            return null;
        }
    }

    public function pengaduanBaru(array $obj)
    {
        $obj['nohp']    = config('services.admin.whatsapp');
        $obj['message'] = $this->notificationMessage->pesanPengaduanBaru($obj);

        return $this->curlFonte($obj);
    }

    public function pengaduanDaruratTerverifikasi(array $obj)
    {
        $obj['nohp']    = config('services.admin.whatsapp');
        $obj['message'] = $this->notificationMessage->pesanPengaduanDaruratTerverifikasi($obj);

        return $this->curlFonte($obj);
    }
}
