<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institution;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(Institution::count() === 0) {
            $this->call([
                \Database\Seeders\User\Institution\SchoolSeeder::class,
                \Database\Seeders\User\Institution\SecretarySeeder::class,
            ]);
        }
    }
}
