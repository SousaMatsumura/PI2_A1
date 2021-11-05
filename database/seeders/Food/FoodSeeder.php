<?php

namespace Database\Seeders\Food;

use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Food::count() === 0) {
            Food::insert([
                ['name' => 'Arroz', 'unit' => 'KG'],
                ['name' => 'Feijão', 'unit' => 'KG'],
                ['name' => 'Macarrão', 'unit' => 'KG'],
                ['name' => 'Farinha de Trigo', 'unit' => 'KG'],
                ['name' => 'Açucar', 'unit' => 'KG'],
                ['name' => 'Aveia', 'unit' => 'KG'],
                ['name' => 'Biscoito Rosquinha', 'unit' => 'KG'],
                ['name' => 'Achocolatado em Pó', 'unit' => 'KG'],
                ['name' => 'Biscoito Maizena', 'unit' => 'KG'],
                ['name' => 'Farinha de Mandioca', 'unit' => 'KG'],
            ]);
        }
        
    }
}
