@extends('layouts.app')

@section('title', 'Gallery - ' . $event->title)

@section('content')
<div class="min-h-screen bg-gradient-to-b from-amber-50 to-orange-50">
    <!-- Header Section -->
    <div class="bg-gradient-to-b from-amber-50 to-orange-100 px-4 py-6">
        <div class="max-w-md mx-auto">
            <!-- Back Button -->
            <div class="flex justify-start mb-4">
                <a href="{{ route('chat.room', $event->id) }}" class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
            </div>

            <!-- Profile Image -->
            <div class="flex justify-center mb-4">
                <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-200 shadow-lg">
                    <img src="/images/Foto Prewedding 4.png" 
                         alt="Wedding Couple" 
                         class="w-full h-full object-cover"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400 items-center justify-center hidden">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Title -->
            <div class="text-center mb-6">
                <h1 class="text-xl font-semibold text-gray-800 mb-1">Wedding Celebration</h1>
                <h2 class="text-lg text-gray-600">Ahmad & Siti</h2>
                @if($images && $images->count() > 0)
                    <p class="text-sm text-gray-500 mt-2">{{ $images->count() }} {{ $images->count() == 1 ? 'photo' : 'photos' }} in gallery</p>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-center space-x-3 mb-8">
                <!-- Gallery (Current) -->
                <button class="w-12 h-12 bg-teal-400 rounded-lg flex items-center justify-center shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </button>

                <!-- Information -->
                <a href="{{ route('event.description', $event->id) }}" class="w-12 h-12 bg-yellow-400 rounded-lg flex items-center justify-center shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </a>

                <!-- Location -->
                <a href="https://maps.app.goo.gl/zBNjFE6ffcvgttq98" target="_blank" class="w-12 h-12 bg-orange-400 rounded-lg flex items-center justify-center shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </a>

                <!-- Chat -->
                <a href="{{ route('chat.room', $event->id) }}" class="w-12 h-12 bg-pink-400 rounded-lg flex items-center justify-center shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Content Sections -->
    <div class="max-w-md mx-auto px-4 space-y-4">
        <!-- Event Information Section -->
        <div class="bg-white rounded-2xl p-4 shadow-sm">
            <div class="flex items-center mb-3">
                <div class="w-2 h-2 bg-black rounded-full mr-2"></div>
                <h3 class="text-sm font-medium text-gray-800">Event Information</h3>
            </div>
            <div class="space-y-3 text-sm text-gray-700 leading-relaxed">
                <p>
                    Halo, manteman 👋🏻 Selamat datang di galeri foto hajatan kita!
                </p>
                <div class="bg-amber-50 rounded-lg p-3 border-l-4 border-amber-400">
                    <p class="font-semibold text-amber-800 mb-2">Wedding Details 💒</p>
                    <div class="space-y-1 text-amber-700">
                        <p><strong>Jumat, 20 Desember 2025</strong></p>
                        <p>⏰ 14.00 - 16.00 WIB</p>
                        <p>📍 Masjid Jami Al-Utsmani, Jatinegara, Cakung, Jakarta Timur</p>
                    </div>
                </div>
                <p class="text-gray-600 italic">
                    Lihat momen-momen indah perjalanan cinta kami di galeri ini ❤️
                </p>
            </div>
        </div>

        <!-- Gallery Section -->
        @if($images && $images->count() > 0)
        <div class="bg-white rounded-2xl p-4 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                    <div class="w-2 h-2 bg-black rounded-full mr-2"></div>
                    <h3 class="text-sm font-medium text-gray-800">Photo Gallery</h3>
                </div>
                <span class="text-xs text-gray-500">{{ $images->count() }} photos</span>
            </div>
            
            <!-- Gallery Grid -->
            <div class="grid grid-cols-2 gap-3">
                @foreach($images as $image)
                    <div class="gallery-item relative rounded-xl overflow-hidden cursor-pointer bg-gray-100 aspect-square group"
                         data-image-url="{{ $image->url }}"
                         data-image-title="{{ $image->title }}"
                         data-image-description="{{ $image->description }}"
                         data-image-index="{{ $loop->index }}">
                        
                        <!-- Loading Placeholder -->
                        <div class="loading-placeholder absolute inset-0 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 animate-pulse">
                            <div class="flex items-center justify-center h-full">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <img src="{{ $image->url }}" 
                             alt="{{ $image->title }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300 opacity-0"
                             onload="this.style.opacity='1'; this.previousElementSibling.style.display='none';"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        
                        <!-- Error Placeholder -->
                        <div class="error-placeholder absolute inset-0 bg-gray-200 items-center justify-center hidden">
                            <div class="text-center">
                                <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-xs text-gray-500">Failed to load</p>
                            </div>
                        </div>
                        
                        <!-- Hover Overlay with Love Icon -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                            <div class="transform scale-0 group-hover:scale-100 transition-transform duration-300 bg-white bg-opacity-90 rounded-full p-3">
                                <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Image Info Overlay -->
                        @if($image->title)
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-3 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                <p class="text-white text-sm font-medium truncate">{{ $image->title }}</p>
                                @if($image->description)
                                    <p class="text-white text-xs opacity-80 truncate">{{ $image->description }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- View All Button -->
            <div class="mt-4 text-center">
                <button id="viewAllPhotos" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-teal-500 to-blue-500 hover:from-teal-600 hover:to-blue-600 text-black rounded-lg shadow-sm transition-all duration-300 transform hover:scale-105">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    View All Photos
                </button>
            </div>
        </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl p-8 shadow-sm text-center">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-800 mb-2">No Photos Yet</h3>
                <p class="text-gray-600 mb-4">Photos will appear here when they're uploaded.</p>
                <a href="{{ route('chat.room', $event->id) }}" 
                   class="inline-flex items-center px-4 py-2 bg-pink-500 hover:bg-pink-600 text-white rounded-lg shadow-sm transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Join Chat to Share Photos
                </a>
            </div>
        @endif
    </div>

    <!-- Bottom Spacing -->
    <div class="h-8"></div>
</div>

<!-- Photo Detail Modal -->
<div id="photoDetailModal" class="fixed inset-0 bg-black bg-opacity-95 hidden z-50 flex items-center justify-center p-4">
    <div class="relative w-full h-full flex items-center justify-center">
        <!-- Close Button -->
        <button id="closePhotoDetail"
            class="absolute top-4 right-4 z-10 w-12 h-12 bg-black bg-opacity-50 hover:bg-black hover:bg-opacity-70 text-white rounded-full flex items-center justify-center transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Previous Button -->
        <button id="prevPhoto"
            class="absolute left-4 top-1/2 transform -translate-y-1/2 z-10 w-12 h-12 bg-black bg-opacity-50 hover:bg-black hover:bg-opacity-70 text-white rounded-full flex items-center justify-center transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <!-- Next Button -->
        <button id="nextPhoto"
            class="absolute right-4 top-1/2 transform -translate-y-1/2 z-10 w-12 h-12 bg-black bg-opacity-50 hover:bg-black hover:bg-opacity-70 text-white rounded-full flex items-center justify-center transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Image Container -->
        <div class="w-full h-full flex items-center justify-center p-8">
            <!-- Loading for modal image -->
            <div id="modalImageLoading" class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="text-center text-white">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-white mx-auto mb-4"></div>
                    <p>Loading image...</p>
                </div>
            </div>
            
            <img id="photoDetailImage" 
                 class="max-w-full max-h-full object-contain rounded-lg shadow-2xl opacity-0" 
                 alt="Photo Detail"
                 onload="this.style.opacity='1'; document.getElementById('modalImageLoading').style.display='none';"
                 onerror="document.getElementById('modalImageLoading').innerHTML='<div class=\'text-center text-white\'><svg class=\'w-12 h-12 mx-auto mb-4\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\'></path></svg><p>Failed to load image</p></div>';">
        </div>

        <!-- Photo Info -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-70 text-white px-6 py-3 rounded-full max-w-md text-center">
            <p id="photoCounter" class="text-sm font-medium mb-1"></p>
            <p id="photoTitle" class="text-xs opacity-80"></p>
            <p id="photoDescription" class="text-xs opacity-60 mt-1"></p>
        </div>

        <!-- Download Button -->
        <button id="downloadPhoto"
            class="absolute top-4 left-4 z-10 w-12 h-12 bg-black bg-opacity-50 hover:bg-black hover:bg-opacity-70 text-white rounded-full flex items-center justify-center transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Photo Gallery functionality
    const galleryItems = document.querySelectorAll('.gallery-item');
    const photoDetailModal = document.getElementById('photoDetailModal');
    const photoDetailImage = document.getElementById('photoDetailImage');
    const modalImageLoading = document.getElementById('modalImageLoading');
    const photoCounter = document.getElementById('photoCounter');
    const photoTitle = document.getElementById('photoTitle');
    const photoDescription = document.getElementById('photoDescription');
    const closePhotoDetail = document.getElementById('closePhotoDetail');
    const prevPhoto = document.getElementById('prevPhoto');
    const nextPhoto = document.getElementById('nextPhoto');
    const downloadPhoto = document.getElementById('downloadPhoto');
    const viewAllPhotos = document.getElementById('viewAllPhotos');
    
    let currentPhotoIndex = 0;
    let photos = [];
    
    // Build photos array
    galleryItems.forEach((item, index) => {
        photos.push({
            url: item.dataset.imageUrl,
            title: item.dataset.imageTitle || '',
            description: item.dataset.imageDescription || '',
            index: index
        });
    });
    
    // Add click event to gallery items
    galleryItems.forEach((item, index) => {
        item.addEventListener('click', function() {
            currentPhotoIndex = index;
            showPhotoDetail();
        });
    });
    
    // View All Photos button
    if (viewAllPhotos) {
        viewAllPhotos.addEventListener('click', function() {
            if (photos.length > 0) {
                currentPhotoIndex = 0;
                showPhotoDetail();
            }
        });
    }
    
    function showPhotoDetail() {
        if (photos.length === 0) return;
        
        const photo = photos[currentPhotoIndex];
        
        // Show modal first
        photoDetailModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Show loading
        modalImageLoading.style.display = 'flex';
        photoDetailImage.style.opacity = '0';
        
        // Update info
        photoCounter.textContent = `${currentPhotoIndex + 1} of ${photos.length}`;
        photoTitle.textContent = photo.title || '';
        photoDescription.textContent = photo.description || '';
        
        // Hide description if empty
        if (!photo.description) {
            photoDescription.style.display = 'none';
        } else {
            photoDescription.style.display = 'block';
        }
        
        // Load image
        photoDetailImage.src = photo.url;
        
        // Update navigation button states
        updateNavigationButtons();
    }
    
    function hidePhotoDetail() {
        photoDetailModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    function updateNavigationButtons() {
        // Show/hide navigation buttons based on photo count
        if (photos.length <= 1) {
            prevPhoto.style.display = 'none';
            nextPhoto.style.display = 'none';
        } else {
            prevPhoto.style.display = 'flex';
            nextPhoto.style.display = 'flex';
        }
    }
    
    // Navigation event listeners
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
    
    // Download functionality
    if (downloadPhoto) {
        downloadPhoto.addEventListener('click', function() {
            if (photos.length > 0) {
                const photo = photos[currentPhotoIndex];
                const link = document.createElement('a');
                link.href = photo.url;
                link.download = photo.title || `photo-${currentPhotoIndex + 1}`;
                link.target = '_blank';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                
                // Show toast notification
                showToast('Photo download started!');
            }
        });
    }
    
    // Close modal when clicking outside the image
    if (photoDetailModal) {
        photoDetailModal.addEventListener('click', function(e) {
            if (e.target === photoDetailModal) {
                hidePhotoDetail();
            }
        });
    }
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (!photoDetailModal.classList.contains('hidden')) {
            switch(e.key) {
                case 'ArrowLeft':
                    e.preventDefault();
                    prevPhoto.click();
                    break;
                case 'ArrowRight':
                    e.preventDefault();
                    nextPhoto.click();
                    break;
                case 'Escape':
                    e.preventDefault();
                    hidePhotoDetail();
                    break;
                case 's':
                case 'S':
                    if (e.ctrlKey || e.metaKey) {
                        e.preventDefault();
                        downloadPhoto.click();
                    }
                    break;
            }
        }
    });
    
    // Touch/swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    let touchStartY = 0;
    let touchEndY = 0;
    
    photoDetailModal.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
        touchStartY = e.changedTouches[0].screenY;
    });
    
    photoDetailModal.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        touchEndY = e.changedTouches[0].screenY;
        handleSwipe();
    });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        const diffX = touchStartX - touchEndX;
        const diffY = touchStartY - touchEndY;
        
        // Only handle horizontal swipes (ignore vertical)
        if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > swipeThreshold) {
            if (diffX > 0) {
                // Swipe left - next photo
                nextPhoto.click();
            } else {
                // Swipe right - previous photo
                prevPhoto.click();
            }
        }
    }
    
    // Toast notification function
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 z-50 px-4 py-2 rounded-lg shadow-lg text-white transform translate-x-full transition-transform duration-300 ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);
        
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                if (document.body.contains(toast)) {
                    document.body.removeChild(toast);
                }
            }, 300);
        }, 3000);
    }
    
    // Preload images for smoother experience
    function preloadImages() {
        photos.forEach((photo, index) => {
            if (index !== currentPhotoIndex) {
                const img = new Image();
                img.src = photo.url;
            }
        });
    }
    
    // Start preloading after initial load
    setTimeout(preloadImages, 2000);
    
    // Handle image loading errors in gallery
    document.querySelectorAll('.gallery-item img').forEach(img => {
        img.addEventListener('error', function() {
            this.style.display = 'none';
            const errorPlaceholder = this.nextElementSibling;
            if (errorPlaceholder && errorPlaceholder.classList.contains('error-placeholder')) {
                errorPlaceholder.style.display = 'flex';
            }
        });
        
        img.addEventListener('load', function() {
            this.style.opacity = '1';
            const loadingPlaceholder = this.previousElementSibling;
            if (loadingPlaceholder && loadingPlaceholder.classList.contains('loading-placeholder')) {
                loadingPlaceholder.style.display = 'none';
            }
        });
    });
});
</script>

<style>
/* Loading Animation */
@keyframes shimmer {
    0% {
        background-position: -200% 0;
    }
    100% {
        background-position: 200% 0;
    }
}

.loading-placeholder {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: shimmer 1.5s infinite;
}

/* Gallery Grid Enhancements */
.gallery-item {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    transform-style: preserve-3d;
}

.gallery-item:hover {
    transform: translateY(-4px) rotateY(2deg) rotateX(2deg);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

/* Image hover effects */
.gallery-item img {
    transition: all 0.4s ease;
}

.gallery-item:hover img {
    transform: scale(1.1);
    filter: brightness(1.1) contrast(1.1);
}

/* Love icon animation */
.gallery-item .transform {
    transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

/* Modal Enhancements */
#photoDetailModal {
    backdrop-filter: blur(8px);
}

#photoDetailImage {
    transition: opacity 0.3s ease;
}

/* Navigation Button Enhancements */
#prevPhoto, #nextPhoto, #closePhotoDetail, #downloadPhoto {
    backdrop-filter: blur(8px);
    transition: all 0.3s ease;
}

#prevPhoto:hover, #nextPhoto:hover, #closePhotoDetail:hover, #downloadPhoto:hover {
    transform: scale(1.1);
    backdrop-filter: blur(12px);
}

/* View All Button */
#viewAllPhotos:hover {
    transform: scale(1.05) translateY(-1px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .gallery-item:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    
    #prevPhoto, #nextPhoto, #closePhotoDetail, #downloadPhoto {
        width: 48px;
        height: 48px;
    }
    
    #prevPhoto {
        left: 8px;
    }
    
    #nextPhoto {
        right: 8px;
    }
    
    #closePhotoDetail {
        top: 8px;
        right: 8px;
    }
    
    #downloadPhoto {
        top: 8px;
        left: 8px;
    }
}

/* Focus States for Accessibility */
button:focus, a:focus {
    outline: 3px solid #f59e0b;
    outline-offset: 2px;
}

/* Pulse animation for love icon */
@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

.gallery-item:hover .bg-white.bg-opacity-90 svg {
    animation: pulse 1s infinite;
}

/* Custom Selection */
::selection {
    background-color: #f59e0b;
    color: white;
}

/* Reduced Motion Support */
@media (prefers-reduced-motion: reduce) {
    .gallery-item,
    .gallery-item img,
    #photoDetailImage,
    button,
    .loading-placeholder {
        transition: none;
        animation: none;
    }
    
    .gallery-item:hover {
        transform: none;
    }
    
    .gallery-item:hover .bg-white.bg-opacity-90 svg {
        animation: none;
    }
}
</style>
@endsection
