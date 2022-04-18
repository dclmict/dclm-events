<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Country;
use App\Models\Continent;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // DB::table('users')->delete();
        User::create(array(
            'name' => 'EventAdmin',
            'email' => 'dclmict@gmail.com',
            'password' => '$2y$10$xe67ijCFBDBERFgXfIW4.uTds76JMe6JXesU0aadeyjBtaH0vQ4sW',
        ));
        
        Continent::create(
            [ 'name' => "Africa" ],
        );
        
        Country::create(
            [ 'name' => "Nigeria", "continent_id" => 1 ],
        );

        // Dclmadminpassword
    }
}
