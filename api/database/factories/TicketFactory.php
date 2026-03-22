<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use App\Models\User;

class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ticket_type' => $this->faker->randomElement(['Regular', 'VIP', 'VVIP']),
            'price'       => $this->faker->randomElement([50000, 100000, 250000]), // Ugandan Shilling style
            'slug'        => $this->faker->unique()->slug,
            'event_id'    => Event::factory(), // Automatically creates an event if none exists
            'user_id'     => User::factory(),
        ];
    }
}
