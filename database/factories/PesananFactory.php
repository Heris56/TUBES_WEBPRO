<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pesanan>
 */
class PesananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status_pesanan' => $this->faker->randomElement(['Pending', 'Completed', 'Cancelled']),
            'total_belanja' => $this->faker->randomFloat(2, 10, 1000),
            'id_keranjang' => \App\Models\Keranjang::factory(),
            'histori_pesanan' => $this->faker->optional()->date(),
        ];
    }
}
