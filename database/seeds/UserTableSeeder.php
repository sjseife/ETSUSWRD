<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'System',
            'base' => '0',
            'extended' => '0',
            'create_update' => '0',
            'delete' => '0',
            'archive' => '0',
            'users' => '0',
            'roles' => '0'
        ]);
        DB::table('roles')->insert([
            'name' => 'Admin',
            'base' => '1',
            'extended' => '1',
            'create_update' => '1',
            'delete' => '1',
            'archive' => '1',
            'users' => '1',
            'roles' => '1'
        ]);
        DB::table('roles')->insert([
            'name' => 'GA',
            'base' => '1',
            'extended' => '1',
            'create_update' => '1',
            'delete' => '1',
            'archive' => '1',
            'users' => '0',
            'roles' => '0'
        ]);
        DB::table('roles')->insert([
            'name' => 'User',
            'base' => '1',
            'extended' => '0',
            'create_update' => '0',
            'delete' => '0',
            'archive' => '0',
            'users' => '0',
            'roles' => '0'
        ]);

        DB::table('users')->insert([
           'name' => 'System',
            'email' => 'System@etsu.edu',
            'password' => bcrypt('pants'),
            'role_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user'),
            'role_id' => '4',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'name' => 'ga',
            'email' => 'ga@gmail.com',
            'password' => bcrypt('ga'),
            'role_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        factory(App\User::class, 100)->create();
    }
}
