<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Veterans'
        ]);
        DB::table('categories')->insert([
            'name' => 'Food'
        ]);
        DB::table('categories')->insert([
            'name' => 'Shelter'
        ]);
    }
}
