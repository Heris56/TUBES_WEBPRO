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
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id_chat');

            $table->text('message');
            $table->dateTime('sent_at')->useCurrent();
            $table->boolean('is_read')->default(false);

            // Foreign keys
            $table->foreignId('id_umkm')
                ->nullable()
                ->constrained('umkm', 'id_umkm')
                ->cascadeOnDelete();

            $table->foreignId('id_pembeli')
                ->nullable()
                ->constrained('pembeli', 'id_pembeli')
                ->cascadeOnDelete();
                
            $table->foreignId('id_kurir')
                ->nullable()
                ->constrained('kurir', 'id_kurir')
                ->cascadeOnDelete();

            $table->string('receiver_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
