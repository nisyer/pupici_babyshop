<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder untuk staff dan kategori
        $this->call([
            StaffSeeder::class,
            CategorySeeder::class,
            // ChatbotSeeder::class (boleh tambah nanti)
        ]);
    }
}
