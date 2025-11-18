<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('settings_contact', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_wa')->unique();
            $table->string('nama_email')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings_contact');
    }
};
