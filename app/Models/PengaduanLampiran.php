<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaduanLampiran extends Model
{
    protected $fillable = ['pengaduan_id', 'file_name', 'original_name'];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }
}
