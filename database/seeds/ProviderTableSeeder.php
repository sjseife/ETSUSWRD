<?php

use Illuminate\Database\Seeder;

class ProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('providers')->insert([
            'name' => 'Test',
            'publicPhoneNumber' => '423-123-3244',
            'publicEmail' => 'info@test.com',
            'website' => 'test.com'
            ]);
        factory(App\Provider::class, 20)->create();
    }
}
