<?php

use Faker\Generator as Faker;

$factory->define(App\Internship::class, function (Faker $faker) {
    return [
        'student' => $faker->numberBetween(1,19),
        'start_date' => $faker->date,
        'end_date' => $faker->date,
        'type' => $faker->randomElement($array = array ('init','perf','pfe')),
        'framer' => $faker->randomElement($array = array ('5','22','26','20','16','40','48','34','30','45','3','6','10','19','2','41','49','47','18','39','24','32','46','9','50','1','8','27','14','28','35')),
        'company_framer' => $faker->numberBetween(1,20),        
    ];
});
