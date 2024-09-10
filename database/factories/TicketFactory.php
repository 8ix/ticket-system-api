<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ticket;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'user_id' => User::factory(),
            'status' => $this->faker->boolean,
        ];
    }

    /**
     * Indicate that the ticket is open.
     *
     * @return \Database\Factories\TicketFactory
     */
    public function open()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => false,
            ];
        });
    }

    /**
     * Indicate that the ticket is closed.
     *
     * @return \Database\Factories\TicketFactory
     */
    public function closed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => true,
            ];
        });
    }

    /**
     * Indicate that the ticket is processed.
     *
     * @return \Database\Factories\TicketFactory
     */
    public function processed(): self
    {
        return $this->state(fn (array $attributes) => [
            'status' => true,
        ]);
    }
}
