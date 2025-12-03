<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
    'nama',
    'jabatan',
    'kontak',
    'aktif',
    'divisi',
    'nim_nip',
    'alamat',
];

    //
}
