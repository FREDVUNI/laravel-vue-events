<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence(4);
        return [
            'title'       => $title,
            'description' => $this->faker->paragraph(2),
            'location'    => $this->faker->city,
            'slug'        => $this->faker->unique()->slug,
            'image'       => 'https://loremflickr.com/1280/720/concert,party,festival,club?random=' . $this->faker->unique()->numberBetween(1, 1000),
            'start_date'  => now()->addDays(7),
            'end_date'    => now()->addDays(8),
        ];
    }
}
