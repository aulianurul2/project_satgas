<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports'; // pastikan sesuai nama tabel kamu di DB
    protected $primaryKey = 'idForm'; // karena kolom PK-nya ini
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'nama_pelapor',
        'TTL',
        'agama',
        'jk',
        'alamat',
        'unsur',
        'jurusan',
        'prodi',
        'no_hp',
        'email',
        'kedudukan',
        'pihak_dilaporkan',
        'nama_terlapor',
        'jk_terlapor',
        'unit_kerja_terlapor',
        'tanggal_kejadian',
        'tempat_kejadian',
        'kronologi',
        'bantuan_yang_diperlukan',
        'bukti',
        'status',
    ];
}
