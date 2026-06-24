<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;

class ProdukController extends Controller
{
    public function explore(Request $request)
    {
        $query = Book::query();
        
        // 1. General search (title)
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where('title', 'like', "%{$searchTerm}%");
        }
        
        // 2. Advanced search (author, year, isbn)
        if ($request->has('advanced_search') && $request->advanced_search != '') {
            $advSearch = $request->advanced_search;
            $query->where(function($q) use ($advSearch) {
                $q->where('author', 'like', "%{$advSearch}%")
                  ->orWhere('published_year', 'like', "%{$advSearch}%")
                  ->orWhere('isbn', 'like', "%{$advSearch}%");
            });
        }
        
        // 3. Category filter
        if ($request->has('category') && $request->category != '' && $request->category != 'All') {
            $query->where('category', $request->category);
        }
        
        // 4. Sorting
        if ($request->has('sort')) {
            if ($request->sort == 'terlama') {
                $query->orderBy('published_year', 'asc')->oldest();
            } else {
                $query->orderBy('published_year', 'desc')->latest();
            }
        } else {
            $query->latest();
        }
        
        // Paginate by 4 for the "See More" functionality
        $books = $query->paginate(4)->withQueryString();
        
        // Return partial view if AJAX
        if ($request->ajax()) {
            return view('produk.partials.book_grid', compact('books'))->render();
        }
        
        // For categories dropdown
        $categories = Book::select('category')->distinct()->pluck('category');
        
        return view('produk.explore', compact('books', 'categories'));
    }

    public function show(Book $book)
    {
        return view('produk.show', compact('book'));
    }

    public function read(Request $request, Book $book)
    {
        return view('produk.read', compact('book'));
    }
}
