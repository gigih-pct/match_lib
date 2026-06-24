<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - MindMatch Library</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #fff8f3; }
        .font-heading { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="antialiased min-h-screen flex text-[#1e1b16]">

    <!-- Left Side: Image -->
    <div class="hidden lg:flex lg:w-[45%] relative bg-black shadow-2xl z-10">
        <img src="{{ asset('images/auth_bg.png') }}" alt="Library" class="absolute inset-0 w-full h-full object-cover opacity-80">
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
        <div class="relative z-10 flex flex-col justify-end p-16 xl:p-20 w-full text-white">
            <h2 class="font-heading text-5xl font-bold mb-6 tracking-tight leading-tight">Discover Your Next<br/>Great Read</h2>
            <p class="text-lg text-white/80 max-w-md leading-relaxed">Join our curated sanctuary of knowledge. A place designed for focus, curation, and intellectual calm.</p>
        </div>
    </div>

    <!-- Right Side: Form -->
    <div class="w-full lg:w-[55%] flex items-center justify-center p-8 sm:p-16 xl:p-24 relative overflow-y-auto">
        <div class="w-full max-w-md my-auto py-8">
            
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-3 mb-10 text-[#775a19] hover:text-[#c5a059] transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:-translate-x-1 transition-transform"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/><path d="M8 7h6"/><path d="M8 11h8"/></svg>
                <span class="font-heading font-bold text-2xl tracking-tight text-[#1e1b16]">MindMatch Library</span>
            </a>

            <h1 class="font-heading text-6xl font-bold mb-4 tracking-tight">Create Account</h1>
            <p class="text-[#7f7667] mb-10 text-lg">Step into the quiet alcove. Register below.</p>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-bold text-[#4e4639] mb-2 tracking-wide">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full bg-[#fcfcd4] border border-[#e9e1d8] text-[#1e1b16] rounded-xl py-4 px-5 focus:outline-none focus:ring-2 focus:ring-[#c5a059] focus:border-transparent transition-all shadow-sm placeholder:text-[#a89d8c]" placeholder="Jane Austen">
                    @error('name')<p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-bold text-[#4e4639] mb-2 tracking-wide">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full bg-[#fcfcd4] border border-[#e9e1d8] text-[#1e1b16] rounded-xl py-4 px-5 focus:outline-none focus:ring-2 focus:ring-[#c5a059] focus:border-transparent transition-all shadow-sm placeholder:text-[#a89d8c]" placeholder="jane@example.com">
                    @error('email')<p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-[#4e4639] mb-2 tracking-wide">Password</label>
                    <input id="password" type="password" name="password" required class="w-full bg-[#fcfcd4] border border-[#e9e1d8] text-[#1e1b16] rounded-xl py-4 px-5 focus:outline-none focus:ring-2 focus:ring-[#c5a059] focus:border-transparent transition-all shadow-sm placeholder:text-[#a89d8c]" placeholder="••••••••">
                    @error('password')<p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="w-full bg-[#c5a059] hover:bg-[#b08e4f] text-[#2c251f] font-bold py-4 px-4 rounded-xl transition-all shadow-sm flex justify-center items-center gap-2 mt-8 text-lg hover:-translate-y-0.5">
                    Sign Up
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
            </form>

            <p class="mt-12 text-center text-[#7f7667]">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-bold text-[#775a19] hover:text-[#c5a059] transition-colors underline underline-offset-4 decoration-[#e9e1d8] hover:decoration-[#c5a059]">Login</a>
            </p>
        </div>
    </div>
</body>
</html>
