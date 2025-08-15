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
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id('id_keranjang');
            $table->float('total')->nullable();
            $table->integer('kuantitas')->nullable();
            $table->string('status');

            // Foreign keys
            $table->foreignId('id_pembeli')
                ->nullable()
                ->constrained('pembelis', 'id_pembeli')
                ->cascadeOnDelete();

            $table->foreignId('id_produk')
                ->nullable()
                ->constrained('produks', 'id_produk')
                ->cascadeOnDelete();

            $table->integer('id_batch');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjangs');
    }
};
