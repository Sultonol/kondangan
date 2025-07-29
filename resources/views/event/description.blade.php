@extends('layouts.app')
@section('title', $event->title . ' - Description')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-red-50">
<!-- Header -->
<div class="bg-white/90 backdrop-blur-xl border-b border-gray-200/50 sticky top-0 z-40 shadow-lg">
    <div class="max-w-4xl mx-auto px-6 py-4 flex items-center justify-between">
        <a href="{{ route('chat.room', $event->id) }}" 
           class="flex items-center text-gray-600 hover:text-gray-800 transition-colors group">
            <svg class="w-6 h-6 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Chat
        </a>
        <h1 class="text-xl font-bold text-gray-800">Wedding Details</h1>
        <div class="w-20"></div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-6 py-8 space-y-8">
    <!-- Group Header with Action Buttons -->
    <div class="text-center">
        <div class="w-32 h-32 bg-gradient-to-br from-rose-400 via-pink-500 to-purple-600 rounded-full mx-auto mb-6 flex items-center justify-center shadow-2xl relative overflow-hidden">
            <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2 font-serif">{{ $event->title }}</h2>
        <p class="text-gray-600 mb-6 flex items-center justify-center">
            <svg class="w-5 h-5 mr-2 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            {{ $event->participants->count() }} participants joined
        </p>
        
        <!-- Action Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <button id="voiceCallBtn" class="flex items-center space-x-2 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl hover:from-green-600 hover:to-emerald-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 group">
                <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                <span class="font-semibold">Voice Call</span>
            </button>
            
            <button id="videoCallBtn" class="flex items-center space-x-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-2xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 group">
                <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                </svg>
                <span class="font-semibold">Video Call</span>
            </button>
            
            <button id="locationBtn" class="flex items-center space-x-2 px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-2xl hover:from-purple-600 hover:to-pink-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 group">
                <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="font-semibold">Location</span>
            </button>
            
            <button id="mediaBtn" class="flex items-center space-x-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-red-600 text-white rounded-2xl hover:from-orange-600 hover:to-red-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 group">
                <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="font-semibold">Media</span>
            </button>
        </div>
    </div>

    <!-- Video Section -->
    @if($videos)
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-[1.02] transition-transform duration-300">
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-red-50 to-pink-50">
            <h3 class="text-2xl font-bold text-gray-800 text-center flex items-center justify-center">
                <svg class="w-6 h-6 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 002 2z"></path>
                </svg>
                {{ $videos->title }}
            </h3>
            @if($videos->description)
                <p class="text-center text-gray-600 mt-2">{{ $videos->description }}</p>
            @endif
        </div>
        
        <div class="relative bg-black group">
            <!-- Video Player -->
            <video class="w-full aspect-video object-cover" 
                   controls 
                   poster="/placeholder.svg?height=720&width=1280&text=Wedding+Video">
                <source src="{{ $videos->url }}" type="video/mp4">
                <source src="{{ $videos->url }}" type="video/webm">
                <source src="{{ $videos->url }}" type="video/ogg">
                Your browser does not support the video tag.
            </video>
            
            <!-- Video Info Overlay -->
            <div class="absolute bottom-4 left-4 bg-black/70 text-white px-6 py-3 rounded-2xl backdrop-blur-sm">
                <p class="font-semibold text-lg">{{ $videos->title }}</p>
                @if($videos->description)
                    <p class="text-sm opacity-90">{{ $videos->description }}</p>
                @endif
            </div>
        </div>
    </div>
    @else
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden p-8 text-center">
        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
        </svg>
        <p class="text-gray-500 text-lg">No video available</p>
    </div>
    @endif

    <!-- Schedule Section -->
    @if($schedules->count() > 0)
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-[1.01] transition-transform duration-300">
        <div class="bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 p-8 text-center relative overflow-hidden">
            <!-- Animated background elements -->
            <div class="absolute top-0 left-0 w-full h-full opacity-20">
                <div class="absolute top-4 left-4 w-8 h-8 border-4 border-white rounded-full animate-bounce"></div>
                <div class="absolute top-4 right-4 w-6 h-6 border-4 border-white rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                <div class="absolute bottom-4 left-8 w-4 h-4 border-4 border-white rounded-full animate-bounce" style="animation-delay: 0.4s;"></div>
                <div class="absolute bottom-4 right-8 w-10 h-10 border-4 border-white rounded-full animate-bounce" style="animation-delay: 0.6s;"></div>
            </div>
            
            <h3 class="text-5xl font-bold text-white mb-3 font-serif relative z-10 drop-shadow-2xl">
                TATANAN WAKTU
            </h3>
            <p class="text-white/90 text-xl relative z-10 font-dancing">Hajatan</p>
        </div>
        
        <div class="p-8">
            <div class="space-y-6">
                @foreach($schedules as $schedule)
                <div class="flex items-center space-x-6 p-6 rounded-3xl border-2 border-orange-200 bg-gradient-to-r from-orange-50 to-yellow-50 hover:shadow-2xl transition-all duration-300 transform hover:scale-[1.02] group">
                    <div class="px-6 py-4 rounded-2xl font-bold text-xl min-w-[140px] text-center shadow-xl group-hover:shadow-2xl transition-shadow text-white"
                         style="background: {{ $schedule->color }}">
                        {{ $schedule->start_time->format('H:i') }} - {{ $schedule->end_time->format('H:i') }}
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-gray-800 text-xl mb-2 group-hover:text-orange-600 transition-colors">{{ $schedule->title }}</h4>
                        @if($schedule->description)
                            <p class="text-gray-600 text-lg leading-relaxed">{{ $schedule->description }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-10 text-center">
                <p class="text-lg text-gray-600 italic bg-gradient-to-r from-orange-100 to-yellow-100 px-8 py-4 rounded-full inline-block border-2 border-orange-200 shadow-lg">
                    "Semoga acara berjalan lancar, sesuai dengan harapan kita semua"
                </p>
            </div>
        </div>
    </div>
    @endif

    <!-- Dress Code Section -->
    @if($event->dress_code_image)
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-[1.01] transition-transform duration-300">
        <div class="bg-gradient-to-r from-orange-400 via-red-500 to-pink-500 p-8 text-center relative overflow-hidden">
            <h3 class="text-5xl font-bold text-white mb-3 font-serif relative z-10 drop-shadow-2xl">
                DRESS Code
            </h3>
            
            <!-- Animated smiley faces -->
            <div class="flex justify-center space-x-3 mt-6 relative z-10">
                @for($i = 0; $i < 5; $i++)
                <div class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center border-3 border-yellow-300 shadow-lg animate-bounce" style="animation-delay: {{ $i * 0.2 }}s;">
                    <span class="text-xl">😊</span>
                </div>
                @endfor
            </div>
        </div>
        
        <div class="p-8">
            <div class="relative rounded-3xl overflow-hidden shadow-2xl group">
                <img src="{{ $event->dress_code_image_url }}" 
                     alt="Dress Code" 
                     class="w-full h-96 object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute top-6 right-6 bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-3 rounded-full font-bold text-3xl shadow-2xl animate-pulse">
                    80's
                </div>
                <div class="absolute bottom-6 left-6 bg-black/70 text-white px-6 py-4 rounded-2xl backdrop-blur-sm">
                    <p class="font-semibold text-lg">Recommended Outfits</p>
                    <p class="text-sm opacity-90">Dress up in 80's style for the celebration!</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Gallery Section -->
    @if($images && $images->count() > 0)
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-[1.01] transition-transform duration-300">
        <div class="p-8 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-pink-50">
            <h3 class="text-3xl font-bold text-gray-800 text-center flex items-center justify-center">
                <svg class="w-8 h-8 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Photo Gallery
            </h3>
            <p class="text-center text-gray-600 mt-2">{{ $images->count() }} photos available</p>
        </div>
        <div class="p-8">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($images as $image)
                <div class="aspect-square rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 cursor-pointer group transform hover:scale-105 relative">
                    <!-- Image with error handling -->
                    <img src="{{ $image->url }}" 
                         alt="{{ $image->title }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                         onerror="this.src='/placeholder.svg?height=300&width=300&text=Image+Not+Found'; this.classList.add('opacity-50');">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                        <div class="text-white">
                            <p class="font-semibold">{{ $image->title }}</p>
                            <p class="text-sm opacity-90">{{ $image->description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Bank Information Section -->
    @if($banks->count() > 0)
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-[1.01] transition-transform duration-300">
        <div class="bg-gradient-to-r from-blue-400 via-cyan-500 to-teal-500 p-8 text-center relative overflow-hidden">
            <h3 class="text-5xl font-bold text-white mb-3 font-serif relative z-10 drop-shadow-2xl">
                IURAN WARGA
            </h3>
            <p class="text-white/90 text-xl relative z-10 font-dancing">Suka-Suka</p>
        </div>
        
        <div class="p-8 space-y-6">
            @foreach($banks as $bank)
            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-3xl p-8 border-2 border-blue-200 shadow-inner">
                <div class="text-center">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-600 text-white px-10 py-6 rounded-3xl font-bold text-3xl mb-6 shadow-2xl">
                        {{ strtoupper($bank->bank_name) }}
                    </div>
                    <div class="space-y-4">
                        <!-- Account Number with Blur Effect -->
                        <div class="relative">
                            <div class="bg-gradient-to-r from-orange-400 to-red-500 text-white px-8 py-4 rounded-2xl font-bold text-xl shadow-xl">
                                <span class="account-number blur-sm select-none">{{ $bank->account_number }}</span>
                                <span class="account-number-visible hidden">{{ $bank->account_number }}</span>
                            </div>
                            <button class="copy-account-btn absolute right-2 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white p-2 rounded-xl transition-colors" data-account="{{ $bank->account_number }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="bg-gradient-to-r from-orange-400 to-red-500 text-white px-8 py-4 rounded-2xl font-bold text-xl shadow-xl">
                            {{ $bank->account_holder }}
                        </div>
                        
                        <!-- Toggle and Copy Buttons -->
                        <div class="flex justify-center space-x-4 mt-6">
                            <button class="toggle-blur-btn flex items-center space-x-2 px-6 py-3 bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded-2xl hover:from-purple-600 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <span>Show Number</span>
                            </button>
                            
                            <button class="copy-full-btn flex items-center space-x-2 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl hover:from-green-600 hover:to-emerald-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105" 
                                    data-bank="{{ $bank->bank_name }}" 
                                    data-account="{{ $bank->account_number }}" 
                                    data-holder="{{ $bank->account_holder }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                <span>Copy Account</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Event Details -->
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-[1.01] transition-transform duration-300">
        <div class="p-8 bg-gradient-to-r from-gray-50 to-blue-50">
            <h3 class="text-3xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center">
                <svg class="w-8 h-8 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Event Details
            </h3>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div class="flex items-center space-x-4 p-4 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-rose-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">Date & Time</p>
                            <p class="font-bold text-gray-800 text-lg">{{ $event->event_date->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4 p-4 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">Location</p>
                            <p class="font-bold text-gray-800 text-lg">{{ $event->location }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <div class="flex items-center space-x-4 p-4 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">Participants</p>
                            <p class="font-bold text-gray-800 text-lg">{{ $event->participants->count() }} people joined</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4 p-4 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">Status</p>
                            <p class="font-bold text-green-600 text-lg">{{ $event->is_active ? 'Active' : 'Inactive' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            @if($event->description)
            <div class="mt-8 p-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-3xl border-2 border-blue-200">
                <h4 class="font-bold text-gray-800 mb-3 text-xl">Description</h4>
                <p class="text-gray-600 leading-relaxed text-lg">{{ $event->description }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
</div>

<!-- Enhanced Video Call Modal -->
<div id="videoCallModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
<div class="bg-white rounded-3xl p-8 max-w-4xl w-full mx-4 shadow-2xl">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Video Call - Wedding Celebration</h3>
        <button id="closeVideoCall" class="p-3 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-2xl transition-colors">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <div class="aspect-video bg-gradient-to-br from-gray-900 to-black rounded-3xl mb-6 flex items-center justify-center overflow-hidden shadow-2xl">
        <video id="weddingVideo" class="w-full h-full rounded-3xl object-cover" controls>
            <source src="/videos/wedding-preview.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <div class="flex justify-center space-x-6">
        <button id="muteBtn" class="p-4 bg-gray-500 text-white rounded-2xl hover:bg-gray-600 transition-colors shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path>
            </svg>
        </button>
        <button id="endVideoCall" class="p-4 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-2xl hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 3l18 18"></path>
            </svg>
        </button>
    </div>
</div>
</div>

<!-- Enhanced Voice Call Modal -->
<div id="voiceCallModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
<div class="bg-white rounded-3xl p-12 max-w-lg w-full mx-4 text-center shadow-2xl">
    <div class="w-40 h-40 bg-gradient-to-br from-rose-500 via-pink-500 to-purple-600 rounded-full mx-auto mb-8 flex items-center justify-center shadow-2xl relative overflow-hidden">
        <svg class="w-20 h-20 text-white animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
        </svg>
        <div class="absolute inset-0 rounded-full border-4 border-white/30 animate-ping"></div>
    </div>
    <h3 class="text-3xl font-bold text-gray-800 mb-3">Voice Call</h3>
    <p class="text-gray-600 mb-8 text-xl font-dancing">{{ $event->groom_name }} & {{ $event->bride_name }}</p>
    <audio id="weddingAudio" controls class="w-full mb-8 rounded-2xl">
        <source src="/audio/wedding-message.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <div class="flex justify-center space-x-6">
        <button id="muteAudioBtn" class="p-4 bg-gray-500 text-white rounded-2xl hover:bg-gray-600 transition-colors shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path>
            </svg>
        </button>
        <button id="endVoiceCall" class="p-4 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-2xl hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 3l18 18"></path>
            </svg>
        </button>
    </div>
</div>
</div>

<!-- Location Modal -->
<div id="locationModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
<div class="bg-white rounded-3xl p-8 max-w-2xl w-full mx-4 shadow-2xl">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Event Location</h3>
        <button id="closeLocation" class="p-3 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-2xl transition-colors">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <div class="space-y-6">
        <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-2xl">
            <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-semibold">Address</p>
                <p class="font-bold text-gray-800 text-lg">{{ $event->location }}</p>
            </div>
        </div>
        <div class="bg-gray-200 rounded-2xl h-64 flex items-center justify-center">
            <p class="text-gray-500">Map will be displayed here</p>
        </div>
        <div class="flex space-x-4">
            <button class="flex-1 flex items-center justify-center space-x-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-2xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                </svg>
                <span>Open in Maps</span>
            </button>
            <button class="flex-1 flex items-center justify-center space-x-2 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl hover:from-green-600 hover:to-emerald-700 transition-all duration-300 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                </svg>
                <span>Copy Address</span>
            </button>
        </div>
    </div>
</div>
</div>

<!-- Media Modal -->
<div id="mediaModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
<div class="bg-white rounded-3xl p-8 max-w-4xl w-full mx-4 shadow-2xl max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Media Gallery</h3>
        <button id="closeMedia" class="p-3 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-2xl transition-colors">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($images as $image)
        <div class="aspect-square rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 cursor-pointer group">
            <img src="{{ $image->url }}" 
                 alt="{{ $image->title }}" 
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        </div>
        @endforeach
    </div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Account number blur/unblur functionality
    document.querySelectorAll('.toggle-blur-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const container = this.closest('.space-y-4');
            const accountNumber = container.querySelector('.account-number');
            const accountNumberVisible = container.querySelector('.account-number-visible');
            
            if (accountNumber.classList.contains('blur-sm')) {
                accountNumber.classList.add('hidden');
                accountNumberVisible.classList.remove('hidden');
                this.innerHTML = `
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                    </svg>
                    <span>Hide Number</span>
                `;
            } else {
                accountNumber.classList.remove('hidden');
                accountNumberVisible.classList.add('hidden');
                this.innerHTML = `
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <span>Show Number</span>
                `;
            }
        });
    });

    // Copy functionality
    document.querySelectorAll('.copy-account-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const account = this.dataset.account;
            navigator.clipboard.writeText(account).then(() => {
                showToast('Account number copied!');
            });
        });
    });

    document.querySelectorAll('.copy-full-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const bank = this.dataset.bank;
            const account = this.dataset.account;
            const holder = this.dataset.holder;
            const fullInfo = `Bank: ${bank}
Account Number: ${account}
Account Holder: ${holder}`;
            
            navigator.clipboard.writeText(fullInfo).then(() => {
                showToast('Full account info copied!');
            });
        });
    });

    // Toast notification function
    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-2xl shadow-lg z-50 transform translate-x-full transition-transform duration-300';
        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);

        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }

    // Modal functionality
    const modals = {
        video: {
            btn: document.getElementById('videoCallBtn'),
            modal: document.getElementById('videoCallModal'),
            close: document.getElementById('closeVideoCall'),
            end: document.getElementById('endVideoCall')
        },
        voice: {
            btn: document.getElementById('voiceCallBtn'),
            modal: document.getElementById('voiceCallModal'),
            end: document.getElementById('endVoiceCall')
        },
        location: {
            btn: document.getElementById('locationBtn'),
            modal: document.getElementById('locationModal'),
            close: document.getElementById('closeLocation')
        },
        media: {
            btn: document.getElementById('mediaBtn'),
            modal: document.getElementById('mediaModal'),
            close: document.getElementById('closeMedia')
        }
    };

    // Setup modal events
    Object.keys(modals).forEach(key => {
        const modal = modals[key];
        
        if (modal.btn) {
            modal.btn.addEventListener('click', function() {
                modal.modal.classList.remove('hidden');
            });
        }

        if (modal.close) {
            modal.close.addEventListener('click', function() {
                modal.modal.classList.add('hidden');
            });
        }

        if (modal.end) {
            modal.end.addEventListener('click', function() {
                modal.modal.classList.add('hidden');
            });
        }

        // Close on backdrop click
        if (modal.modal) {
            modal.modal.addEventListener('click', function(e) {
                if (e.target === modal.modal) {
                    modal.modal.classList.add('hidden');
                }
            });
        }
    });
});
</script>

<style>
.scrollbar-thin::-webkit-scrollbar {
width: 4px;
}
.scrollbar-thin::-webkit-scrollbar-track {
background: #f1f1f1;
}
.scrollbar-thin::-webkit-scrollbar-thumb {
background: #c1c1c1;
border-radius: 2px;
}
.scrollbar-thin::-webkit-scrollbar-thumb:hover {
background: #a1a1a1;
}

@keyframes spin-slow {
from {
    transform: rotate(0deg);
}
to {
    transform: rotate(360deg);
}
}

.animate-spin-slow {
animation: spin-slow 3s linear infinite;
}

.font-dancing {
font-family: 'Dancing Script', cursive;
}

.font-serif {
font-family: 'Playfair Display', serif;
}
</style>

@endsection
