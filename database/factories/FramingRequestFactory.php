<?php

use Faker\Generator as Faker;

$factory->define(App\FramingRequest::class, function (Faker $faker) {
    return [
        'internship' => $faker->numberBetween(1,200),
        'teacher' => $faker->numberBetween(1,200),
        'request_type' => $faker->randomElement($array = array ('request','wish')), 
        'status' => $faker->randomElement($array = array ('waiting','accepeted','rejected')), 
    ];
});
