@extends('layouts.app')

@section('title', 'Explore Books - MindMatch Library')

@section('content')
<div class="mb-8">
    <h1 class="font-heading text-4xl font-bold tracking-tight text-[#1e1b16] mb-2">Explore Library</h1>
    <p class="text-[#4e4639] text-lg">
        @if(request('search'))
            Search results for "<span class="font-bold text-[#775a19]">{{ request('search') }}</span>"
        @else
            Discover your next favorite book from our curated collection.
        @endif
    </p>
</div>

<!-- Filters Bar -->
<div class="bg-white p-4 rounded-2xl shadow-sm border border-[#e9e1d8]/60 mb-10 flex flex-col md:flex-row gap-4 items-center">
    <form action="{{ route('produk.explore') }}" method="GET" id="filter-form" class="w-full flex flex-col md:flex-row gap-4 items-center">
        <!-- Keep existing search query if present -->
        @if(request('search'))
            <input type="hidden" name="search" value="{{ request('search') }}">
        @endif
        
        <!-- Category Filter -->
        <div class="w-full md:w-auto relative shrink-0">
            <select name="category" onchange="document.getElementById('filter-form').submit()" class="w-full md:w-48 appearance-none bg-[#fbf2e9] border border-[#e9e1d8] text-[#4e4639] text-sm rounded-xl py-3 pl-4 pr-10 focus:outline-none focus:ring-2 focus:ring-[#c5a059] font-medium cursor-pointer">
                <option value="All">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-[#775a19]">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
            </div>
        </div>

        <!-- Advanced Search (Author/Year/ISBN) -->
        <div class="w-full md:flex-1 relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 focus-within:text-[#775a19]">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            </div>
            <input type="text" name="advanced_search" value="{{ request('advanced_search') }}" class="w-full bg-white border border-[#e9e1d8] text-sm rounded-xl py-3 pl-11 pr-4 focus:outline-none focus:ring-2 focus:ring-[#c5a059] placeholder:text-gray-400 shadow-inner" placeholder="Filter by Author, Year, or ISBN...">
        </div>

        <!-- Sort Filter -->
        <div class="w-full md:w-auto relative shrink-0">
            <select name="sort" onchange="document.getElementById('filter-form').submit()" class="w-full md:w-40 appearance-none bg-[#fbf2e9] border border-[#e9e1d8] text-[#4e4639] text-sm rounded-xl py-3 pl-4 pr-10 focus:outline-none focus:ring-2 focus:ring-[#c5a059] font-medium cursor-pointer">
                <option value="terbaru" {{ request('sort') == 'terbaru' || !request('sort') ? 'selected' : '' }}>Terbaru</option>
                <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-[#775a19]">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18M6 12h12m-9 6h6"/></svg>
            </div>
        </div>
        
        <button type="submit" class="hidden md:flex bg-[#c5a059] hover:bg-[#b08e4f] text-[#2c251f] font-bold py-3 px-6 rounded-xl transition-all shadow-sm shrink-0 items-center gap-2">
            Filter
        </button>
    </form>
</div>

@if($books->isEmpty())
    <div class="bg-white rounded-3xl p-16 text-center border border-[#e9e1d8]/60 shadow-sm mt-8 mb-20">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto text-[#d1c5b4] mb-6"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        <h3 class="font-heading text-3xl font-bold text-[#1e1b16] mb-3">No books found</h3>
        <p class="text-[#4e4639] text-lg mb-8">We couldn't find any books matching your criteria. Try adjusting your filters.</p>
        <a href="{{ route('produk.explore') }}" class="inline-block px-8 py-3 bg-[#fbf2e9] text-[#775a19] font-bold rounded-xl hover:bg-[#e9e1d8] transition-colors shadow-sm">Clear All Filters</a>
    </div>
@else
    <div id="book-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6 lg:gap-8 mb-12">
        @include('produk.partials.book_grid', ['books' => $books])
    </div>

    <!-- See More Button -->
    <div class="mt-8 mb-20 flex justify-center w-full">
        @if($books->hasMorePages())
            <button id="see-more-btn" data-next-page="2" class="bg-white border-2 border-[#c5a059] text-[#775a19] hover:bg-[#fbf2e9] hover:border-[#775a19] font-bold py-3.5 px-12 rounded-full transition-all shadow-sm flex items-center gap-3 active:scale-95 cursor-pointer">
                <span id="see-more-text">See More</span>
                <svg id="see-more-spinner" class="animate-spin hidden h-5 w-5 text-[#775a19]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
        @else
            <p class="text-[#7f7667] text-sm font-medium bg-[#fbf2e9] px-6 py-2 rounded-full border border-[#e9e1d8]">You've reached the end of the list.</p>
        @endif
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const seeMoreBtn = document.getElementById('see-more-btn');
        if (!seeMoreBtn) return;

        seeMoreBtn.addEventListener('click', function() {
            const btn = this;
            const nextPage = btn.getAttribute('data-next-page');
            const grid = document.getElementById('book-grid');
            
            // Show loading state
            document.getElementById('see-more-text').textContent = 'Loading...';
            document.getElementById('see-more-spinner').classList.remove('hidden');
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-wait');

            // Get current URL params and append page
            const url = new URL(window.location.href);
            url.searchParams.set('page', nextPage);

            fetch(url.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if(response.ok) return response.text();
                throw new Error('Network response was not ok.');
            })
            .then(html => {
                // If empty or very short string, no more books
                if(html.trim().length < 10) {
                    btn.parentElement.innerHTML = '<p class="text-[#7f7667] text-sm font-medium bg-[#fbf2e9] px-6 py-2 rounded-full border border-[#e9e1d8]">You\'ve reached the end of the list.</p>';
                    return;
                }
                
                // Append new books
                grid.insertAdjacentHTML('beforeend', html);
                
                // Check if this new batch implies there are more pages? 
                // A better way is if the returned HTML is less than 4 books, but we can just wait for the next click to hit empty, 
                // OR we could have the backend send a flag. For simplicity, we just keep showing it until it returns empty.
                
                // Increment next page data
                btn.setAttribute('data-next-page', parseInt(nextPage) + 1);
                
                // Restore button state
                document.getElementById('see-more-text').textContent = 'See More';
                document.getElementById('see-more-spinner').classList.add('hidden');
                btn.disabled = false;
                btn.classList.remove('opacity-75', 'cursor-wait');
            })
            .catch(error => {
                console.error('Error fetching more books:', error);
                document.getElementById('see-more-text').textContent = 'Try Again';
                document.getElementById('see-more-spinner').classList.add('hidden');
                btn.disabled = false;
                btn.classList.remove('opacity-75', 'cursor-wait');
            });
        });
    });
</script>
@endsection
