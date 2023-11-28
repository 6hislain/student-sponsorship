<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->numberBetween(100, 1000),
            'currency' => $this->faker->randomElement(['USD', 'RWF', 'EUR']),
            'confirmed' => $this->faker->randomElement([true, false]),
            'type' => $this->faker->randomElement(['regular', 'donation']),
            'attachment' => 'https://picsum.photos/id/' . $this->faker->numberBetween(1, 500) . '/300/300',
            'description' => $this->faker->paragraph(),
            'sponsor_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
