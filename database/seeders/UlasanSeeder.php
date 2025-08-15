<?php

namespace Database\Seeders;

use App\Models\Ulasan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UlasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ulasan::factory()->count(20)->create();
    }
}
