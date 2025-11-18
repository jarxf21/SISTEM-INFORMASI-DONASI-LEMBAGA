<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  

public function up(): void
{
    Schema::table('campaign', function (Blueprint $table) {
        // Jangan tambah kolom slug lagi karena sudah ada
        $table->unique('slug');
    });
}

public function down(): void
{
    Schema::table('campaign', function (Blueprint $table) {
        $table->dropUnique(['slug']);
    });
}


};
