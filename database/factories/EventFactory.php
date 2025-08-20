<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('now', '+3 months');
    return [
        'title' => $this->faker->sentence(3),
        'description' => $this->faker->paragraph(3),
        'venue' => $this->faker->address(),
        'start_datetime' => $start,
        'end_datetime' => $this->faker->dateTimeBetween($start, (clone $start)->modify('+5 hours')),
        'status' => $this->faker->randomElement(['draft', 'published']),
        // organizer_id akan diisi di seeder
    ];
    }
}
