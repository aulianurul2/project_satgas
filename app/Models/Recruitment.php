<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    protected $table = 'members'; // tetap pakai tabel pelamars

    protected $fillable = [
        'nama',
        'nim',
        'jurusan',
        'prodi',
        'ipk_terakhir',
        'no_wa',
        'cv',
        'essay',
        'pas_foto',
        'status',
    ];

    protected $attributes = [
        'status' => 'Seleksi',
    ];
}
