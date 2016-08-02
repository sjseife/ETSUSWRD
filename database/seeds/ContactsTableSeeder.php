<?php

use Illuminate\Database\Seeder;
use App\Contact;
use Illuminate\Database\Schema;
use Illuminate\Support\Facades;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Contact::class, 50)->create();
    }
}
