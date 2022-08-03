<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama' => 'Administrator',
            'username' => 'admin',
            'role' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);
        DB::table('users')->insert([
            'nama' => 'Waitress',
            'username' => 'waitress',
            'role' => 'waitress',
            'email' => 'waitress@waitress.com',
            'password' => bcrypt('waitress'),
        ]);
        DB::table('users')->insert([
            'nama' => 'Cook',
            'username' => 'cook',
            'role' => 'cook',
            'email' => 'cook@cook.com',
            'password' => bcrypt('cook'),
        ]);
        DB::table('users')->insert([
            'nama' => 'Cashier',
            'username' => 'cashier',
            'role' => 'cashier',
            'email' => 'cashier@cashier.com',
            'password' => bcrypt('cashier'),
        ]);
    }
}
