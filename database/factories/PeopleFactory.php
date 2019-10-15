<?php

use Faker\Generator as Faker;

$factory->define(App\Person::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'date_of_birth' => $faker->date('Y-m-d', $max = '2000-01-01'),
        'phone_first' => $faker->phoneNumber,
        'phone_second' => $faker->phoneNumber,
        'address' => $faker->address
    ];
});
