<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalArtikel    = Artikel::count();
        $totalPanduan    = Artikel::kategori('panduan')->count();
        $totalPencegahan = Artikel::kategori('pencegahan')->count();
        $totalPublished  = Artikel::published()->count();

        $totalPengaduan   = Schema::hasTable('pengaduans') ? Pengaduan::count() : null;
        $pengaduanPending = Schema::hasTable('pengaduans') ? Pengaduan::where('status', 'pending')->count() : null;

        $range = $request->query('range', '30'); // 7 | 30 | 90 | all

        $kategoriChart = ['labels' => [], 'data' => []];
        $trendChart    = ['labels' => [], 'data' => []];

        if (Schema::hasTable('pengaduans')) {
            $baseQuery = Pengaduan::query();

            if ($range !== 'all') {
                $baseQuery->where('created_at', '>=', now()->subDays((int) $range));
            }

            $kategoriRaw = (clone $baseQuery)
                ->selectRaw('kategori_masalah, COUNT(*) as total')
                ->groupBy('kategori_masalah')
                ->orderByDesc('total')
                ->pluck('total', 'kategori_masalah');

            foreach ($kategoriRaw as $kategori => $total) {
                $kategoriChart['labels'][] = Pengaduan::KATEGORI_LABELS[$kategori] ?? $kategori;
                $kategoriChart['data'][]   = $total;
            }

            $trendRaw = (clone $baseQuery)
                ->selectRaw('DATE(created_at) as tgl, COUNT(*) as total')
                ->groupBy('tgl')
                ->pluck('total', 'tgl');

            $trendDays = min($range === 'all' ? 30 : (int) $range, 30);

            for ($i = $trendDays - 1; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $trendChart['labels'][] = $date->translatedFormat('d M');
                $trendChart['data'][]   = (int) ($trendRaw[$date->toDateString()] ?? 0);
            }
        }

        return view('dashboard.index', compact(
            'totalArtikel', 'totalPanduan', 'totalPencegahan', 'totalPublished',
            'totalPengaduan', 'pengaduanPending', 'kategoriChart', 'trendChart', 'range'
        ));
    }
}