<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendaftarBantuanSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        foreach (range(1, 100) as $index) {
            DB::table('pendaftar_bantuan')->insert([
                'program_id'      => $faker->numberBetween(1, 5), // relasi ke program tetap
                'warga_id'        => $faker->numberBetween(1, 1000), // random saja karena belum ada relasi
                'status_seleksi'  => $faker->randomElement(['Lulus', 'Tidak Lulus', 'Menunggu']),
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}
