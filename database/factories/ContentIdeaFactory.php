<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContentIdea>
 */
class ContentIdeaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['idea', 'draft', 'scheduled', 'completed']),
            'content_type' => fake()->randomElement(['article', 'video', 'live_stream', 'social_post', 'other']),
            'scheduled_at' => fake()->boolean(25) ? fake()->dateTimeBetween('now', '+30 days') : null,
            'keywords' => fake()->words(random_int(3, 8)),
            'tags' => fake()->words(random_int(2, 5)),
        ];
    }

    /**
     * Indicate that the content idea is scheduled.
     */
    public function scheduled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'scheduled',
            'scheduled_at' => fake()->dateTimeBetween('now', '+14 days'),
        ]);
    }

    /**
     * Indicate that the content idea is a video.
     */
    public function video(): static
    {
        return $this->state(fn (array $attributes) => [
            'content_type' => 'video',
            'title' => 'How to ' . fake()->sentence(3),
        ]);
    }

    /**
     * Indicate that the content idea is an article.
     */
    public function article(): static
    {
        return $this->state(fn (array $attributes) => [
            'content_type' => 'article',
            'title' => fake()->sentence(5) . ' Guide',
        ]);
    }
}