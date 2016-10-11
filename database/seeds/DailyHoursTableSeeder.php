<?php

use Illuminate\Database\Seeder;

class DailyHoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\DailyHours::class, 200)->create();
    }
}
