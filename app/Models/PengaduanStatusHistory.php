<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaduanStatusHistory extends Model
{
    protected $fillable = ['pengaduan_id', 'status', 'judul', 'catatan'];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }
}
