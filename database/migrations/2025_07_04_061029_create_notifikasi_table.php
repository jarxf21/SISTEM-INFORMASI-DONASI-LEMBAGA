<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id('id_notifikasi');
            $table->unsignedBigInteger('id_program');
            $table->unsignedBigInteger('id_campaign');
            $table->timestamp('tanggal_kirim');
            $table->enum('status_pengiriman', ['terkirim', 'gagal', 'pending']);
            $table->integer('jumlah_penerima');
            $table->enum('aktivasi', ['aktif', 'tidak-aktif']);
            $table->timestamps();
            
            $table->foreign('id_program')->references('id_kegiatan')->on('kegiatan');
            $table->foreign('id_campaign')->references('id_campaign')->on('campaign');
        });
    
    }
    public function down()
    {
        Schema::dropIfExists('notifikasi');
    }
};