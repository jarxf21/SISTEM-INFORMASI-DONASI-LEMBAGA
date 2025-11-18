<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id('id_kegiatan');
            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('id_kategori');
            $table->string('judul')->attribute();
            $table->text('dokumentasi_kegiatan')->attribute();
            $table->longText('deskripsi_lengkap');
            $table->date('tanggal_upload');
            $table->string('slug');
            $table->text('ringkasan_kegiatan');
            $table->timestamps();
            
            $table->foreign('id_admin')->references('id_admin')->on('admin');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_kegiatan');
        });
    
    }
    public function down()
    {
        Schema::dropIfExists('kegiatan');
    }
};