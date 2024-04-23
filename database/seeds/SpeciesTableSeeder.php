<?php

use Illuminate\Database\Seeder;
use App\Species;
use App\Breed;

class SpeciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Species::insert([
            ['name' => 'Dogs'],
            ['name' => 'Cats'],
            ['name' => 'Rodents'],
            ['name' => 'Reptiles'],
            ['name' => 'Birds'],
            ['name' => 'Other']
        ]);

        Breed::insert([
            ['name' => 'German shephard', 'species_id' => 1],
            ['name' => 'Pomeranian', 'species_id' => 1],
            ['name' => 'Baset', 'species_id' => 1],
            ['name' => 'Rotweiller', 'species_id' => 1],
            ['name' => 'Rainių veislė', 'species_id' => 2],
            ['name' => 'Micių veislė', 'species_id' => 2],
            ['name' => 'Kicių veislė', 'species_id' => 2],
            ['name' => 'Jerry', 'species_id' => 3],
            ['name' => 'Crocodile', 'species_id' => 4],
            ['name' => 'Chicken', 'species_id' => 5],
            ['name' => 'Pidgeon', 'species_id' => 5],
            ['name' => 'Starfish', 'species_id' => 6],
            ['name' => 'Monkey', 'species_id' => 6]
        ]);
    }
}
