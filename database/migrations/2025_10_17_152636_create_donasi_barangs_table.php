<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donasi_barang', function (Blueprint $table) {
            $table->id('id_donasi_barang');
            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('id_donatur');
            $table->unsignedBigInteger('id_campaign');
            $table->string('nama_barang');
            $table->integer('jumlah')->default(1);
            $table->string('satuan')->nullable();
            $table->date('tanggal_donasi');
            $table->text('catatan')->nullable();
            $table->timestamps();

            // Relasi sama seperti tabel donasi uang
            $table->foreign('id_admin')->references('id_admin')->on('admin')->onDelete('cascade');
            $table->foreign('id_donatur')->references('id_donatur')->on('donatur')->onDelete('cascade');
            $table->foreign('id_campaign')->references('id_campaign')->on('campaign')->onDelete('cascade');
           
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donasi_barang');
    }
};
