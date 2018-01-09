<?php

use Faker\Generator as Faker;

$factory->define(App\Registration::class, function (Faker $faker) {
    $year = $faker->numberBetween(2013,2018);
    $year1 = $year +1;
    return [
        'student' => $faker->randomElement($array = array ('12','29','44','25','42','23','11','31','4','33','36','43','21','17','37','13','38','7','15')),
        'group' => $faker->numberBetween(1,13),
        'session' => "$year/$year1",
    ];
});
