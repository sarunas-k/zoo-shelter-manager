<?php

use Faker\Generator as Faker;

$factory->define(App\Call::class, function (Faker $faker) {
    return [
        'caller_name' => $faker->name,
        'caller_phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'info' => $faker->sentence,
        'date_time' => now(),
        'staff_id' => App\Staff::all()->random()->id,
        'status' => $faker->randomElement(['Waiting', 'On hold', 'Finished']),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
