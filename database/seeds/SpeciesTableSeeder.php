<?php

use Illuminate\Database\Seeder;
use App\Species;

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
    }
}
