<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $end = $this->faker->optional()->dateTimeBetween($start, '+2 months');

        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->optional()->paragraph,
            'image_url' => $this->faker->optional()->imageUrl(400, 300),
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end ? $end->format('Y-m-d') : null,
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'id_umkm' => \App\Models\Umkm::factory(),
        ];
    }
}
