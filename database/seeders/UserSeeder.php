<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;   // ← WAJIB TAMBAHKAN INI

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
