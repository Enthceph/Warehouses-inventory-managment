<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $company = Company::inRandomOrder()->first();
        $categories = $company->categories;
        if ($categories->count() == 0) {
            $categoryId = null;
        } else {
            $categoryId = $categories->random()->id;
        }

        return [
            'name' => fake()->word(),
            'additional_info' => fake()->optional()->sentence(3),
            'company_id' => Company::factory() || $company->id,
            'category_id' => $categoryId,
            'created_at' => fake()->dateTimeBetween('-4 years'),
            'deleted_at' => fake()->optional(0.2)->dateTimeBetween('-2 years'),
        ];
    }
}
