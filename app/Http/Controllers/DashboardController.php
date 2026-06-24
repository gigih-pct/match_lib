<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Services\RecommendationService;

class DashboardController extends Controller
{
    public function index(RecommendationService $recommendationService)
    {
        $featuredBook = Book::where('title', 'Meditations')->first();
        $recentBooks = collect();
        $sectionTitle = 'Career & Financial';

        $user = auth()->user();
        if ($user && $user->preferences) {
            $recentBooks = $recommendationService->getRecommendations($user, 4, $featuredBook?->id);
            $goal = $user->preferences['goal'] ?? '';
            $sectionTitle = $goal ? "Curated for " . $goal : "Recommended for You";
        } else {
            $recentBooks = Book::where('title', '!=', 'Meditations')->inRandomOrder()->limit(4)->get();
            $sectionTitle = 'Top Picks for You';
        }
        
        return view('dashboard.index', compact('featuredBook', 'recentBooks', 'sectionTitle'));
    }
}
