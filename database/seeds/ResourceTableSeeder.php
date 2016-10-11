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
            'description' => 'Here at Test, we firmly believe in Science!',
            'Comments' => 'Surprise! The site does not exist!',
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
            'comments' => 'Surprise! The site does not exist!',
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
            'comments' => 'Surprise! The site does not exist!',
            'provider_id' => '3'
        ]);
        factory(App\Resource::class, 50)->create();
    }
}
