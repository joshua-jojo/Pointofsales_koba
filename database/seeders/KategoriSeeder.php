<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoris')->insert([
            'id'=>1,
            'nama'=>'Makanan'
        ]);
        DB::table('kategoris')->insert([
            'id'=>2,
            'nama'=>'Minuman'
        ]);
        DB::table('kategoris')->insert([
            'id'=>3,
            'nama'=>'Susu'
        ]);
        DB::table('kategoris')->insert([
            'id'=>4,
            'nama'=>'Sayur'
        ]);
        DB::table('kategoris')->insert([
            'id'=>5,
            'nama'=>'Buah'
        ]);
        DB::table('kategoris')->insert([
            'id'=>6,
            'nama'=>'Daging'
        ]);
        DB::table('kategoris')->insert([
            'id'=>7,
            'nama'=>'Saus'
        ]);
    }
}
