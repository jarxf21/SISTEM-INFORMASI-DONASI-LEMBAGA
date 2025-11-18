<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('donasi', function (Blueprint $table) {
        $table->dropForeign(['id_campaign']);
        $table->foreign('id_campaign')
              ->references('id_campaign')
              ->on('campaign')
              ->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('donasi', function (Blueprint $table) {
        $table->dropForeign(['id_campaign']);
        $table->foreign('id_campaign')
              ->references('id_campaign')
              ->on('campaign');
    });
}
};
