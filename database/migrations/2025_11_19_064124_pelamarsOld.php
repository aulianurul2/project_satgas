<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('pelamars', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->string('nim', 50)->unique();
            $table->string('jurusan', 255);
            $table->string('prodi', 255);
            $table->decimal('ipk_terakhir', 3, 2); // contoh: 3.75
            $table->string('no_wa', 20);
            $table->string('cv', 255);      // path file CV (PDF)
            $table->string('essay', 255);   // path file Essay (PDF)
            $table->string('pas_foto', 255); // path file foto (jpg/png)
            $table->enum('status', ['Seleksi', 'Lolos Wawancara', 'Diterima'])->default('Seleksi');
            $table->timestamps();
        });
    }

    /**
     * Hapus tabel jika rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelamars');
    }
};
