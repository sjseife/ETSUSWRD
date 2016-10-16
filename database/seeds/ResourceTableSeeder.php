<?php

use Illuminate\Database\Seeder;
use App\Resource;
use Illuminate\Database\Schema;
use Illuminate\Support\Facades;

class ResourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resources')->insert([
            'name' => 'Test',
            'streetAddress' => '123 Test Way',
            'streetAddress2' => 'Apt 3',
            'city' => 'Johnson City',
            'county' => 'Washington',
            'state' => 'TN',
            'zipCode' => '37601',
            'publicPhoneNumber' => '423-123-3244',
            'publicEmail' => 'test@email.com',
            'website' => 'test.com',
            'description' => file_get_contents('http://loripsum.net/api/2/plaintext'),
            'Comments' => file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'provider_id' => '1'
        ]);
        DB::table('resources')->insert([
            'name' => 'Test1',
            'streetAddress' => '987 MLK Blv',
            'city' => 'Johnson City',
            'county' => 'Washington',
            'state' => 'TN',
            'zipCode' => '37604',
            'publicPhoneNumber' => '423-234-3944',
            'publicEmail' => 'test1@email.com',
            'website' => 'test.com',
            'description' => file_get_contents('http://loripsum.net/api/3/plaintext'),
            'provider_id' => '2'
        ]);
        DB::table('resources')->insert([
            'name' => 'Test2',
            'streetAddress' => '234 No Longer Care Ave',
            'streetAddress2' => 'Apt 209',
            'city' => 'Gray',
            'county' => 'Washington',
            'state' => 'TN',
            'zipCode' => '37615',
            'publicPhoneNumber' => '423-954-3774',
            'publicEmail' => 'test2@email.com',
            'website' => 'test.com',
            'description' => file_get_contents('http://loripsum.net/api/4/plaintext'),
            'comments' => file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'provider_id' => '3'
        ]);
        factory(App\Resource::class, 50)->create();
    }
}
