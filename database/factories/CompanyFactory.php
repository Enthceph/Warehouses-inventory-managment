<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->unique()->company(),
            'address' => fake()->address(),
            'contact_info' => fake()->tollFreePhoneNumber(),
            'created_at' => fake()->dateTimeBetween('-5 years'),
        ];
    }
}
