<?php

namespace Database\Factories;

use App\Enums\ScheduleType;
use App\Models\Tariff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstDate = fake()->dateTimeBetween('tomorrow', '+14 days');
        $lastDate = fake()->dateTimeBetween($firstDate, $firstDate->format('Y-m-d H:i:s') . '+14 days');
        return [
            'client_name' => fake()->name(),
            'client_phone' => fake()->numerify('79#########'),
            'tariff_id' => Tariff::inRandomOrder()->first(),
            'schedule_type' => fake()->randomElement(ScheduleType::class),
            'comment' => fake()->sentence(),
            'first_date' => $firstDate,
            'last_date' => $lastDate,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
