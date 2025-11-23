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
        // Contoh factory bawaan
        // User::factory(10)->create();

        // User default contoh
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // 👉 Panggil seeder yang kamu buat di sini
        $this->call([
            UserSeeder::class,
        ]);
    }
}
