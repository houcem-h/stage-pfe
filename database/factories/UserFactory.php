<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'birthdate' => $faker->date,
        'cin' => $faker->numberBetween(10000000,99999999),
        'phone' => $faker->e164PhoneNumber,
        'password' => $password ?: $password = bcrypt('12345'),
        //'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'role' => $faker->numberBetween(0,2),        
        'remember_token' => str_random(10),
    ];
});
