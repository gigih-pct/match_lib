<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BookSeeder::class,
        ]);

        // Dummy users for Book Club
        $user1 = \App\Models\User::firstOrCreate(
            ['email' => 'sarah@example.com'],
            ['name' => 'Sarah Jenkins', 'password' => bcrypt('password')]
        );
        $user2 = \App\Models\User::firstOrCreate(
            ['email' => 'marcus@example.com'],
            ['name' => 'Marcus Aurelius Fan', 'password' => bcrypt('password')]
        );

        $book1 = \App\Models\Book::where('title', 'Meditations')->first();
        $book2 = \App\Models\Book::where('title', 'The Psychology of Money')->first();

        // Dummy Posts
        if (\App\Models\Post::count() == 0) {
            \App\Models\Post::create([
                'user_id' => $user1->id,
                'book_id' => $book2 ? $book2->id : null,
                'content' => 'Just finished this masterpiece. It completely changed how I view wealth. It\'s not about how much you make, but how you behave with it. Highly recommend to everyone in this club!',
                'created_at' => now()->subDays(2)
            ]);

            \App\Models\Post::create([
                'user_id' => $user2->id,
                'book_id' => $book1 ? $book1->id : null,
                'content' => 'Re-reading this for the 3rd time this year. "You have power over your mind - not outside events." Never gets old. What is everyone else reading this weekend?',
                'created_at' => now()->subHours(5)
            ]);
        }

        // Dummy Reading Sessions for the main user (id: 1) if exists
        $mainUser = \App\Models\User::find(1);
        if ($mainUser && \App\Models\ReadingSession::where('user_id', $mainUser->id)->count() == 0) {
            $days = [
                now()->startOfWeek(),
                now()->startOfWeek()->addDays(1),
                now()->startOfWeek()->addDays(2),
                now()->startOfWeek()->addDays(3),
                now()->startOfWeek()->addDays(4),
                now()->startOfWeek()->addDays(5),
            ];

            $minutes = [45, 60, 30, 0, 120, 85]; // Mon to Sat

            foreach ($days as $index => $date) {
                if ($date <= now()) {
                    \App\Models\ReadingSession::create([
                        'user_id' => $mainUser->id,
                        'read_date' => $date->format('Y-m-d'),
                        'minutes_read' => $minutes[$index]
                    ]);
                }
            }
        }
    }
}
