<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContentLog>
 */
class ContentLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contentType = fake()->randomElement(['article', 'video', 'live_stream']);
        
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'content_type' => $contentType,
            'url' => fake()->url(),
            'keywords' => fake()->words(random_int(4, 10)),
            'categories' => fake()->words(random_int(2, 4)),
            'views' => fake()->numberBetween(10, 50000),
            'engagement' => fake()->numberBetween(1, 5000),
            'published_at' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
        ];
    }

    /**
     * Indicate that the content is a high-performing piece.
     */
    public function highPerforming(): static
    {
        return $this->state(fn (array $attributes) => [
            'views' => fake()->numberBetween(10000, 100000),
            'engagement' => fake()->numberBetween(1000, 10000),
        ]);
    }

    /**
     * Indicate that the content is a video.
     */
    public function video(): static
    {
        return $this->state(fn (array $attributes) => [
            'content_type' => 'video',
            'title' => 'How to ' . fake()->sentence(3),
        ]);
    }

    /**
     * Indicate that the content is an article.
     */
    public function article(): static
    {
        return $this->state(fn (array $attributes) => [
            'content_type' => 'article',
            'title' => fake()->sentence(5) . ' - Complete Guide',
        ]);
    }
}