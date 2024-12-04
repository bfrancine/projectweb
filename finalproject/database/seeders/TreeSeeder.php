<?php

namespace Database\Seeders;

use App\Models\Species;
use App\Models\Tree;
use Illuminate\Database\Seeder;

class TreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $species = Species::all();

        // Create 10 available trees
        foreach (range(1, 10) as $index) {
            Tree::create([
                'size' => rand(1, 5),
                'species_id' => $species->random()->id,
                'location' => 'Location ' . $index,
                'status' => 'available',
                'price' => rand(50, 500),
                'photo' => null,
            ]);
        }
    }
}
