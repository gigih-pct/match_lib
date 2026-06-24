<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RecommendationService;

class MyShelfController extends Controller
{
    public function index(RecommendationService $recommendationService)
    {
        $recommendedBooks = collect();
        $currentlyReading = collect();
        $favorites = collect();
        
        // Reading stats
        $totalMinutesThisWeek = 0;
        $chartData = [
            'Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0, 'Fri' => 0, 'Sat' => 0, 'Sun' => 0
        ];
        
        if (auth()->check()) {
            $user = auth()->user();
            $recommendedBooks = $recommendationService->getRecommendations($user, 3);
            
            $currentlyReading = $user->books()
                ->wherePivot('progress_percentage', '>', 0)
                ->wherePivot('progress_percentage', '<', 100)
                ->orderByPivot('last_read_at', 'desc')
                ->get();
                
            $favorites = $user->books()
                ->wherePivot('is_favorite', true)
                ->get();

            // Fetch reading sessions for the current week (Monday to Sunday)
            $startOfWeek = now()->startOfWeek();
            $endOfWeek = now()->endOfWeek();

            $sessions = \App\Models\ReadingSession::where('user_id', $user->id)
                ->whereBetween('read_date', [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')])
                ->get();

            foreach ($sessions as $session) {
                $dayName = \Carbon\Carbon::parse($session->read_date)->format('D'); // Mon, Tue...
                $chartData[$dayName] = $session->minutes_read;
                $totalMinutesThisWeek += $session->minutes_read;
            }
        }
        
        // Find max value to calculate percentage for chart heights
        $maxMinutes = max($chartData) ?: 1; // prevent division by zero
        
        $chartHeights = [];
        foreach ($chartData as $day => $minutes) {
            $chartHeights[$day] = ($minutes / $maxMinutes) * 100;
        }

        return view('myshelf.index', compact('recommendedBooks', 'currentlyReading', 'favorites', 'totalMinutesThisWeek', 'chartData', 'chartHeights'));
    }
}
