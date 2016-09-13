<?php

use Illuminate\Database\Seeder;


class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->insert([
            'id' => 1,
            'firstName' => 'George',
            'lastName' => 'McFly',
            'email' => 'back2@dafuture.com',
            'phoneNumber' => '1111111111',
            'resource_id' => 2
        ]);

        DB::table('contacts')->insert([
            'id' => 2,
            'firstName' => 'Blah',
            'lastName' => 'Blob',
            'email' => 'bleh@bloo.com',
            'phoneNumber' => '1233211232',
            'resource_id' => 1
        ]);

        DB::table('contacts')->insert([
            'id' => 3,
            'firstName' => 'Bill',
            'lastName' => 'Smith',
            'email' => 'bill@smith.com',
            'phoneNumber' => '3332224424',
            'resource_id' => 3
        ]);
    }
}
