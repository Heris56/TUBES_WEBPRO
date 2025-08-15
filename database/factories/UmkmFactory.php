<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Umkm>
 */
class UmkmFactory extends Factory
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
            'nama_usaha' => $this->faker->optional()->company,
            'NIK_KTP' => $this->faker->unique()->numerify('################'),
            // 'is_verified' => $this->faker->boolean(70),
            // 'auth_code' => $this->faker->optional()->numerify('######'),
            // 'reset_token' => $this->faker->optional()->sha1,
            // 'reset_token_expiry' => $this->faker->optional()->dateTimeBetween('now', '+1 hour'),
        ];
    }
}
