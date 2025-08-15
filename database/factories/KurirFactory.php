<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kurir>
 */
class KurirFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kurir' => $this->faker->name,
            'id_umkm' => \App\Models\Umkm::factory(), // create a UMKM automatically
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // default password
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'nomor_telepon' => $this->faker->optional()->numerify('08##########'),
        ];
    }
}
