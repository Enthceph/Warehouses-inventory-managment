<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Warehouse>
 */
class WarehouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $company = Company::inRandomOrder()->first();
        return [
            'name' => fake()->unique()->word(),
            'location' => fake()->address(),
            'contact_info' => fake()->optional(0.35)->tollFreePhoneNumber(),
            'company_id' => $company->id,
        ];
    }
}
