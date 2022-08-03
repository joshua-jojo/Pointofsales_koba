<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BulanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bulans')->insert([
            'nama' => 'Januari'
        ]);
        DB::table('bulans')->insert([
            'nama' => 'Februari'
        ]);
        DB::table('bulans')->insert([
            'nama' => 'Maret'
        ]);
        DB::table('bulans')->insert([
            'nama' => 'April'
        ]);
        DB::table('bulans')->insert([
            'nama' => 'Mei'
        ]);
        DB::table('bulans')->insert([
            'nama' => 'Juni'
        ]);
        DB::table('bulans')->insert([
            'nama' => 'Juli'
        ]);
        DB::table('bulans')->insert([
            'nama' => 'Agustus'
        ]);
        DB::table('bulans')->insert([
            'nama' => 'September'
        ]);
        DB::table('bulans')->insert([
            'nama' => 'Oktober'
        ]);
        DB::table('bulans')->insert([
            'nama' => 'November'
        ]);
        DB::table('bulans')->insert([
            'nama' => 'Desember'
        ]);
    }
}
