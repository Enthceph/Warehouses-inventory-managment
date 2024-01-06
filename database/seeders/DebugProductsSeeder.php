<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DebugProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Test product 1',
                'organisation_id' => 1,
            ],
            [
                'name' => 'Test product 2',
                'organisation_id' => 2,
            ],
        ]);
    }
}
