<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductCategory>
 */
class ProductCategoryFactory extends Factory
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
            'company_id' => $company->id,
            'deleted_at' => $this->faker->optional(0.1)->dateTimeBetween('-5 years'),
        ];
    }
}
