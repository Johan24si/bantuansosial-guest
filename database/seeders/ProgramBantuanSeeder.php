<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramBantuanSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');  // Locale Indonesia

        foreach (range(1, 5) as $index) {
            DB::table('program_bantuan')->insert([
                'kode' => 'PB' . str_pad($index, 4, '0', STR_PAD_LEFT),
                'nama_program' => $faker->words(3, true), // 3 kata sebagai nama program
                'tahun' => $faker->year($max = 'now'),
                'deskripsi' => $faker->optional()->realText(100), // teks pendek ala Indonesia
                'anggaran' => $faker->randomFloat(2, 1000000, 1000000000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
