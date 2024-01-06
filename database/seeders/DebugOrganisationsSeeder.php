<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DebugOrganisationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organisations')->insert([
            [
                'name' => 'Org 1',
                'address' => 'Org address 1',
                'contact_info' => 'Org contact info 1',
                'owner_id' => 1,

            ],
            [
                'name' => 'Org 2',
                'address' => 'Org address 2',
                'contact_info' => 'Org contact info 2',
                'owner_id' => 2,
            ],
        ]);
    }
}
