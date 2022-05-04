<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $start = $this->faker->dateTimeBetween('-5 days', 'now');
        $end = clone $start;
        $end->add(\DateInterval::createFromDateString($this->faker->numberBetween(1,10)." days"));
        return [
            "start" => $start->format("Y-m-d"),
            "end" => $end->format("Y-m-d"),
            "description" => $this->faker->realText(1000),
            "title" => $this->faker->jobTitle()
        ];
    }
}
