<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
    'judul', 'slug', 'deskripsi', 'konten', 'penulis', 'thumbnail',
    'status', 'alasan_penolakan', 'created_by',
];


    protected static function booted(): void
    {
        static::creating(function (Berita $berita) {
            $berita->slug = static::generateUniqueSlug($berita->judul);
        });

        static::updating(function (Berita $berita) {
            if ($berita->isDirty('judul')) {
                $berita->slug = static::generateUniqueSlug(
                    $berita->judul,
                    $berita->id
                );
            }
        });
    }

    public static function generateUniqueSlug(
        string $judul,
        ?int $ignoreId = null
    ): string {
        $slug = Str::slug($judul);
        $original = $slug;
        $i = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $i++;
        }

        return $slug;
    }

    public const STATUS_ORDER = [
    'draft'     => 1,
    'published' => 2,
    'rejected'  => 3,
];

public function scopeOrderByStatusPriority($query)
{
    return $query->orderByRaw("FIELD(status, 'draft', 'published', 'rejected')");
}

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
