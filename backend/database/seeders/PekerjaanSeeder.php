<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pekerjaan')->insert([
            ['id' => 1, 'pekerjaan' => 'Guru', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'pekerjaan' => 'Mahasiswa', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'pekerjaan' => 'Karyawan Swasta', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'pekerjaan' => 'Perawat', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'pekerjaan' => 'Wiraswasta', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
