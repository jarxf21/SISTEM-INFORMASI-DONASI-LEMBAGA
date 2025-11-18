<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotificationAndStatusToKegiatanTable extends Migration
{
    public function up(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->boolean('email_notification_sent')->default(false);
            $table->enum('status', ['published', 'draft'])->default('draft');
        });
    }

    public function down(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->dropColumn(['email_notification_sent', 'status']);
        });
    }
}
