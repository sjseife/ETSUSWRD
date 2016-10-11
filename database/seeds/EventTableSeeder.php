<?php

use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'name' => 'Test',
            'startDate' => '2016-10-22',
            'endDate' => '2016-10-23',
            'streetAddress' => '123 Blah Street',
            'city' => 'Gray',
            'county' => 'Washington',
            'state' => 'TN',
            'zipCode' => '37615',
            'publicPhoneNumber' => '423-954-2343',
            'comments' => 'Surprise! The event does not exist!',
            'provider_id' => '1'
        ]);

        DB::table('events')->insert([
            'name' => 'Test1',
            'startDate' => '2016-10-15',
            'endDate' => '2016-10-16',
            'streetAddress' => '952 Lets Move On Ave.',
            'city' => 'Johnson City',
            'county' => 'Washington',
            'state' => 'TN',
            'zipCode' => '37615',
            'publicPhoneNumber' => '423-954-3042',
            'comments' => 'Surprise! The event does not exist!',
            'provider_id' => '2'
        ]);

        DB::table('events')->insert([
            'name' => 'Test2',
            'startDate' => '2016-10-08',
            'endDate' => '2016-10-09',
            'streetAddress' => '234 No Longer Care Ave',
            'streetAddress2' => 'Apt 209',
            'city' => 'Gray',
            'county' => 'Washington',
            'state' => 'TN',
            'zipCode' => '37615',
            'publicPhoneNumber' => '423-954-3774',
            'comments' => 'Surprise! The event does not exist!',
            'provider_id' => '3'
        ]);
        for($x = 1; $x < 4; $x++)
        {
            DB::table('daily_hours')->insert([
                'day' => 'Saturday',
                'openTime' => '10:00:00',
                'closeTime' => '22:00:00',
                'event_id' => $x
            ]);
            DB::table('daily_hours')->insert([
                'day' => 'Sunday',
                'openTime' => '10:00:00',
                'closeTime' => '22:00:00',
                'event_id' => $x
            ]);
        }
    }
}
