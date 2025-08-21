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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama_lengkap', 255);
            $table->string('nomor_telepon', 255);
            $table->text('alamat')->nullable();
            $table->string('username', 255)->unique();
            $table->string('email', 255)->unique();
            $table->string('password', 255);

            // role: buyer / seller
            $table->enum('role', ['pembeli', 'umkm'])->default('pembeli');

            // fields khusus untuk UMKM (nullable for pembeli)
            $table->string('nama_usaha')->nullable();
            $table->string('NIK_KTP', 16)->unique()->nullable();

            // common auth fields
            $table->boolean('is_verified')->default(false);
            $table->string('auth_code', 6)->nullable();
            $table->string('reset_token')->nullable();
            $table->dateTime('reset_token_expiry')->nullable();

            $table->text('profileImg')->nullable();

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
        Schema::dropIfExists('pembelis');
    }
};
