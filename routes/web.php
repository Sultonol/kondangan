<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FileUploadController;
use App\Models\Event;
use App\Models\Media;

Route::get('/', [EventController::class, 'showJoinForm'])->name('join.form');
Route::post('/join', [EventController::class, 'join'])->name('join');

// Debug route untuk cek data
Route::get('/debug-data', function() {
    $event = Event::first();
    
    if (!$event) {
        return 'No event found';
    }
    
    $allMedia = Media::where('event_id', $event->id)->get();
    $images = Media::where('event_id', $event->id)->where('type', 'image')->get();
    $videos = Media::where('event_id', $event->id)->where('type', 'video')->get();
    
    return [
        'event_id' => $event->id,
        'event_title' => $event->title,
        'all_media_count' => $allMedia->count(),
        'all_media' => $allMedia->map(function($media) {
            return [
                'id' => $media->id,
                'title' => $media->title,
                'file_path' => $media->file_path,
                'type' => $media->type,
                'url' => $media->url,
                'file_exists' => $media->fileExists(),
                'full_path' => $media->full_path
            ];
        }),
        'images_count' => $images->count(),
        'images' => $images->map(function($image) {
            return [
                'id' => $image->id,
                'title' => $image->title,
                'file_path' => $image->file_path,
                'type' => $image->type,
                'url' => $image->url,
                'file_exists' => $image->fileExists(),
                'full_path' => $image->full_path
            ];
        }),
        'videos_count' => $videos->count(),
        'videos' => $videos->map(function($video) {
            return [
                'id' => $video->id,
                'title' => $video->title,
                'file_path' => $video->file_path,
                'type' => $video->type,
                'url' => $video->url,
                'file_exists' => $video->fileExists(),
                'full_path' => $video->full_path
            ];
        }),
        'storage_path' => storage_path('app/public'),
        'public_path' => public_path('storage')
    ];
});

Route::middleware(['participant'])->group(function () {
    Route::get('/chat/{event}', [ChatController::class, 'room'])->name('chat.room');
    Route::post('/chat/{event}/message', [ChatController::class, 'sendMessage'])->name('chat.send');
    // Route::get('/chat/{event}/profile/{participant}', [ChatController::class, 'profile'])->name('chat.profile');
    
    // Event routes
    Route::get('/event/{event}/description', [EventController::class, 'description'])->name('event.description');
    
    // Chat API routes
    Route::get('/chat/{event}/videos', [ChatController::class, 'getVideos'])->name('chat.videos');
    
    // File upload routes
    Route::post('/event/{event}/upload-media', [FileUploadController::class, 'uploadMedia'])->name('event.upload.media');
    Route::post('/event/{event}/upload-dress-code', [FileUploadController::class, 'uploadDressCode'])->name('event.upload.dress-code');
    Route::post('/event/{event}/add-schedule', [FileUploadController::class, 'addSchedule'])->name('event.add.schedule');
    Route::post('/event/{event}/add-bank', [FileUploadController::class, 'addBank'])->name('event.add.bank');
});

// Public routes (tidak perlu middleware participant)
Route::get('/event/{event}', [EventController::class, 'description'])->name('event.public.description');

// Storage link route (untuk development)
Route::get('/storage-link', function() {
    if (app()->environment('local')) {
        $target = storage_path('app/public');
        $link = public_path('storage');
        
        if (file_exists($link)) {
            return 'Storage link already exists';
        }
        
        symlink($target, $link);
        return 'Storage link created successfully';
    }
    
    return 'Not allowed in production';
});

Route::get('/event/{event}/gallery', [EventController::class, 'gallery'])->name('event.gallery');
