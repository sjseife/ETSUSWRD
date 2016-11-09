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
        $this->call(EventTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(FlagTableSeeder::class);
        $this->call(PivotTableSeeder::class);
        $this->call(DailyHoursTableSeeder::class);
    }
}
