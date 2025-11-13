<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    // Izinkan kolom untuk mass assignment
    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'kategori',
    ];
}
