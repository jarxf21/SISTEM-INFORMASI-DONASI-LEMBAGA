<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
      
        Schema::create('donasi', function (Blueprint $table) {
            $table->id('id_donasi');
            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('id_donatur');
            $table->unsignedBigInteger('id_kategori');
            $table->unsignedBigInteger('id_campaign');
            $table->decimal('jumlah_donasi', 15, 2);
            $table->string('catatan')->nullable();
            $table->date('tanggal_donasi');
            $table->timestamps();
            
            $table->foreign('id_admin')->references('id_admin')->on('admin');
            $table->foreign('id_donatur')->references('id_donatur')->on('donatur');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_kegiatan');
            $table->foreign('id_campaign')
                  ->references('id_campaign')
                  ->on('campaign')
                  ->onDelete('cascade');
        });
    
}
    public function down()
    {
        Schema::dropIfExists('donasi');
    }
};