<?php
// database/migrations/xxxx_xx_xx_create_donatur_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        
        Schema::create('donatur', function (Blueprint $table) {
            $table->id('id_donatur');
            $table->unsignedBigInteger('id_admin');
            $table->string('nama');
            $table->string('alamat');
            $table->string('no_whatsApp');
            $table->timestamps();
            
            $table->foreign('id_admin')->references('id_admin')->on('admin');
        });
    }

    public function down()
    {
        Schema::dropIfExists('donatur');
    }
};
