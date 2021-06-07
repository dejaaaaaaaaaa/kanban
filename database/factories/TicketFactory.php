<?php

namespace Database\Factories;

use App\Models\Priority;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(200),
            'status_id' => Status::factory()->lazy(),
            'priority_id' => Priority::factory()->lazy(),
            'user_id' => User::factory()->lazy(),
            'created_by' => User::factory()->lazy(),
            'updated_by' => User::factory()->lazy(),
        ];
    }
}
