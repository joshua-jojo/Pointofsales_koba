<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \FakerRestaurant\Provider\id_ID\Restaurant($faker));

        for ($i=0; $i < 10; $i++) { 
            DB::table('produks')->insert([
                'nama' => $faker->foodName(),
                'harga' => rand(1,10),
                'id_kategori' => 1,
                'stok' => 10,
                'id_satuan' => 1,
            ]);
        }
        for ($i=0; $i < 10; $i++) { 
            DB::table('produks')->insert([
                'nama' => $faker->beverageName(),
                'harga' => rand(1,10),
                'stok' => 10,
                'id_kategori' => 2,
                'id_satuan' => 1,
            ]);
        }

    }
}
