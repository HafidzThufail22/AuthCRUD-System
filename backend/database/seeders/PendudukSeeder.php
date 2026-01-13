<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penduduk')->insert([
            [
                'nik' => '32080001',
                'nama' => 'Ahmad Fauzi',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1998-05-12',
                'alamat' => 'Jl. Merdeka ... 17B',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'pekerjaan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '32080002',
                'nama' => 'Siti Aisyah',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2000-08-20',
                'alamat' => 'Jl. Asia Afr... 21B',
                'agama' => 'Islam',
                'status_perkawinan' => 'Belum Kawin',
                'pekerjaan_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '32080003',
                'nama' => 'Budi Santoso',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Cimahi',
                'tanggal_lahir' => '1995-02-14',
                'alamat' => 'Jl. Sudirman... 17B',
                'agama' => 'Kristen',
                'status_perkawinan' => 'Kawin',
                'pekerjaan_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '32080004',
                'nama' => 'Maria Angelina',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1997-11-03',
                'alamat' => 'Jl. Gatot Su... 23B',
                'agama' => 'Katolik',
                'status_perkawinan' => 'Belum Kawin',
                'pekerjaan_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '32080005',
                'nama' => 'Andi Wijaya',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1990-01-25',
                'alamat' => 'Jl. Pahlawan... 17B',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'pekerjaan_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
