<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('reports', function (Blueprint $table) {
        if (!Schema::hasColumn('reports', 'tanggal_lahir')) {
            $table->date('tanggal_lahir')->nullable();
        }
    });
}

public function down()
{
    Schema::table('reports', function (Blueprint $table) {
        if (Schema::hasColumn('reports', 'tanggal_lahir')) {
            $table->dropColumn('tanggal_lahir');
        }
    });
}

};
