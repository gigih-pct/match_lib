@php
    $avatar = asset('images/avatar_yusup_1782216375318.png');
@endphp
<!-- Top Navigation -->
<nav class="sticky top-0 z-50 bg-[#fff8f3]/90 backdrop-blur-md border-b border-[#e9e1d8]">
    <div class="max-w-[1200px] mx-auto px-6 h-20 flex items-center justify-between gap-8">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 shrink-0 cursor-pointer group">
            <div class="text-[#775a19] transition-transform group-hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/><path d="M8 7h6"/><path d="M8 11h8"/></svg>
            </div>
            <span class="font-heading font-bold text-xl leading-tight">MindMatch<br/>Library</span>
        </a>

        <!-- Search Bar -->
        <form action="{{ route('produk.explore') }}" method="GET" class="flex-grow max-w-xl hidden md:block">
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#775a19] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" class="w-full bg-white text-sm rounded-full py-3 pl-11 pr-4 focus:outline-none focus:ring-2 focus:ring-[#c5a059] shadow-sm transition-all placeholder:text-gray-400" placeholder="Search books, authors, topics...">
            </div>
        </form>

        <!-- Right Nav -->
        <div class="flex items-center gap-8 shrink-0">
            <div class="hidden lg:flex items-center gap-6 text-sm font-medium text-[#4e4639]">
                <a href="{{ route('dashboard') }}" class="{{ Route::is('dashboard') ? 'text-[#1e1b16] border-b-2 border-[#775a19]' : 'hover:text-[#1e1b16] transition-colors' }} py-1">Home</a>
                <a href="{{ route('produk.explore') }}" class="{{ Route::is('produk.explore') || Route::is('produk.show') ? 'text-[#1e1b16] border-b-2 border-[#775a19]' : 'hover:text-[#1e1b16] transition-colors' }} py-1">Explore</a>
                <a href="{{ route('bookclub') }}" class="{{ Route::is('bookclub') ? 'text-[#1e1b16] border-b-2 border-[#775a19]' : 'hover:text-[#1e1b16] transition-colors' }} py-1">Book Club</a>
                <a href="{{ route('myshelf') }}" class="{{ Route::is('myshelf') ? 'text-[#1e1b16] border-b-2 border-[#775a19]' : 'hover:text-[#1e1b16] transition-colors' }} py-1">My Shelf</a>
            </div>
            
            <div class="flex items-center gap-4 border-l border-[#e9e1d8] pl-6">
                @auth
                    <button class="text-[#4e4639] hover:text-[#1e1b16] transition-colors relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full border border-[#fff8f3]"></span>
                    </button>
                    <button class="text-[#4e4639] hover:text-[#1e1b16] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                    <div class="relative group ml-2">
                        <button type="button" class="w-9 h-9 rounded-full overflow-hidden border-2 border-white shadow-sm cursor-pointer transition-transform group-hover:scale-105">
                            <img src="{{ asset('images/avatar_eleanor.png') }}" alt="User Avatar" class="w-full h-full object-cover">
                        </button>
                        
                        <!-- Dropdown -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-[#e9e1d8] py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 translate-y-1 group-hover:translate-y-0">
                            <div class="px-4 py-2 border-b border-[#e9e1d8]/60 mb-1">
                                <p class="text-sm font-bold text-[#1e1b16] truncate">{{ auth()->user()->name }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-[#4e4639] hover:bg-[#fbf2e9] hover:text-[#775a19] transition-colors">Edit Profile</a>
                            <a href="{{ route('myshelf') }}" class="block px-4 py-2 text-sm text-[#4e4639] hover:bg-[#fbf2e9] hover:text-[#775a19] transition-colors">My Shelf</a>
                            <div class="border-t border-[#e9e1d8]/60 mt-1 pt-1">
                                <form method="POST" action="{{ route('logout') }}" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors font-medium flex items-center justify-between">
                                        Logout
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-[#4e4639] hover:text-[#1e1b16] transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-[#c5a059] hover:bg-[#b08e4f] text-[#2c251f] text-sm font-bold py-2.5 px-6 rounded-full transition-all shadow-sm">Sign Up</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
