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
            'protectedEmail' => $faker->safeEmail,
            'protectedPhoneNumber' => $faker->phoneNumber
        ];
    });

    $factory->define(App\Resource::class, function (Faker\Generator $faker) {
        return [
            'name' => $faker->company,
            'streetAddress' => $faker->streetAddress,
            'city' => $faker->city,
            'county' => $faker->city,
            'state' => 'TN',
            'zipcode' => $faker->postcode,
            'publicPhoneNumber' => $faker->phoneNumber,
            'provider_id' => rand(1, 21)
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

    $factory->define(App\Provider::class, function (Faker\Generator $faker) {
       return [
           'name' => $faker->name,
           'publicPhoneNumber' => $faker->phoneNumber,
           'publicEmail' => $faker->safeEmail,
           'website' => $faker->domainName
       ];
    });

    $factory->define(App\DailyHours::class, function (Faker\Generator $faker) {
        $days = array(
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday'
        );
       return [
           'day' => $days[rand(1,7)],
           'openTime' => $faker->time(),
           'closeTime' => $faker->time(),
           'resource_id' => rand(1,50)
       ];
    });

