<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramBantuanSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        $programs = [
            'Bantuan Langsung Tunai Desa',
            'Program Keluarga Harapan',
            'Bantuan Pangan Non Tunai',
            'Bantuan Modal UMKM',
            'Beasiswa Pendidikan Warga Tidak Mampu',
            'Bantuan Untuk Orang Kurang Mampu',
            'Bantuan Panti Asuhan',
        ];

        $deskripsiList = [
            'Program ini bertujuan untuk meningkatkan kesejahteraan masyarakat.',
            'Bantuan diberikan kepada warga yang memenuhi persyaratan tertentu.',
            'Program dilaksanakan oleh pemerintah desa secara berkala.',
            'Dana disalurkan secara transparan dan tepat sasaran.',
            'Penerima manfaat wajib mengikuti seluruh ketentuan yang berlaku.',
            'Program ini difokuskan untuk membantu warga kurang mampu.',
            'Penyaluran bantuan dilakukan sesuai jadwal yang telah ditentukan.',
        ];

        foreach (range(1, 100) as $index) {
            DB::table('program_bantuan')->insert([
                'kode' => 'PB' . str_pad($index, 4, '0', STR_PAD_LEFT),
                'nama_program' => $faker->randomElement($programs),
                'tahun' => $faker->year('now'),
                'deskripsi' => $faker->randomElement($deskripsiList),
                'anggaran' => $faker->randomFloat(2, 1000000, 1000000000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
