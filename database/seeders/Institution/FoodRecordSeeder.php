<?php

namespace Database\Seeders\Institution;

use Illuminate\Database\Seeder;
use App\Models\{
    Institution,
    Food,
    FoodRecord
};

class FoodRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Institution::where('type', 'SCHOOL')->get() as $school) {

            foreach(Food::all() as $food) {

                FoodRecord::create([
                    'food_id' => $food->id,
                    'institution_id' => $school->id,
                    'amount' => rand(3, 15)
                ]);

            }

        }
    }
}
