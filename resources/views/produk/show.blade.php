@extends('layouts.app')

@section('title', $book->title . ' - MindMatch Library')

@section('content')
<div class="max-w-[1000px] mx-auto pb-12">
    <!-- Breadcrumb -->
    <nav class="flex text-sm text-[#4e4639] font-medium mb-10" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('produk.explore') }}" class="hover:text-[#1e1b16] transition-colors">Explore</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-2 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="{{ route('produk.explore', ['search' => $book->category]) }}" class="hover:text-[#1e1b16] transition-colors">{{ $book->category }}</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-2 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="text-[#1e1b16] truncate max-w-[200px] md:max-w-none">{{ $book->title }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="flex flex-col md:flex-row gap-12 lg:gap-20">
        <!-- Left Column: Image & Save -->
        <div class="w-full md:w-[35%] lg:w-[30%] shrink-0 flex flex-col gap-6">
            <div class="w-full rounded-2xl overflow-hidden shadow-2xl shadow-black/10 aspect-[2/3] bg-[#2a2a2a] relative group">
                @if($book->image)
                    <img src="{{ asset('images/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                @else
                    <div class="w-full h-full flex items-center justify-center text-[#c5a059] bg-[#fbf2e9]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>
                    </div>
                @endif
                <!-- Subtly darken edges for realistic book cover feel -->
                <div class="absolute inset-0 shadow-[inset_-20px_0_40px_rgba(255,255,255,0.1),inset_10px_0_20px_rgba(0,0,0,0.3)] pointer-events-none"></div>
            </div>
            
            @php
                $isFav = auth()->check() && auth()->user()->books->where('id', $book->id)->where('pivot.is_favorite', true)->isNotEmpty();
            @endphp
            <button data-book-id="{{ $book->id }}" class="favorite-btn w-full py-4 border-2 border-[#c5a059] {{ $isFav ? 'bg-[#fbf2e9]' : '' }} text-[#775a19] font-bold rounded-xl hover:bg-[#fbf2e9] hover:border-[#775a19] transition-all flex items-center justify-center gap-2 active:scale-95 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="{{ $isFav ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="{{ $isFav ? 'text-red-500' : 'text-[#775a19]' }}"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                Favorite Book
            </button>
            
            <!-- Book Stats -->
            <div class="flex items-center justify-between px-4 pt-8 border-t border-[#e9e1d8] mt-2 text-center">
                <div class="flex flex-col gap-2">
                    <span class="text-[11px] font-bold tracking-[0.2em] text-[#7f7667] uppercase">Pages</span>
                    <span class="font-heading text-2xl font-bold text-[#1e1b16]">{{ $book->pages }}</span>
                </div>
                <div class="w-px h-12 bg-[#e9e1d8]"></div>
                <div class="flex flex-col gap-2">
                    <span class="text-[11px] font-bold tracking-[0.2em] text-[#7f7667] uppercase">Time</span>
                    <span class="font-heading text-2xl font-bold text-[#1e1b16]">{{ round($book->reading_time_mins / 60) }}h</span>
                </div>
                <div class="w-px h-12 bg-[#e9e1d8]"></div>
                <div class="flex flex-col gap-2">
                    <span class="text-[11px] font-bold tracking-[0.2em] text-[#7f7667] uppercase">Pub</span>
                    <span class="font-heading text-2xl font-bold text-[#1e1b16]">{{ $book->published_year }}</span>
                </div>
            </div>
        </div>

        <!-- Right Column: Details -->
        <div class="flex-grow flex flex-col pt-2">
            <!-- Tags -->
            <div class="flex flex-wrap gap-3 mb-8">
                <span class="px-5 py-2 border border-[#d1c5b4] bg-[#fbf2e9]/50 hover:bg-[#e9e1d8] transition-colors cursor-pointer text-[#4e4639] rounded-full text-xs font-bold">{{ $book->category }}</span>
                @if($book->title === 'Meditations')
                    <span class="px-5 py-2 border border-[#d1c5b4] bg-[#fbf2e9]/50 hover:bg-[#e9e1d8] transition-colors cursor-pointer text-[#4e4639] rounded-full text-xs font-bold">Stoicism</span>
                @endif
            </div>

            <!-- Title & Author -->
            <h1 class="font-heading text-5xl lg:text-7xl font-bold text-[#1e1b16] mb-6 leading-tight tracking-tight">{{ $book->title }}</h1>
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-10 border-b border-[#e9e1d8] pb-10">
                <p class="text-3xl text-[#4e4639] font-heading font-medium italic">by {{ $book->author }}</p>
                
                <div class="flex items-center gap-2">
                    <div class="flex text-[#c5a059]">
                        @for($i = 1; $i <= 5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="{{ $i <= round($book->rating) ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        @endfor
                    </div>
                    <span class="text-base font-bold text-[#1e1b16] ml-3">{{ $book->rating }} <span class="text-[#7f7667] font-medium">({{ number_format($book->reviews_count) }} reviews)</span></span>
                </div>
            </div>

            <!-- Description -->
            <div class="prose prose-lg text-[#2c251f] mb-12 max-w-none leading-[1.8] font-body text-lg">
                {!! nl2br(e($book->description)) !!}
            </div>

            <!-- Personality Insight -->
            <div class="bg-white rounded-[2rem] p-8 lg:p-10 border-l-8 border-[#c5a059] shadow-sm mb-12 flex flex-col md:flex-row gap-8 items-start relative overflow-hidden">
                <div class="w-16 h-16 shrink-0 rounded-full bg-[#fbf2e9] text-[#775a19] flex items-center justify-center relative z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/><circle cx="12" cy="12" r="4"/></svg>
                </div>
                <div class="relative z-10">
                    <h3 class="font-heading text-3xl font-bold text-[#1e1b16] mb-3">Personality Insight</h3>
                    <p class="text-[#4e4639] leading-[1.7] text-lg">
                        This book aligns perfectly with your preference for <strong class="text-[#1e1b16]">Introspective</strong> and <strong class="text-[#1e1b16]">Practical Philosophy</strong> reads. Users who enjoyed "Letters from a Stoic" typically find immense value in these reflections. It challenges you to focus on what you can control.
                    </p>
                </div>
            </div>

            <!-- Action Area -->
            <div class="mt-auto pt-4">
                <!-- Toggle Quick/Full -->
                <div class="bg-[#e9e1d8]/50 p-2 rounded-2xl flex items-center mb-8 w-full">
                    <button id="btn-quick" onclick="setMode('quick')" class="flex-1 bg-white shadow-md text-[#1e1b16] font-bold py-4 rounded-xl text-sm transition-all hover:shadow-lg">Quick Read (5 mins)</button>
                    <button id="btn-full" onclick="setMode('full')" class="flex-1 text-[#4e4639] hover:text-[#1e1b16] font-bold py-4 rounded-xl text-sm transition-all hover:bg-white/50">Full Version</button>
                </div>
                
                <a id="btn-start" href="{{ route('produk.read', ['book' => $book->id, 'mode' => 'quick']) }}" class="w-full bg-[#c5a059] hover:bg-[#b08e4f] text-[#2c251f] font-bold text-xl py-5 rounded-2xl transition-all shadow-md hover:shadow-lg active:scale-[0.99] flex items-center justify-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/><path d="M8 11h8"/></svg>
                    Start Reading
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function setMode(mode) {
    const btnQuick = document.getElementById('btn-quick');
    const btnFull = document.getElementById('btn-full');
    const btnStart = document.getElementById('btn-start');
    
    if (mode === 'quick') {
        btnQuick.className = "flex-1 bg-white shadow-md text-[#1e1b16] font-bold py-4 rounded-xl text-sm transition-all hover:shadow-lg";
        btnFull.className = "flex-1 text-[#4e4639] hover:text-[#1e1b16] font-bold py-4 rounded-xl text-sm transition-all hover:bg-white/50";
    } else {
        btnFull.className = "flex-1 bg-white shadow-md text-[#1e1b16] font-bold py-4 rounded-xl text-sm transition-all hover:shadow-lg";
        btnQuick.className = "flex-1 text-[#4e4639] hover:text-[#1e1b16] font-bold py-4 rounded-xl text-sm transition-all hover:bg-white/50";
    }
    
    // update url
    const baseUrl = "{{ route('produk.read', ['book' => $book->id]) }}";
    btnStart.href = baseUrl + "?mode=" + mode;
}
</script>
@endsection
