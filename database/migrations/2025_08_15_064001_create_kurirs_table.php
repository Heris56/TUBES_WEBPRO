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
        Schema::create('kurirs', function (Blueprint $table) {
            $table->id('id_kurir');
            $table->string('nama_kurir', 255);

            // Foreign keys
            $table->foreignId('id_umkm')
                ->constrained('umkms', 'id_umkm')
                ->cascadeOnDelete();

            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('status', 20);
            $table->string('nomor_telepon', 13)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurirs');
    }
};
