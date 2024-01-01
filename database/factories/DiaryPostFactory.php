<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiaryPost>
 */
class DiaryPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraphs(3, true),
            'slug' => $this->faker->slug,
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
