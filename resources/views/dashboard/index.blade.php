@extends('layouts.app')

@section('title', 'Dashboard - MindMatch Library')

@section('content')
<!-- Removed static variables -->
<!-- Greeting Section -->
<header class="mb-10">
    <h1 class="font-heading text-5xl md:text-6xl font-bold tracking-tight text-[#1e1b16] mb-3">Hello Yusup,</h1>
    <p class="text-xl text-[#4e4639]">your focused read for today.</p>
</header>

<!-- Featured Card -->
@if($featuredBook)
<section class="bg-white rounded-3xl shadow-sm border border-[#e9e1d8]/60 overflow-hidden flex flex-col md:flex-row transition-all duration-300 hover:shadow-md mb-16 group">
    <!-- Image Area -->
    <a href="{{ route('produk.show', $featuredBook) }}" class="w-full md:w-[45%] h-72 md:h-auto overflow-hidden relative bg-[#2a2a2a] block">
        <img src="{{ asset('images/' . $featuredBook->image) }}" alt="{{ $featuredBook->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
        <!-- Inner soft shadow overlay to blend the image a bit -->
        <div class="absolute inset-0 shadow-[inset_-20px_0_40px_rgba(255,255,255,0.1)] pointer-events-none"></div>
    </a>
    
    <!-- Content Area -->
    <div class="p-8 md:p-12 lg:p-16 flex flex-col justify-center w-full md:w-[55%]">
        <div class="flex items-center gap-4 mb-6">
            <span class="bg-[#fbf2e9] text-[#775a19] px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase">Daily Pick</span>
            <span class="flex items-center gap-1 text-sm text-[#4e4639] font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                10 min Quick Read
            </span>
        </div>
        
        <h2 class="font-heading text-4xl lg:text-5xl font-bold leading-tight mb-3 text-[#1e1b16]">
            <a href="{{ route('produk.show', $featuredBook) }}" class="hover:text-[#775a19] transition-colors">{{ $featuredBook->title }}</a>
        </h2>
        <p class="text-[#4e4639] font-medium mb-6">By {{ $featuredBook->author }}</p>
        
        <p class="text-[#4e4639] text-lg leading-relaxed mb-10 max-w-lg line-clamp-3">
            {{ $featuredBook->description }}
        </p>
        
        <div class="flex items-center gap-4">
            <a href="{{ route('produk.read', ['book' => $featuredBook->id, 'mode' => 'quick']) }}" class="bg-[#c5a059] text-[#2c251f] hover:bg-[#b08e4f] px-8 py-3.5 rounded-xl font-bold transition-all duration-300 flex items-center gap-2 shadow-sm hover:shadow active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/><path d="M8 11h8"/></svg>
                Read Now
            </a>
            @php
                $isFav = auth()->check() && auth()->user()->books->where('id', $featuredBook->id)->where('pivot.is_favorite', true)->isNotEmpty();
            @endphp
            <button data-book-id="{{ $featuredBook->id }}" class="favorite-btn p-3.5 {{ $isFav ? 'bg-[#fbf2e9]' : '' }} text-[#4e4639] hover:text-[#775a19] hover:bg-[#fbf2e9] rounded-xl transition-all duration-300 border border-transparent hover:border-[#e9e1d8]">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="{{ $isFav ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $isFav ? 'text-red-500' : 'text-[#4e4639]' }}"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
            </button>
        </div>
    </div>
</section>
@endif

<!-- Career & Financial Section -->
<section>
    <div class="flex items-center justify-between mb-8">
        <h3 class="font-heading text-3xl font-bold text-[#1e1b16] border-l-4 border-[#c5a059] pl-4">{{ $sectionTitle }}</h3>
        <a href="{{ route('produk.explore') }}" class="text-[#775a19] font-medium hover:text-[#4e3700] flex items-center gap-1 transition-colors text-sm">
            View all 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        </a>
    </div>

    <!-- Books Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6 lg:gap-8">
        
        @foreach($recentBooks as $book)
        <a href="{{ route('produk.show', $book) }}" class="group block cursor-pointer relative">
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
            <h4 class="font-bold text-[#1e1b16] leading-tight mb-1 group-hover:text-[#775a19] transition-colors truncate">{{ $book->title }}</h4>
            <p class="text-xs text-[#4e4639] truncate">{{ $book->author }}</p>
        </a>
        @endforeach

        <!-- Discover More -->
        <a href="{{ route('produk.explore') }}" class="group cursor-pointer hidden lg:block">
            <div class="aspect-[3/4] rounded-xl border-2 border-dashed border-[#d1c5b4] flex items-center justify-center bg-[#fbf2e9]/50 transition-all duration-500 group-hover:border-[#c5a059] group-hover:bg-[#fbf2e9] mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-[#7f7667] group-hover:text-[#c5a059] transition-colors group-hover:scale-110 duration-300"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </div>
            <h4 class="font-bold text-[#1e1b16] leading-tight mb-1 group-hover:text-[#775a19] transition-colors">Discover More</h4>
            <p class="text-xs text-[#4e4639]">120+ Titles</p>
        </a>

    </div>
</section>
@endsection
