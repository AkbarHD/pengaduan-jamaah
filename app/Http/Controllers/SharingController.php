<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class SharingController extends Controller
{
    private string $thumbnailDirectory = 'uploads/berita-thumbnail';

    private string $allowedTags = '<p><br><strong><em><u><s><blockquote><ol><ul><li><a><img><h1><h2><h3><sub><sup><span>';

    public function create()
    {
        return view('sharing.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'penulis'    => ['nullable', 'string', 'max:150'],
            'judul'      => ['required', 'string', 'max:255'],
            'deskripsi'  => ['required', 'string', 'max:500'],
            'konten'     => ['required', 'string', 'max:20000'],
            'thumbnail'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'konfirmasi' => ['accepted'],
        ], [
            'judul.required'      => 'Judul cerita wajib diisi.',
            'deskripsi.required'  => 'Ringkasan singkat wajib diisi.',
            'konten.required'     => 'Cerita pengalaman wajib diisi.',
            'konfirmasi.accepted' => 'Mohon konfirmasi bahwa cerita ini benar pengalaman Anda.',
        ]);

        $berita = new Berita([
            'judul'     => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'konten'    => $this->sanitizeHtml($validated['konten']),
            'penulis'   => $validated['penulis'] ?: 'Jamaah',
            'status'    => 'draft',
        ]);

        if ($request->hasFile('thumbnail')) {
            $berita->thumbnail = $this->uploadImage($request->file('thumbnail'));
        }

        $berita->save();

        return redirect()
            ->route('sharing.sukses', $berita->slug)
            ->with('success', 'Cerita Anda berhasil dikirim.');
    }

    public function sukses(string $slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();

        return view('sharing.sukses', compact('berita'));
    }

    /**
     * Bersihkan HTML dari input publik: batasi tag yang diizinkan,
     * hapus atribut event handler (onclick dll) dan javascript: link.
     */
    private function sanitizeHtml(string $html): string
    {
        $clean = strip_tags($html, $this->allowedTags);
        $clean = preg_replace('/\s*on\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $clean);
        $clean = preg_replace('/(href|src)\s*=\s*["\']javascript:[^"\']*["\']/i', '$1="#"', $clean);

        return $clean;
    }

    private function uploadImage($file): string
    {
        $directory = public_path($this->thumbnailDirectory);

        if (! file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = uniqid('berita_') . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $filename);

        return $filename;
    }
}
