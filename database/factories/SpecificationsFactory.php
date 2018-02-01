<?php

use Faker\Generator as Faker;

$factory->define(App\Specification::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'project_type' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'existing_desc' => $faker->sentence($nbWords = 7, $variableNbWords = true),
        'requirement_spec' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'hardware_env' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'software_env' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'provisional_planning' => $faker->sentence($nbWords = 4, $variableNbWords = true),

    ];
});
