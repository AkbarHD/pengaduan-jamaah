<?php

namespace App\Http\Controllers;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Berita;

class HomeController extends Controller
{
    public function index()
    {
        $artikelTerbaru = Artikel::published()
            ->latest()
            ->take(3)
            ->get();

        return view('home.index', compact('artikelTerbaru'));
    }

    public function faq()
    {
        return view('home.faq');
    }

    public function about()
    {
        return view('home.tentang');
    }

    public function panduan(Request $request)
    {
        $kategori = $request->query('kategori');
        $search = $request->query('search');

        $artikels = Artikel::published()
            ->when($kategori, fn($q) => $q->kategori($kategori))
            ->when($search, function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq
                        ->where('judul', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('panduan.index', compact('artikels', 'kategori', 'search'));
    }

    public function panduanDetail(string $slug)
    {
        $artikel = Artikel::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $artikelTerkait = Artikel::published()
            ->where('kategori', $artikel->kategori)
            ->where('id', '!=', $artikel->id)
            ->latest()
            ->take(3)
            ->get();

        return view('panduan.show', compact('artikel', 'artikelTerkait'));
    }

    public function panduanDownload(string $slug)
    {
        $artikel = Artikel::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $pdf = Pdf::loadView('admin.artikel.pdf', compact('artikel'))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'DejaVu Sans',
                'dpi' => 96,
                'chroot' => public_path(),
                'isPhpEnabled' => false,
            ]);

        return $pdf->download($artikel->slug . '.pdf');
    }

    public function cekStatus()
    {
        return view('status.index');
    }

    public function berita(Request $request)
    {
        $search = $request->query('search');

        $beritas = Berita::published()
            ->when($search, function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq
                        ->where('judul', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('berita.index', compact('beritas', 'search'));
    }

    public function beritaDetail(string $slug)
    {
        $berita = Berita::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $beritaTerkait = Berita::published()
            ->where('id', '!=', $berita->id)
            ->latest()
            ->take(3)
            ->get();

        return view('berita.show', compact('berita', 'beritaTerkait'));
    }
}
