<?php

namespace Database\Seeders;

use App\Models\ContentIdea;
use App\Models\ContentLog;
use App\Models\JournalEntry;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class PersonalOSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a demo user if one doesn't exist
        $user = User::firstOrCreate(
            ['email' => 'demo@personalos.com'],
            [
                'name' => 'PersonalOS Demo',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // Create sample tasks
        Task::factory()->count(15)->create(['user_id' => $user->id]);
        Task::factory()->backlog()->count(8)->create(['user_id' => $user->id]);
        Task::factory()->scheduled()->count(5)->create(['user_id' => $user->id]);
        Task::factory()->completed()->count(12)->create(['user_id' => $user->id]);

        // Create sample content ideas
        ContentIdea::factory()->count(10)->create(['user_id' => $user->id]);
        ContentIdea::factory()->scheduled()->count(3)->create(['user_id' => $user->id]);
        ContentIdea::factory()->video()->count(5)->create(['user_id' => $user->id]);
        ContentIdea::factory()->article()->count(7)->create(['user_id' => $user->id]);

        // Create sample journal entries
        JournalEntry::factory()->count(20)->create(['user_id' => $user->id]);
        JournalEntry::factory()->today()->count(1)->create(['user_id' => $user->id]);
        JournalEntry::factory()->reflection()->count(3)->create(['user_id' => $user->id]);
        JournalEntry::factory()->work()->count(5)->create(['user_id' => $user->id]);

        // Create sample content logs
        ContentLog::factory()->count(15)->create(['user_id' => $user->id]);
        ContentLog::factory()->highPerforming()->count(3)->create(['user_id' => $user->id]);
        ContentLog::factory()->video()->count(8)->create(['user_id' => $user->id]);
        ContentLog::factory()->article()->count(10)->create(['user_id' => $user->id]);
    }
}