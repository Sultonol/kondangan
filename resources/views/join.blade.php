@extends('layouts.app')
@section('title', 'Join Wedding Invitation')
@section('content')
<div class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Background decorations -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-pink-200/30 to-purple-200/30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-rose-200/30 to-pink-200/30 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-purple-100/20 to-pink-100/20 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-md w-full">
        <!-- Main Card -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-8 relative overflow-hidden">
            <!-- Card decoration -->
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-rose-400 via-pink-400 to-purple-400"></div>
            
            <div class="text-center mb-8">
                <!-- Logo -->
                <div class="relative w-24 h-24 mx-auto mb-6">
                    <div class="w-24 h-24 bg-gradient-to-br from-rose-400 via-pink-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg relative overflow-hidden">
                        <!-- Heart icon with animation -->
                        <div class="relative">
                            <svg class="w-12 h-12 text-white animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            <!-- Sparkle effects -->
                            <div class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-300 rounded-full animate-ping"></div>
                            <div class="absolute -bottom-1 -left-1 w-2 h-2 bg-pink-300 rounded-full animate-ping" style="animation-delay: 0.5s;"></div>
                        </div>
                    </div>
                    <!-- Ring decoration -->
                    <div class="absolute inset-0 rounded-full border-4 border-gradient-to-r from-rose-200 to-purple-200 animate-spin-slow"></div>
                </div>

                <h1 class="text-4xl font-bold bg-gradient-to-r from-rose-600 via-pink-600 to-purple-600 bg-clip-text text-transparent mb-3 font-dancing">
                    Wedding Invitation
                </h1>
                <p class="text-gray-600 text-lg font-medium">Join our celebration chat room</p>
                <div class="w-16 h-1 bg-gradient-to-r from-rose-400 to-purple-400 rounded-full mx-auto mt-4"></div>
            </div>

            <form action="{{ route('join') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Invitation Code -->
                <div class="group">
                    <label for="invitation_code" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                        Invitation Code
                    </label>
                    <div class="relative">
                        <input type="text"
                               id="invitation_code"
                               name="invitation_code"
                               value="{{ old('invitation_code') }}"
                               class="w-full px-4 py-4 pl-12 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-rose-500/20 focus:border-rose-400 transition-all duration-300 bg-white/50 backdrop-blur-sm group-hover:border-rose-300"
                               placeholder="Enter invitation code"
                               required>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-rose-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                    </div>
                    @error('invitation_code')
                        <p class="mt-2 text-sm text-red-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Name -->
                <div class="group">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Full Name
                    </label>
                    <div class="relative">
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               class="w-full px-4 py-4 pl-12 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-pink-500/20 focus:border-pink-400 transition-all duration-300 bg-white/50 backdrop-blur-sm group-hover:border-pink-300"
                               placeholder="Enter your full name"
                               required>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-pink-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="group">
                    <label for="phone" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Phone Number <span class="text-gray-400 font-normal">(Optional)</span>
                    </label>
                    <div class="relative">
                        <input type="tel"
                               id="phone"
                               name="phone"
                               value="{{ old('phone') }}"
                               class="w-full px-4 py-4 pl-12 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-400 transition-all duration-300 bg-white/50 backdrop-blur-sm group-hover:border-purple-300"
                               placeholder="e.g., 08123456789">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-purple-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    @error('phone')
                        <p class="mt-2 text-sm text-red-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full bg-gradient-to-r from-rose-500 via-pink-500 to-purple-600 text-white py-4 px-6 rounded-2xl font-bold text-lg hover:from-rose-600 hover:via-pink-600 hover:to-purple-700 transform hover:scale-[1.02] hover:shadow-2xl transition-all duration-300 shadow-lg relative overflow-hidden group">
                    <span class="relative z-10 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        Join Celebration
                    </span>
                    <!-- Button shine effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                </button>
            </form>

            <!-- Footer decoration -->
            <div class="mt-8 text-center">
                <div class="flex items-center justify-center space-x-2 text-gray-400">
                    <div class="w-8 h-px bg-gradient-to-r from-transparent to-gray-300"></div>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    <div class="w-8 h-px bg-gradient-to-l from-transparent to-gray-300"></div>
                </div>
                <p class="text-xs text-gray-500 mt-2 font-medium">Made with love for your special day</p>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes spin-slow {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
.animate-spin-slow {
    animation: spin-slow 8s linear infinite;
}
</style>
@endsection