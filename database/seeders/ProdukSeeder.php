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
        for ($i=0; $i < 10; $i++) { 
            DB::table('produks')->insert([
                'nama' => $faker->dairyName(),
                'harga' => rand(1,10),
                'stok' => 10,
                'id_kategori' => 3,
                'id_satuan' => 1,
            ]);
        }
        for ($i=0; $i < 10; $i++) { 
            DB::table('produks')->insert([
                'nama' => $faker->vegetableName(),
                'harga' => rand(1,10),
                'stok' => 10,
                'id_kategori' => 4,
                'id_satuan' => 1,
            ]);
        }
        for ($i=0; $i < 10; $i++) { 
            DB::table('produks')->insert([
                'nama' => $faker->fruitName(),
                'harga' => rand(1,10),
                'stok' => 10,
                'id_kategori' => 5,
                'id_satuan' => 1,
            ]);
        }
        for ($i=0; $i < 10; $i++) { 
            DB::table('produks')->insert([
                'nama' => $faker->meatName(),
                'harga' => rand(1,10),
                'stok' => 10,
                'id_kategori' => 6,
                'id_satuan' => 1,
            ]);
        }
        for ($i=0; $i < 10; $i++) { 
            DB::table('produks')->insert([
                'nama' => $faker->sauceName(),
                'harga' => rand(1,10),
                'stok' => 10,
                'id_kategori' => 7,
                'id_satuan' => 1,
            ]);
        }

    }
}
