<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
       
        Schema::create('campaign', function (Blueprint $table) {
            $table->id('id_campaign');
            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('id_kategori');
            $table->string('judul_campaign');
            $table->text('deskripsi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status_campaign', ['aktif', 'selesai', 'ditutup']);
            $table->string('gambar_campaign')->nullable();
            $table->timestamps();
            
            $table->foreign('id_admin')->references('id_admin')->on('admin');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_kegiatan');
        });
    
}

    public function down()
    {
        Schema::dropIfExists('campaign');
    }
};
