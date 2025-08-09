@extends('layouts.app')

@section('title', $event->title)

@section('content')
    <div class="flex h-screen relative overflow-hidden">
        <div class="absolute inset-0">
            <img src="/storage/events/images/walpaper.jpeg" alt="Chat Background" class="w-full h-full object-cover opacity-30"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
            <div class="hidden w-full h-full opacity-10"
                style="background: linear-gradient(135deg, #F8EAD0 0%, #F5E6C8 50%, #F2E2C0 100%); background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><defs><pattern id=%22traditional%22 x=%220%22 y=%220%22 width=%2220%22 height=%2220%22 patternUnits=%22userSpaceOnUse%22><circle cx=%2210%22 cy=%2210%22 r=%222%22 fill=%22%238B7355%22 opacity=%220.1%22/><path d=%22M5,5 Q10,2 15,5 Q18,10 15,15 Q10,18 5,15 Q2,10 5,5%22 fill=%22none%22 stroke=%22%238B7355%22 stroke-width=%220.3%22 opacity=%220.1%22/></pattern></defs><rect width=%22100%22 height=%22100%22 fill=%22url(%23traditional)%22/></svg>'); background-size: 60px 60px;">
            </div>
        </div>

        {{-- Background Music - ENHANCED AUTO PLAY --}}
        <audio id="backgroundMusic" loop preload="auto" style="display: none;">
            <source src="/storage/events/videos/nadhif.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>

        <div class="fixed top-20 right-4 z-40">
            <button id="speakerBtn"
                class="w-14 h-14 bg-white/90 backdrop-blur-sm hover:bg-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center relative transform hover:scale-110"
                title="Toggle Music">
                <svg id="speakerIcon" class="w-6 h-6 text-[#8B7355]" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 14.142M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z">
                    </path>
                </svg>
                <div id="musicIndicator"
                    class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full animate-pulse border-2 border-white">
                </div>
            </button>
        </div>

        <div class="flex-1 flex flex-col relative z-10">
            <div class="bg-[#F8EAD0]/95 backdrop-blur-sm border-b border-[#E8D5B7] shadow-sm">
                <div class="px-4 py-3 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <button onclick="window.location.href='{{ route('join.form') }}'"
                            class="p-2 text-[#8B7355] hover:bg-[#F2E2C0] rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                                </path>
                            </svg>
                        </button>
                        <div class="relative">
                            <div
                                class="w-16 h-16 rounded-xl overflow-hidden bg-gradient-to-br from-[#D4B896] via-[#C9A876] to-[#B8956A] flex-shrink-0 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border-2 border-white">
                                <img src="/storage/events/images/logo.png" alt="Logo" class="w-full h-full object-cover"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div
                                    class="w-full h-full bg-gradient-to-br from-[#C9A876] to-[#B8956A] items-center justify-center hidden">
                                    <svg class="w-8 h-8 text-white drop-shadow-sm" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                    </svg>
                                </div>
                            </div>
                            <div
                                class="absolute inset-0 w-16 h-16 rounded-xl bg-gradient-to-br from-[#B8956A] to-[#A0845C] -z-10 transform translate-x-1 translate-y-1 opacity-30">
                            </div>
                        </div>
                        <div class="cursor-pointer hover:bg-[#F2E2C0] rounded-lg px-2 py-1 transition-colors"
                            onclick="window.location.href='{{ route('event.description', $event->id) }}'">
                            <h1 class="font-semibold text-[#8B7355] text-sm md:text-base">{{ $event->title }}</h1>
                            <p class="text-xs text-[#A0845C] font-medium">Aqilla & Rusydan</p>
                            <p class="text-xs text-[#B8956A] hidden md:block">
                                {{ $event->event_date->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</p>
                        </div>
                        <button id="videoCallBtn"
                            class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors ml-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div id="realtimeStatus"
                            class="hidden items-center space-x-2 px-3 py-1 rounded-full text-xs font-medium">
                            <div class="w-2 h-2 rounded-full"></div>
                            <span></span>
                        </div>
                        {{-- WIB CLOCK REMOVED --}}
                        <button id="menuBtn" class="p-2 text-[#8B7355] hover:bg-[#F2E2C0] rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div id="messagesContainer" class="flex-1 overflow-y-auto p-4 space-y-4 relative">
                <div class="relative z-10">
                    @foreach ($messages as $message)
                        @php
                            $isMyMessage = $currentParticipant && $message->participant_id == $currentParticipant->id;
                            // PERBAIKAN: Pastikan timezone WIB untuk display
                            $messageTime = $message->created_at->setTimezone('Asia/Jakarta');
                        @endphp
                        <div class="flex {{ $isMyMessage ? 'justify-end' : 'justify-start' }} message-item mb-4"
                            data-message-id="{{ $message->id }}">
                            @if (!$isMyMessage)
                                <div
                                    class="w-8 h-8 bg-gradient-to-br from-[#C9A876] to-[#B8956A] rounded-full flex items-center justify-center flex-shrink-0 mr-3 shadow-sm">
                                    <span
                                        class="text-white font-medium text-xs">{{ substr($message->sender_name ?? ($message->participant?->name ?? 'U'), 0, 1) }}</span>
                                </div>
                            @endif
                            <div
                                class="flex flex-col {{ $isMyMessage ? 'items-end' : 'items-start' }} max-w-xs md:max-w-md">
                                <div
                                    class="flex items-center space-x-2 mb-1 {{ $isMyMessage ? 'flex-row-reverse space-x-reverse' : '' }}">
                                    <span
                                        class="font-medium text-[#8B7355] text-sm">{{ $message->sender_name ?? ($message->participant?->name ?? 'Unknown') }}</span>
                                    <span class="text-xs text-[#A0845C]">{{ $messageTime->format('H:i') }} WIB</span>
                                </div>
                                <div
                                    class="rounded-2xl shadow-sm border max-w-full break-words {{ $isMyMessage
                                        ? 'bg-green-500 text-white border-green-400 rounded-br-md'
                                        : 'bg-white text-gray-800 border-gray-200 rounded-bl-md' }}">
                                    @if ($message->isImageAttachment())
                                        <div
                                            class="rounded-t-2xl overflow-hidden {{ $isMyMessage ? 'rounded-tr-2xl' : 'rounded-tl-2xl' }}">
                                            <img src="{{ $message->getImageUrl() }}" alt="Shared Image"
                                                class="w-full max-w-xs h-auto cursor-pointer hover:opacity-90 transition-opacity"
                                                onclick="openImageModal('{{ $message->getImageUrl() }}', '{{ $message->sender_name }}')">
                                        </div>
                                    @endif
                                    @if ($message->isLocationAttachment())
                                        @php $locationData = $message->getLocationData(); @endphp
                                        <div
                                            class="rounded-t-2xl overflow-hidden {{ $isMyMessage ? 'rounded-tr-2xl' : 'rounded-tl-2xl' }}">
                                            <div class="bg-white p-3 border-b border-gray-100 location-bubble">
                                                <div class="flex items-center space-x-3 mb-3">
                                                    <div
                                                        class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                                                        <svg class="w-5 h-5 text-white" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div class="flex-1">
                                                        <p class="font-semibold text-gray-800 text-sm">
                                                            {{ $locationData['name'] ?? 'Shared Location' }}</p>
                                                        <p class="text-gray-600 text-xs">📍
                                                            {{ isset($locationData['is_wedding_venue']) && $locationData['is_wedding_venue'] ? 'Wedding Venue Location' : 'Shared Location' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="rounded-lg overflow-hidden shadow-sm border border-gray-200 mb-3">
                                                    @if (isset($locationData['is_wedding_venue']) && $locationData['is_wedding_venue'])
                                                        <iframe
                                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.192079040854!2d106.92321707503716!3d-6.201992893774889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698cd0b04c8f2b%3A0x673c6a4d7d3c5f4!2sMasjid%20Jami%20Al-Utsmani!5e0!3m2!1sen!2sid!4v1753913917430!5m2!1sen!2sid"
                                                            width="100%" height="200" style="border:0;"
                                                            allowfullscreen="" loading="lazy"
                                                            referrerpolicy="no-referrer-when-downgrade"
                                                            class="w-full location-map-iframe">
                                                        </iframe>
                                                    @else
                                                        <iframe
                                                            src="https://maps.google.com/maps?q={{ $locationData['lat'] ?? -6.2088 }},{{ $locationData['lng'] ?? 106.8456 }}&z=15&output=embed"
                                                            width="100%" height="200" style="border:0;"
                                                            allowfullscreen="" loading="lazy"
                                                            referrerpolicy="no-referrer-when-downgrade"
                                                            class="w-full location-map-iframe">
                                                        </iframe>
                                                    @endif
                                                </div>
                                                <div class="bg-gray-50 rounded-lg p-3 mb-3">
                                                    <div class="flex items-center justify-between">
                                                        <div class="flex-1">
                                                            @if (isset($locationData['is_wedding_venue']) && $locationData['is_wedding_venue'])
                                                                <p class="text-sm font-medium text-gray-800">Masjid Jami
                                                                    Al-Utsmani</p>
                                                                <p class="text-xs text-gray-600">Jatinegara, Cakung,
                                                                    Jakarta Timur</p>
                                                            @else
                                                                <p class="text-sm font-medium text-gray-800">
                                                                    {{ $locationData['name'] ?? 'Current Location' }}</p>
                                                                <p class="text-xs text-gray-600">Shared current location
                                                                </p>
                                                            @endif
                                                            @if (isset($locationData['lat']) && isset($locationData['lng']))
                                                                <p class="text-xs text-gray-500 mt-1">
                                                                    {{ $locationData['lat'] }}, {{ $locationData['lng'] }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                        <div class="text-right">
                                                            <span
                                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ isset($locationData['is_wedding_venue']) && $locationData['is_wedding_venue'] ? 'bg-pink-100 text-pink-800' : 'bg-green-100 text-green-800' }}">
                                                                📍
                                                                {{ isset($locationData['is_wedding_venue']) && $locationData['is_wedding_venue'] ? 'Wedding Venue' : 'Live Location' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="space-y-2">
                                                    @if (isset($locationData['is_wedding_venue']) && $locationData['is_wedding_venue'])
                                                        <button
                                                            onclick="window.open('https://www.google.com/maps/dir/?api=1&destination=-6.2019928,106.925792', '_blank')"
                                                            class="w-full px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm font-medium transition-all duration-300 flex items-center justify-center space-x-2 shadow-sm hover:shadow-md transform hover:scale-[1.01]">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                                </path>
                                                            </svg>
                                                            <span>Open in Maps</span>
                                                        </button>
                                                    @else
                                                        <button
                                                            onclick="window.open('https://maps.google.com/maps?q={{ $locationData['lat'] ?? -6.2088 }},{{ $locationData['lng'] ?? 106.8456 }}', '_blank')"
                                                            class="w-full px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm font-medium transition-all duration-300 flex items-center justify-center space-x-2 shadow-sm hover:shadow-md transform hover:scale-[1.01]">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                                </path>
                                                            </svg>
                                                            <span>Open in Maps</span>
                                                        </button>
                                                    @endif
                                                    <button
                                                        onclick="shareLocation('{{ $locationData['name'] ?? 'Shared Location' }}', '{{ $locationData['lat'] ?? '' }}', '{{ $locationData['lng'] ?? '' }}')"
                                                        class="w-full px-3 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg text-sm font-medium transition-all duration-300 flex items-center justify-center space-x-2 shadow-sm hover:shadow-md transform hover:scale-[1.01]">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z">
                                                            </path>
                                                        </svg>
                                                        <span>Share Location</span>
                                                    </button>
                                                    <button
                                                        onclick="getDirections('{{ $locationData['lat'] ?? -6.2019928 }}', '{{ $locationData['lng'] ?? 106.925792 }}')"
                                                        class="w-full px-3 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg text-sm font-medium transition-all duration-300 flex items-center justify-center space-x-2 shadow-sm hover:shadow-md transform hover:scale-[1.01]">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m0 0L9 7">
                                                            </path>
                                                        </svg>
                                                        <span>Directions</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($message->message)
                                        <div class="p-3 {{ $message->hasAttachment() ? 'pt-2' : '' }}">
                                            <p class="text-sm leading-relaxed">{{ $message->message }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if ($isMyMessage)
                                <div
                                    class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center flex-shrink-0 ml-3 shadow-sm">
                                    <span
                                        class="text-white font-medium text-xs">{{ substr($message->sender_name ?? ($message->participant?->name ?? 'U'), 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="relative p-4">
                <div class="absolute inset-0">
                    <img src="/storage/events/images/walpaper.jpeg" alt="Input Background"
                        class="w-full h-full object-cover opacity-30"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <div class="hidden w-full h-full bg-gradient-to-t from-[#F8EAD0] to-[#F5E6C8] opacity-80"></div>
                </div>
                <form id="messageForm" class="relative z-10" enctype="multipart/form-data">
                    @csrf
                    <div id="attachmentPreview"
                        class="hidden mb-3 p-3 bg-white/80 backdrop-blur-sm rounded-lg border border-[#E8D5B7]">
                        <div id="imagePreview" class="hidden">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-[#8B7355]">Image to send:</span>
                                <button type="button" id="removeImage" class="text-red-500 hover:text-red-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <img id="imagePreviewImg" class="max-w-32 h-auto rounded-lg border" alt="Preview">
                        </div>
                        <div id="locationPreview" class="hidden">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-[#8B7355]">Location ready to send:</span>
                                <button type="button" id="removeLocation" class="text-red-500 hover:text-red-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p id="locationName" class="text-sm font-medium text-[#8B7355]"></p>
                                    <p id="locationCoords" class="text-xs text-[#A0845C]"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-3 relative">
                        <div class="flex space-x-1">
                            <button type="button" id="imageBtn"
                                class="p-2 text-[#8B7355] hover:bg-[#F2E2C0]/50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </button>
                            <button type="button" id="locationBtn"
                                class="p-2 text-[#8B7355] hover:bg-[#F2E2C0]/50 rounded-lg transition-colors"
                                title="Share location">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="w-24 md:w-32 relative">
                            <input type="text" id="nameInput" name="name"
                                class="w-full px-3 py-2 border-0 rounded-2xl focus:ring-2 focus:ring-[#C9A876] text-sm bg-transparent placeholder-[#A0845C] text-[#8B7355] font-medium"
                                placeholder="Name" required>
                        </div>
                        <div class="flex-1 relative">
                            <input type="text" id="messageInput" name="message"
                                class="w-full px-3 py-2 border-0 rounded-2xl focus:ring-2 focus:ring-[#C9A876] text-sm bg-transparent placeholder-[#A0845C] text-[#8B7355] font-medium"
                                placeholder="Type a message...">
                        </div>
                        <button type="submit"
                            class="px-4 py-2 bg-gradient-to-r from-[#C9A876] to-[#B8956A] hover:from-[#B8956A] hover:to-[#A0845C] text-white rounded-2xl transition-all duration-300 flex items-center space-x-1 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            <span class="hidden md:inline text-sm font-medium">Send</span>
                        </button>
                    </div>
                    <input type="file" id="imageInput" name="image" accept="image/*" class="hidden">
                    <input type="hidden" id="locationLat" name="location_lat">
                    <input type="hidden" id="locationLng" name="location_lng">
                    <input type="hidden" id="locationNameInput" name="location_name">
                    <input type="hidden" id="locationUrlInput" name="location_url">
                    <input type="hidden" id="isWeddingVenueInput" name="is_wedding_venue" value="false">
                </form>
            </div>
        </div>
    </div>

    {{-- All modals remain the same --}}
    <div id="notificationContainer" class="fixed top-4 right-4 z-50 space-y-2"></div>

    <div id="locationChoiceModal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-sm w-full mx-4 overflow-hidden">
            <div class="bg-gradient-to-r from-[#C9A876] to-[#B8956A] text-white p-4 text-center">
                <h3 class="text-lg font-semibold">Share Location</h3>
                <p class="text-[#F8EAD0] text-sm">Choose location to share</p>
            </div>
            <div class="p-4 space-y-3">
                <button id="shareCurrentLocation"
                    class="w-full flex items-center space-x-3 p-4 hover:bg-[#F8EAD0] rounded-lg transition-colors text-left border border-gray-200">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-[#8B7355]">📍 Current Location</h4>
                        <p class="text-sm text-[#A0845C]">Share your current location</p>
                    </div>
                </button>
                <button id="shareWeddingVenue"
                    class="w-full flex items-center space-x-3 p-4 hover:bg-[#F8EAD0] rounded-lg transition-colors text-left border border-gray-200">
                    <div class="w-12 h-12 bg-pink-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-[#8B7355]">💒 Wedding Venue</h4>
                        <p class="text-sm text-[#A0845C]">Masjid Jami Al-Utsmani</p>
                    </div>
                </button>
            </div>
            <div class="p-4 bg-[#F8EAD0] flex justify-center">
                <button id="closeLocationChoice"
                    class="px-6 py-2 bg-[#C9A876] hover:bg-[#B8956A] text-white rounded-lg transition-colors">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 hidden z-50 flex items-center justify-center p-4">
        <div class="relative w-full h-full flex items-center justify-center">
            <button id="closeImageModal"
                class="absolute top-4 right-4 z-10 w-10 h-10 bg-black bg-opacity-50 hover:bg-black hover:bg-opacity-70 text-white rounded-full flex items-center justify-center transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
            <div class="w-full h-full flex items-center justify-center p-8">
                <img id="modalImage" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl"
                    alt="Full Size Image">
            </div>
            <div
                class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-50 text-white px-4 py-2 rounded-full">
                <p id="modalImageSender" class="text-sm font-medium"></p>
            </div>
        </div>
    </div>

    {{-- ENHANCED Video Call Modal with Draggable User Camera --}}
    <div id="videoCallModal"
        class="fixed inset-0 bg-black bg-opacity-90 hidden z-50 flex items-center justify-center p-4">
        <div class="relative w-full video-call-modal-container flex flex-col bg-[#202c33] rounded-xl shadow-2xl">
            <button id="closeVideoModal"
                class="absolute top-4 right-4 z-30 w-10 h-10 bg-black/50 hover:bg-black/70 text-white rounded-full flex items-center justify-center transition-colors"
                title="Close">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
            <div class="flex-1 w-full relative">
                <div id="mainVideoContainer" class="absolute inset-0">
                    <video id="weddingVideoMain" class="w-full h-full object-cover"
                        src="{{ asset('storage/events/videos/Pre-Wedding.mp4') }}" playsinline loop>
                        Your browser does not support the video tag.
                    </video>
                </div>
                <button id="toggleMainVideoAudio"
                    class="absolute top-4 left-4 z-30 w-10 h-10 bg-black/50 hover:bg-black/70 text-white rounded-full flex items-center justify-center transition-colors"
                    title="Toggle video audio">
                    <svg id="mainAudioOnIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 14.142M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z">
                        </path>
                    </svg>
                    <svg id="mainAudioOffIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"></path>
                    </svg>
                </button>

                <div id="myCameraContainer"
                    class="draggable-camera z-10 w-24 h-32 md:w-28 md:h-36 rounded-lg overflow-hidden shadow-xl border-2 border-white/40">
                    <video id="myVideoFeed" class="w-full h-full object-cover hidden" autoplay playsinline muted></video>
                    <div id="myVideoPlaceholder"
                        class="w-full h-full flex items-center justify-center bg-[#3a454d] text-white/50">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </div>
                </div>

                <div class="absolute top-0 left-0 right-0 z-20 p-4 text-center pointer-events-none">
                    <div class="w-20 h-20 mx-auto mb-2 bg-gray-600 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white/90">Aqilla & Rusydan</h3>
                    <p id="callStatus" class="text-white/60">Live broadcast...</p>
                    <p id="videoCallDuration" class="mt-2 text-white/80 hidden">00:00</p>
                </div>
            </div>

            {{-- FIXED: Control buttons positioned to be always visible --}}
            <div
                class="absolute bottom-0 left-0 right-0 z-30 p-4 flex justify-center space-x-6 bg-gradient-to-t from-black/50 to-transparent">
                <button id="muteVideoBtn" class="video-control-btn text-white bg-white/20 hover:bg-white/30"
                    title="Mute Mic">
                    <svg id="micOnIcon" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 15c1.66 0 3-1.34 3-3V6c0-1.66-1.34-3-3-3S9 4.34 9 6v6c0 1.66 1.34 3 3 3zm5.49-3.41c.23-.42.06-.95-.36-1.18a.75.75 0 00-1.18.36C15.53 11.45 15 12 15 12V6c0-1.66-1.34-3-3-3S9 4.34 9 6v6c0 1.66 1.34 3 3 3a3 3 0 003-3v-3.59a.75.75 0 00-1.5 0v3.59c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5V6c0-.83-.67-1.5-1.5-1.5S7.5 5.17 7.5 6v6c0 1.66 1.34 3 3 3a3 3 0 003-3v-3.59c.23-.42.06-.95-.36-1.18a.75.75 0 00-1.18.36z">
                        </path>
                        <path
                            d="M12 19c-2.76 0-5-2.24-5-5h-1c0 3.04 2.4 5.57 5.5 5.96V21h1v-2.04c3.1-.39 5.5-2.92 5.5-5.96h-1c0 2.76-2.24 5-5 5z">
                        </path>
                    </svg>
                    <svg id="micOffIcon" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 15c1.66 0 3-1.34 3-3V6c0-1.66-1.34-3-3-3S9 4.34 9 6v6c0 1.66 1.34 3 3 3zm5.49-3.41c.23-.42.06-.95-.36-1.18a.75.75 0 00-1.18.36C15.53 11.45 15 12 15 12V6c0-1.66-1.34-3-3-3S9 4.34 9 6v6c0 1.66 1.34 3 3 3a3 3 0 003-3v-3.59a.75.75 0 00-1.5 0v3.59c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5V6c0-.83-.67-1.5-1.5-1.5S7.5 5.17 7.5 6v6c0 1.66 1.34 3 3 3a3 3 0 003-3v-3.59c.23-.42.06-.95-.36-1.18a.75.75 0 00-1.18.36z">
                        </path>
                        <path
                            d="M12 19c-2.76 0-5-2.24-5-5h-1c0 3.04 2.4 5.57 5.5 5.96V21h1v-2.04c3.1-.39 5.5-2.92 5.5-5.96h-1c0 2.76-2.24 5-5 5z">
                        </path>
                        <path d="M1.396 1.396L21 21" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                    </svg>
                </button>
                <button id="endVideoCall" class="video-control-btn bg-red-500 hover:bg-red-600 text-white"
                    title="End Call">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 9c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z">
                        </path>
                        <path d="M19 13h-2v2h2v-2zm0-4h-2v2h2V9z"></path>
                    </svg>
                </button>
                <button id="cameraToggleBtn" class="video-control-btn text-white bg-white/20 hover:bg-white/30"
                    title="Toggle Camera">
                    <svg id="cameraOnIcon" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z">
                        </path>
                    </svg>
                    <svg id="cameraOffIcon" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z">
                        </path>
                        <path d="M1.396 1.396L21 21" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="menuModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-sm w-full mx-4 overflow-hidden" id="menuModalContent">
            <div class="bg-gradient-to-r from-[#C9A876] to-[#B8956A] text-white p-4 text-center">
                <h3 class="text-lg font-semibold">Menu</h3>
                <p class="text-[#F8EAD0] text-sm">Chat Options</p>
            </div>
            <div class="p-4 space-y-2">
                <button id="viewEventBtn"
                    class="w-full flex items-center space-x-3 p-3 hover:bg-[#F8EAD0] rounded-lg transition-colors text-left">
                    <svg class="w-5 h-5 text-[#8B7355]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-[#8B7355] font-medium">View Event Details</span>
                </button>
                <button id="shareEventBtn"
                    class="w-full flex items-center space-x-3 p-3 hover:bg-[#F8EAD0] rounded-lg transition-colors text-left">
                    <svg class="w-5 h-5 text-[#8B7355]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z">
                        </path>
                    </svg>
                    <span class="text-[#8B7355] font-medium">Share Event</span>
                </button>
                <button id="settingsBtn"
                    class="w-full flex items-center space-x-3 p-3 hover:bg-[#F8EAD0] rounded-lg transition-colors text-left">
                    <svg class="w-5 h-5 text-[#8B7355]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-[#8B7355] font-medium">Settings</span>
                </button>
                <button id="helpBtn"
                    class="w-full flex items-center space-x-3 p-3 hover:bg-[#F8EAD0] rounded-lg transition-colors text-left">
                    <svg class="w-5 h-5 text-[#8B7355]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    <span class="text-[#8B7355] font-medium">Help & Support</span>
                </button>
            </div>
            <div class="p-4 bg-[#F8EAD0] flex justify-center">
                <button id="closeMenu"
                    class="px-6 py-2 bg-[#C9A876] hover:bg-[#B8956A] text-white rounded-lg transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>

    {{-- Include Reverb JavaScript --}}
    @vite(['resources/js/app.js'])

    <script>
        // Global variables
        let backgroundMusic;
        let isMusicMuted = false;
        let isMusicReady = false;
        let realtimeConnection = null;
        let isRealtimeConnected = false;
        let receivedMessageIds = new Set();
        let isVideoCallActive = false;
        let musicWasPlayingBeforeCall = false;
        let autoPlayAttempted = false;

        // Current participant info from server
        const currentParticipant = @json($currentParticipant);
        const eventId = {{ $event->id }};

        // Initialize Realtime Connection with Reverb
        function initializeRealtime() {
            console.log('🔄 Initializing Reverb realtime connection...');
            try {
                window.Echo.channel(`chat.${eventId}`)
                    .listen('.message.sent', (data) => {
                        console.log('📨 Received realtime message:', data);
                        if (receivedMessageIds.has(data.id)) {
                            console.log('⚠️ Duplicate message ignored:', data.id);
                            return;
                        }
                        receivedMessageIds.add(data.id);
                        if (currentParticipant && data.participant.id === currentParticipant.id) {
                            console.log('⚠️ Own message ignored');
                            return;
                        }
                        addRealtimeMessageToChat(data);
                        showNotification(`💬 ${data.participant.name}: ${data.message || 'Sent an attachment'}`, 'info',
                            3000);
                    });

                window.Echo.connector.pusher.connection.bind('connected', () => {
                    console.log('✅ Reverb connected');
                    isRealtimeConnected = true;
                    updateRealtimeStatus('connected');
                    showNotification('🔗 Realtime chat connected!', 'success', 2000);
                });

                window.Echo.connector.pusher.connection.bind('disconnected', () => {
                    console.log('❌ Reverb disconnected');
                    isRealtimeConnected = false;
                    updateRealtimeStatus('disconnected');
                    showNotification('⚠️ Realtime chat disconnected', 'warning', 3000);
                });

                window.Echo.connector.pusher.connection.bind('error', (error) => {
                    console.error('❌ Reverb connection error:', error);
                    isRealtimeConnected = false;
                    updateRealtimeStatus('error');
                    showNotification('❌ Realtime connection error', 'error', 4000);
                });

            } catch (error) {
                console.error('❌ Failed to initialize Reverb:', error);
                showNotification('❌ Failed to connect to realtime chat', 'error', 4000);
            }
        }

        function updateRealtimeStatus(status) {
            const statusElement = document.getElementById('realtimeStatus');
            const dot = statusElement.querySelector('.w-2');
            const text = statusElement.querySelector('span');
            statusElement.classList.remove('hidden');
            statusElement.classList.add('flex');
            switch (status) {
                case 'connected':
                    statusElement.className =
                        'flex items-center space-x-2 px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800';
                    dot.className = 'w-2 h-2 rounded-full bg-green-500 animate-pulse';
                    text.textContent = 'Live';
                    break;
                case 'disconnected':
                    statusElement.className =
                        'flex items-center space-x-2 px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800';
                    dot.className = 'w-2 h-2 rounded-full bg-yellow-500';
                    text.textContent = 'Reconnecting...';
                    break;
                case 'error':
                    statusElement.className =
                        'flex items-center space-x-2 px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800';
                    dot.className = 'w-2 h-2 rounded-full bg-red-500';
                    text.textContent = 'Offline';
                    break;
            }
        }

        function addRealtimeMessageToChat(messageData) {
            const existingMessage = document.querySelector(`[data-message-id="${messageData.id}"]`);
            if (existingMessage) {
                console.log('⚠️ Message already exists in DOM:', messageData.id);
                return;
            }
            const messageDiv = document.createElement('div');
            messageDiv.className = 'flex justify-start message-item mb-4';
            messageDiv.setAttribute('data-message-id', messageData.id);
            let attachmentHtml = '';
            if (messageData.attachment_type === 'image') {
                attachmentHtml = `
                    <div class="rounded-t-2xl overflow-hidden rounded-tl-2xl">
                        <img src="${messageData.attachment_url}" alt="Shared Image"
                             class="w-full max-w-xs h-auto cursor-pointer hover:opacity-90 transition-opacity"
                             onclick="openImageModal('${messageData.attachment_url}', '${messageData.sender_name}')">
                    </div>
                `;
            }
            if (messageData.attachment_type === 'location' && messageData.location_data) {
                const locationData = messageData.location_data;
                const isWeddingVenue = locationData.is_wedding_venue || false;
                const locationName = locationData.name || 'Shared Location';
                const locationLatVal = locationData.lat || '';
                const locationLngVal = locationData.lng || '';
                const mapUrl = isWeddingVenue ?
                    'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.192079040854!2d106.92321707503716!3d-6.201992893774889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698cd0b04c8f2b%3A0x673c6a4d7d3c5f4!2sMasjid%20Jami%20Al-Utsmani!5e0!3m2!1sen!2sid!4v1753913917430!5m2!1sen!2sid' :
                    `https://maps.google.com/maps?q=${locationLatVal},${locationLngVal}&z=15&output=embed`;
                attachmentHtml = `
                    <div class="rounded-t-2xl overflow-hidden rounded-tl-2xl">
                        <div class="bg-white p-3 border-b border-gray-100 location-bubble">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-800 text-sm">${locationName}</p>
                                    <p class="text-gray-600 text-xs">📍 ${isWeddingVenue ? 'Wedding Venue Location' : 'Shared Location'}</p>
                                </div>
                            </div>
                            <div class="rounded-lg overflow-hidden shadow-sm border border-gray-200 mb-3">
                                <iframe src="${mapUrl}" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="w-full location-map-iframe"></iframe>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3 mb-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        ${isWeddingVenue ? `
                                                    <p class="text-sm font-medium text-gray-800">Masjid Jami Al-Utsmani</p>
                                                    <p class="text-xs text-gray-600">Jatinegara, Cakung, Jakarta Timur</p>
                                                ` : `
                                                    <p class="text-sm font-medium text-gray-800">${locationName}</p>
                                                    <p class="text-xs text-gray-600">Shared current location</p>
                                                `}
                                        <p class="text-xs text-gray-500 mt-1">${locationLatVal}, ${locationLngVal}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${isWeddingVenue ? 'bg-pink-100 text-pink-800' : 'bg-green-100 text-green-800'}">
                                            📍 ${isWeddingVenue ? 'Wedding Venue' : 'Live Location'}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <button onclick="window.open('${isWeddingVenue ? 'https://www.google.com/maps/dir/?api=1&destination=-6.2019928,106.925792' : `https://maps.google.com/maps?q=${locationLatVal},${locationLngVal}`}', '_blank')" class="w-full px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm font-medium transition-all duration-300 flex items-center justify-center space-x-2 shadow-sm hover:shadow-md transform hover:scale-[1.01]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    <span>Open in Maps</span>
                                </button>
                                <button onclick="shareLocation('${locationName}', '${locationLatVal}', '${locationLngVal}')" class="w-full px-3 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg text-sm font-medium transition-all duration-300 flex items-center justify-center space-x-2 shadow-sm hover:shadow-md transform hover:scale-[1.01]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                    </svg>
                                    <span>Share Location</span>
                                </button>
                                <button onclick="getDirections('${isWeddingVenue ? -6.2019928 : locationLatVal}', '${isWeddingVenue ? 106.925792 : locationLngVal}')" class="w-full px-3 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg text-sm font-medium transition-all duration-300 flex items-center justify-center space-x-2 shadow-sm hover:shadow-md transform hover:scale-[1.01]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m0 0L9 7"></path>
                                    </svg>
                                    <span>Directions</span>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }
            messageDiv.innerHTML = `
                ${!isMyMessage ? `
                            <div class="w-8 h-8 bg-gradient-to-br from-[#C9A876] to-[#B8956A] rounded-full flex items-center justify-center flex-shrink-0 mr-3 shadow-sm">
                                <span class="text-white font-medium text-xs">${message.sender_name.charAt(0)}</span>
                            </div>
                            ` : ''}
                                <div class="flex flex-col ${isMyMessage ? 'items-end' : 'items-start'} max-w-xs md:max-w-md">
                    <div class="flex items-center space-x-2 mb-1 ${isMyMessage ? 'flex-row-reverse space-x-reverse' : ''}">
                        <span class="font-medium text-[#8B7355] text-sm">${message.sender_name}</span>
                        <span class="text-xs text-[#A0845C]">${message.created_at} WIB</span>
                    </div>
                    <div class="rounded-2xl shadow-sm border max-w-full break-words ${isMyMessage
                        ? 'bg-green-500 text-white border-green-400 rounded-br-md'
                        : 'bg-white text-gray-800 border-gray-200 rounded-bl-md'}">
                        ${attachmentHtml}
                        ${message.message ? `<div class="p-3 ${attachmentHtml ? 'pt-2' : ''}"><p class="text-sm leading-relaxed">${message.message}</p></div>` : ''}
                    </div>
                </div>
                ${isMyMessage ? `
                            <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center flex-shrink-0 ml-3 shadow-sm">
                                <span class="text-white font-medium text-xs">${message.sender_name.charAt(0)}</span>
                            </div>
                            ` : ''}
            `;
            const messagesDiv = document.querySelector('#messagesContainer .relative.z-10');
            messagesDiv.appendChild(messageDiv);
            scrollToBottom();
            messageDiv.style.opacity = '0';
            messageDiv.style.transform = 'translateY(20px)';
            setTimeout(() => {
                messageDiv.style.transition = 'all 0.3s ease-out';
                messageDiv.style.opacity = '1';
                messageDiv.style.transform = 'translateY(0)';
            }, 100);
        }

        // --- ENHANCED AUDIO PLAYER FUNCTIONS ---
        function initAudioPlayer() {
            console.log('🎵 Initializing audio player with aggressive auto-play...');
            backgroundMusic = document.getElementById('backgroundMusic');
            if (!backgroundMusic) {
                console.error('Background music element not found');
                return;
            }
            backgroundMusic.volume = 0.25;
            backgroundMusic.addEventListener('canplaythrough', function() {
                isMusicReady = true;
                if (!autoPlayAttempted) {
                    attemptAutoPlay();
                }
            });
            backgroundMusic.addEventListener('loadeddata', function() {
                isMusicReady = true;
                if (!autoPlayAttempted) {
                    attemptAutoPlay();
                }
            });
            backgroundMusic.addEventListener('play', function() {
                updateSpeakerIcon(false);
                updateMusicIndicator(true);
                isMusicMuted = false;
                showNotification('🎵 "Bergema Sampai Selamanya" is now playing softly in the background', 'success',
                    4000);
            });
            backgroundMusic.addEventListener('pause', function() {
                updateSpeakerIcon(true);
                updateMusicIndicator(false);
                isMusicMuted = true;
            });
            backgroundMusic.addEventListener('error', function(e) {
                console.error('🎵 Audio error:', e);
                showNotification('Background music failed to load', 'warning', 3000);
                updateMusicIndicator(false);
            });
            backgroundMusic.load();
            setTimeout(() => {
                if (!autoPlayAttempted) {
                    attemptAutoPlay();
                }
            }, 500);
            setTimeout(() => {
                if (!autoPlayAttempted && backgroundMusic.paused) {
                    attemptAutoPlay();
                }
            }, 1000);
            setTimeout(() => {
                if (!autoPlayAttempted && backgroundMusic.paused) {
                    attemptAutoPlay();
                }
            }, 2000);
            console.log('🎵 Audio player initialized with multiple auto-play attempts...');
        }

        function attemptAutoPlay() {
            if (!backgroundMusic || !isMusicReady || autoPlayAttempted) {
                return;
            }
            autoPlayAttempted = true;
            console.log('🎵 Attempting aggressive auto-play...');
            const playPromise = backgroundMusic.play();
            if (playPromise !== undefined) {
                playPromise.then(() => {
                    isMusicMuted = false;
                }).catch(error => {
                    setTimeout(() => {
                        tryUserInteractionPlay();
                    }, 100);
                });
            }
        }

        function tryUserInteractionPlay() {
            const playButton = document.createElement('button');
            playButton.style.position = 'fixed';
            playButton.style.top = '-1000px';
            playButton.style.left = '-1000px';
            playButton.style.opacity = '0';
            playButton.style.pointerEvents = 'none';
            playButton.addEventListener('click', function() {
                const playPromise = backgroundMusic.play();
                if (playPromise !== undefined) {
                    playPromise.then(() => {
                        isMusicMuted = false;
                        document.body.removeChild(playButton);
                    }).catch(error => {
                        showNotification('🎵 Click the speaker button to enable background music', 'info',
                            5000);
                        updateSpeakerIcon(true);
                        updateMusicIndicator(false);
                        isMusicMuted = true;
                        document.body.removeChild(playButton);
                    });
                }
            });
            document.body.appendChild(playButton);
            playButton.click();
        }

        function updateSpeakerIcon(muted) {
            const speakerIcon = document.getElementById('speakerIcon');
            const speakerBtn = document.getElementById('speakerBtn');
            if (!speakerIcon || !speakerBtn) return;
            if (muted) {
                speakerIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"></path>
                `;
                speakerBtn.title = 'Enable Background Music';
                speakerBtn.classList.remove('text-[#8B7355]');
                speakerBtn.classList.add('text-red-500');
            } else {
                speakerIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 14.142M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path>
                `;
                speakerBtn.title = 'Disable Background Music';
                speakerBtn.classList.remove('text-red-500');
                speakerBtn.classList.add('text-[#8B7355]');
            }
        }

        function updateMusicIndicator(playing) {
            const indicator = document.getElementById('musicIndicator');
            if (!indicator) return;
            if (playing) {
                indicator.classList.remove('hidden');
            } else {
                indicator.classList.add('hidden');
            }
        }

        function toggleMusic() {
            if (!backgroundMusic) {
                showNotification('Music player not available', 'error');
                return;
            }
            try {
                if (backgroundMusic.paused) {
                    const playPromise = backgroundMusic.play();
                    if (playPromise !== undefined) {
                        playPromise.then(() => {
                            showNotification('🎵 Background music enabled', 'success', 2000);
                        }).catch(error => {
                            showNotification('Failed to play music', 'error');
                        });
                    }
                } else {
                    backgroundMusic.pause();
                    showNotification('🔇 Background music disabled', 'info', 2000);
                }
            } catch (error) {
                showNotification('Error controlling music', 'error');
            }
        }

        function pauseMusicForVideoCall() {
            if (!backgroundMusic) return;
            if (!backgroundMusic.paused) {
                musicWasPlayingBeforeCall = true;
                backgroundMusic.pause();
                showNotification('🔇 Background music paused for video call', 'info', 2000);
            } else {
                musicWasPlayingBeforeCall = false;
            }
        }

        function resumeMusicAfterVideoCall() {
            if (!backgroundMusic) return;
            if (musicWasPlayingBeforeCall && backgroundMusic.paused) {
                const playPromise = backgroundMusic.play();
                if (playPromise !== undefined) {
                    playPromise.then(() => {
                        showNotification('🎵 Background music resumed', 'success', 2000);
                    }).catch(error => {
                        console.error('Error resuming music:', error);
                    });
                }
            }
        }

        function showNotification(message, type = 'info', duration = 4000) {
            const container = document.getElementById('notificationContainer');
            if (!container) return;
            const notification = document.createElement('div');
            notification.className =
                `notification-item ${type === 'success' && message.includes('🎵') ? 'notification-music' : ''}`;
            const notificationId = 'notification-' + Date.now();
            notification.id = notificationId;
            notification.innerHTML = `
                <div class="notification-content">
                    <div class="notification-text">
                        <div class="notification-icon">
                            ${getNotificationIcon(type)}
                        </div>
                        <div class="notification-message">${message}</div>
                    </div>
                    <button class="notification-close" onclick="closeNotification('${notificationId}')" aria-label="Close notification">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>
            `;
            container.appendChild(notification);
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);
            if (duration > 0) {
                setTimeout(() => {
                    closeNotification(notificationId);
                }, duration);
            }
            const maxNotifications = window.innerWidth <= 768 ? 3 : 5;
            const notifications = container.querySelectorAll('.notification-item');
            if (notifications.length > maxNotifications) {
                closeNotification(notifications[0].id);
            }
        }

        function closeNotification(notificationId) {
            const notification = document.getElementById(notificationId);
            if (notification) {
                notification.classList.remove('show');
                notification.classList.add('hide');
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }
        }

        function getNotificationIcon(type) {
            const iconSize = window.innerWidth <= 480 ? '16' : '20';
            const icons = {
                success: `<svg width="${iconSize}" height="${iconSize}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke="#22c55e"/>
                </svg>`,
                error: `<svg width="${iconSize}" height="${iconSize}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                   <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="#ef4444"/>
                 </svg>`,
                warning: `<svg width="${iconSize}" height="${iconSize}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" stroke="#f59e0b"/>
                  </svg>`,
                info: `<svg width="${iconSize}" height="${iconSize}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="#3b82f6"/>           </svg>`
            };
            return icons[type] || icons.info;
        }

        function scrollToBottom() {
            const messagesContainer = document.getElementById('messagesContainer');
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        function addMessageToChat(message, isMyMessage = false) {
            receivedMessageIds.add(message.id);
            const messageDiv = document.createElement('div');
            messageDiv.className = `flex ${isMyMessage ? 'justify-end' : 'justify-start'} message-item mb-4`;
            messageDiv.setAttribute('data-message-id', message.id);
            const currentTime = message.created_at || new Date().toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            }) + ' WIB';
            let attachmentHtml = '';
            if (message.attachment_type === 'image') {
                attachmentHtml = `
                    <div class="rounded-t-2xl overflow-hidden ${isMyMessage ? 'rounded-tr-2xl' : 'rounded-tl-2xl'}">
                        <img src="${message.attachment_url}"
                             alt="Shared Image"
                             class="w-full max-w-xs h-auto cursor-pointer hover:opacity-90 transition-opacity"
                             onclick="openImageModal('${message.attachment_url}', '${message.sender_name}')">
                    </div>
                `;
            }
            if (message.attachment_type === 'location' && message.location_data) {
                const isWeddingVenue = message.location_data.is_wedding_venue || false;
                const locationName = message.location_data.name || 'Shared Location';
                const locationLatVal = message.location_data.lat || '';
                const locationLngVal = message.location_data.lng || '';
                const mapUrl = isWeddingVenue ?
                    'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.192079040854!2d106.92321707503716!3d-6.201992893774889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698cd0b04c8f2b%3A0x673c6a4d7d3c5f4!2sMasjid%20Jami%20Al-Utsmani!5e0!3m2!1sen!2sid!4v1753913917430!5m2!1sen!2sid' :
                    `https://maps.google.com/maps?q=${locationLatVal},${locationLngVal}&z=15&output=embed`;
                attachmentHtml = `
                    <div class="rounded-t-2xl overflow-hidden ${isMyMessage ? 'rounded-tr-2xl' : 'rounded-tl-2xl'}">
                        <div class="bg-white p-3 border-b border-gray-100 location-bubble">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-800 text-sm">${locationName}</p>
                                    <p class="text-gray-600 text-xs">📍 ${isWeddingVenue ? 'Wedding Venue Location' : 'Shared Location'}</p>
                                </div>
                            </div>
                            <div class="rounded-lg overflow-hidden shadow-sm border border-gray-200 mb-3">
                                <iframe
                                    src="${mapUrl}"
                                    width="100%"
                                    height="200"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    class="w-full location-map-iframe">
                                </iframe>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3 mb-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        ${isWeddingVenue ? `
                                                    <p class="text-sm font-medium text-gray-800">Masjid Jami Al-Utsmani</p>
                                                    <p class="text-xs text-gray-600">Jatinegara, Cakung, Jakarta Timur</p>
                                                    ` : `
                                                    <p class="text-sm font-medium text-gray-800">${locationName}</p>
                                                    <p class="text-xs text-gray-600">Shared current location</p>
                                                    `}
                                        <p class="text-xs text-gray-500 mt-1">${locationLatVal}, ${locationLngVal}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${isWeddingVenue ? 'bg-pink-100 text-pink-800' : 'bg-green-100 text-green-800'}">
                                            📍 ${isWeddingVenue ? 'Wedding Venue' : 'Live Location'}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <button onclick="window.open('${isWeddingVenue ? 'https://www.google.com/maps/dir/?api=1&destination=-6.2019928,106.925792' : `https://maps.google.com/maps?q=${locationLatVal},${locationLngVal}`}', '_blank')"
                                        class="w-full px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm font-medium transition-all duration-300 flex items-center justify-center space-x-2 shadow-sm hover:shadow-md transform hover:scale-[1.01]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    <span>Open in Maps</span>
                                </button>
                                <button onclick="shareLocation('${locationName}', '${locationLatVal}', '${locationLngVal}')"
                                        class="w-full px-3 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg text-sm font-medium transition-all duration-300 flex items-center justify-center space-x-2 shadow-sm hover:shadow-md transform hover:scale-[1.01]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                    </svg>
                                    <span>Share Location</span>
                                </button>
                                <button onclick="getDirections('${isWeddingVenue ? -6.2019928 : locationLatVal}', '${isWeddingVenue ? 106.925792 : locationLngVal}')"
                                        class="w-full px-3 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg text-sm font-medium transition-all duration-300 flex items-center justify-center space-x-2 shadow-sm hover:shadow-md transform hover:scale-[1.01]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m0 0L9 7"></path>
                                    </svg>
                                    <span>Directions</span>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }
            messageDiv.innerHTML = `
                ${!isMyMessage ? `
                            <div class="w-8 h-8 bg-gradient-to-br from-[#C9A876] to-[#B8956A] rounded-full flex items-center justify-center flex-shrink-0 mr-3 shadow-sm">
                                <span class="text-white font-medium text-xs">${message.sender_name.charAt(0)}</span>
                            </div>
                            ` : ''}
                                <div class="flex flex-col ${isMyMessage ? 'items-end' : 'items-start'} max-w-xs md:max-w-md">
                    <div class="flex items-center space-x-2 mb-1 ${isMyMessage ? 'flex-row-reverse space-x-reverse' : ''}">
                        <span class="font-medium text-[#8B7355] text-sm">${message.sender_name}</span>
                        <span class="text-xs text-[#A0845C]">${currentTime} WIB</span>
                    </div>
                    <div class="rounded-2xl shadow-sm border max-w-full break-words ${isMyMessage
                        ? 'bg-green-500 text-white border-green-400 rounded-br-md'
                        : 'bg-white text-gray-800 border-gray-200 rounded-bl-md'}">
                        ${attachmentHtml}
                        ${message.message ? `<div class="p-3 ${attachmentHtml ? 'pt-2' : ''}"><p class="text-sm leading-relaxed">${message.message}</p></div>` : ''}
                    </div>
                </div>
                ${isMyMessage ? `
                            <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center flex-shrink-0 ml-3 shadow-sm">
                                <span class="text-white font-medium text-xs">${message.sender_name.charAt(0)}</span>
                            </div>
                            ` : ''}
            `;
            const messagesDiv = document.querySelector('#messagesContainer .relative.z-10');
            messagesDiv.appendChild(messageDiv);
            scrollToBottom();
        }
        window.shareLocation = function(name, lat, lng) {
            const locationUrl = lat && lng ?
                `https://maps.google.com/maps?q=${lat},${lng}` :
                'https://www.google.com/maps/dir/?api=1&destination=-6.2019928,106.925792';
            if (navigator.share) {
                navigator.share({
                    title: `Location: ${name}`,
                    text: `Check out this location: ${name}`,
                    url: locationUrl
                }).catch(err => console.log('Error sharing:', err));
            } else {
                navigator.clipboard.writeText(`${name} - ${locationUrl}`).then(() => {
                    showNotification('📍 Location details copied to clipboard!', 'success');
                }).catch(() => {
                    showNotification('Unable to copy location details', 'error');
                });
            }
        };
        window.getDirections = function(lat, lng) {
            const directionsUrl =
                `https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15865.75037923707!2d106.925792!3d-6.2019928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698bb9d68516d3%3A0x867c293c6f932f91!2sMasjid%20Jami%20Al-Utsmani!5e0!3m2!1sen!2sid!4v1689658253106!5m2!1sen!2sid${lat},${lng}`;
            window.open(directionsUrl, '_blank');
            showNotification('🗺️ Opening directions...', 'info', 2000);
        };
        window.openImageModal = function(imageUrl, senderName) {
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('modalImageSender').textContent = `Shared by ${senderName}`;
            document.getElementById('imageModal').classList.remove('hidden');
        };

        // --- NEW DRAG AND DROP FUNCTIONALITY ---
        function makeDraggable(element) {
            let pos1 = 0,
                pos2 = 0,
                pos3 = 0,
                pos4 = 0;
            const container = document.getElementById('videoCallModal').querySelector('.video-call-modal-container');

            element.onmousedown = dragMouseDown;
            element.ontouchstart = dragTouchStart;

            function dragMouseDown(e) {
                e = e || window.event;
                e.preventDefault();
                pos3 = e.clientX;
                pos4 = e.clientY;
                document.onmouseup = closeDragElement;
                document.onmousemove = elementDrag;
            }

            function dragTouchStart(e) {
                e = e || window.event;
                e.preventDefault();
                const touch = e.touches[0];
                pos3 = touch.clientX;
                pos4 = touch.clientY;
                document.ontouchend = closeDragElement;
                document.ontouchmove = elementDrag;
            }

            function elementDrag(e) {
                e = e || window.event;
                const clientX = e.clientX || e.touches[0].clientX;
                const clientY = e.clientY || e.touches[0].clientY;

                pos1 = pos3 - clientX;
                pos2 = pos4 - clientY;
                pos3 = clientX;
                pos4 = clientY;

                let newTop = element.offsetTop - pos2;
                let newLeft = element.offsetLeft - pos1;

                // Boundary checks
                const containerRect = container.getBoundingClientRect();
                const elementRect = element.getBoundingClientRect();

                // Check top boundary (prevent dragging above the header)
                const headerHeight = document.querySelector('.video-call-modal-container .p-4.text-center').offsetHeight;
                if (newTop < headerHeight) {
                    newTop = headerHeight;
                }
                // Check bottom boundary (prevent dragging below the controls)
                const controlsHeight = document.querySelector('.video-call-modal-container .bottom-0').offsetHeight;
                if (newTop > (containerRect.height - elementRect.height - controlsHeight)) {
                    newTop = containerRect.height - elementRect.height - controlsHeight;
                }
                // Check left boundary
                if (newLeft < 0) {
                    newLeft = 0;
                }
                // Check right boundary
                if (newLeft > (containerRect.width - elementRect.width)) {
                    newLeft = containerRect.width - elementRect.width;
                }

                element.style.top = newTop + "px";
                element.style.left = newLeft + "px";
            }

            function closeDragElement() {
                document.onmouseup = null;
                document.onmousemove = null;
                document.ontouchend = null;
                document.ontouchmove = null;
            }
        }

        // DOM Content Loaded
        document.addEventListener('DOMContentLoaded', function() {
            const messageForm = document.getElementById('messageForm');
            const nameInput = document.getElementById('nameInput');
            const messageInput = document.getElementById('messageInput');
            const messagesContainer = document.getElementById('messagesContainer');
            const speakerBtn = document.getElementById('speakerBtn');
            const imageBtn = document.getElementById('imageBtn');
            const locationBtn = document.getElementById('locationBtn');
            const imageInput = document.getElementById('imageInput');
            const attachmentPreview = document.getElementById('attachmentPreview');
            const imagePreview = document.getElementById('imagePreview');
            const locationPreview = document.getElementById('locationPreview');
            const removeImage = document.getElementById('removeImage');
            const removeLocation = document.getElementById('removeLocation');
            const locationChoiceModal = document.getElementById('locationChoiceModal');
            const closeLocationChoice = document.getElementById('closeLocationChoice');
            const shareCurrentLocation = document.getElementById('shareCurrentLocation');
            const shareWeddingVenue = document.getElementById('shareWeddingVenue');
            const locationLat = document.getElementById('locationLat');
            const locationLng = document.getElementById('locationLng');
            const locationNameInput = document.getElementById('locationNameInput');
            const locationUrlInput = document.getElementById('locationUrlInput');
            const isWeddingVenueInput = document.getElementById('isWeddingVenueInput');
            if (currentParticipant && currentParticipant.name) {
                nameInput.value = currentParticipant.name;
            } else {
                const savedName = localStorage.getItem('chatName');
                if (savedName) {
                    nameInput.value = savedName;
                }
            }
            nameInput.addEventListener('input', function() {
                localStorage.setItem('chatName', this.value);
            });
            initAudioPlayer();
            setTimeout(() => {
                initializeRealtime();
            }, 1000);
            if (speakerBtn) {
                speakerBtn.addEventListener('click', toggleMusic);
            }
            scrollToBottom();
            imageBtn.addEventListener('click', function() {
                imageInput.click();
            });
            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imagePreviewImg').src = e.target.result;
                        showAttachmentPreview('image');
                    };
                    reader.readAsDataURL(file);
                }
            });
            removeImage.addEventListener('click', function() {
                imageInput.value = '';
                hideAttachmentPreview();
            });
            if (locationBtn) {
                locationBtn.addEventListener('click', function() {
                    locationChoiceModal.classList.remove('hidden');
                });
            }
            closeLocationChoice.addEventListener('click', function() {
                locationChoiceModal.classList.add('hidden');
            });
            shareCurrentLocation.addEventListener('click', function() {
                locationChoiceModal.classList.add('hidden');
                if (navigator.geolocation) {
                    shareCurrentLocation.disabled = true;
                    shareCurrentLocation.innerHTML = `
                        <div class="w-12 h-12 bg-gray-400 rounded-full flex items-center justify-center flex-shrink-0">
                            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-white"></div>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-[#8B7355]">⏳ Getting Location...</h4>
                            <p class="text-sm text-[#A0845C]">Please wait...</p>
                        </div>
                    `;
                    showNotification('📍 Getting your current location...', 'info', 3000);
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        locationLat.value = lat;
                        locationLng.value = lng;
                        locationNameInput.value = 'Current Location';
                        locationUrlInput.value =
                            `https://maps.google.com/maps?q=${lat},${lng}&z=15&output=embed`;
                        isWeddingVenueInput.value = 'false';
                        document.getElementById('locationName').textContent = 'Current Location';
                        document.getElementById('locationCoords').textContent =
                            `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                        showAttachmentPreview('location');
                        shareCurrentLocation.disabled = false;
                        shareCurrentLocation.innerHTML = `
                            <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-[#8B7355]">📍 Current Location</h4>
                                <p class="text-sm text-[#A0845C]">Share your current location</p>
                            </div>
                        `;
                    }, function(error) {
                        let errorMessage = 'Unable to get your location.';
                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                errorMessage =
                                    'Location access denied. Please enable location services.';
                                break;
                            case error.POSITION_UNAVAILABLE:
                                errorMessage = 'Location information unavailable.';
                                break;
                            case error.TIMEOUT:
                                errorMessage = 'Location request timed out.';
                                break;
                        }
                        showNotification(errorMessage, 'error');
                        shareCurrentLocation.disabled = false;
                        shareCurrentLocation.innerHTML = `
                            <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-[#8B7355]">📍 Current Location</h4>
                                <p class="text-sm text-[#A0845C]">Share your current location</p>
                            </div>
                        `;
                    });
                } else {
                    showNotification('Geolocation is not supported by this browser.', 'error');
                }
            });
            shareWeddingVenue.addEventListener('click', function() {
                locationChoiceModal.classList.add('hidden');
                const weddingVenueData = {
                    lat: -6.2019928,
                    lng: 106.925792,
                    name: 'Masjid Jami Al-Utsmani',
                    url: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.192079040854!2d106.92321707503716!3d-6.201992893774889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698cd0b04c8f2b%3A0x673c6a4d7d3c5f4!2sMasjid%20Jami%20Al-Utsmani!5e0!3m2!1sen!2sid!4v1753913917430!5m2!1sen!2sid',
                    is_wedding_venue: true
                };
                locationLat.value = weddingVenueData.lat;
                locationLng.value = weddingVenueData.lng;
                locationNameInput.value = weddingVenueData.name;
                locationUrlInput.value = weddingVenueData.url;
                isWeddingVenueInput.value = 'true';
                document.getElementById('locationName').textContent = weddingVenueData.name;
                document.getElementById('locationCoords').textContent = 'Wedding Venue Location';
                showAttachmentPreview('location');
            });
            locationChoiceModal.addEventListener('click', function(e) {
                if (e.target === locationChoiceModal) {
                    locationChoiceModal.classList.add('hidden');
                }
            });
            removeLocation.addEventListener('click', function() {
                locationLat.value = '';
                locationLng.value = '';
                locationNameInput.value = '';
                locationUrlInput.value = '';
                isWeddingVenueInput.value = 'false';
                hideAttachmentPreview();
            });

            function showAttachmentPreview(type) {
                attachmentPreview.classList.remove('hidden');
                if (type === 'image') {
                    imagePreview.classList.remove('hidden');
                    locationPreview.classList.add('hidden');
                } else if (type === 'location') {
                    locationPreview.classList.remove('hidden');
                    imagePreview.classList.add('hidden');
                }
            }

            function hideAttachmentPreview() {
                attachmentPreview.classList.add('hidden');
                imagePreview.classList.add('hidden');
                locationPreview.classList.add('hidden');
                imageInput.value = '';
            }

            function validateForm() {
                const name = nameInput.value.trim();
                if (!name) {
                    showNotification('Please enter your name', 'warning');
                    nameInput.focus();
                    return false;
                }
                return true;
            }
            messageForm.addEventListener('submit', function(e) {
                e.preventDefault();
                if (!validateForm()) {
                    return;
                }
                const message = messageInput.value.trim();
                const hasImage = imageInput.files.length > 0;
                const hasLocation = locationLat.value && locationLng.value;
                if (!message && !hasImage && !hasLocation) {
                    showNotification('Please enter a message, upload an image, or share a location',
                        'warning');
                    if (!hasImage && !hasLocation) messageInput.focus();
                    return;
                }
                const formData = new FormData(messageForm);
                const submitBtn = messageForm.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                `;
                fetch(`{{ route('chat.send', $event->id) }}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            messageInput.value = '';
                            imageInput.value = '';
                            locationLat.value = '';
                            locationLng.value = '';
                            locationNameInput.value = '';
                            locationUrlInput.value = '';
                            isWeddingVenueInput.value = 'false';
                            hideAttachmentPreview();
                            addMessageToChat(data.message, true);
                            if (data.message.attachment_type === 'image') {
                                showNotification('📷 Image sent successfully!', 'success', 2000);
                            } else if (data.message.attachment_type === 'location') {
                                showNotification('📍 Location shared successfully!', 'success', 2000);
                            } else {
                                showNotification('Message sent!', 'success', 2000);
                            }
                        } else if (data.error) {
                            showNotification(data.error, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Failed to send message', 'error');
                    })
                    .finally(() => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = `
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            <span class="hidden md:inline text-sm font-medium">Send</span>
                        `;
                    });
            });
            document.getElementById('closeImageModal').addEventListener('click', function() {
                document.getElementById('imageModal').classList.add('hidden');
            });
            document.getElementById('imageModal').addEventListener('click', function(e) {
                if (e.target === e.currentTarget) {
                    document.getElementById('imageModal').classList.add('hidden');
                }
            });
            const videoCallBtn = document.getElementById('videoCallBtn');
            const videoCallModal = document.getElementById('videoCallModal');
            const weddingVideoMain = document.getElementById('weddingVideoMain');
            const endVideoCall = document.getElementById('endVideoCall');
            const closeVideoModal = document.getElementById('closeVideoModal');
            const muteVideoBtn = document.getElementById('muteVideoBtn');
            const cameraToggleBtn = document.getElementById('cameraToggleBtn');
            const myVideoFeed = document.getElementById('myVideoFeed');
            const myVideoPlaceholder = document.getElementById('myVideoPlaceholder');
            const callStatus = document.getElementById('callStatus');
            const videoCallDuration = document.getElementById('videoCallDuration');
            const toggleMainVideoAudioBtn = document.getElementById('toggleMainVideoAudio');
            const mainAudioOnIcon = document.getElementById('mainAudioOnIcon');
            const mainAudioOffIcon = document.getElementById('mainAudioOffIcon');
            let videoCallTimer = null;
            let isMicMuted = false;
            let isCameraOn = true;
            let localStream = null;
            let isMainVideoMuted = false;
            const menuBtn = document.getElementById('menuBtn');
            const menuModal = document.getElementById('menuModal');
            const closeMenu = document.getElementById('closeMenu');
            const viewEventBtn = document.getElementById('viewEventBtn');
            const shareEventBtn = document.getElementById('shareEventBtn');
            const settingsBtn = document.getElementById('settingsBtn');
            const helpBtn = document.getElementById('helpBtn');
            const myCameraContainer = document.getElementById('myCameraContainer');

            function startVideoCallTimer() {
                let seconds = 0;
                if (callStatus) callStatus.classList.add('hidden');
                if (videoCallDuration) videoCallDuration.classList.remove('hidden');
                videoCallTimer = setInterval(() => {
                    seconds++;
                    const mins = Math.floor(seconds / 60);
                    const secs = seconds % 60;
                    if (videoCallDuration) {
                        videoCallDuration.textContent =
                            `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
                    }
                }, 1000);
            }

            function stopVideoCallTimer() {
                if (videoCallTimer) {
                    clearInterval(videoCallTimer);
                    videoCallTimer = null;
                }
                if (videoCallDuration) videoCallDuration.classList.add('hidden');
                if (callStatus) callStatus.classList.remove('hidden');
            }

            function requestUserMedia() {
                if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                    navigator.mediaDevices.getUserMedia({
                            video: true,
                            audio: true
                        })
                        .then(stream => {
                            localStream = stream;
                            if (myVideoFeed) {
                                myVideoFeed.srcObject = stream;
                                myVideoFeed.classList.remove('hidden');
                                myVideoPlaceholder.classList.add('hidden');
                            }
                            startVideoCallTimer();
                            if (callStatus) callStatus.textContent = 'Live broadcast...';
                        })
                        .catch(err => {
                            console.error("Error accessing media devices: ", err);
                            showNotification(
                                "Failed to access camera and microphone. Please check permissions.",
                                'error', 5000);
                            myVideoFeed.classList.add('hidden');
                            myVideoPlaceholder.classList.remove('hidden');
                            if (callStatus) callStatus.textContent = 'Live broadcast...';
                        });
                } else {
                    showNotification("Your browser does not support media devices.", 'error', 5000);
                }
            }

            function stopUserMedia() {
                if (localStream) {
                    localStream.getTracks().forEach(track => track.stop());
                    localStream = null;
                    if (myVideoFeed) myVideoFeed.srcObject = null;
                }
            }
            if (videoCallBtn) {
                videoCallBtn.addEventListener('click', function() {
                    isVideoCallActive = true;
                    pauseMusicForVideoCall();
                    videoCallModal.classList.remove('hidden');
                    requestUserMedia();
                    if (weddingVideoMain) {
                        weddingVideoMain.muted = false;
                        weddingVideoMain.play().catch(e => console.error("Video playback failed:", e));
                        isMainVideoMuted = false;
                        mainAudioOnIcon.classList.remove('hidden');
                        mainAudioOffIcon.classList.add('hidden');
                    }
                    showNotification('📹 Video call started - Background music paused', 'info', 3000);
                    // Panggil fungsi draggable pada elemen kamera pengguna setelah video call dimulai
                    makeDraggable(myCameraContainer);
                });
            }
            if (endVideoCall) {
                endVideoCall.addEventListener('click', function() {
                    isVideoCallActive = false;
                    videoCallModal.classList.add('hidden');
                    if (weddingVideoMain) {
                        weddingVideoMain.pause();
                        weddingVideoMain.currentTime = 0;
                        weddingVideoMain.muted = true;
                    }
                    stopUserMedia();
                    stopVideoCallTimer();
                    if (callStatus) callStatus.textContent = 'Live broadcast...';
                    resumeMusicAfterVideoCall();
                    showNotification('📹 Video call ended - Background music resumed', 'info', 2000);
                });
            }
            if (closeVideoModal) {
                closeVideoModal.addEventListener('click', function() {
                    if (endVideoCall) endVideoCall.click();
                });
            }
            if (toggleMainVideoAudioBtn) {
                toggleMainVideoAudioBtn.addEventListener('click', function() {
                    if (weddingVideoMain) {
                        weddingVideoMain.muted = !weddingVideoMain.muted;
                        isMainVideoMuted = weddingVideoMain.muted;
                        mainAudioOnIcon.classList.toggle('hidden', isMainVideoMuted);
                        mainAudioOffIcon.classList.toggle('hidden', !isMainVideoMuted);
                        showNotification(isMainVideoMuted ? '🔇 Video audio muted' :
                            '🔊 Video audio enabled', 'info', 1500);
                    }
                });
            }
            if (muteVideoBtn) {
                muteVideoBtn.addEventListener('click', function() {
                    isMicMuted = !isMicMuted;
                    if (localStream) {
                        localStream.getAudioTracks().forEach(track => track.enabled = !isMicMuted);
                    }
                    const micOnIcon = document.getElementById('micOnIcon');
                    const micOffIcon = document.getElementById('micOffIcon');
                    if (micOnIcon && micOffIcon) {
                        micOnIcon.classList.toggle('hidden', isMicMuted);
                        micOffIcon.classList.toggle('hidden', !isMicMuted);
                    }
                    showNotification(isMicMuted ? '🔇 Audio muted' : '🔊 Audio unmuted', 'info', 1500);
                });
            }
            if (cameraToggleBtn) {
                cameraToggleBtn.addEventListener('click', function() {
                    isCameraOn = !isCameraOn;
                    if (localStream) {
                        localStream.getVideoTracks().forEach(track => track.enabled = isCameraOn);
                    }
                    const cameraOnIcon = document.getElementById('cameraOnIcon');
                    const cameraOffIcon = document.getElementById('cameraOffIcon');
                    if (cameraOnIcon && cameraOffIcon) {
                        cameraOnIcon.classList.toggle('hidden', !isCameraOn);
                        cameraOffIcon.classList.toggle('hidden', isCameraOn);
                    }
                    if (myVideoFeed && myVideoPlaceholder) {
                        myVideoFeed.classList.toggle('hidden', !isCameraOn);
                        myVideoPlaceholder.classList.toggle('hidden', isCameraOn);
                    }
                    showNotification(isCameraOn ? '📹 Camera is on' : '📹 Camera is off', 'info', 1500);
                });
            }
            if (menuBtn) {
                menuBtn.addEventListener('click', function() {
                    menuModal.classList.remove('hidden');
                });
            }
            if (closeMenu) {
                closeMenu.addEventListener('click', function() {
                    menuModal.classList.add('hidden');
                });
            }
            if (viewEventBtn) {
                viewEventBtn.addEventListener('click', function() {
                    window.location.href = '{{ route('event.description', $event->id) }}';
                });
            }
            if (shareEventBtn) {
                shareEventBtn.addEventListener('click', function() {
                    if (navigator.share) {
                        navigator.share({
                            title: '{{ $event->title }}',
                            text: 'Join our wedding celebration chat!',
                            url: window.location.href
                        });
                    } else {
                        navigator.clipboard.writeText(window.location.href).then(() => {
                            showNotification('Event link copied to clipboard!', 'success');
                        }).catch(() => {
                            showNotification('Unable to copy event details', 'error');
                        });
                    }
                    menuModal.classList.add('hidden');
                });
            }
            if (settingsBtn) {
                settingsBtn.addEventListener('click', function() {
                    showNotification('Settings feature coming soon!', 'info');
                    menuModal.classList.add('hidden');
                });
            }
            if (helpBtn) {
                helpBtn.addEventListener('click', function() {
                    showNotification(
                        'Help: This is a wedding celebration chat. Enter your name and start chatting with other guests! You can also share images and your location. Use the speaker button to control background music.',
                        'info', 6000);
                    menuModal.classList.add('hidden');
                });
            }
            [videoCallModal, menuModal, locationChoiceModal].forEach(modal => {
                if (modal) {
                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) {
                            modal.classList.add('hidden');
                            if (modal === videoCallModal) {
                                stopUserMedia();
                                stopVideoCallTimer();
                                if (weddingVideoMain) {
                                    weddingVideoMain.pause();
                                    weddingVideoMain.currentTime = 0;
                                    weddingVideoMain.muted = true;
                                }
                                isVideoCallActive = false;
                                resumeMusicAfterVideoCall();
                            }
                        }
                    });
                }
            });
        });

        window.addEventListener('resize', function() {
            const container = document.getElementById('notificationContainer');
            if (container) {
                const notifications = container.querySelectorAll('.notification-item.show');
                notifications.forEach((notification, index) => {
                    notification.style.animationDelay = (index * 0.1) + 's';
                });
            }
        });
    </script>

    <style>
        /* All existing styles remain the same */
        .fixed.top-20.right-4 button {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.8);
        }

        .fixed.top-20.right-4 button:hover {
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
            border-color: rgba(255, 255, 255, 1);
        }

        #musicIndicator {
            animation: pulse 2s infinite;
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
        }

        @keyframes pulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(34, 197, 94, 0);
            }

            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
            }
        }

        #locationChoiceModal .bg-white {
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        #shareCurrentLocation,
        #shareWeddingVenue {
            transition: all 0.3s ease;
        }

        #shareCurrentLocation:hover,
        #shareWeddingVenue:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .location-map-iframe {
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .location-map-iframe:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .location-map-iframe {
                height: 150px !important;
            }

            .space-y-2 {
                gap: 0.5rem;
            }

            .space-y-2 button {
                width: 100%;
            }

            .fixed.top-20.right-4 {
                top: 5rem;
                right: 1rem;
            }

            .fixed.top-20.right-4 button {
                width: 3rem;
                height: 3rem;
            }

            .fixed.top-20.right-4 button svg {
                width: 1.25rem;
                height: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .location-map-iframe {
                height: 120px !important;
            }
        }

        .location-bubble {
            animation: locationBubbleSlideIn 0.5s ease-out;
        }

        @keyframes locationBubbleSlideIn {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .space-y-2 button:hover {
            transform: translateY(-1px) scale(1.01);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .space-y-2 button:active {
            transform: translateY(0) scale(1);
        }

        #notificationContainer {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 9999;
            max-width: 400px;
            width: auto;
            pointer-events: none;
        }

        .notification-item {
            pointer-events: auto;
            margin-bottom: 0.5rem;
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            max-width: 100%;
            word-wrap: break-word;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .notification-item.show {
            transform: translateX(0);
            opacity: 1;
        }

        .notification-item.hide {
            transform: translateX(100%);
            opacity: 0;
        }

        .notification-content {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 1rem;
            box-shadow:
                0 10px 25px rgba(0, 0, 0, 0.1),
                0 4px 12px rgba(0, 0, 0, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(232, 213, 183, 0.3);
            position: relative;
            overflow: hidden;
        }

        .notification-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #C9A876, #B8956A);
            border-radius: 12px 12px 0 0;
        }

        .notification-music {
            background: linear-gradient(135deg,
                    rgba(201, 168, 118, 0.1) 0%,
                    rgba(184, 149, 106, 0.1) 100%);
            border-left: 4px solid #C9A876;
        }

        .notification-music .notification-content::before {
            background: linear-gradient(90deg, #C9A876, #B8956A, #C9A876);
            animation: musicPulse 2s ease-in-out infinite;
        }

        @keyframes musicPulse {

            0%,
            100% {
                opacity: 0.8;
            }

            50% {
                opacity: 1;
            }
        }

        .notification-text {
            font-size: 0.875rem;
            line-height: 1.4;
            color: #8B7355;
            font-weight: 500;
            margin: 0;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .notification-icon {
            flex-shrink: 0;
            width: 1.25rem;
            height: 1.25rem;
            margin-top: 0.125rem;
        }

        .notification-message {
            flex: 1;
            min-width: 0;
        }

        .notification-close {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            width: 1.5rem;
            height: 1.5rem;
            border: none;
            background: rgba(139, 115, 85, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #A0845C;
        }

        .notification-close:hover {
            background: rgba(139, 115, 85, 0.2);
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            #notificationContainer {
                top: 0.5rem;
                left: 0.5rem;
                right: 0.5rem;
                max-width: none;
                width: auto;
            }

            .notification-item {
                transform: translateY(-100%);
            }

            .notification-item.show {
                transform: translateY(0);
            }

            .notification-item.hide {
                transform: translateY(-100%);
            }
        }

        #speakerBtn {
            transition: all 0.3s ease;
        }

        #speakerBtn:hover {
            transform: scale(1.1);
        }

        #speakerBtn.text-red-500:hover {
            background-color: rgba(239, 68, 68, 0.1);
        }

        .message-item {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message-item:hover .rounded-2xl {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        #attachmentPreview {
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #imagePreviewImg {
            max-width: 128px;
            max-height: 96px;
            object-fit: cover;
        }

        #imageBtn:hover,
        #locationBtn:hover {
            transform: scale(1.1);
            background-color: rgba(242, 226, 192, 0.7);
        }

        #locationPreview .w-8 {
            animation: pulse 2s infinite;
        }

        #imageModal {
            backdrop-filter: blur(4px);
        }

        #modalImage {
            max-width: 90vw;
            max-height: 90vh;
        }

        #videoCallModal .video-call-modal-container {
            background-color: #1f2937;
            max-width: 90vw;
            height: 90vh;
            max-height: none;
        }

        @media (max-width: 768px) {
            #videoCallModal .video-call-modal-container {
                max-width: 95vw;
                height: 95vh;
            }
        }

        .video-control-btn {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .video-control-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        .video-control-btn svg {
            transition: transform 0.3s ease;
        }

        .video-control-btn:hover svg {
            transform: scale(1.1);
        }

        #endVideoCall {
            background-color: #ef4444;
        }

        #endVideoCall:hover {
            background-color: #dc2626;
        }

        #messagesContainer {
            scroll-behavior: smooth;
        }

        #messagesContainer::-webkit-scrollbar {
            width: 6px;
        }

        #messagesContainer::-webkit-scrollbar-track {
            background: rgba(248, 234, 208, 0.3);
            border-radius: 3px;
        }

        #messagesContainer::-webkit-scrollbar-thumb {
            background: rgba(201, 168, 118, 0.5);
            border-radius: 3px;
        }

        #messagesContainer::-webkit-scrollbar-thumb:hover {
            background: rgba(184, 149, 106, 0.7);
        }

        input.bg-transparent {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        input.bg-transparent:focus {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(201, 168, 118, 0.4);
            box-shadow: 0 0 0 3px rgba(201, 168, 118, 0.1);
        }

        input.bg-transparent:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        button[type="submit"] {
            font-weight: 500;
            letter-spacing: 0.025em;
        }

        button[type="submit"]:hover {
            transform: translateY(-1px) scale(1.02);
            box-shadow: 0 8px 25px rgba(201, 168, 118, 0.4);
        }

        button[type="submit"]:active {
            transform: translateY(0) scale(1);
        }

        button:focus,
        input:focus {
            outline: 3px solid rgba(201, 168, 118, 0.5);
            outline-offset: 2px;
        }

        * {
            transition: all 0.2s ease;
        }

        input,
        button {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .location-bubble .space-y-2 button {
            font-size: 0.875rem;
            letter-spacing: 0.025em;
            padding: 0.5rem 0.75rem;
            height: auto;
            min-height: 36px;
        }

        .location-bubble .space-y-2 button svg {
            transition: transform 0.2s ease;
            width: 1rem;
            height: 1rem;
        }

        .location-bubble .space-y-2 button:hover svg {
            transform: scale(1.05);
        }

        .draggable-camera {
            position: absolute;
            top: 25%;
            left: 20px;
            cursor: grab;
            touch-action: none;
        }

        .draggable-camera:active {
            cursor: grabbing;
        }
    </style>
@endsection
