<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SponsorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'address' => $this->faker->streetAddress(),
            'contact' => $this->faker->phoneNumber(),
            'image' => 'https://picsum.photos/id/' . $this->faker->numberBetween(1, 500) . '/300/300',
            'description' => $this->faker->paragraph(),
            'dob' => $this->faker->dateTimeBetween('1970-11-11', '1990-11-11')->format('Y-m-d'),
            'identification' => 'https://picsum.photos/id/' . $this->faker->numberBetween(1, 500) . '/300/300',
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
