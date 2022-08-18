<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hargas')->insert([
            'nama' => 'PPN'
        ]);
        DB::table('hargas')->insert([
            'nama' => 'Global Discount'
        ]);
    }
}
