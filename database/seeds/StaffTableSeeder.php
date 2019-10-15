<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Staff::class, 10)->create()->each(function ($staff) {
            $staff->calls()->saveMany(App\Call::all()->random(rand(0,3)));
            $staff->animals()->saveMany(App\Animal::all()->random(rand(0,3)));
            $staff->procedures()->saveMany(App\Procedure::all()->random(rand(0,3)));
        });
    }
}
