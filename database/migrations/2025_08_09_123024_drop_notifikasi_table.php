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
        Schema::dropIfExists('notifikasi');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kalau ingin rollback, bisa bikin tabel kembali
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->text('pesan')->nullable();
            $table->timestamps();
        });
    }
};
