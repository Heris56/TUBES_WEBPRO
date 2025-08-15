<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'harga' => $this->faker->randomFloat(2, 10, 1000),
            'stok' => $this->faker->numberBetween(1, 100),
            'berat' => $this->faker->randomFloat(2, 0.1, 10),
            'nama_barang' => $this->faker->words(3, true),
            'deskripsi_barang' => $this->faker->optional()->paragraph,
            // 'image_url' => $this->faker->optional()->imageUrl(200, 200),
            'tipe_barang' => $this->faker->optional()->randomElement(['Makanan', 'Minuman', 'Elektronik', 'Lainnya']),
            'id_umkm' => \App\Models\Umkm::factory(),
        ];
    }
}
