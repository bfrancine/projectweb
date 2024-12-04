<?php

namespace Database\Seeders;

use App\Models\Species;
use Illuminate\Database\Seeder;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $species = [
            [
                'commercial_name' => 'Oak Tree',
                'scientific_name' => 'Quercus',
            ],
            [
                'commercial_name' => 'Pine Tree',
                'scientific_name' => 'Pinus',
            ],
            [
                'commercial_name' => 'Maple Tree',
                'scientific_name' => 'Acer',
            ],
            [
                'commercial_name' => 'Cedar Tree',
                'scientific_name' => 'Cedrus',
            ],
            [
                'commercial_name' => 'Birch Tree',
                'scientific_name' => 'Betula',
            ],
        ];

        foreach ($species as $specie) {
            Species::create($specie);
        }
    }
}
