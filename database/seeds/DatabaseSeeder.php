<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CallsTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(IntakeTypesTableSeeder::class);
        $this->call(PeopleTableSeeder::class);
        $this->call(SpeciesTableSeeder::class);
        $this->call(StaffTableSeeder::class);
    }
}
