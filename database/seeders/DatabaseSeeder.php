<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            BulanSeeder::class,
            KategoriSeeder::class,
            SatuanSeeder::class,
            ProdukSeeder::class,
            MejaSeeder::class,
            // PemasukkanSeeder::class,
            // PengeluaranSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
