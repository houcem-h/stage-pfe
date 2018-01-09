<?php

use Faker\Generator as Faker;

$factory->define(App\Group::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement($array = array ('TI11','TI12','TI13','TI14','TI15','DSI21','DSI22','RSI2','SEM2','DSI31','DSI32','RSI3','SEM3')),
        'stream' => $faker->randomElement($array = array ('TI','DSI','RSI','SEM')),                
    ];
});
