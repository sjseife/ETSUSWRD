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
        $this->call(UsersTableSeeder::class);
        $this->call(ResourceTableSeeder::class);
        $this->call(FlagTableSeeder::class);
        //$this->call(CategoriesTableSeeder::class);
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
