<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'activity' => $faker->bs,
        'phone' => $faker->e164PhoneNumber,
        'fax' => $faker->e164PhoneNumber,
        'address' => $faker->address,        
    ];
});
