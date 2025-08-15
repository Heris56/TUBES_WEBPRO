<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ulasan>
 */
class UlasanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_pembeli' => \App\Models\Pembeli::factory(),
            'id_produk' => \App\Models\Produk::factory(),
            'username' => $this->faker->userName,
            'ulasan' => $this->faker->paragraph,
            'rating' => $this->faker->randomFloat(1, 1, 5),
        ];
    }
}
