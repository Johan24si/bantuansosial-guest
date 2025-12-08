<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 1 user khusus
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@gmail.com',
            'role'  => 'admin', // wajib disesuaikan dengan model
        ]);

        // Buat banyak user random
        User::factory(100)->create([
            'role' => 'user', // default role untuk mass seeding
        ]);
    }
}

