<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Keranjang>
 */
class KeranjangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total' => $this->faker->randomFloat(2, 10, 1000),
            'kuantitas' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['Pending', 'Paid', 'Cancelled']),
            'id_pembeli' => \App\Models\Pembeli::factory(),
            'id_produk' => \App\Models\Produk::factory(),
            'id_batch' => $this->faker->numberBetween(1, 1000),
        ];
    }
}
