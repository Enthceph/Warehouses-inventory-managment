<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
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
            'role_id' => 3,
            'company_id' => $company->id,
            'created_at' => $company->created_at,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $user->createToken("API TOKEN")->plainTextToken;
        });
    }
}
