<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 48; $i++) { 
            DB::table('pengeluarans')->insert([
                'nama' => (string)rand(1,10),
                'total' => rand(1,10),
                'harga' => rand(1,10),
                'jumlah' => rand(1,10),
                'keterangan' => '-',
                'created_at' => '2022-'.rand(1,12).'-2',
            ]);
        }
    }
}
