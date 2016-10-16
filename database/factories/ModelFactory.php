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
$day_index = 1;
$id = 1;

function variableChanger($i, $j){
   global $id, $day_index;

    $id = $i;
    $day_index = $j;
}

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
            'publicEmail' => $faker->safeEmail,
            'description' => file_get_contents('http://loripsum.net/api/2/plaintext'),
            'Comments' => file_get_contents('http://loripsum.net/api/1/short/plaintext'),
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
           'name' => $faker->company,
           'publicPhoneNumber' => $faker->phoneNumber,
           'publicEmail' => $faker->safeEmail,
           'website' => $faker->domainName,
           'description' => file_get_contents('http://loripsum.net/api/2/plaintext'),
           'Comments' => file_get_contents('http://loripsum.net/api/1/short/plaintext'),
       ];
    });

    $factory->define(App\DailyHours::class, function (Faker\Generator $faker){

        global $id, $day_index;

        $days = array(
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday');

                return [
                   'day' => $days[$day_index],
                    'openTime' => '09:00:00',
                    'closeTime' => '17:00:00',
                    'resource_id' => $id
                ];
    });

