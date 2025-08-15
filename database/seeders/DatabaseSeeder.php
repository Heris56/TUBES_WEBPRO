<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            CampaignSeeder::class,
            KeranjangSeeder::class,
            KurirSeeder::class,
            PembeliSeeder::class,
            PesananSeeder::class,
            ProdukSeeder::class,
            RiwayatSeeder::class,
            UlasanSeeder::class,
            UmkmSeeder::class,
        ]);
    }
}
