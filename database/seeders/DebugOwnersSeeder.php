<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DebugOwnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'first_name' => "FirstName1",
                'last_name' => "LastName1",
                'email' => "test@test.com",
                'password' => "",
                'role_id' => 2,
            ],
            [
                'first_name' => "FirstName2",
                'last_name' => "LastName2",
                'email' => "test2@test.com",
                'password' => "",
                'role_id' => 2,
            ],
        ]);
    }
}
