<?php

namespace Database\Seeders;

use App\Models\Outlet;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $warehousesCount = 12;

        for ($i = 0; $i < $warehousesCount; $i++) {
            $warehouse = Warehouse::factory()->create();

            Outlet::factory()->create([
                'address' => $warehouse['address'],
                'contact_info' => $warehouse['contact_info'],
                'warehouse_id' => $warehouse['id'],
                'company_id' => $warehouse['company_id'],
            ]);
        }

    }
}
