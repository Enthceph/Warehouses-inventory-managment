<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class EmployeeFactory extends Factory
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
            'full_name' => fake()->unique()->name(),
            'email' => fake()->unique()->email(),
            'password' => Hash::make('qwertyui'),
            'role_id' => fake()->numberBetween(3, 6),
            'company_id' => $company->id,
            'created_at' => $company->created_at,
            'deleted_at' => fake()->dateTimeBetween('-3 years', "-1 year"),
        ];
    }
}
