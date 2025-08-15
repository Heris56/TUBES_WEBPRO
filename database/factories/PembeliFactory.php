<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembeli>
 */
class PembeliFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_lengkap' => $this->faker->name,
            'nomor_telepon' => $this->faker->numerify('08##########'),
            'alamat' => $this->faker->optional()->address,
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            // 'profileImg' => $this->faker->optional()->imageUrl(200, 200),
            // 'auth_code' => $this->faker->optional()->numerify('######'),
            // 'is_verified' => $this->faker->boolean(70), // 70% chance verified
        ];
    }
}
