<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemasukkanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 24; $i++) { 
            DB::table('pemasukkans')->insert([
                'nama' => (string)rand(1,10),
                'total' => rand(1,10),
                'harga' => rand(1,10),
                'jumlah' => rand(1,10),
                'created_at' => '2022-'.rand(1,12).'-2',
            ]);
        }
    }
}
