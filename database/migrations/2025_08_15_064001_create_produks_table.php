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
        Schema::create('produks', function (Blueprint $table) {
            $table->id('id_produk');
            $table->float('harga'); // could be decimal(10,2) if for currency
            $table->integer('stok');
            $table->float('berat');
            $table->string('nama_barang');
            $table->text('deskripsi_barang')->nullable();
            $table->string('image_url')->nullable();
            $table->string('tipe_barang')->nullable();

            // Foreign keys
            $table->foreignId('id_umkm')
                ->constrained('umkms', 'id_umkm')
                ->cascadeOnDelete();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
