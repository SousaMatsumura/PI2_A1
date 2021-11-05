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
        $this->call([
            \Database\Seeders\User\Institution\SchoolSeeder::class,
            \Database\Seeders\User\Institution\SecretarySeeder::class,
            \Database\Seeders\Food\FoodSeeder::class,
            \Database\Seeders\Institution\FoodRecordSeeder::class
        ]);
    }
}
