<?php
// database/migrations/xxxx_xx_xx_create_kategori_kegiatan_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        
        Schema::create('kategori_kegiatan', function (Blueprint $table) {
            $table->id('id_kategori');
            $table->unsignedBigInteger('id_admin');
            $table->string('nama_kategori');
            $table->text('deskripsi_kategori');
            $table->timestamps();
            
            $table->foreign('id_admin')->references('id_admin')->on('admin');
            
        });
    
    }
    public function down()
    {
        Schema::dropIfExists('kategori_kegiatan');
    }
};