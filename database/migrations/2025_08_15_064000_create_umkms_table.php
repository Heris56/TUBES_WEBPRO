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
        Schema::create('umkms', function (Blueprint $table) {
            $table->id('id_umkm');
            $table->string('nama_lengkap');
            $table->string('nomor_telepon');
            $table->text('alamat')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nama_usaha')->nullable();
            $table->string('NIK_KTP', 16)->unique();
            $table->boolean('is_verified')->default(false);
            $table->string('auth_code', 6)->nullable();
            $table->string('reset_token')->nullable();
            $table->dateTime('reset_token_expiry')->nullable();

            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
