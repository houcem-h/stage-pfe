<?php

use Faker\Generator as Faker;

$factory->define(App\Manager::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->e164PhoneNumber,
        'email' => $faker->safeEmail,
        'company' => $faker->numberBetween(1,20),
        'position' => $faker->jobTitle,        
    ];
});
