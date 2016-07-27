<?php

use Illuminate\Database\Seeder;

class ResourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resource')->insert([
            'Name' => 'Test',
            'StreetAddress' => '123 Test Way',
            'StreetAddress2' => 'Apt 3',
            'City' => 'Johnson City',
            'County' => 'Washington',
            'State' => 'TN',
            'ZipCode' => '37601',
            'PhoneNumber' => '423-123-3244',
            'OpeningHours' => '12:00:00',
            'ClosingHours' => '20:00:00',
            'Comments' => 'Surprise! The site does not exist!'
        ]);
        DB::table('resource')->insert([
            'Name' => 'Test1',
            'StreetAddress' => '987 MLK Blv',
            'City' => 'Johnson City',
            'County' => 'Washington',
            'State' => 'TN',
            'ZipCode' => '37604',
            'PhoneNumber' => '423-234-3944',
            'OpeningHours' => '07:00:00',
            'ClosingHours' => '21:00:00',
            'Comments' => 'Surprise! The site does not exist!'
        ]);
        DB::table('resource')->insert([
            'Name' => 'Test2',
            'StreetAddress' => '234 No Longer Care Ave',
            'StreetAddress2' => 'Apt 209',
            'City' => 'Gray',
            'County' => 'Washington',
            'State' => 'TN',
            'ZipCode' => '37615',
            'PhoneNumber' => '423-954-3774',
            'OpeningHours' => '00:00:00',
            'ClosingHours' => '00:00:00',
            'Comments' => 'Surprise! The site does not exist!'
        ]);
    }
}
