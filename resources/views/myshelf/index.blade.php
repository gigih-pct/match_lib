@extends('layouts.app')

@section('title', 'My Shelf - MindMatch Library')

@section('content')
    @auth
        <!-- AUTHENTICATED STATE -->
        <div class="flex flex-col lg:flex-row gap-8 mb-20">
            
            <!-- Left Sidebar -->
            <div class="w-full lg:w-[320px] shrink-0 space-y-6">
                <!-- Profile Card -->
                <div class="bg-[#fcfcd4] rounded-[24px] p-8 flex flex-col items-center text-center shadow-sm border border-[#e9e1d8]/40">
                    <div class="relative mb-4">
                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-md">
                            <img src="{{ asset('images/avatar_eleanor.png') }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute bottom-1 right-1 w-8 h-8 bg-[#c5a059] rounded-full flex items-center justify-center text-white border-2 border-white shadow-sm cursor-pointer hover:bg-[#b08e4f] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m18 5-3-3H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="m14 2 4 4"/><path d="m9 15 2 2 4-4"/></svg>
                        </div>
                    </div>
                    
                    <h2 class="font-heading text-2xl font-bold text-[#1e1b16] mb-1">{{ auth()->user()->name }}</h2>
                    <p class="text-[#4e4639] text-sm mb-6">Avid Reader & Scholar</p>
                    
                    <div class="w-full flex justify-between border-t border-[#e9e1d8]/60 pt-6 mb-6">
                        <div class="text-center">
                            <p class="text-xs font-bold text-[#7f7667] tracking-wider uppercase mb-1">Books</p>
                            <p class="font-heading text-2xl font-bold text-[#775a19]">142</p>
                        </div>
                        <div class="text-center">
                            <p class="text-xs font-bold text-[#7f7667] tracking-wider uppercase mb-1">Hours</p>
                            <p class="font-heading text-2xl font-bold text-[#775a19]">850</p>
                        </div>
                    </div>
                    
                    <div class="w-full flex flex-col gap-3">
                        <a href="{{ route('quiz.step1') }}" class="w-full text-center bg-[#c5a059] hover:bg-[#b08e4f] text-[#2c251f] font-bold py-3 px-4 rounded-xl transition-all shadow-sm flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/><path d="M16 21v-5h5"/></svg>
                            Retake Quiz
                        </a>
                        <button class="w-full bg-white border border-[#e9e1d8] hover:border-[#c5a059] text-[#4e4639] font-bold py-3 px-4 rounded-xl transition-all shadow-sm">
                            Edit Profile
                        </button>
                    </div>
                </div>

                <!-- Achievements Card -->
                <div class="bg-[#fcfcd4] rounded-[24px] p-8 shadow-sm border border-[#e9e1d8]/40">
                    <h3 class="font-heading text-xl font-bold text-[#1e1b16] mb-6">Achievements</h3>
                    
                    <div class="space-y-6">
                        <!-- Achievement 1 -->
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-[#f4ebd0] flex items-center justify-center shrink-0 text-[#775a19]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-[#1e1b16]">30 Day Streak</h4>
                                <p class="text-xs text-[#4e4639]">Read every day for a month</p>
                            </div>
                        </div>

                        <!-- Achievement 2 -->
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-[#e6f0e6] flex items-center justify-center shrink-0 text-[#2d5a27]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-[#1e1b16]">Bibliophile</h4>
                                <p class="text-xs text-[#4e4639]">Completed 100 books</p>
                            </div>
                        </div>

                        <!-- Achievement 3 -->
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-[#e8e4db] flex items-center justify-center shrink-0 text-[#5c5446]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-[#1e1b16]">Classicist</h4>
                                <p class="text-xs text-[#4e4639]">Read 10 classic novels</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 space-y-12">
                
                <!-- Reading Progress -->
                <div class="bg-[#fcfcd4] rounded-[24px] p-8 sm:p-10 shadow-sm border border-[#e9e1d8]/40 relative overflow-hidden h-80 flex flex-col">
                    <div class="flex justify-between items-start mb-auto relative z-10">
                        <div>
                            <h2 class="font-heading text-3xl font-bold text-[#1e1b16] mb-2">Reading Progress</h2>
                            <p class="text-[#4e4639]">Minutes read this week</p>
                        </div>
                        <div class="text-right flex items-baseline gap-2">
                            <span class="font-heading text-5xl font-bold text-[#775a19]">{{ $totalMinutesThisWeek }}</span>
                            <span class="text-[#4e4639] font-medium">mins</span>
                        </div>
                    </div>

                    <!-- Dynamic Chart Area -->
                    <div class="w-full relative z-10 mt-10 flex flex-col justify-end h-40">
                        <div class="w-full border-b border-[#e9e1d8]/60 flex justify-between px-2 h-full items-end pb-2 gap-2 sm:gap-4">
                            @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                                @php 
                                    $isToday = now()->format('D') == $day;
                                    $minutes = $chartData[$day] ?? 0;
                                    $height = isset($chartHeights[$day]) ? max(5, $chartHeights[$day]) : 5; // minimum 5% height so it's visible if > 0
                                @endphp
                                <div class="flex-1 flex flex-col items-center justify-end h-full group relative">
                                    <!-- Tooltip -->
                                    <div class="absolute -top-8 bg-[#1e1b16] text-white text-[10px] font-bold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-20">
                                        {{ $minutes }} mins
                                    </div>
                                    <!-- Bar -->
                                    <div class="w-full max-w-[40px] rounded-t-lg transition-all duration-500 {{ $isToday ? 'bg-[#c5a059]' : 'bg-[#e8e4db] group-hover:bg-[#d1c5b4]' }}" style="height: {{ $minutes > 0 ? $height : 0 }}%"></div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- X-Axis Labels -->
                        <div class="w-full flex justify-between px-2 text-xs font-bold text-[#7f7667] pt-2">
                            @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                                @php $isToday = now()->format('D') == $day; @endphp
                                <span class="flex-1 text-center {{ $isToday ? 'text-[#c5a059]' : '' }}">{{ substr($day, 0, 1) }}</span>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Decorative dashed lines -->
                    <div class="absolute inset-x-8 top-32 border-t border-dashed border-[#e9e1d8]/80"></div>
                    <div class="absolute inset-x-8 top-44 border-t border-dashed border-[#e9e1d8]/80"></div>
                    <div class="absolute inset-x-8 top-56 border-t border-dashed border-[#e9e1d8]/80"></div>
                </div>

                <!-- Favorites -->
                @if($favorites->isNotEmpty())
                <div>
                    <div class="flex justify-between items-end mb-6">
                        <h2 class="font-heading text-3xl font-bold text-[#1e1b16] border-l-4 border-[#c5a059] pl-4">My Favorites</h2>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                        @include('produk.partials.book_grid', ['books' => $favorites])
                    </div>
                </div>
                @endif

                <!-- Currently Reading -->
                <div>
                    <div class="flex justify-between items-end mb-6">
                        <h2 class="font-heading text-3xl font-bold text-[#1e1b16] border-l-4 border-[#c5a059] pl-4">Currently Reading</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        @foreach($currentlyReading as $book)
                        <div class="bg-[#fcfcd4] rounded-[24px] overflow-hidden shadow-sm border border-[#e9e1d8]/40 flex flex-col h-full relative group">
                            <button data-book-id="{{ $book->id }}" class="favorite-btn absolute top-3 right-3 bg-white/80 backdrop-blur-sm p-2 rounded-full shadow-sm hover:bg-white transition-all z-10">
                                @php $isFav = $book->pivot->is_favorite ?? false; @endphp
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="{{ $isFav ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $isFav ? 'text-red-500' : 'text-[#4e4639]' }}"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                            </button>

                            <a href="{{ route('produk.show', $book) }}" class="h-56 bg-[#e8e4db] relative flex items-center justify-center p-6 cursor-pointer">
                                <div class="absolute top-0 left-4 w-4 h-6 bg-[#c5a059]"></div>
                                @if($book->image)
                                    <img src="{{ asset('images/' . $book->image) }}" alt="{{ $book->title }}" class="max-h-full max-w-full shadow-xl transition-transform group-hover:scale-105">
                                @else
                                    <div class="font-heading font-bold text-[#775a19] text-center">{{ $book->title }}</div>
                                @endif
                            </a>
                            <div class="p-6 flex flex-col flex-1">
                                <div class="inline-block px-3 py-1 bg-[#f4ebd0] text-[#775a19] text-xs font-bold rounded-md mb-3 self-start">{{ $book->category }}</div>
                                <h3 class="font-heading text-xl font-bold text-[#1e1b16] mb-1 line-clamp-2">{{ $book->title }}</h3>
                                <p class="text-sm text-[#4e4639] mb-6">{{ $book->author }}</p>
                                
                                <div class="mt-auto">
                                    <div class="flex justify-between text-xs font-bold text-[#1e1b16] mb-2">
                                        <span>{{ $book->pivot->progress_percentage }}% completed</span>
                                        <span>{{ round(($book->pivot->progress_percentage/100) * ($book->pages ?? 300)) }} / {{ $book->pages ?? 300 }} p.</span>
                                    </div>
                                    <div class="w-full bg-[#e9e1d8] rounded-full h-1.5">
                                        <div class="bg-[#775a19] h-1.5 rounded-full" style="width: {{ $book->pivot->progress_percentage }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- Start New Book -->
                        <a href="{{ route('produk.explore') }}" class="rounded-[24px] border-2 border-dashed border-[#e9e1d8] hover:border-[#c5a059] hover:bg-[#fbf2e9]/50 flex flex-col items-center justify-center p-8 text-center transition-all group h-full min-h-[300px]">
                            <div class="w-16 h-16 rounded-full bg-[#e9e1d8] group-hover:bg-[#f4ebd0] flex items-center justify-center text-[#7f7667] group-hover:text-[#775a19] mb-6 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                            </div>
                            <h3 class="font-heading text-2xl font-bold text-[#1e1b16] mb-2">Start a New Book</h3>
                            <p class="text-sm text-[#4e4639]">Browse the explore page to find your next great read.</p>
                        </a>

                    </div>
                </div>

                <!-- Recommended for You -->
                @if($recommendedBooks->isNotEmpty())
                <div>
                    <div class="flex justify-between items-end mb-6">
                        <h2 class="font-heading text-3xl font-bold text-[#1e1b16] border-l-4 border-[#c5a059] pl-4">Recommended for You</h2>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                        @include('produk.partials.book_grid', ['books' => $recommendedBooks])
                    </div>
                </div>
                @endif

            </div>
        </div>
    @else
        <!-- GUEST STATE -->
        <div class="bg-white rounded-3xl p-16 text-center border border-[#e9e1d8]/60 shadow-sm mt-8 mb-20">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto text-[#d1c5b4] mb-6"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/><path d="M8 7h6"/><path d="M8 11h8"/></svg>
            <h3 class="font-heading text-3xl font-bold text-[#1e1b16] mb-3">Your Shelf Awaits</h3>
            <p class="text-[#4e4639] text-lg mb-8 max-w-lg mx-auto">Log in to track your reading progress, earn achievements, and build your personalized digital library.</p>
            
            <div class="flex justify-center gap-4">
                <a href="{{ route('login') }}" class="inline-block px-8 py-3.5 bg-white border-2 border-[#c5a059] text-[#775a19] font-bold rounded-xl hover:bg-[#fbf2e9] transition-colors shadow-sm">Log In</a>
                <a href="{{ route('register') }}" class="inline-block px-8 py-3.5 bg-[#c5a059] text-[#2c251f] font-bold rounded-xl hover:bg-[#b08e4f] transition-colors shadow-sm">Sign Up</a>
            </div>
        </div>
    @endauth
@endsection
