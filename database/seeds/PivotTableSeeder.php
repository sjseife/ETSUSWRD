<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PivotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($x = 1; $x < 20; $x++)
        {
            DB::table('category_resource')->insert([
                'category_id' => '1',
                'resource_id' => '' + $x,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
        for($x = 20; $x < 40; $x++)
        {
            DB::table('category_resource')->insert([
                'category_id' => '2',
                'resource_id' => '' + $x,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
        for($x = 30; $x < 50; $x++)
        {
            DB::table('category_resource')->insert([
                'category_id' => '3',
                'resource_id' => '' + $x,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
