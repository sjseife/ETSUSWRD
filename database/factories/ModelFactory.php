<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Contact::class, function (Faker\Generator $faker) {
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'email' => $faker->safeEmail,
        'phoneNumber' => $faker->phoneNumber
    ];
});

$factory->define(App\Resource::class, function (Faker\Generator $faker) {
    return [
        'Name' => $faker->company,
        'StreetAddress' => $faker->streetAddress,
        'City' => $faker->city,
        'County' => $faker->city,
        'State' => 'TN',
        'Zipcode' => $faker->postcode,
        'PhoneNumber' => $faker->phoneNumber,
        'OpeningHours' => $faker->time('H:i:s'),
        'ClosingHours' => $faker->time('H:i:s')
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'role' => 'User',
        'password' => bcrypt(str_random(10)),
    ];
});

