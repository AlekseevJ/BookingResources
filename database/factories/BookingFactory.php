<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Resource;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = \Date::now()->addDays($this->faker->numberBetween(1, 10))->addHours($this->faker->numberBetween(1, 12));
        $endTime = (clone $startTime)->addHours($this->faker->numberBetween(1, 4));

        return [
            'resource_id' => Resource::factory(),
            'user_id' => User::factory(),
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }
}
