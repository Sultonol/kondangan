@extends('layouts.app')

@section('title', $event->title . ' - Description')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-amber-50 to-orange-50">
        <!-- Header Section -->
        <div class="bg-gradient-to-b from-amber-50 to-orange-100 px-4 py-6">
            <div class="max-w-md mx-auto">
                <!-- Back Button -->
                <div class="flex justify-start mb-4">
                    <a href="{{ route('chat.room', $event->id) }}"
                        class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </a>
                </div>

                <!-- Profile Image -->
                <div class="flex justify-center mb-4">
                    <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-200 shadow-lg">
                        <img src="/images/wedding-couple.png" alt="Wedding Couple" class="w-full h-full object-cover"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div
                            class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400 items-center justify-center hidden">
                            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Title -->
                <div class="text-center mb-6">
                    <h1 class="text-xl font-semibold text-gray-800 mb-1">Wedding Celebration</h1>
                    <h2 class="text-lg text-gray-600">Ahmad & Siti</h2>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-center space-x-3 mb-8">
                    <!-- Video Call -->
                    {{-- <button id="videoCallBtn"
                        class="w-12 h-12 bg-pink-400 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                    </button> --}}

                    <!-- Information -->
                    <button id="informationBtn"
                        class="w-12 h-12 bg-yellow-400 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </button>

                    <!-- Location -->
                    <a href="https://maps.app.goo.gl/zBNjFE6ffcvgttq98" target="_blank"
                        class="w-12 h-12 bg-orange-400 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </a>

                    <!-- Media -->
                    <a href="#media" class="w-12 h-12 bg-teal-400 rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Content Sections -->
        <div class="max-w-md mx-auto px-4 space-y-4">
            <!-- Pre-Wedding Video Section -->
            @if ($mainVideo && $mainVideo->fileExists())
                <div class="rounded-2xl p-4 shadow-sm">
                    <div class="flex items-center mb-3">
                        <div class="w-2 h-2 bg-black rounded-full mr-2"></div>
                        <h3 class="text-sm font-medium text-gray-800">Pre-Wedding Video</h3>
                    </div>
                    <div class="relative rounded-xl overflow-hidden">
                        <video id="mainVideo" class="w-full h-48 object-cover cursor-pointer" controls playsinline
                            crossorigin="anonymous">
                            <source src="{{ $mainVideo->url }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div class="absolute inset-0 flex items-center justify-center cursor-pointer" id="videoOverlay">
                            <div class="w-12 h-12 bg-white bg-opacity-80 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-800 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Event Description Section -->
            <div class="rounded-2xl p-4 shadow-sm">
                <div class="flex items-center mb-3">
                    <div class="w-2 h-2 bg-black rounded-full mr-2"></div>
                    <h3 class="text-sm font-medium text-gray-800">Undangan</h3>
                </div>
                <div class="space-y-3 text-sm text-gray-700 leading-relaxed">
                    <p>
                        Halo, manteman 👋🏻 Akhir tahun pada kemana, nih? Ada acara gak?
                    </p>
                    <p>
                        Kalo belum ada, kita mau ajak kalian dateng ke hajatan kita, <strong>Aqilla Nasyia Maulidia</strong>
                        dan <strong>Rusydan Siswantoro Galih Aji</strong> 🎉
                    </p>
                    <div class="bg-amber-50 rounded-lg p-3 border-l-4 border-amber-400">
                        <p class="font-semibold text-amber-800 mb-2">Save the date! 📅</p>
                        <div class="space-y-1 text-amber-700">
                            <p><strong>Jumat, 20 Desember 2025</strong></p>
                            <p>⏰ 14.00 - 16.00 WIB</p>
                            <p>📍 Masjid Jami Al-Utsmani, Jatinegara, Cakung, Jakarta Timur</p>
                        </div>
                    </div>
                    <p>
                        Nih, shareloc biar ga nyasar ya ges ya! 👇
                    </p>
                    <a href="https://maps.app.goo.gl/7FvajFSzQ7T1jqtv6?g_st=ipc" target="_blank"
                        class="inline-flex items-center space-x-2 bg-blue-50 hover:bg-blue-100 text-blue-700 px-3 py-2 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-sm font-medium">Lihat Lokasi di Maps</span>
                    </a>
                    <p class="text-gray-600 italic">
                        Dateng sih gak wajib (tapi kalau dateng kami happy banget 😍), yang penting doa dan restunya buat
                        perjalanan baru kami, ya! Sampai ketemu ❤
                    </p>
                </div>
            </div>


            <!-- Media Section -->
            @if ($images && $images->count() > 0)
                <div id="media" class="rounded-2xl p-4 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-black rounded-full mr-2"></div>
                            <h3 class="text-sm font-medium text-gray-800">Media</h3>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </div>

                    <!-- Display all images in horizontal scroll -->
                    <div class="flex space-x-3 overflow-x-auto pb-2"
                        style="scrollbar-width: none; -ms-overflow-style: none;">
                        @foreach ($images as $image)
                            <div class="relative rounded-xl overflow-hidden cursor-pointer gallery-item flex-shrink-0 w-50 h-72"
                                data-image-url="{{ $image->url }}" data-image-title="{{ $image->title }}"
                                data-image-description="{{ $image->description }}" data-image-index="{{ $loop->index }}">
                                <img src="{{ $image->url }}" alt="{{ $image->title }}"
                                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                    onerror="this.src='/images/wedding-placeholder.png';">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Bank Information Section -->
            @if ($banks->count() > 0)
                @foreach ($banks as $bank)
                    <div class="rounded-2xl p-4 shadow-sm">
                        <div class="flex items-center mb-3">
                            <div class="w-2 h-2 bg-black rounded-full mr-2"></div>
                            <h3 class="text-sm font-medium text-gray-800">Iuran Warga Suka-Suka Aja</h3>
                        </div>

                        <!-- Use the provided SVG design -->
                        <div class="relative rounded-xl overflow-hidden mb-3 h-[230px]">
                            <img src="/storage/events/images/Frame 16.svg" alt="Iuran Warga Design"
                                class="w-full object-top"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <!-- Fallback design if SVG not found -->
                            <div class="hidden bg-gradient-to-br from-teal-400 to-blue-500 rounded-xl p-4 overflow-hidden">
                                <!-- Decorative Pattern -->
                                <div class="absolute inset-0 opacity-20">
                                    <div class="w-full h-full"
                                        style="background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 60 60%22><circle cx=%2230%22 cy=%2230%22 r=%2210%22 fill=%22white%22 opacity=%220.3%22/><circle cx=%2215%22 cy=%2215%22 r=%225%22 fill=%22white%22 opacity=%220.2%22/><circle cx=%2245%22 cy=%2245%22 r=%227%22 fill=%22white%22 opacity=%220.2%22/></svg>'); background-size: 60px 60px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button
                            class="copy-full-btn bg-[#F8EAD0] hover:bg-amber-80 text-gray-800 font-semibold px-3 py-2 rounded-lg transition-colors shadow-lg w-full
           focus:outline-none focus:ring-0">
                            {{-- < class="w-4 h-4 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"> --}}
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                            <div class="text-xs">Copy</div>
                        </button>
                        <!-- Copy Button -->
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Bottom Spacing -->
        <div class="h-8"></div>
    </div>

    <!-- Photo Modal -->
    <div id="photoDetailModal"
        class="fixed inset-0 bg-black bg-opacity-90 hidden z-50 flex items-center justify-center p-4">
        <div class="relative w-full h-full flex items-center justify-center">
            <button id="closePhotoDetail"
                class="absolute top-4 right-4 z-10 w-10 h-10 bg-black bg-opacity-50 hover:bg-black hover:bg-opacity-70 text-white rounded-full flex items-center justify-center transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <button id="prevPhoto"
                class="absolute left-4 top-1/2 transform -translate-y-1/2 z-10 w-12 h-12 bg-black bg-opacity-50 hover:bg-black hover:bg-opacity-70 text-white rounded-full flex items-center justify-center transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <button id="nextPhoto"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 z-10 w-12 h-12 bg-black bg-opacity-50 hover:bg-black hover:bg-opacity-70 text-white rounded-full flex items-center justify-center transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <div class="w-full h-full flex items-center justify-center p-8">
                <img id="photoDetailImage" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl"
                    alt="Photo Detail">
            </div>

            <div
                class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-50 text-white px-4 py-2 rounded-full">
                <p id="photoCounter" class="text-sm font-medium"></p>
            </div>
        </div>
    </div>

    <!-- Video Call Modal -->
    <div id="videoCallModal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg mx-4 overflow-hidden">
            <div class="bg-gradient-to-r from-pink-500 to-pink-600 text-white p-4 text-center">
                <h3 class="text-lg font-semibold">{{ $event->title }}</h3>
                <p class="text-pink-100 text-sm">Video Call</p>
            </div>

            <div class="relative bg-gray-900 aspect-video flex items-center justify-center">
                @if ($mainVideo && $mainVideo->fileExists())
                    <video id="weddingVideo" class="w-full h-full object-cover" controls autoplay>
                        <source src="{{ $mainVideo->url }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @else
                    <div class="text-center text-white p-8">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                        <p class="text-lg font-semibold mb-2">Video Coming Soon</p>
                        <p class="text-gray-400">Wedding memories will be shared here</p>
                    </div>
                @endif
            </div>

            <div class="p-4 bg-gray-50 flex justify-center space-x-4">
                <button id="endVideoCall" class="p-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Information Modal -->
    <div id="informationModal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white p-4 text-center">
                <h3 class="text-lg font-semibold">Wedding Information</h3>
                <p class="text-yellow-100 text-sm">Ahmad & Siti</p>
            </div>

            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-2">Event Details</h4>
                        <p class="text-gray-600 text-sm">
                            {{ $event->description ?? 'Join us in celebrating the union of Ahmad and Siti in a beautiful wedding ceremony.' }}
                        </p>
                    </div>

                    @if ($schedules->count() > 0)
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Schedule</h4>
                            <div class="space-y-2">
                                @foreach ($schedules->take(3) as $schedule)
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-600">{{ $schedule->title }}</span>
                                        <span
                                            class="text-gray-800 font-medium">{{ $schedule->start_time->format('H:i') }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div>
                        <h4 class="font-semibold text-gray-800 mb-2">Dress Code</h4>
                        <p class="text-gray-600 text-sm">Smart casual or traditional attire</p>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-gray-50 flex justify-center">
                <button id="closeInformation"
                    class="px-6 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Video functionality
            const mainVideo = document.getElementById('mainVideo');
            const videoOverlay = document.getElementById('videoOverlay');

            if (mainVideo && videoOverlay) {
                videoOverlay.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (mainVideo.paused) {
                        mainVideo.play();
                        videoOverlay.style.display = 'none';
                    } else {
                        mainVideo.pause();
                        videoOverlay.style.display = 'flex';
                    }
                });

                mainVideo.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (mainVideo.paused) {
                        mainVideo.play();
                        videoOverlay.style.display = 'none';
                    } else {
                        mainVideo.pause();
                        videoOverlay.style.display = 'flex';
                    }
                });

                mainVideo.addEventListener('play', function() {
                    videoOverlay.style.display = 'none';
                });

                mainVideo.addEventListener('pause', function() {
                    videoOverlay.style.display = 'flex';
                });
            }

            // Photo Gallery functionality
            const galleryItems = document.querySelectorAll('.gallery-item');
            const photoDetailModal = document.getElementById('photoDetailModal');
            const photoDetailImage = document.getElementById('photoDetailImage');
            const photoCounter = document.getElementById('photoCounter');
            const closePhotoDetail = document.getElementById('closePhotoDetail');
            const prevPhoto = document.getElementById('prevPhoto');
            const nextPhoto = document.getElementById('nextPhoto');

            let currentPhotoIndex = 0;
            let photos = [];

            galleryItems.forEach((item, index) => {
                photos.push({
                    url: item.dataset.imageUrl,
                    title: item.dataset.imageTitle,
                    description: item.dataset.imageDescription,
                    index: index
                });
            });

            galleryItems.forEach((item, index) => {
                item.addEventListener('click', function() {
                    currentPhotoIndex = index;
                    showPhotoDetail();
                });
            });

            function showPhotoDetail() {
                const photo = photos[currentPhotoIndex];
                photoDetailImage.src = photo.url;
                photoCounter.textContent = `${currentPhotoIndex + 1} of ${photos.length}`;
                photoDetailModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function hidePhotoDetail() {
                photoDetailModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            if (prevPhoto) {
                prevPhoto.addEventListener('click', function() {
                    currentPhotoIndex = currentPhotoIndex > 0 ? currentPhotoIndex - 1 : photos.length - 1;
                    showPhotoDetail();
                });
            }

            if (nextPhoto) {
                nextPhoto.addEventListener('click', function() {
                    currentPhotoIndex = currentPhotoIndex < photos.length - 1 ? currentPhotoIndex + 1 : 0;
                    showPhotoDetail();
                });
            }

            if (closePhotoDetail) {
                closePhotoDetail.addEventListener('click', hidePhotoDetail);
            }

            if (photoDetailModal) {
                photoDetailModal.addEventListener('click', function(e) {
                    if (e.target === photoDetailModal) {
                        hidePhotoDetail();
                    }
                });
            }

            // Show more images functionality
            const showMoreBtn = document.getElementById('showMoreImages');
            if (showMoreBtn) {
                let isExpanded = false;
                const mediaGrid = document.querySelector('#media .grid');
                const allImages = mediaGrid.querySelectorAll('.gallery-item');

                // Initially show only first 4 images
                if (allImages.length > 4) {
                    for (let i = 4; i < allImages.length; i++) {
                        allImages[i].style.display = 'none';
                    }
                }

                showMoreBtn.addEventListener('click', function() {
                    if (!isExpanded) {
                        // Show all images
                        allImages.forEach(img => img.style.display = 'block');
                        this.textContent = 'Show less';
                        isExpanded = true;
                    } else {
                        // Hide images after first 4
                        for (let i = 4; i < allImages.length; i++) {
                            allImages[i].style.display = 'none';
                        }
                        this.textContent = `Show all ${allImages.length} photos`;
                        isExpanded = false;
                    }
                });
            }

            // Video Call Modal
            const videoCallBtn = document.getElementById('videoCallBtn');
            const videoCallModal = document.getElementById('videoCallModal');
            const weddingVideo = document.getElementById('weddingVideo');
            const endVideoCall = document.getElementById('endVideoCall');
            const videoCallDuration = document.getElementById('videoCallDuration');
            const closeVideoModal = document.getElementById('closeVideoModal');
            const muteVideoBtn = document.getElementById('muteVideoBtn');
            const cameraToggleBtn = document.getElementById('cameraToggleBtn');

            let videoCallStartTime = null;
            let videoCallTimer = null;
            let isVideoMuted = false;
            let isCameraOff = false;

            function formatCallTime(seconds) {
                const mins = Math.floor(seconds / 60);
                const secs = seconds % 60;
                return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
            }

            function startVideoCallTimer() {
                videoCallStartTime = Date.now();
                videoCallTimer = setInterval(() => {
                    const elapsed = Math.floor((Date.now() - videoCallStartTime) / 1000);
                    if (videoCallDuration) {
                        videoCallDuration.textContent = formatCallTime(elapsed);
                    }
                }, 1000);
            }

            function stopVideoCallTimer() {
                if (videoCallTimer) {
                    clearInterval(videoCallTimer);
                    videoCallTimer = null;
                }
                if (videoCallDuration) {
                    videoCallDuration.textContent = '00:00';
                }
            }

            if (videoCallBtn) {
                videoCallBtn.addEventListener('click', function() {
                    videoCallModal.classList.remove('hidden');
                    startVideoCallTimer();
                    if (weddingVideo) {
                        weddingVideo.play().catch(e => console.error("Video playback failed:", e));
                    }
                });
            }

            if (endVideoCall) {
                endVideoCall.addEventListener('click', function() {
                    videoCallModal.classList.add('hidden');
                    if (weddingVideo) {
                        weddingVideo.pause();
                        weddingVideo.currentTime = 0;
                    }
                    stopVideoCallTimer();
                });
            }
            if (closeVideoModal) {
                closeVideoModal.addEventListener('click', function() {
                    if (endVideoCall) endVideoCall.click();
                });
            }

            if (muteVideoBtn && weddingVideo) {
                muteVideoBtn.addEventListener('click', function() {
                    isVideoMuted = !isVideoMuted;
                    weddingVideo.muted = isVideoMuted;
                    document.getElementById('micOnIcon').classList.toggle('hidden', isVideoMuted);
                    document.getElementById('micOffIcon').classList.toggle('hidden', !isVideoMuted);
                });
            }

            if (cameraToggleBtn) {
                cameraToggleBtn.addEventListener('click', function() {
                    isCameraOff = !isCameraOff;
                    document.getElementById('cameraOnIcon').classList.toggle('hidden', isCameraOff);
                    document.getElementById('cameraOffIcon').classList.toggle('hidden', !isCameraOff);
                });
            }

            // Information Modal
            const informationBtn = document.getElementById('informationBtn');
            const informationModal = document.getElementById('informationModal');
            const closeInformation = document.getElementById('closeInformation');

            if (informationBtn) {
                informationBtn.addEventListener('click', function() {
                    informationModal.classList.remove('hidden');
                });
            }

            if (closeInformation) {
                closeInformation.addEventListener('click', function() {
                    informationModal.classList.add('hidden');
                });
            }

            // Close modals when clicking outside
            [videoCallModal, informationModal].forEach(modal => {
                if (modal) {
                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) {
                            modal.classList.add('hidden');
                            if (modal === videoCallModal && weddingVideo) {
                                weddingVideo.pause();
                            }
                        }
                    });
                }
            });


            // Copy functionality for account numbers
            document.querySelectorAll('.copy-account-btn').forEach(btn => {
                btn.addEventListener('click', function(event) {
                    event
                .stopPropagation(); // Prevent modal from closing if copy button is inside a clickable element
                    const accountNumberElement = this.closest('.relative').querySelector(
                        '.account-number');
                    if (accountNumberElement) {
                        const accountNumber = accountNumberElement.getAttribute(
                            'data-account-number');
                        if (navigator.clipboard && navigator.clipboard.writeText) {
                            navigator.clipboard.writeText(accountNumber)
                                .then(() => {
                                    showToast('Nomor rekening berhasil disalin!');
                                })
                                .catch(err => {
                                    console.error('Failed to copy text: ', err);
                                    showToast('Gagal menyalin nomor rekening.', 'error');
                                });
                        } else {
                            // Fallback for older browsers
                            const tempInput = document.createElement('input');
                            tempInput.value = accountNumber;
                            document.body.appendChild(tempInput);
                            tempInput.select();
                            document.execCommand('copy');
                            document.body.removeChild(tempInput);
                            showToast('Nomor rekening berhasil disalin! (Fallback)');
                        }
                    }
                });
            });

            // Copy button for the SVG card
            document.querySelectorAll('.copy-full-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const container = this.closest('.rounded-2xl');
                    // DUMMY ACCOUNT NUMBER - SILAKAN UBAH INI
                    const accountNumber = '1234567890123456789';
                    if (navigator.clipboard && navigator.clipboard.writeText) {
                        navigator.clipboard.writeText(accountNumber)
                            .then(() => {
                                showToast('Nomor rekening berhasil disalin!');
                            })
                            .catch(err => {
                                console.error('Failed to copy text: ', err);
                                showToast('Gagal menyalin nomor rekening.', 'error');
                            });
                    } else {
                        // Fallback for older browsers
                        const tempInput = document.createElement('input');
                        tempInput.value = accountNumber;
                        document.body.appendChild(tempInput);
                        tempInput.select();
                        document.execCommand('copy');
                        document.body.removeChild(tempInput);
                        showToast('Nomor rekening berhasil disalin! (Fallback)');
                    }
                });
            });


            // Toast notification function
            function showToast(message, type = 'success') {
                const toast = document.createElement('div');
                let bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
                toast.className =
                    `fixed top-4 right-4 ${bgColor} text-white px-4 py-2 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
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

            // Keyboard navigation for photo modal
            document.addEventListener('keydown', function(e) {
                if (!photoDetailModal.classList.contains('hidden')) {
                    if (e.key === 'ArrowLeft') {
                        prevPhoto.click();
                    } else if (e.key === 'ArrowRight') {
                        nextPhoto.click();
                    } else if (e.key === 'Escape') {
                        hidePhotoDetail();
                    }
                }
            });
        });
    </script>

    <style>
        /* Enhanced hover effects for gallery */
        .gallery-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Smooth transitions */
        .gallery-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Focus states for accessibility */
        button:focus,
        a:focus {
            outline: 3px solid #f59e0b;
            outline-offset: 2px;
        }

        /* Custom selection colors */
        ::selection {
            background-color: #f59e0b;
            color: white;
        }

        /* Mobile optimizations */
        @media (max-width: 768px) {
            .gallery-item {
                height: 160px;
                /* Slightly taller on mobile */
            }

            /* Ensure touch targets are at least 44px */
            button,
            a {
                min-height: 44px;
                min-width: 44px;
            }

            /* Better spacing for mobile */
            .space-y-4>*+* {
                margin-top: 1rem;
            }
        }

        /* Loading animation for images */
        .gallery-item img {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item img[src] {
            opacity: 1;
        }

        /* Blur effect styling */
        .blur-sm {
            filter: blur(4px);
            transition: filter 0.3s ease;
        }

        /* Account number styling */
        .account-number,
        .account-number-visible {
            cursor: pointer;
            user-select: none;
            transition: all 0.3s ease;
        }

        .account-number:hover,
        .account-number-visible:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            padding: 2px 4px;
        }
    </style>
@endsection
