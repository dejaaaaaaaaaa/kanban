<?php

namespace Database\Factories;

use App\Models\Priority;
use Illuminate\Database\Eloquent\Factories\Factory;

class PriorityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Priority::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'priority' => $this->faker->word(),
            'color' => $this->faker->hexColor()
        ];
    }
}
