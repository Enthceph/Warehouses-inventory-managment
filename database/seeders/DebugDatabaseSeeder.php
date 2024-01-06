<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DebugDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DebugOwnersSeeder::class);
        $this->call(DebugOrganisationsSeeder::class);
        $this->call(DebugProductsSeeder::class);
    }
}
