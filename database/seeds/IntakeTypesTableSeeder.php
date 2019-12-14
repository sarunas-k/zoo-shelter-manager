<?php

use Illuminate\Database\Seeder;

class IntakeTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\IntakeType::insert([
            ['name' => 'Stray'],
            ['name' => 'Foster'],
            ['name' => 'Surrender'],
            ['name' => 'Boarding'],
            ['name' => 'Confiscated']
        ]);
    }
}
