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
        if (! Schema::hasTable('admin')) {
            Schema::create('admin', function (Blueprint $table) {
                $table->id();
                $table->string('username')->unique();
                $table->string('password');
                $table->string('nama');
                $table->string('role')->default('admin');
                $table->string('email', 100)->unique()->nullable();
                $table->timestamp('email_verified_at')->nullable();
            });
        } else {
            Schema::table('admin', function (Blueprint $table) {
                if (! Schema::hasColumn('admin', 'username')) {
                    $table->string('username')->unique()->after('id');
                }
                if (! Schema::hasColumn('admin', 'password')) {
                    $table->string('password')->after('username');
                }
                if (! Schema::hasColumn('admin', 'nama')) {
                    $table->string('nama')->after('password');
                }
                if (! Schema::hasColumn('admin', 'role')) {
                    $table->string('role')->default('admin')->after('nama');
                }
                if (! Schema::hasColumn('admin', 'email')) {
                    $table->string('email', 100)->unique()->nullable()->after('nama');
                }
                if (! Schema::hasColumn('admin', 'email_verified_at')) {
                    $table->timestamp('email_verified_at')->nullable()->after('email');
                }
            });
        }

        if (! Schema::hasTable('event')) {
            Schema::create('event', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->foreignId('admin_id')->constrained('admin')->cascadeOnDelete();
                $table->text('deskripsi')->nullable();
                $table->string('gambar')->nullable();
                $table->date('tanggal');
            });
        }

        if (Schema::hasTable('otp_codes') && ! Schema::hasTable('kode_otp')) {
            Schema::rename('otp_codes', 'kode_otp');
        }

        if (! Schema::hasTable('kode_otp')) {
            Schema::create('kode_otp', function (Blueprint $table) {
                $table->id();
                $table->string('email')->index();
                $table->string('otp', 6);
                $table->string('action');
                $table->timestamp('expires_at');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('kode_otp')) {
            Schema::dropIfExists('kode_otp');
        }

        if (Schema::hasTable('event')) {
            Schema::dropIfExists('event');
        }

        if (Schema::hasTable('admin')) {
            Schema::dropIfExists('admin');
        }
    }
};
