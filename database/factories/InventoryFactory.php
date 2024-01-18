<?php

namespace Database\Factories;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $quantity = fake()->numberBetween(1, 50);
        $unit_price = fake()->numberBetween(1, 400);
        $total_value = $quantity * $unit_price;

        $warehouse = Warehouse::inRandomOrder()->first();

        $product = Product::where('company_id', $warehouse->company_id)
            ->inRandomOrder()
            ->first();

        if (!$product) {
            $product = Product::factory()->create([
                'company_id' => $warehouse->company_id
            ]);
        }

        return [
            'quantity' => $quantity,
            'unit_price' => $unit_price,
            'total_value' => $total_value,
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'created_at' => fake()->dateTimeBetween('-1 year', "-2 months"),
            'deleted_at' => fake()->dateTimeBetween('-8 months', "-3 months"),
            'expires_at' => fake()->dateTimeBetween('now', "3 weeks")
        ];
    }
}
