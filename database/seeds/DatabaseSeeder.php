<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ResourceTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
    }
}
