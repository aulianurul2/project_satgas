<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan.
     */
    protected $table = 'pelamars';

    /**
     * Kolom yang bisa diisi (mass assignable).
     */
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

    /**
     * Nilai default kolom tertentu.
     */
    protected $attributes = [
        'status' => 'Seleksi',
    ];
}
