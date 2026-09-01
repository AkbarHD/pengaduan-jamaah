<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Artikel extends Model
{
    use HasFactory;

  protected $fillable = [
    'kategori', 'judul', 'slug', 'deskripsi', 'konten', 'penulis',
    'thumbnail', 'waktu_baca', 'status', 'created_by',
];

    protected static function booted(): void
    {
        static::creating(function (Artikel $artikel) {
            $artikel->slug = static::generateUniqueSlug($artikel->judul);
        });

        static::updating(function (Artikel $artikel) {
            if ($artikel->isDirty('judul')) {
                $artikel->slug = static::generateUniqueSlug($artikel->judul, $artikel->id);
            }
        });
    }

    public static function generateUniqueSlug(string $judul, ?int $ignoreId = null): string
    {
        $slug = Str::slug($judul);
        $original = $slug;
        $i = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $i++;
        }

        return $slug;
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeKategori($query, string $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
