<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Locale Indonesia
        $faker = \Faker\Factory::create('id_ID');

        foreach (range(1, 100) as $index) {
            DB::table('users')->insert([
                'name'              => $faker->name,
                'email'             => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password'          => Hash::make('123456789'),
                'role'              => $faker->randomElement(['admin', 'user']),
                'remember_token'    => Str::random(10),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
