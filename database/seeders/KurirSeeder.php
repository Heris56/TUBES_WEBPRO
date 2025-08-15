<?php

namespace Database\Seeders;

use App\Models\Kurir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KurirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kurir::factory()->count(5)->create();
    }
}
