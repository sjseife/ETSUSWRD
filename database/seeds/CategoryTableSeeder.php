<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            'Name' => 'Veterans'
        ]);
        DB::table('category')->insert([
            'Name' => 'Food'
        ]);
        DB::table('category')->insert([
            'Name' => 'Housing'
        ]);
    }
}
