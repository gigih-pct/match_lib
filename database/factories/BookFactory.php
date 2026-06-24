<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Philosophy', 'Business', 'Self-Help', 'Productivity', 'Finance', 'Psychology'];
        $images = [
            'book_wealth_1782216404247.png',
            'book_mindful_1782216416504.png',
            'book_economic_1782216430017.png',
            'book_quiet_1782216443831.png',
            'featured_book_1782216391202.png'
        ];

        return [
            'title' => ucwords($this->faker->words(rand(2, 4), true)),
            'author' => $this->faker->name(),
            'isbn' => $this->faker->isbn13(),
            'category' => $this->faker->randomElement($categories),
            'image' => $this->faker->randomElement($images),
            'description' => $this->faker->paragraphs(2, true),
            'rating' => $this->faker->randomFloat(1, 3, 5),
            'reviews_count' => $this->faker->numberBetween(10, 5000),
            'pages' => $this->faker->numberBetween(100, 800),
            'reading_time_mins' => $this->faker->numberBetween(30, 600),
            'published_year' => $this->faker->year(),
        ];
    }
}
