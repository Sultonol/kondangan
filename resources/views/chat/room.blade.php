@extends('layouts.app')
@section('title', $event->title)
@section('content')
<div class="flex h-screen bg-gradient-to-br from-slate-50 to-gray-100">
    <!-- Sidebar -->
    <div class="w-80 bg-white/90 backdrop-blur-xl border-r border-gray-200/50 flex flex-col shadow-xl">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-rose-500 via-pink-500 to-purple-600 relative overflow-hidden">
            <!-- Background pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-32 h-32 bg-white rounded-full -translate-x-16 -translate-y-16"></div>
                <div class="absolute bottom-0 right-0 w-24 h-24 bg-white rounded-full translate-x-12 translate-y-12"></div>
            </div>
            
            <div class="flex items-center space-x-4 relative z-10">
                <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/30">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </div>
                <div class="text-white">
                    <h2 class="font-bold text-lg font-dancing">{{ $event->groom_name }} & {{ $event->bride_name }}</h2>
                    <p class="text-sm opacity-90 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        {{ $event->participants->count() }} participants
                    </p>
                </div>
            </div>
        </div>

        <!-- Participants List -->
        <div class="flex-1 overflow-y-auto scrollbar-thin">
            <div class="p-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold text-gray-600 uppercase tracking-wider">Participants</h3>
                    <div class="w-6 h-6 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full flex items-center justify-center">
                        <span class="text-xs font-bold text-white">{{ $event->participants->where('is_online', true)->count() }}</span>
                    </div>
                </div>
                
                <div class="space-y-2">
                    @foreach($event->participants as $p)
                    <div class="flex items-center space-x-3 p-3 rounded-2xl hover:bg-gradient-to-r hover:from-rose-50 hover:to-pink-50 cursor-pointer participant-item transition-all duration-300 group border border-transparent hover:border-rose-200/50"
                         data-participant-id="{{ $p->id }}">
                        <div class="relative">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-400 via-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                <span class="text-white font-bold text-sm">{{ substr($p->name, 0, 1) }}</span>
                            </div>
                            @if($p->is_online)
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 border-2 border-white rounded-full online-pulse"></div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-900 truncate group-hover:text-rose-600 transition-colors">{{ $p->name }}</p>
                            <p class="text-xs text-gray-500 flex items-center">
                                @if($p->is_online)
                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                                    Online now
                                @else
                                    <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $p->last_seen->diffForHumans() }}
                                @endif
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Area -->
    <div class="flex-1 flex flex-col">
        <!-- Chat Header -->
        <div class="p-6 bg-white/90 backdrop-blur-xl border-b border-gray-200/50 flex items-center justify-between shadow-sm">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">{{ $event->title }}</h1>
                <p class="text-sm text-gray-500 flex items-center mt-1">
                    <svg class="w-4 h-4 mr-2 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2h3z"></path>
                    </svg>
                    {{ $event->event_date->format('d M Y, H:i') }}
                </p>
            </div>
            <div class="flex space-x-3">
                <button id="videoCallBtn" class="p-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl hover:from-green-600 hover:to-emerald-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 group">
                    <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                </button>
                <button id="voiceCallBtn" class="p-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-2xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 group">
                    <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Messages Area -->
        <div id="messagesContainer" class="flex-1 overflow-y-auto p-6 space-y-4 scrollbar-thin bg-gradient-to-b from-gray-50/50 to-white/50">
            @foreach($messages as $message)
            <div class="flex items-start space-x-3 message-item group">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-400 via-purple-500 to-pink-500 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg">
                    <span class="text-white font-bold text-sm">{{ substr($message->participant->name, 0, 1) }}</span>
                </div>
                <div class="flex-1 max-w-2xl">
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="font-semibold text-gray-900">{{ $message->participant->name }}</span>
                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">{{ $message->created_at->format('H:i') }}</span>
                    </div>
                    <div class="bg-white rounded-2xl rounded-tl-lg p-4 shadow-sm border border-gray-100 group-hover:shadow-md transition-shadow duration-300">
                        <p class="text-gray-800 leading-relaxed">{{ $message->message }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Message Input -->
        <div class="p-6 bg-white/90 backdrop-blur-xl border-t border-gray-200/50">
            <form id="messageForm" class="flex space-x-4">
                @csrf
                <div class="flex-1 relative">
                    <input type="text"
                           id="messageInput"
                           name="message"
                           class="w-full px-6 py-4 pr-12 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-rose-500/20 focus:border-rose-400 transition-all duration-300 bg-white/80 backdrop-blur-sm placeholder-gray-400"
                           placeholder="Type your heartfelt message..."
                           required>
                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                    </div>
                </div>
                <button type="submit"
                        class="px-8 py-4 bg-gradient-to-r from-rose-500 via-pink-500 to-purple-600 text-white rounded-2xl hover:from-rose-600 hover:via-pink-600 hover:to-purple-700 transition-all duration-300 flex items-center space-x-2 shadow-lg hover:shadow-xl transform hover:scale-105 font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    <span>Send</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Enhanced Video Call Modal -->
<div id="videoCallModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-8 max-w-3xl w-full mx-4 shadow-2xl">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Video Call - Wedding Celebration</h3>
            <button id="closeVideoCall" class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="aspect-video bg-gradient-to-br from-gray-900 to-black rounded-2xl mb-6 flex items-center justify-center overflow-hidden shadow-inner">
            <video id="weddingVideo" class="w-full h-full rounded-2xl object-cover" controls>
                <source src="/videos/wedding-preview.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="flex justify-center space-x-4">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messageForm = document.getElementById('messageForm');
    const messageInput = document.getElementById('messageInput');
    const messagesContainer = document.getElementById('messagesContainer');

    // Auto scroll to bottom
    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    scrollToBottom();

    // Send message
    messageForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const message = messageInput.value.trim();
        if (!message) return;

        fetch(`{{ route('chat.send', $event->id) }}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageInput.value = '';
                addMessageToChat(data.message, true);
            }
        })
        .catch(error => console.error('Error:', error));
    });

    // Add message to chat
    function addMessageToChat(message, isOwn = false) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'flex items-start space-x-3 message-item group';
        
        messageDiv.innerHTML = `
            <div class="w-10 h-10 bg-gradient-to-br from-blue-400 via-purple-500 to-pink-500 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg">
                <span class="text-white font-bold text-sm">${message.participant.name.charAt(0)}</span>
            </div>
            <div class="flex-1 max-w-2xl">
                <div class="flex items-center space-x-2 mb-2">
                    <span class="font-semibold text-gray-900">${message.participant.name}</span>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">${new Date().toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'})}</span>
                </div>
                <div class="bg-white rounded-2xl rounded-tl-lg p-4 shadow-sm border border-gray-100 group-hover:shadow-md transition-shadow duration-300">
                    <p class="text-gray-800 leading-relaxed">${message.message}</p>
                </div>
            </div>
        `;
        
        messagesContainer.appendChild(messageDiv);
        scrollToBottom();
    }

    // Video Call
    const videoCallBtn = document.getElementById('videoCallBtn');
    const videoCallModal = document.getElementById('videoCallModal');
    const closeVideoCall = document.getElementById('closeVideoCall');
    const endVideoCall = document.getElementById('endVideoCall');

    videoCallBtn.addEventListener('click', function() {
        videoCallModal.classList.remove('hidden');
    });

    closeVideoCall.addEventListener('click', function() {
        videoCallModal.classList.add('hidden');
    });

    endVideoCall.addEventListener('click', function() {
        videoCallModal.classList.add('hidden');
    });

    // Voice Call
    const voiceCallBtn = document.getElementById('voiceCallBtn');
    const voiceCallModal = document.getElementById('voiceCallModal');
    const endVoiceCall = document.getElementById('endVoiceCall');

    voiceCallBtn.addEventListener('click', function() {
        voiceCallModal.classList.remove('hidden');
    });

    endVoiceCall.addEventListener('click', function() {
        voiceCallModal.classList.add('hidden');
    });

    // Participant click to profile
    document.querySelectorAll('.participant-item').forEach(item => {
        item.addEventListener('click', function() {
            const participantId = this.dataset.participantId;
            window.location.href = `{{ route('chat.profile', [$event->id, ':participantId']) }}`.replace(':participantId', participantId);
        });
    });
});
</script>
@endsection