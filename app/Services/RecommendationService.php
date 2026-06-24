<?php

namespace App\Services;

use App\Models\Book;
use App\Models\User;

class RecommendationService
{
    /**
     * Get recommended books for a user based on their quiz preferences.
     */
    public function getRecommendations(?User $user, int $limit = 4, $excludeId = null)
    {
        $query = Book::query();
        
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        if (!$user || empty($user->preferences)) {
            return $query->inRandomOrder()->limit($limit)->get();
        }

        $prefs = is_string($user->preferences) ? json_decode($user->preferences, true) : $user->preferences;
        $books = $query->get();

        // Calculate a match score for each book
        $scoredBooks = $books->map(function ($book) use ($prefs) {
            $score = 0;
            $category = $book->category;

            // 1. Direct Genre Match (Highest Weight)
            if (isset($prefs['genres']) && is_array($prefs['genres'])) {
                if (in_array($category, $prefs['genres'])) {
                    $score += 50;
                }
            }

            // 2. Goal Matching
            $goal = $prefs['goal'] ?? '';
            if ($goal === 'Deep Dive Learning' && in_array($category, ['Science', 'Technology', 'History', 'Philosophy', 'Psychology'])) {
                $score += 20;
            } elseif ($goal === 'Light Escapism' && in_array($category, ['Fiction', 'Art'])) {
                $score += 20;
            } elseif ($goal === 'Quick Inspiration' && in_array($category, ['Self-Help', 'Business', 'Biography'])) {
                $score += 20;
            }

            // 3. Mood Matching
            $mood = $prefs['mood'] ?? '';
            if ($mood === 'Relaxed' && in_array($category, ['Fiction', 'Art'])) {
                $score += 15;
            } elseif ($mood === 'Focused' && in_array($category, ['Business', 'Technology', 'Science', 'Psychology'])) {
                $score += 15;
            } elseif ($mood === 'Inspired' && in_array($category, ['Biography', 'Self-Help', 'Philosophy'])) {
                $score += 15;
            } elseif ($mood === 'Tired' && in_array($category, ['Fiction', 'Self-Help'])) {
                $score += 15;
            }

            // 4. Pacing Matching (Simulated via text analysis)
            // Fast-paced prefers shorter descriptions or action words, Slow-burn prefers longer descriptions.
            $descLength = strlen($book->description);
            $pacing = $prefs['pacing'] ?? '';
            if ($pacing === 'Fast' && $descLength < 400) {
                $score += 10;
            } elseif ($pacing === 'Slow' && $descLength >= 400) {
                $score += 10;
            }

            // Add a slight random factor to prevent the exact same books every time
            $score += rand(1, 5);

            $book->match_score = $score;
            return $book;
        });

        // Sort by highest score first
        $sorted = $scoredBooks->sortByDesc('match_score')->values();

        // Return top X
        return $sorted->take($limit);
    }
}
