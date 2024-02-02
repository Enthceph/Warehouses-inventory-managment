<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CompanySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProductCategoriesSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(WarehouseSeeder::class);
        $this->call(InventorySeeder::class);
    }
}
