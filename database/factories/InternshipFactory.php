<?php

use Faker\Generator as Faker;

$factory->define(App\Internship::class, function (Faker $faker) {
    return [
        'student' => $faker->unique()->numberBetween(1,200),
        'start_date' => $faker->date,
        'end_date' => $faker->date,
        'type' => $faker->randomElement($array = array ('init','perf','pfe')),
        'state' => $faker->randomElement($array = array ('waiting','accepted','rejected')),
        'framer' => $faker->numberBetween(1,200),
        'company_framer' => $faker->numberBetween(1,200),
        'specifications' => $faker->numberBetween(1,200),       
    ];
});
