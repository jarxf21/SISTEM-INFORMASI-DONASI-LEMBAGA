<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_campaign')->nullable()->after('id_kegiatan'); // atau sesuaikan posisi
            $table->foreign('id_campaign')->references('id_campaign')->on('campaign')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->dropForeign(['id_campaign']);
            $table->dropColumn('id_campaign');
        });
    }
};
