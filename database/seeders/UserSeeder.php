<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 1 user khusus
        User::create([
            'name'  => 'fmi',
            'email' => 'test@gmail.com',
            'role'  => 'admin', // wajib disesuaikan dengan model
        ]);


    }
}

