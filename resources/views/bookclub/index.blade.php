@extends('layouts.app')

@section('title', 'Book Club - MindMatch Library')

@section('content')
<div class="max-w-[1200px] mx-auto pb-12">
    
    <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- Left Sidebar: Profile -->
        <div class="w-full lg:w-[280px] shrink-0">
            <div class="bg-[#fcfcd4] rounded-[24px] overflow-hidden shadow-sm border border-[#e9e1d8]/40 sticky top-28">
                <div class="h-24 bg-[#e8e4db] w-full relative">
                    <div class="absolute inset-0 bg-[#c5a059]/20 mix-blend-multiply"></div>
                </div>
                <div class="px-6 pb-6 relative flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-full border-4 border-[#fcfcd4] shadow-md overflow-hidden bg-white -mt-10 mb-3">
                        @if(auth()->check())
                            <img src="{{ asset('images/avatar_eleanor.png') }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-[#c5a059] bg-[#fbf2e9]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                        @endif
                    </div>
                    
                    @if(auth()->check())
                        <h2 class="font-heading text-lg font-bold text-[#1e1b16]">{{ auth()->user()->name }}</h2>
                        <p class="text-xs text-[#4e4639] mb-4">Avid Reader & Scholar</p>
                        
                        <div class="w-full border-t border-[#e9e1d8]/60 pt-4 flex justify-between text-sm">
                            <span class="text-[#7f7667] font-medium">Club Posts</span>
                            <span class="font-bold text-[#775a19]">{{ auth()->user()->posts->count() ?? 0 }}</span>
                        </div>
                    @else
                        <h2 class="font-heading text-lg font-bold text-[#1e1b16] mb-2">Welcome Guest</h2>
                        <p class="text-xs text-[#4e4639] mb-4">Join our community of readers.</p>
                        <a href="{{ route('login') }}" class="w-full bg-[#c5a059] text-[#2c251f] text-sm font-bold py-2 rounded-xl text-center">Sign In</a>
                    @endif
                </div>
            </div>
            
            <div class="mt-6 bg-[#fcfcd4] rounded-[24px] p-6 shadow-sm border border-[#e9e1d8]/40">
                <h3 class="font-heading text-lg font-bold text-[#1e1b16] mb-4">Your Groups</h3>
                <div class="space-y-3 text-sm text-[#4e4639]">
                    <a href="#" class="flex items-center gap-2 hover:text-[#775a19] transition-colors font-medium">
                        <div class="w-6 h-6 rounded bg-[#e8e4db] flex items-center justify-center text-[#c5a059]">#</div>
                        Philosophy Enthusiasts
                    </a>
                    <a href="#" class="flex items-center gap-2 hover:text-[#775a19] transition-colors font-medium">
                        <div class="w-6 h-6 rounded bg-[#e8e4db] flex items-center justify-center text-[#c5a059]">#</div>
                        Modern Classics
                    </a>
                </div>
            </div>
        </div>

        <!-- Middle Column: Feed -->
        <div class="flex-grow max-w-2xl">
            @auth
            <!-- Create Post -->
            <div class="bg-white rounded-[24px] p-6 shadow-sm border border-[#e9e1d8]/60 mb-6">
                <form action="{{ route('bookclub.store') }}" method="POST">
                    @csrf
                    <div class="flex gap-4 mb-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden shrink-0">
                            <img src="{{ asset('images/avatar_eleanor.png') }}" alt="User Avatar" class="w-full h-full object-cover">
                        </div>
                        <textarea name="content" rows="2" class="w-full bg-[#fbf2e9] border border-[#e9e1d8] rounded-2xl p-4 text-[#1e1b16] placeholder:text-[#7f7667] focus:outline-none focus:ring-2 focus:ring-[#c5a059] resize-none transition-all" placeholder="Share your reading thoughts or start a discussion..."></textarea>
                    </div>
                    <div class="flex justify-between items-center pl-16">
                        <div class="flex flex-col gap-2">
                            <!-- Hidden input for selected book ID -->
                            <input type="hidden" name="book_id" id="selected-book-id" value="">
                            
                            <!-- Button to trigger modal -->
                            <button type="button" onclick="document.getElementById('attach-book-modal').classList.remove('hidden')" class="text-[#7f7667] hover:bg-[#fbf2e9] p-2 rounded-lg transition-colors flex items-center gap-2 text-sm font-bold border border-transparent hover:border-[#e9e1d8]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="m3 15 2 2 4-4"/></svg>
                                Attach Book
                            </button>

                            <!-- Preview area for selected book -->
                            <div id="selected-book-preview" class="hidden flex items-center gap-3 bg-[#fbf2e9] border border-[#e9e1d8] rounded-lg p-2 max-w-xs relative group">
                                <div class="w-10 h-14 bg-[#e8e4db] shrink-0 rounded overflow-hidden">
                                    <img id="preview-image" src="" class="w-full h-full object-cover" alt="Selected Book">
                                </div>
                                <div class="flex-grow min-w-0 pr-6">
                                    <p id="preview-title" class="text-xs font-bold text-[#1e1b16] truncate"></p>
                                    <p class="text-[10px] text-[#7f7667] uppercase font-bold tracking-wide mt-0.5">Attached</p>
                                </div>
                                <button type="button" onclick="removeSelectedBook()" class="absolute top-2 right-2 text-[#7f7667] hover:text-red-500 transition-colors p-1 bg-white/80 rounded-full opacity-0 group-hover:opacity-100 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="bg-[#1e1b16] text-white hover:bg-[#36322b] px-6 py-2 rounded-full font-bold text-sm transition-all shadow-sm">Post</button>
                    </div>
                </form>
            </div>
            @endauth

            <div class="space-y-6">
                @foreach($posts as $post)
                <!-- Post Card -->
                <div class="bg-white rounded-[24px] p-6 shadow-sm border border-[#e9e1d8]/60">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex gap-3">
                            <div class="w-12 h-12 rounded-full overflow-hidden shrink-0 bg-[#e8e4db]">
                                @if($post->user->id == 1 || $post->user->id == auth()->id())
                                    <img src="{{ asset('images/avatar_eleanor.png') }}" alt="{{ $post->user->name }}" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('images/avatar_yusup_1782216375318.png') }}" alt="{{ $post->user->name }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div>
                                <h3 class="font-heading text-lg font-bold text-[#1e1b16] leading-none">{{ $post->user->name }}</h3>
                                <span class="text-xs text-[#7f7667]">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <button class="text-[#7f7667] hover:text-[#1e1b16]"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/></svg></button>
                    </div>
                    
                    <p class="text-[#2c251f] mb-4 text-[15px] leading-relaxed">
                        {{ $post->content }}
                    </p>

                    @if($post->book)
                    <a href="{{ route('produk.show', $post->book) }}" class="block border border-[#e9e1d8] rounded-2xl overflow-hidden hover:bg-[#fbf2e9]/30 transition-colors mb-4 group cursor-pointer">
                        <div class="flex">
                            <div class="w-24 h-32 bg-[#e8e4db] shrink-0">
                                @if($post->book->image)
                                    <img src="{{ asset('images/' . $post->book->image) }}" class="w-full h-full object-cover" alt="{{ $post->book->title }}">
                                @endif
                            </div>
                            <div class="p-4 flex flex-col justify-center">
                                <h4 class="font-heading font-bold text-[#1e1b16] group-hover:text-[#c5a059] transition-colors">{{ $post->book->title }}</h4>
                                <p class="text-sm text-[#4e4639]">{{ $post->book->author }}</p>
                                <div class="mt-2 text-xs font-bold text-[#775a19] bg-[#fcfcd4] inline-block px-2 py-1 rounded self-start">{{ $post->book->category }}</div>
                            </div>
                        </div>
                    </a>
                    @endif

                    <!-- Action Bar -->
                    <div class="flex items-center gap-6 border-t border-[#e9e1d8]/60 pt-4 mt-2">
                        @php
                            $isLiked = auth()->check() && $post->likes->where('user_id', auth()->id())->isNotEmpty();
                        @endphp
                        <button data-post-id="{{ $post->id }}" class="like-btn flex items-center gap-2 text-sm font-bold transition-colors {{ $isLiked ? 'text-[#c5a059]' : 'text-[#7f7667] hover:text-[#c5a059]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="{{ $isLiked ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="like-icon"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>
                            <span class="like-count">{{ $post->likes->count() }}</span> Like
                        </button>
                        <button onclick="document.getElementById('comment-form-{{ $post->id }}').classList.toggle('hidden')" class="flex items-center gap-2 text-[#7f7667] hover:text-[#c5a059] text-sm font-bold transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"/></svg>
                            {{ $post->comments->count() }} Comment
                        </button>
                        <button class="flex items-center gap-2 text-[#7f7667] hover:text-[#1e1b16] text-sm font-bold transition-colors ml-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" x2="15.42" y1="13.51" y2="17.49"/><line x1="15.41" x2="8.59" y1="6.51" y2="10.49"/></svg>
                            Share
                        </button>
                    </div>

                    <!-- Comments Section -->
                    <div class="mt-4 border-t border-[#e9e1d8]/60 pt-4 space-y-4">
                        @foreach($post->comments as $comment)
                            <div class="flex gap-3">
                                <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 bg-[#e8e4db]">
                                    <img src="{{ asset('images/avatar_yusup_1782216375318.png') }}" class="w-full h-full object-cover">
                                </div>
                                <div class="bg-[#fcfcd4] p-3 rounded-2xl rounded-tl-none w-full border border-[#e9e1d8]/40">
                                    <h5 class="font-bold text-[#1e1b16] text-sm">{{ $comment->user->name }} <span class="text-xs font-normal text-[#7f7667] ml-2">{{ $comment->created_at->diffForHumans() }}</span></h5>
                                    <p class="text-[#4e4639] text-sm mt-1">{{ $comment->content }}</p>
                                </div>
                            </div>
                        @endforeach

                        @auth
                            <form id="comment-form-{{ $post->id }}" action="{{ route('bookclub.comment', $post) }}" method="POST" class="flex gap-3 mt-4 hidden">
                                @csrf
                                <div class="w-8 h-8 rounded-full overflow-hidden shrink-0">
                                    <img src="{{ asset('images/avatar_eleanor.png') }}" class="w-full h-full object-cover">
                                </div>
                                <input type="text" name="content" class="w-full bg-[#fbf2e9] border border-[#e9e1d8] rounded-full px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#c5a059]" placeholder="Add a comment..." required>
                                <button type="submit" class="bg-[#c5a059] text-white rounded-full px-4 text-sm font-bold hover:bg-[#b08e4f] transition-colors">Reply</button>
                            </form>
                        @endauth
                    </div>
                </div>
                @endforeach
                
                @if($posts->isEmpty())
                <div class="text-center py-12 text-[#7f7667]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-4 opacity-50"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <p>No posts yet. Be the first to share your thoughts!</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Right Sidebar: Widgets -->
        <div class="w-full lg:w-[300px] shrink-0 space-y-6 hidden lg:block">
            <!-- Trending Discussions -->
            <div class="bg-white rounded-[24px] p-6 shadow-sm border border-[#e9e1d8]/60 sticky top-28">
                <h3 class="font-heading text-lg font-bold text-[#1e1b16] mb-4 flex items-center gap-2">
                    Trending Now
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#c5a059]"><path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"/></svg>
                </h3>
                <div class="space-y-4">
                    <div class="cursor-pointer group">
                        <p class="text-sm font-bold text-[#1e1b16] group-hover:text-[#c5a059] transition-colors leading-tight">What's the best philosophy book for beginners?</p>
                        <span class="text-xs text-[#7f7667]">124 active participants</span>
                    </div>
                    <div class="cursor-pointer group">
                        <p class="text-sm font-bold text-[#1e1b16] group-hover:text-[#c5a059] transition-colors leading-tight">Review: The Psychology of Money</p>
                        <span class="text-xs text-[#7f7667]">89 active participants</span>
                    </div>
                    <div class="cursor-pointer group">
                        <p class="text-sm font-bold text-[#1e1b16] group-hover:text-[#c5a059] transition-colors leading-tight">How to build a reading habit in 2026</p>
                        <span class="text-xs text-[#7f7667]">256 active participants</span>
                    </div>
                </div>
                <a href="#" class="block text-center text-sm font-bold text-[#775a19] mt-6 hover:text-[#c5a059] transition-colors">Show more</a>
            </div>
        </div>
        
    </div>
</div>

<!-- Attach Book Modal -->
<div id="attach-book-modal" class="fixed inset-0 z-[100] hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-[#1e1b16]/60 backdrop-blur-sm" onclick="document.getElementById('attach-book-modal').classList.add('hidden')"></div>
    
    <!-- Modal Content -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-4xl max-h-[90vh] bg-[#fff8f3] rounded-[32px] shadow-2xl overflow-hidden flex flex-col">
        <!-- Header -->
        <div class="px-8 py-6 border-b border-[#e9e1d8] flex justify-between items-center bg-white sticky top-0 z-10">
            <div>
                <h2 class="font-heading text-2xl font-bold text-[#1e1b16]">Select a Book to Attach</h2>
                <p class="text-sm text-[#7f7667] mt-1">Showing only your favorite books</p>
            </div>
            <button onclick="document.getElementById('attach-book-modal').classList.add('hidden')" class="p-2 text-[#7f7667] hover:bg-[#fbf2e9] hover:text-[#1e1b16] rounded-full transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>
        
        <!-- Book Grid -->
        <div class="p-8 overflow-y-auto">
            @if($favoriteBooks && $favoriteBooks->isNotEmpty())
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach($favoriteBooks as $book)
                        <button type="button" onclick="selectBook('{{ $book->id }}', '{{ addslashes($book->title) }}', '{{ $book->image ? asset('images/' . $book->image) : '' }}')" class="group text-left text-left focus:outline-none focus:ring-4 focus:ring-[#c5a059] rounded-xl transition-all hover:-translate-y-1">
                            <div class="aspect-[3/4] bg-[#e8e4db] rounded-xl overflow-hidden shadow-sm border border-[#e9e1d8] group-hover:shadow-md group-hover:border-[#c5a059] transition-all mb-3 relative">
                                @if($book->image)
                                    <img src="{{ asset('images/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[#c5a059] bg-[#fbf2e9]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-[#1e1b16]/0 group-hover:bg-[#1e1b16]/10 transition-colors"></div>
                            </div>
                            <h4 class="font-bold text-sm text-[#1e1b16] group-hover:text-[#775a19] truncate leading-tight">{{ $book->title }}</h4>
                            <p class="text-xs text-[#7f7667] truncate">{{ $book->author }}</p>
                        </button>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mx-auto text-[#d1c5b4] mb-4"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                    <h3 class="font-heading text-xl font-bold text-[#1e1b16] mb-2">No Favorites Yet</h3>
                    <p class="text-[#7f7667]">You haven't marked any books as favorites.<br>Explore the library and heart some books first!</p>
                    <button type="button" onclick="document.getElementById('attach-book-modal').classList.add('hidden')" class="mt-6 bg-[#1e1b16] text-white px-6 py-2 rounded-full text-sm font-bold hover:bg-[#36322b] transition-colors">Close</button>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function selectBook(id, title, imageUrl) {
        document.getElementById('selected-book-id').value = id;
        document.getElementById('preview-title').textContent = title;
        
        const previewImage = document.getElementById('preview-image');
        if (imageUrl) {
            previewImage.src = imageUrl;
            previewImage.classList.remove('hidden');
        } else {
            previewImage.classList.add('hidden');
        }
        
        document.getElementById('selected-book-preview').classList.remove('hidden');
        document.getElementById('attach-book-modal').classList.add('hidden');
    }

    function removeSelectedBook() {
        document.getElementById('selected-book-id').value = "";
        document.getElementById('selected-book-preview').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        document.querySelectorAll('.like-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const postId = this.dataset.postId;
                const icon = this.querySelector('.like-icon');
                const countSpan = this.querySelector('.like-count');
                
                fetch(`/book-club/post/${postId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        countSpan.textContent = data.likes_count;
                        if (data.is_liked) {
                            this.classList.replace('text-[#7f7667]', 'text-[#c5a059]');
                            this.classList.remove('hover:text-[#c5a059]');
                            icon.setAttribute('fill', 'currentColor');
                        } else {
                            this.classList.replace('text-[#c5a059]', 'text-[#7f7667]');
                            this.classList.add('hover:text-[#c5a059]');
                            icon.setAttribute('fill', 'none');
                        }
                    }
                })
                .catch(err => {
                    if (err.status === 401 || String(err).includes('Unauthenticated')) {
                        window.location.href = '/login';
                    }
                });
            });
        });
    });
</script>
@endsection
