<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'reports'; // <-- ini penting, sesuai migration
    protected $primaryKey = 'idForm'; // sesuai migration kamu
    protected $fillable = [
        'user_id', 'nama_pelapor', 'TTL', 'agama', 'jk', 'alamat', 'unsur',
        'jurusan', 'prodi', 'no_hp', 'email', 'kedudukan',
        'pihak_dilaporkan', 'nama_terlapor', 'jk_terlapor', 'unit_kerja_terlapor',
        'tanggal_kejadian', 'tempat_kejadian', 'kronologi',
        'bantuan_yang_diperlukan', 'bukti', 'status',
    ];
}
