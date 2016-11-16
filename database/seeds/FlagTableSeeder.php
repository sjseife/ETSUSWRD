<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('flags')->insert([
            'level' => 'Delete',
            'comments' => 'Resource went bankrupt and no longer provides services. :(',
            'resolved' => '0',
            'submitted_by' => '3',
            'resource_id' => '6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('flags')->insert([
            'level' => 'Update',
            'comments' => 'Contact got Married! Last name is now Fitzgerald. :)',
            'resolved' => '0',
            'submitted_by' => '3',
            'contact_id' => '6',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('flags')->insert([
            'level' => 'Delete',
            'comments' => 'Event is cancelled due to inbound hurricane! :(',
            'resolved' => '0',
            'submitted_by' => '3',
            'event_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
