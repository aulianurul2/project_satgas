<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Primary key disesuaikan dengan migrasi
    protected $primaryKey = 'idUser';
    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang dapat diisi
    protected $fillable = [
        'nama',
        'email',
        'password',
        'kontak',
        'alamat',
        'jenisUser',
    ];

    // Kolom yang disembunyikan
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Cast otomatis
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Cek role admin (opsional)
    public function isAdmin(): bool
    {
        return $this->jenisUser === 'admin';
    }
}
