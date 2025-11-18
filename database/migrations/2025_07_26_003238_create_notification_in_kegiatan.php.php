<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tambah kolom untuk tracking notifikasi email di tabel kegiatan
        if (!Schema::hasColumn('kegiatan', 'email_notification_sent')) {
            Schema::table('kegiatan', function (Blueprint $table) {
                $table->boolean('email_notification_sent')->default(false);
                $table->timestamp('email_sent_at')->nullable();
                $table->integer('email_sent_count')->default(0);
            });
        }

        // Tambah kolom untuk donatur email preferences (opsional)
        if (!Schema::hasColumn('donatur', 'receive_email_notifications')) {
            Schema::table('donatur', function (Blueprint $table) {
                $table->boolean('receive_email_notifications')->default(true);
            });
        }
    }

    public function down()
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->dropColumn(['email_notification_sent', 'email_sent_at', 'email_sent_count']);
        });
        
        Schema::table('donatur', function (Blueprint $table) {
            $table->dropColumn('receive_email_notifications');
        });
    }
};
