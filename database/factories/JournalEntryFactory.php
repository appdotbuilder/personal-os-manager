<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JournalEntry>
 */
class JournalEntryFactory extends Factory
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
            'content' => fake()->paragraphs(random_int(2, 6), true),
            'tags' => fake()->words(random_int(1, 4)),
            'entry_date' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
        ];
    }

    /**
     * Indicate that the journal entry is from today.
     */
    public function today(): static
    {
        return $this->state(fn (array $attributes) => [
            'entry_date' => now()->format('Y-m-d'),
            'title' => 'Today\'s Thoughts',
        ]);
    }

    /**
     * Indicate that the journal entry is a reflection.
     */
    public function reflection(): static
    {
        return $this->state(fn (array $attributes) => [
            'title' => 'Reflection: ' . fake()->sentence(3),
            'tags' => ['reflection', 'personal', 'growth'],
        ]);
    }

    /**
     * Indicate that the journal entry is about work.
     */
    public function work(): static
    {
        return $this->state(fn (array $attributes) => [
            'title' => 'Work Update: ' . fake()->sentence(2),
            'tags' => ['work', 'productivity', 'career'],
        ]);
    }
}