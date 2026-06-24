@extends('layouts.app')

@section('title', 'Reading: ' . $book->title)

@section('content')
<div class="max-w-4xl mx-auto bg-[#fffcf8] rounded-[2rem] p-8 md:p-16 lg:p-20 shadow-sm border border-[#e9e1d8] min-h-[85vh] relative my-6">
    <a href="{{ route('produk.show', $book) }}" class="absolute top-6 left-6 md:top-10 md:left-10 text-[#7f7667] hover:text-[#1e1b16] transition-colors flex items-center gap-2 text-sm font-bold tracking-[0.2em] uppercase">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        Back to Book
    </a>
    
    <div class="text-center mb-16 mt-12 md:mt-4">
        <span class="inline-block px-4 py-1.5 bg-[#fbf2e9] text-[#775a19] rounded-full font-bold text-xs tracking-[0.2em] uppercase mb-6">{{ request('mode') == 'full' ? 'Full Book' : 'Quick Read Summary' }}</span>
        <h1 class="font-heading text-5xl md:text-6xl font-bold text-[#1e1b16] mb-6 leading-tight">{{ $book->title }}</h1>
        <p class="text-xl text-[#4e4639] font-heading font-medium italic">By {{ $book->author }}</p>
    </div>
    
    <div class="prose prose-lg md:prose-xl text-[#2c251f] font-body leading-[2] mx-auto text-lg md:text-xl">
        @if(request('mode') == 'quick')
            <p class="first-letter:text-7xl first-letter:font-heading first-letter:font-bold first-letter:text-[#1e1b16] first-letter:mr-3 first-letter:float-left">
                {!! nl2br(e($book->description)) !!}
            </p>
            <p class="mt-8">This quick summary gives you the fundamental concepts of the book. To dive deeper into the arguments, evidence, and practical applications, switch to the Full Version.</p>
        @else
            <h2 class="font-heading text-3xl font-bold mb-8 text-center">Chapter 1: The Foundations</h2>
            <p class="first-letter:text-7xl first-letter:font-heading first-letter:font-bold first-letter:text-[#1e1b16] first-letter:mr-3 first-letter:float-left">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vel volutpat felis, eu condimentum massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla posuere pulvinar interdum. Integer at lorem metus.
            </p>
            <p>
                Curabitur euismod libero eget varius sodales. Fusce finibus id enim eget sollicitudin. Maecenas iaculis pretium iaculis. Etiam at efficitur tellus. Integer tristique purus ac justo convallis, non vehicula erat congue. In laoreet ipsum felis, ac pretium eros pellentesque in.
            </p>
            <p>
                Phasellus eget augue id neque varius euismod. Sed consequat quam quis justo bibendum, vel finibus erat fermentum. Praesent laoreet odio a est sollicitudin dignissim. Nullam ullamcorper nulla eu sapien elementum vulputate.
            </p>
            
            <div class="my-12 text-center text-[#c5a059]">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/><path d="M8 11h8"/></svg>
            </div>
            
            <h2 class="font-heading text-3xl font-bold mb-8 text-center">Chapter 2: Building Upon the Past</h2>
            <p>
                Sed sit amet aliquet ipsum, id eleifend tortor. Aliquam id sagittis erat. Morbi ac ex non ipsum consequat cursus a et felis. Ut interdum aliquet lorem non congue. Nunc ac risus at felis condimentum fermentum. Nullam nec arcu eros.
            </p>
            <p>
                Donec iaculis ex et lacus volutpat elementum. Mauris bibendum justo sit amet varius dictum. In non lorem vitae velit ultrices rhoncus vitae vel eros. Sed venenatis augue ut nisi efficitur, at interdum neque fermentum.
            </p>
        @endif
    </div>
    
    <div class="mt-20 text-center border-t border-[#e9e1d8] pt-12">
        <p class="text-[#7f7667] text-sm font-medium tracking-wide">You have reached the end of this {{ request('mode') == 'quick' ? 'summary' : 'chapter' }}.</p>
        
        @if(request('mode') == 'quick')
            <a href="{{ route('produk.read', ['book' => $book->id, 'mode' => 'full']) }}" class="inline-block mt-8 bg-[#1e1b16] text-white hover:bg-[#36322b] px-8 py-4 rounded-xl font-bold transition-all shadow-md hover:shadow-lg">
                Continue to Full Version
            </a>
        @else
            <!-- Progress Tracker -->
            <div class="mt-8 mb-12 bg-[#fbf2e9] rounded-3xl p-8 border border-[#e9e1d8] shadow-inner max-w-2xl mx-auto">
                <h3 class="font-heading text-2xl font-bold text-center mb-6 text-[#1e1b16]">Track Your Progress</h3>
                @php
                    $currentProgress = 0;
                    if (auth()->check()) {
                        $interaction = auth()->user()->books->where('id', $book->id)->first();
                        $currentProgress = $interaction ? $interaction->pivot->progress_percentage : 0;
                    }
                @endphp
                <form id="progressForm" data-book-id="{{ $book->id }}" class="flex flex-col items-center gap-6">
                    <div class="w-full flex items-center gap-4">
                        <span class="text-sm font-bold text-[#775a19]">0%</span>
                        <input type="range" id="progressInput" min="0" max="100" value="{{ $currentProgress }}" class="w-full h-2 bg-white border border-[#e9e1d8] rounded-lg appearance-none cursor-pointer accent-[#c5a059]" oninput="document.getElementById('progressOutput').innerText = this.value + '%'">
                        <span class="text-sm font-bold text-[#775a19]">100%</span>
                    </div>
                    <div class="text-center font-bold text-[#c5a059] text-3xl font-heading" id="progressOutput">{{ $currentProgress }}%</div>
                    <button type="submit" class="bg-[#c5a059] hover:bg-[#b08e4f] text-[#2c251f] font-bold py-3 px-8 rounded-xl transition-all shadow-sm flex items-center gap-2 active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"/></svg>
                        Save Bookmark
                    </button>
                </form>
            </div>

            <a href="{{ route('dashboard') }}" class="inline-block bg-[#1e1b16] text-white hover:bg-[#36322b] px-8 py-4 rounded-xl font-bold transition-all shadow-md hover:shadow-lg">
                Return to Dashboard
            </a>
        @endif
    </div>
</div>
@endsection
