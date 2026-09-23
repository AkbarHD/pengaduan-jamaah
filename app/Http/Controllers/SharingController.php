<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class SharingController extends Controller
{
    private string $thumbnailDirectory = 'uploads/berita-thumbnail';

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
            'konten'     => ['required', 'string', 'max:5000'],
            'thumbnail'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'konfirmasi' => ['accepted'],
        ], [
            'judul.required'      => 'Judul cerita wajib diisi.',
            'deskripsi.required'  => 'Ringkasan singkat wajib diisi.',
            'konten.required'     => 'Cerita pengalaman wajib diisi.',
            'konfirmasi.accepted' => 'Mohon konfirmasi bahwa cerita ini benar pengalaman Anda.',
        ]);

        // Ubah textarea polos jadi paragraf HTML yang aman (escape dulu, baru nl2br),
        // supaya tampil rapi di halaman detail tanpa risiko XSS.
        $paragraphs = preg_split('/\n\s*\n/', trim($validated['konten']));
        $konten = collect($paragraphs)
            ->filter(fn ($p) => trim($p) !== '')
            ->map(fn ($p) => '<p>' . nl2br(e(trim($p))) . '</p>')
            ->implode('');

        $berita = new Berita([
            'judul'     => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'konten'    => $konten,
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
