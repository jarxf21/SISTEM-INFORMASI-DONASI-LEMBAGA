<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailToDonaturTable extends Migration
{
    public function up(): void
    {
        Schema::table('donatur', function (Blueprint $table) {
            $table->string('email')->nullable()->after('nama'); // ganti `nama` dengan kolom sebelum `email` jika ingin menyesuaikan posisi
        });
    }

    public function down(): void
    {
        Schema::table('donatur', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
}
