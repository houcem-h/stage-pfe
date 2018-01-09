<?php

use Faker\Generator as Faker;

$factory->define(App\Minute::class, function (Faker $faker) {
    return [
        'defense' => $faker->numberBetween(1,20),
        'final_note' => $faker->randomFloat(2,0,20),
        'mention' => $faker->word,
        'notes' => $faker->sentence(10),        
    ];
});
