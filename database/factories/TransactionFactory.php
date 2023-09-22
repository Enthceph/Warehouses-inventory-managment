<?php

namespace Database\Factories;

use App\Models\Categories;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\DateTime;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TransactionFactory extends Factory
{

    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $types = ['income', 'expense'];

        $categories_keys[] = Categories::getIncomesCategoriesKeys();
        $categories_keys[] = Categories::getExpensesCategoriesKeys();

        return [
            'amount' => fake()->numberBetween(0, 3000),
            'type' => fake()->randomElement($types),
            'date' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
            'description' => fake()->word(),

            'category_id' => fake()->randomElement(fake()->randomElement($categories_keys)),
            'user_id' => fake()->randomElement(User::all()->pluck('id')),

            'created_at' => fake()->unixTime(new DateTime('-3 months')),
            'updated_at' => fake()->unixTime(new DateTime('-1 months')),
        ];
    }
}
