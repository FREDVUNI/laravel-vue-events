<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaymentFactory extends Factory
{
    public function definition()
    {
        return [
            'payment_status' => 'paid',
            'payment_method' => $this->faker->randomElement(['stripe', 'paypal', 'mobile_money']),
            'transaction_id' => 'TRX-' . Str::upper(Str::random(10)),
            'amount' => 50000, // This is usually overridden in the Seeder anyway
        ];
    }
}
