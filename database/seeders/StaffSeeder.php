<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        Staff::create([
            'staff_id' => 'M01',
            'name' => 'Nabilah',
            'password' => Hash::make('password123'),
        ]);

        // Tambahan contoh staff lain (optional)
        Staff::create([
            'staff_id' => 'S02',
            'name' => 'Fatin Akmar',
            'password' => Hash::make('password456'),
        ]);
    }
}
