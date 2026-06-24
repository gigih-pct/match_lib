<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert the specific "Meditations" book
        Book::create([
            'title' => 'Meditations',
            'author' => 'Marcus Aurelius',
            'isbn' => '9780812968255',
            'category' => 'Philosophy',
            'image' => 'book_meditations_ai.png', // We'll rename the generated image to this later
            'description' => "Written by the Roman Emperor Marcus Aurelius as a source for his own guidance and self-improvement, these personal notes have become one of the most influential works of philosophy ever written.\n\nIt offers a remarkable series of spiritual reflections and exercises developed as the emperor struggled to understand himself and make sense of the universe.",
            'rating' => 4.8,
            'reviews_count' => 2400,
            'pages' => 254,
            'reading_time_mins' => 300, // 5h = 300 mins
            'published_year' => 167, // AD 167
        ]);

        // Generate 30 random books
        Book::factory()->count(30)->create();
    }
}
