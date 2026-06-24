@foreach($books as $book)
    <a href="{{ route('produk.show', $book) }}" class="group block book-item relative">
        <div class="aspect-[3/4] rounded-xl overflow-hidden shadow-sm transition-all duration-500 group-hover:shadow-xl group-hover:-translate-y-2 mb-4 bg-gray-100 relative">
            @if($book->image)
                <img src="{{ asset('images/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-[#c5a059] bg-[#fbf2e9]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>
                </div>
            @endif
            
            @php
                $isFav = auth()->check() && auth()->user()->books->where('id', $book->id)->where('pivot.is_favorite', true)->isNotEmpty();
            @endphp
            <button data-book-id="{{ $book->id }}" class="favorite-btn absolute top-3 right-3 bg-white/80 backdrop-blur-sm p-2 rounded-full shadow-sm hover:bg-white transition-all z-10">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="{{ $isFav ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $isFav ? 'text-red-500' : 'text-[#4e4639]' }}"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
            </button>
        </div>
        <h4 class="font-bold text-[#1e1b16] leading-tight mb-1 group-hover:text-[#775a19] transition-colors line-clamp-2" title="{{ $book->title }}">{{ $book->title }}</h4>
        <p class="text-sm text-[#4e4639] truncate">{{ $book->author }}</p>
        
        <div class="flex items-center gap-1 mt-2 text-sm font-medium text-[#c5a059]">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            {{ $book->rating }}
        </div>
    </a>
@endforeach
