@extends('layouts.app')
@section('title', $participant->name . ' - Profile')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100">
    <!-- Enhanced Header -->
    <div class="bg-white/90 backdrop-blur-xl shadow-lg border-b border-gray-200/50">
        <div class="max-w-6xl mx-auto px-6 py-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('chat.room', $event->id) }}" class="p-3 hover:bg-gradient-to-r hover:from-rose-50 hover:to-pink-50 rounded-2xl transition-all duration-300 group border border-transparent hover:border-rose-200/50">
                    <svg class="w-6 h-6 text-gray-600 group-hover:text-rose-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Profile</h1>
                    <p class="text-sm text-gray-500">Participant details and information</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-8">
        <!-- Enhanced Profile Header -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl p-10 mb-8 border border-white/20 relative overflow-hidden">
            <!-- Background decoration -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-rose-100/30 to-purple-100/30 rounded-full -translate-y-32 translate-x-32 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-pink-100/30 to-rose-100/30 rounded-full translate-y-24 -translate-x-24 blur-3xl"></div>
            
            <div class="text-center relative z-10">
                <div class="relative w-32 h-32 mx-auto mb-6">
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-400 via-purple-500 to-pink-500 rounded-3xl flex items-center justify-center shadow-2xl">
                        <span class="text-white font-bold text-4xl">{{ substr($participant->name, 0, 1) }}</span>
                    </div>
                    <!-- Decorative rings -->
                    <div class="absolute inset-0 rounded-3xl border-4 border-gradient-to-r from-rose-200 to-purple-200 animate-spin-slow"></div>
                    <div class="absolute -inset-2 rounded-3xl border-2 border-gradient-to-r from-pink-200 to-rose-200 animate-pulse"></div>
                </div>
                
                <h2 class="text-4xl font-bold text-gray-800 mb-4 font-dancing">{{ $participant->name }}</h2>
                <div class="mb-8">
                    @if($participant->is_online)
                        <span class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-full text-sm font-semibold shadow-lg">
                            <div class="w-3 h-3 bg-white rounded-full mr-2 animate-pulse"></div>
                            Online Now
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-gray-400 to-gray-500 text-white rounded-full text-sm font-semibold shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Last seen {{ $participant->last_seen->diffForHumans() }}
                        </span>
                    @endif
                </div>

                <!-- Enhanced Action Buttons -->
                <div class="flex flex-wrap justify-center gap-4">
                    <button id="profileVideoCall" class="flex items-center space-x-3 px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl hover:from-green-600 hover:to-emerald-700 transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:scale-105 group">
                        <svg class="w-6 h-6 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-semibold">Video Call</span>
                    </button>

                    <button id="profileVoiceCall" class="flex items-center space-x-3 px-8 py-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-2xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:scale-105 group">
                        <svg class="w-6 h-6 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="font-semibold">Voice Call</span>
                    </button>

                    <button class="flex items-center space-x-3 px-8 py-4 bg-gradient-to-r from-purple-500 to-violet-600 text-white rounded-2xl hover:from-purple-600 hover:to-violet-700 transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:scale-105 group">
                        <svg class="w-6 h-6 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-semibold">Location</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Enhanced Event Information -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl p-10 mb-8 border border-white/20">
            <div class="flex items-center mb-8">
                <div class="w-12 h-12 bg-gradient-to-r from-rose-500 to-pink-600 rounded-2xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-800">Event Information</h3>
            </div>

            <div class="grid lg:grid-cols-2 gap-8 mb-10">
                <div class="space-y-6">
                    <div>
                        <h4 class="text-2xl font-bold text-gray-800 mb-3 font-dancing">{{ $event->title }}</h4>
                        <p class="text-gray-600 text-lg leading-relaxed">{{ $event->description }}</p>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-rose-50 to-pink-50 rounded-2xl border border-rose-200/50">
                            <div class="w-12 h-12 bg-gradient-to-r from-rose-400 to-pink-500 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2h3z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Event Date</p>
                                <p class="text-gray-600">{{ $event->event_date->format('d F Y, H:i') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-purple-50 to-violet-50 rounded-2xl border border-purple-200/50">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-violet-500 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Location</p>
                                <p class="text-gray-600">{{ $event->location }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    @if($event->dress_code_image)
                    <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl p-6 border border-gray-200/50">
                        <h4 class="font-bold text-gray-800 mb-4 text-xl">Dress Code</h4>
                        <div class="relative overflow-hidden rounded-2xl shadow-lg">
                            <img src="{{ asset('storage/' . $event->dress_code_image) }}"
                                 alt="Dress Code"
                                 class="w-full h-64 object-cover hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Enhanced Schedule -->
            @if($event->schedule)
            <div class="mb-8">
                <h4 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Schedule
                </h4>
                <div class="space-y-4">
                    @foreach($event->schedule as $index => $schedule)
                    <div class="flex items-center space-x-6 p-6 bg-gradient-to-r from-white to-gray-50 rounded-2xl border border-gray-200/50 hover:shadow-lg transition-all duration-300 group">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-gradient-to-br from-rose-400 to-pink-500 rounded-2xl flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                {{ $index + 1 }}
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h5 class="font-bold text-gray-800 text-lg group-hover:text-rose-600 transition-colors">{{ $schedule['title'] ?? '' }}</h5>
                                <span class="px-3 py-1 bg-gradient-to-r from-rose-100 to-pink-100 text-rose-700 rounded-full text-sm font-semibold">
                                    {{ $schedule['time'] ?? '' }}
                                </span>
                            </div>
                            @if(isset($schedule['description']))
                            <p class="text-gray-600 leading-relaxed">{{ $schedule['description'] }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Enhanced Media Section -->
        @if($event->media->count() > 0)
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl p-10 mb-8 border border-white/20">
            <div class="flex items-center mb-8">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-violet-600 rounded-2xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-800">Media Gallery</h3>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($event->media as $media)
                <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-6 border border-gray-200/50 hover:shadow-xl transition-all duration-300 group">
                    <div class="relative overflow-hidden rounded-2xl mb-4">
                        @if($media->type === 'image')
                        <img src="{{ asset('storage/' . $media->file_path) }}"
                             alt="{{ $media->title }}"
                             class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                        @elseif($media->type === 'video')
                        <video class="w-full h-48 object-cover rounded-2xl" controls>
                            <source src="{{ asset('storage/' . $media->file_path) }}" type="video/mp4">
                        </video>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <h5 class="font-bold text-gray-800 mb-2 text-lg">{{ $media->title }}</h5>
                    @if($media->description)
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $media->description }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Enhanced Wedding Gift Section -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl p-10 border border-white/20">
            <div class="flex items-center mb-8">
                <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-rose-600 rounded-2xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 font-dancing">Wedding Gift</h3>
            </div>

            <div class="bg-gradient-to-br from-pink-50 via-rose-50 to-purple-50 rounded-3xl p-8 border border-pink-200/50 relative overflow-hidden">
                <!-- Background decoration -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-pink-200/30 to-purple-200/30 rounded-full -translate-y-16 translate-x-16 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-rose-200/30 to-pink-200/30 rounded-full translate-y-12 -translate-x-12 blur-2xl"></div>
                
                <div class="relative z-10">
                    <div class="flex flex-col lg:flex-row items-center justify-between mb-6">
                        <div class="text-center lg:text-left mb-4 lg:mb-0">
                            <h4 class="text-2xl font-bold text-gray-800 mb-2">{{ $event->bank_name }}</h4>
                            <p class="text-gray-600 text-lg font-semibold">{{ $event->account_holder }}</p>
                        </div>
                        <div class="text-center lg:text-right">
                            <p class="text-3xl font-bold text-gray-800 mb-4 font-mono tracking-wider" id="accountNumber">{{ $event->account_number }}</p>
                            <button id="copyAccountBtn"
                                    class="px-6 py-3 bg-gradient-to-r from-pink-500 to-rose-600 text-white rounded-2xl hover:from-pink-600 hover:to-rose-700 transition-all duration-300 flex items-center space-x-2 shadow-lg hover:shadow-xl transform hover:scale-105 font-semibold mx-auto lg:mx-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                <span>Copy Account</span>
                            </button>
                        </div>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-1 bg-gradient-to-r from-pink-400 to-rose-400 rounded-full mx-auto mb-4"></div>
                        <p class="text-gray-600 leading-relaxed text-lg">
                            Your presence and prayers are the greatest gifts for us. However, if you wish to give a wedding gift, you can transfer it to the account above.
                        </p>
                        <div class="flex items-center justify-center mt-6 space-x-2 text-gray-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            <span class="text-sm font-medium">Thank you for your kindness</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Video Call Modal -->
<div id="videoCallModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-8 max-w-4xl w-full mx-4 shadow-2xl">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Video Call - Wedding Celebration</h3>
            <button id="closeVideoCall" class="p-3 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-2xl transition-all duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        <div class="flex justify-center space-x-4">
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
    <div class="bg-white rounded-3xl p-10 max-w-md w-full mx-4 text-center shadow-2xl">
        <div class="w-32 h-32 bg-gradient-to-br from-rose-500 via-pink-500 to-purple-600 rounded-full mx-auto mb-8 flex items-center justify-center shadow-2xl relative">
            <svg class="w-16 h-16 text-white animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
            </svg>
            <div class="absolute inset-0 rounded-full border-4 border-white/30 animate-ping"></div>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Voice Call</h3>
        <p class="text-gray-600 mb-8 text-lg font-dancing">{{ $event->groom_name }} & {{ $event->bride_name }}</p>
        <audio id="weddingAudio" controls class="w-full mb-8 rounded-2xl">
            <source src="/audio/wedding-message.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        <div class="flex justify-center space-x-4">
            <button id="endVoiceCall" class="p-4 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-2xl hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 3l18 18"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Copy account number with enhanced animation
    const copyAccountBtn = document.getElementById('copyAccountBtn');
    const accountNumber = document.getElementById('accountNumber').textContent;
    
    copyAccountBtn.addEventListener('click', function() {
        navigator.clipboard.writeText(accountNumber).then(function() {
            // Enhanced button feedback
            const originalText = copyAccountBtn.innerHTML;
            copyAccountBtn.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Copied!</span>
            `;
            copyAccountBtn.classList.remove('bg-gradient-to-r', 'from-pink-500', 'to-rose-600', 'hover:from-pink-600', 'hover:to-rose-700');
            copyAccountBtn.classList.add('bg-gradient-to-r', 'from-green-500', 'to-emerald-600');
            
            setTimeout(function() {
                copyAccountBtn.innerHTML = originalText;
                copyAccountBtn.classList.remove('bg-gradient-to-r', 'from-green-500', 'to-emerald-600');
                copyAccountBtn.classList.add('bg-gradient-to-r', 'from-pink-500', 'to-rose-600', 'hover:from-pink-600', 'hover:to-rose-700');
            }, 2000);
        });
    });

    // Video Call functionality
    const profileVideoCall = document.getElementById('profileVideoCall');
    const videoCallModal = document.getElementById('videoCallModal');
    const closeVideoCall = document.getElementById('closeVideoCall');
    const endVideoCall = document.getElementById('endVideoCall');

    profileVideoCall.addEventListener('click', function() {
        videoCallModal.classList.remove('hidden');
    });

    closeVideoCall.addEventListener('click', function() {
        videoCallModal.classList.add('hidden');
    });

    endVideoCall.addEventListener('click', function() {
        videoCallModal.classList.add('hidden');
    });

    // Voice Call functionality
    const profileVoiceCall = document.getElementById('profileVoiceCall');
    const voiceCallModal = document.getElementById('voiceCallModal');
    const endVoiceCall = document.getElementById('endVoiceCall');

    profileVoiceCall.addEventListener('click', function() {
        voiceCallModal.classList.remove('hidden');
    });

    endVoiceCall.addEventListener('click', function() {
        voiceCallModal.classList.add('hidden');
    });
});
</script>
@endsection