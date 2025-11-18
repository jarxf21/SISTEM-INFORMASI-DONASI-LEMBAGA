<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('campaign', function (Blueprint $table) {
            if (!Schema::hasColumn('campaign', 'target_donasi')) {
                $table->decimal('target_donasi', 15, 2)->nullable()->after('deskripsi');
            }
        });
    }

    public function down(): void
    {
        Schema::table('campaign', function (Blueprint $table) {
            if (Schema::hasColumn('campaign', 'target_donasi')) {
                $table->dropColumn('target_donasi');
            }
        });
    }
};
