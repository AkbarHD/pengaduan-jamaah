<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArtikelController extends Controller
{
    private string $thumbnailDirectory = 'uploads/artikel-thumbnail';

    public function index()
    {
        $artikels = Artikel::latest()->get();

        return view('admin.artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $this->uploadImage(
                $request->file('thumbnail')
            );
        }

        $validated['created_by'] = Auth::id();

        Artikel::create($validated);

        return redirect()
            ->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('thumbnail')) {
            $this->deleteFile($this->thumbnailDirectory, $artikel->thumbnail);
            $validated['thumbnail'] = $this->uploadImage(
                $request->file('thumbnail')
            );
        }

        $artikel->update($validated);

        return redirect()
            ->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        $this->deleteFile($this->thumbnailDirectory, $artikel->thumbnail);
        $artikel->delete();

        return redirect()
            ->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    public function downloadPdf(Artikel $artikel)
    {
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

    private function validateData(Request $request): array
    {
        return $request->validate([
            'kategori' => ['required', 'in:panduan,pencegahan'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string', 'max:500'],
            'konten' => ['required', 'string'],
            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'waktu_baca' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'in:draft,published'],
        ]);
    }

    private function uploadImage($file): string
    {
        $directory = public_path($this->thumbnailDirectory);

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename =
            uniqid('thumb_') . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $filename);

        return $filename;
    }

    private function deleteFile(string $directory, ?string $filename): void
    {
        if (!$filename) {
            return;
        }

        $path = public_path($directory . '/' . $filename);

        if (file_exists($path)) {
            unlink($path);
        }
    }
}
