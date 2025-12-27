<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropinsiSeeder extends Seeder
{
    public function run()
    {
        DB::table('propinsis')->insert([
            ['nama_propinsi' => 'D.I. Yogyakarta'],
            ['nama_propinsi' => 'Jawa Tengah'],
            ['nama_propinsi' => 'Jawa Barat'],
            ['nama_propinsi' => 'Jawa Timur'],
            ['nama_propinsi' => 'DKI Jakarta'],
            ['nama_propinsi' => 'Banten'],
        ]);
    }
}
