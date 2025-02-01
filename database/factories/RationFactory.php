<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ration>
 */
class RationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cookingDate = fake()->dateTimeBetween('tomorrow', '+14 days');
        $deliveryDate = fake()->dateTimeBetween($cookingDate, $cookingDate->format('Y-m-d H:i:s') . '+1 day');
        return [
            'order_id' => Order::inRandomOrder()->first(),
            'cooking_date' => $cookingDate,
            'delivery_date' => $deliveryDate,
        ];
    }
}
