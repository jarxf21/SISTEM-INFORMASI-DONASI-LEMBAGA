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
        Schema::table('campaign', function (Blueprint $table) {
            // ubah dari date ke datetime
            $table->dateTime('tanggal_mulai')->change();
            $table->dateTime('tanggal_selesai')->change();
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::table('campaign', function (Blueprint $table) {
            // balikin jadi date lagi kalau rollback
            $table->date('tanggal_mulai')->change();
            $table->date('tanggal_selesai')->change();
        });
    }
};
