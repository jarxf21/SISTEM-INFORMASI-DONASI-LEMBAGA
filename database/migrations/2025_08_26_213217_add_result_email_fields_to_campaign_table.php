<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('campaign', function (Blueprint $table) {
            $table->boolean('result_email_sent')->default(false)->after('target_donasi');
            $table->timestamp('result_email_sent_at')->nullable()->after('result_email_sent');
            $table->integer('result_email_sent_count')->nullable()->after('result_email_sent_at');
        });
    }

    public function down(): void
    {
        Schema::table('campaign', function (Blueprint $table) {
            $table->dropColumn([
                'result_email_sent',
                'result_email_sent_at',
                'result_email_sent_count',
            ]);
        });
    }
};
