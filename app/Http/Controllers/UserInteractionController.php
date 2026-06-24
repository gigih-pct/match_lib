<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class UserInteractionController extends Controller
{
    public function toggleFavorite(Book $book)
    {
        $user = auth()->user();
        
        $interaction = $user->books()->where('book_id', $book->id)->first();
        
        if ($interaction) {
            $newStatus = !$interaction->pivot->is_favorite;
            $user->books()->updateExistingPivot($book->id, ['is_favorite' => $newStatus]);
        } else {
            $user->books()->attach($book->id, ['is_favorite' => true]);
            $newStatus = true;
        }

        return response()->json(['success' => true, 'is_favorite' => $newStatus]);
    }

    public function saveProgress(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);
        $user = auth()->user();

        // Check whether progress parameter is from new input or old input
        $progress = $request->input('percentage') ?? $request->input('progress', 0);
        $percentage = max(0, min(100, (int)$progress));

        $user->books()->syncWithoutDetaching([
            $bookId => [
                'progress_percentage' => $percentage,
                'last_read_at' => now()
            ]
        ]);

        // Log reading session for today (simulate 15-45 minutes read)
        $today = now()->format('Y-m-d');
        $session = \App\Models\ReadingSession::firstOrNew([
            'user_id' => $user->id,
            'read_date' => $today
        ]);
        
        $session->minutes_read += rand(15, 45); // simulate reading duration
        $session->save();

        return response()->json([
            'status' => 'success',
            'progress' => $percentage,
            'minutes_added' => $session->minutes_read
        ]);
    }
}
