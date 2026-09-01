<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    private string $thumbnailDirectory = 'uploads/berita-thumbnail';

    public function index()
    {
        $beritas = Berita::latest()->get();

        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
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

        Berita::create($validated);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('thumbnail')) {
            $this->deleteFile($berita->thumbnail);
            $validated['thumbnail'] = $this->uploadImage(
                $request->file('thumbnail')
            );
        }

        $berita->update($validated);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        $this->deleteFile($berita->thumbnail);
        $berita->delete();

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    private function validateData(Request $request): array
{
    return $request->validate([
        'judul'      => ['required', 'string', 'max:255'],
        'deskripsi'  => ['required', 'string', 'max:500'],
        'konten'     => ['required', 'string'],
        'penulis'    => ['nullable', 'string', 'max:150'],
        'thumbnail'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        'status'     => ['required', 'in:draft,published'],
    ]);
}

    private function uploadImage($file): string
    {
        $directory = public_path($this->thumbnailDirectory);

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename =
            uniqid('berita_') . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $filename);

        return $filename;
    }

    private function deleteFile(?string $filename): void
    {
        if (!$filename) {
            return;
        }

        $path = public_path($this->thumbnailDirectory . '/' . $filename);

        if (file_exists($path)) {
            unlink($path);
        }
    }
}
