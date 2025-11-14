<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelamars', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                 // Nama pelamar
            $table->string('nim')->unique();       // NIM, saya tambahkan unique agar tidak duplikat
            $table->string('jurusan');
            $table->string('prodi');
            $table->decimal('ipk_terakhir', 3, 2); // IPK, misal 3.89
            $table->string('no_wa');                // Nomor WhatsApp
            $table->string('cv');                   // Path file CV
            $table->string('essay');                // Path file Essay
            $table->string('pas_foto');             // Path file Pas Foto
            $table->enum('status', ['Seleksi', 'Lolos Wawancara', 'Diterima'])->default('Seleksi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelamars');
    }
};
