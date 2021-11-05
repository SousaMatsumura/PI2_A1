<?php

namespace Database\Seeders\User\Institution;

use Illuminate\Database\Seeder;
use App\Models\{
    Address, 
    Institution, 
    User
};

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = Address::create([
            'zipcode' => '11666-530',
            'street' => 'Rua Aldo Marcuci',
            'number' => '300',
            'district' => 'Praia das Palmeiras',
            'city' => 'Caraguatatuba',
            'state' => 'SP'
        ]);

        $institution = Institution::create([
            'name' => 'Ciefi Prof. Ricardo Luques Sammarco Serra',
            'type' => 'SCHOOL',
            'address_id' => $address->id,
            'phone' => '(12) 3888-4186'
        ]);

        User::create([
            'name' => 'Ricardo Lucques',
            'username' => 'ricardo',
            'password' => bcrypt('ricardo'),
            'email' => 'ricardolucques@gmail.com',
            'phone' => '(12) 0000-0000',
            'institution_id' => $institution->id
        ]);
    }
}
