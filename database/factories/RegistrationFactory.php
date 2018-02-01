<?php

use Faker\Generator as Faker;

$factory->define(App\Registration::class, function (Faker $faker) {
    $year = $faker->numberBetween(2013,2018);
    $year1 = $year +1;
    return [
        'student' => $faker->numberBetween(1,200),
        'group' => $faker->numberBetween(1,200),
        'session' => "$year/$year1",
        "state" => $faker->randomElement(["waiting","accepted","rejected"])
    ];
});
