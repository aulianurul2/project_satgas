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
    Schema::table('users', function (Blueprint $table) {
        $table->enum('jenisUser', ['admin', 'minor_admin', 'user'])
              ->default('user')
              ->change();
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->enum('jenisUser', ['admin', 'user'])
              ->default('user')
              ->change();
    });
}

};
