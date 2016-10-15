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
        for($i = 1; $i < 51; $i++)
            for($j = 1; $j < 6; $j++)
            {
                variableChanger($i, $j);

                factory(App\DailyHours::class, 1)->create();
            }
    }
}
