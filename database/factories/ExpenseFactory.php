<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\DateTime;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Expense::class;

    public function definition()
    {
        return [
            'amount' => fake()->numberBetween(0, 3000),
            'date' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
            'description' => fake()->word(),

            'category_id' => $this->faker->randomElement(Expense::getCategoriesKeys()),
            'user_id' => $this->faker->randomElement(User::all()->pluck('id')),

            'created_at' => fake()->unixTime(new DateTime('-3 months')),
            'updated_at' => fake()->unixTime(new DateTime('-1 months')),
        ];
    }
}
