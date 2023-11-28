<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChildFactory extends Factory
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
            'school' => $this->faker->randomElement(['gikongoro', 'byumba', 'kayonza', 'kigali']),
            'address' => $this->faker->streetAddress(),
            'contact_person' => $this->faker->name(),
            'contact_details' => $this->faker->phoneNumber(),
            'image' => 'https://picsum.photos/id/' . $this->faker->numberBetween(1, 500) . '/300/300',
            'description' => $this->faker->paragraph(),
            'dob' => $this->faker->dateTimeBetween('2010-11-11', '2020-11-11')->format('Y-m-d'),
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
