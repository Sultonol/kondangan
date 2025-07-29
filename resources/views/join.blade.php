<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Group Hajatan</title>
</head>
<body>
    @extends('layouts.app')
@section('title', isset($event) ? 'Join ' . $event->title : 'Join Wedding Chat')

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
                <div class="relative w-20 h-20 mx-auto mb-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-rose-400 via-pink-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg relative overflow-hidden">
                        <div class="relative">
                            <svg class="w-10 h-10 text-white animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            <div class="absolute -top-1 -right-1 w-2 h-2 bg-yellow-300 rounded-full animate-ping"></div>
                        </div>
                    </div>
                    <div class="absolute inset-0 rounded-full border-2 border-rose-200 animate-spin-slow"></div>
                </div>

                @if(isset($event))
                    <!-- Event Info -->
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-rose-600 via-pink-600 to-purple-600 bg-clip-text text-transparent mb-2 font-dancing">
                        {{ $event->groom_name }} & {{ $event->bride_name }}
                    </h1>
                    <div class="text-sm text-gray-600 mb-2">
                        {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, H:i') }}
                    </div>
                    <p class="text-gray-600 font-medium">Join Wedding Chat</p>
                @else
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-rose-600 via-pink-600 to-purple-600 bg-clip-text text-transparent mb-2 font-dancing">
                        Wedding Chat
                    </h1>
                    <p class="text-gray-600 font-medium">Join the Celebration</p>
                @endif
                
                <div class="w-12 h-1 bg-gradient-to-r from-rose-400 to-purple-400 rounded-full mx-auto mt-3"></div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl">
                    <p class="text-green-600 text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            <!-- Error Message -->
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl">
                    <p class="text-red-600 text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('error') }}
                    </p>
                </div>
            @endif

            <!-- No Active Event Message -->
            @if(!isset($event))
                <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-2xl">
                    <p class="text-yellow-600 text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tidak ada acara yang aktif saat ini.
                    </p>
                </div>
            @endif

            @if(isset($event))
                <form action="{{ route('join') }}" method="POST" class="space-y-5" id="joinForm">
                    @csrf
                    
                    <!-- Name -->
                    <div class="group">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Your Name
                        </label>
                        <div class="relative">
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   class="w-full px-4 py-3 pl-11 border-2 border-gray-200 rounded-xl focus:ring-3 focus:ring-pink-500/20 focus:border-pink-400 transition-all duration-300 bg-white/70 backdrop-blur-sm group-hover:border-pink-300 @error('name') border-red-300 @enderror"
                                   placeholder="Enter your name"
                                   required>
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
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
                        <p class="mt-1 text-xs text-gray-500">
                            <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            If you've joined before, use the same name to continue
                        </p>
                    </div>

                    <!-- Phone -->
                    <div class="group">
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
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
                                   class="w-full px-4 py-3 pl-11 border-2 border-gray-200 rounded-xl focus:ring-3 focus:ring-purple-500/20 focus:border-purple-400 transition-all duration-300 bg-white/70 backdrop-blur-sm group-hover:border-purple-300"
                                   placeholder="08123456789">
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
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
                            id="joinButton"
                            class="w-full bg-gradient-to-r from-rose-500 via-pink-500 to-purple-600 text-white py-3 px-6 rounded-xl font-bold text-base hover:from-rose-600 hover:via-pink-600 hover:to-purple-700 transform hover:scale-[1.02] hover:shadow-xl transition-all duration-300 shadow-lg relative overflow-hidden group disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="relative z-10 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <span id="buttonText">Join Chat</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    </button>
                </form>

                <!-- Participants Count -->
                <div class="mt-6 text-center">
                    <div class="flex items-center justify-center text-gray-500 text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        <span>{{ $event->participants->count() }} people joined</span>
                    </div>
                </div>
            @endif

            <!-- Footer decoration -->
            <div class="mt-6 text-center">
                <div class="flex items-center justify-center space-x-2 text-gray-400">
                    <div class="w-6 h-px bg-gradient-to-r from-transparent to-gray-300"></div>
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    <div class="w-6 h-px bg-gradient-to-l from-transparent to-gray-300"></div>
                </div>
                <p class="text-xs text-gray-500 mt-1 font-medium">Made with love</p>
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

<script>
// Handle form submission with loading state
document.getElementById('joinForm')?.addEventListener('submit', function(e) {
    const button = document.getElementById('joinButton');
    const buttonText = document.getElementById('buttonText');
    
    button.disabled = true;
    buttonText.textContent = 'Joining...';
    
    // Re-enable button after 3 seconds in case of error
    setTimeout(() => {
        button.disabled = false;
        buttonText.textContent = 'Join Chat';
    }, 3000);
});

// Auto-focus on name input
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    if (nameInput) {
        nameInput.focus();
    }
});
</script>
@endsection
</body>
</html>