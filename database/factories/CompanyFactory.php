<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->company,
        'activity' => $faker->unique()->bs,
        'phone' => $faker->unique()->e164PhoneNumber,
        'fax' => $faker->unique()->e164PhoneNumber,
        'address' => $faker->unique()->address,        
    ];
});
