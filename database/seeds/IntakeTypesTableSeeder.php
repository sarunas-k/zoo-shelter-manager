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
            ['name' => 'Confiscated'],
            ['name' => 'Foster'],
            ['name' => 'Surrender'],
            ['name' => 'Stray']
        ]);
    }
}
