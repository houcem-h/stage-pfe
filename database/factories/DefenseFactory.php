<?php

use Faker\Generator as Faker;

$factory->define(App\Defense::class, function (Faker $faker) {
    return [
        'date_d' => $faker->dateTimeThisMonth($max = 'now', $timezone = null),
        'start_time' => $faker->time('H:i'),
        'end_time' => $faker->time('H:i'),
        'classroom' => $faker->numerify('I#.#'),
        'internship' => $faker->numberBetween(1,200),
        'reporter' => $faker->numberBetween(1,200),
        'president' => $faker->numberBetween(1,200),
    ];
});
