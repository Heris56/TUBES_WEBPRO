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
        Schema::create('ulasans', function (Blueprint $table) {
            $table->id('id_ulasan');

            // Foreign keys
            $table->foreignId('id_pembeli')
                ->constrained('pembelis', 'id_pembeli')
                ->cascadeOnDelete();

            $table->foreignId('id_produk')
                ->constrained('produks', 'id_produk')
                ->cascadeOnDelete();

            $table->string('username', 255);
            $table->text('ulasan');
            $table->float('rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasans');
    }
};
