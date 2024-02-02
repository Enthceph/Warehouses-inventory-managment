<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Outlet;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Outlet>
 */
class OutletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'name' => fake()->unique()->word(),
            'address' => Warehouse::factory(),
            'contact_info' => Warehouse::factory(),
            'company_id' => Company::factory(),
            'warehouse_id' => Warehouse::factory(),
        ];
    }
}
