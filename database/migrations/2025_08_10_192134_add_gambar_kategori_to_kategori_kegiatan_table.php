<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom baru.
     */
    public function up(): void
    {
        Schema::table('kategori_kegiatan', function (Blueprint $table) {
            $table->string('gambar_kategori')->nullable()->after('nama_kategori');
        });
    }

    /**
     * Hapus kolom jika rollback.
     */
    public function down(): void
    {
        Schema::table('kategori_kegiatan', function (Blueprint $table) {
            $table->dropColumn('gambar_kategori');
        });
    }
};
