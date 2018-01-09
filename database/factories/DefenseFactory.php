<?php

use Faker\Generator as Faker;

$factory->define(App\Defense::class, function (Faker $faker) {
    return [
        'date_d' => $faker->date,
        'start_time' => $faker->time('H:i'),
        'end_time' => $faker->time('H:i'),
        'classroom' => $faker->numerify('I#.#'),
        'internship' => $faker->numberBetween(1,20),
        'reporter' => $faker->randomElement($array = array ('5','22','26','20','16','40','48','34','30','45','3','6','10','19','2','41','49','47','18','39','24','32','46','9','50','1','8','27','14','28','35')),
        'president' => $faker->randomElement($array = array ('5','22','26','20','16','40','48','34','30','45','3','6','10','19','2','41','49','47','18','39','24','32','46','9','50','1','8','27','14','28','35')),
    ];
});
