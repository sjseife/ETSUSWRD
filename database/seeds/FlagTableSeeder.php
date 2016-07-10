<?php

use Illuminate\Database\Seeder;

class FlagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('flag')->insert([
        'Date' => '2016-07-09',
        'Level' => '1',
        'Comments' => 'Flag for resource 1',
        'user_id' => '2',
        'resource_id' => '1'
    ]);
        DB::table('flag')->insert([
            'Date' => '2016-03-12',
            'Level' => '0',
            'Comments' => 'Flag for resource 2',
            'user_id' => '2',
            'resource_id' => '2'
        ]);
        DB::table('flag')->insert([
            'Date' => '2016-05-05',
            'Level' => '2',
            'Comments' => 'Flag for resource 3',
            'user_id' => '3',
            'resource_id' => '3'
        ]);
    }

}