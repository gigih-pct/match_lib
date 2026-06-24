@extends('layouts.app')

@section('title', 'Edit Profile - MindMatch Library')

@section('content')
<div class="max-w-2xl mx-auto pb-12">
    <div class="bg-white rounded-[32px] shadow-sm border border-[#e9e1d8]/60 overflow-hidden">
        
        <!-- Header -->
        <div class="bg-[#fcfcd4] px-8 py-10 text-center border-b border-[#e9e1d8]/40 relative">
            <div class="absolute inset-0 bg-[#c5a059]/10 mix-blend-multiply"></div>
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-24 h-24 rounded-full border-4 border-white shadow-md overflow-hidden bg-white mb-4">
                    <img src="{{ asset('images/avatar_eleanor.png') }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                </div>
                <h2 class="font-heading text-3xl font-bold text-[#1e1b16]">Profile Settings</h2>
                <p class="text-[#4e4639] mt-2">Manage your personal information and password.</p>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-8 md:p-12">
            @if(session('success'))
                <div class="mb-8 p-4 bg-[#fbf2e9] border border-[#c5a059] text-[#775a19] rounded-2xl flex items-center gap-3 font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-bold text-[#1e1b16] mb-2">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required 
                        class="w-full bg-[#fff8f3] border border-[#e9e1d8] rounded-xl px-4 py-3 text-[#1e1b16] focus:outline-none focus:ring-2 focus:ring-[#c5a059] transition-all">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-bold text-[#1e1b16] mb-2">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required 
                        class="w-full bg-[#fff8f3] border border-[#e9e1d8] rounded-xl px-4 py-3 text-[#1e1b16] focus:outline-none focus:ring-2 focus:ring-[#c5a059] transition-all">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-[#e9e1d8] my-8">

                <!-- Password Info -->
                <div class="mb-4">
                    <h3 class="font-bold text-[#1e1b16] text-lg">Change Password</h3>
                    <p class="text-xs text-[#7f7667]">Leave blank if you don't want to change it.</p>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-bold text-[#1e1b16] mb-2">New Password</label>
                    <input type="password" id="password" name="password" 
                        class="w-full bg-[#fff8f3] border border-[#e9e1d8] rounded-xl px-4 py-3 text-[#1e1b16] focus:outline-none focus:ring-2 focus:ring-[#c5a059] transition-all">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-[#1e1b16] mb-2">Confirm New Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                        class="w-full bg-[#fff8f3] border border-[#e9e1d8] rounded-xl px-4 py-3 text-[#1e1b16] focus:outline-none focus:ring-2 focus:ring-[#c5a059] transition-all">
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-[#1e1b16] hover:bg-[#36322b] text-white font-bold py-3.5 px-6 rounded-xl transition-all shadow-sm">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
