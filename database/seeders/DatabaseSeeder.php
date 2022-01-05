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
        // \App\Models\User::factory(5)->create();
        \App\Models\Barang::factory(10)->create();
        \App\Models\Pemasok::factory(10)->create();

        $this->call([
            UserSeeder::class
        ]);
    }
}