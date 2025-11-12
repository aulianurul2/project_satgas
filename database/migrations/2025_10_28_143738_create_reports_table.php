<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id('idForm');
            $table->foreignId('user_id')->constraid('users')->onDelete('cascade');
            $table->string('nama_pelapor');
            $table->string('TTL');
            $table->string('agama');
            $table->string('jk');
            $table->string('alamat');
            $table->string('unsur');
            $table->string('jurusan');
            $table->string('prodi');
            $table->string('no_hp');
            $table->string('email');
            $table->string('kedudukan');
            $table->string('pihak_dilaporkan')->nullable();
            $table->string('unit_kerja_terlapor')->nullable();
            $table->date('tanggal_kejadian')->nullable();
            $table->string('tempat_kejadian');
            $table->text('kronologi');
            $table->text('bantuan_yang_diperlukan')->nullable();
            $table->string('nama_terlapor');
            $table->string('jk_terlapor');
            $table->string('bukti')->nullable(); // path file upload
            $table->enum('status', ['Diterima', 'Diverifikasi', 'Diproses', 'Selesai'])->default('Diterima');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
