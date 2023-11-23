<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_categories')->insert([
            ['category' => 'other'],
            ['category' => 'income'],
            ['category' => 'expense'],
            ['category' => 'tax'],
        ]);
    }
}
