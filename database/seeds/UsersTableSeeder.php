<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema;
use Illuminate\Database\Migrations\Migration;
use App\User;
use Illuminate\Support\Facades;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'Admin'
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user'),
            'role' => 'User'
        ]);
        DB::table('users')->insert([
            'name' => 'ga',
            'email' => 'ga@gmail.com',
            'password' => bcrypt('ga'),
            'role' => 'GA'
        ]);

        factory(App\User::class, 100)->create();
    }
}
