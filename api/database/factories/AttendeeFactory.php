<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;

class AttendeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'     => $this->faker->unique()->name,
            'email'    => $this->faker->unique()->safeEmail,
            'phone'    => $this->faker->unique()->phoneNumber,
            'slug'     => $this->faker->unique()->slug,
            'event_id' => Event::factory(),
        ];
    }
}
