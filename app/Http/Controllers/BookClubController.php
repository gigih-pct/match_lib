<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BookClubController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'book', 'likes', 'comments.user'])->latest()->get();
        $favoriteBooks = collect();
        if (auth()->check()) {
            $favoriteBooks = auth()->user()->books()->wherePivot('is_favorite', true)->get();
        }
        return view('bookclub.index', compact('posts', 'favoriteBooks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'book_id' => 'nullable|exists:books,id'
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
            'book_id' => $request->input('book_id'),
        ]);

        return redirect()->back()->with('success', 'Post published successfully!');
    }

    public function toggleLike(Post $post)
    {
        $user = auth()->user();
        $like = $post->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            $isLiked = false;
        } else {
            $post->likes()->create(['user_id' => $user->id]);
            $isLiked = true;
        }

        return response()->json([
            'success' => true,
            'is_liked' => $isLiked,
            'likes_count' => $post->likes()->count()
        ]);
    }

    public function storeComment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->input('content')
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
