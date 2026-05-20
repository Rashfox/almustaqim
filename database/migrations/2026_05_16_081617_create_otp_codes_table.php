<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('otp_codes', function (Blueprint $table) {
        $table->id();
        $table->string('email')->index(); // Email tujuan OTP
        $table->string('otp', 6);         // 6 digit kode OTP
        $table->string('action');         // Jenis aksi: 'register' atau 'forgot_password'
        $table->timestamp('expires_at');  // Waktu kedaluwarsa (misal: 5 menit dari sekarang)
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('otp_codes');
}
};
