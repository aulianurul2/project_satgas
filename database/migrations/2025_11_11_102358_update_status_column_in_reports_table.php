<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->enum('status', [
                'Menunggu Verifikasi Admin',
                'Terverifikasi',
                'Diproses',
                'Selesai',
                'Dibatalkan'
            ])->default('Menunggu Verifikasi Admin')->change();
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->enum('status', [
                'Diterima',
                'Diverifikasi',
                'Diproses',
                'Selesai'
            ])->default('Diterima')->change();
        });
    }
};
