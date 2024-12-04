<?php

namespace Database\Seeders;

use App\Models\Species;
use App\Models\Tree;
use Illuminate\Database\Seeder;
use Storage;

class TreeSeeder extends Seeder
{
    public function run()
    {
        Storage::disk('public')->makeDirectory('trees');

        $species = Species::all();

        collect(range(1, 10))->each(function ($number) use ($species) {
            $image = $number . '.jpg';
            $imagePath = resource_path('assets/trees/' . $image);

            if (file_exists($imagePath)) {
                Storage::disk('public')->put(
                    'trees/' . $image,
                    file_get_contents($imagePath)
                );
            }

            Tree::create([
                'size' => rand(1, 5),
                'species_id' => $species->random()->id,
                'location' => 'Location ' . $number,
                'status' => 'available',
                'price' => rand(50, 500),
                'photo' => 'trees/' . $image,
            ]);
        });
    }
}