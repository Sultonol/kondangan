<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Message;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function room(Event $event)
    {
        // Get messages for this event with WIB timezone
        $messages = $event->messages()
            ->with('participant')
            ->latest()
            ->take(50)
            ->get()
            ->reverse()
            ->map(function ($message) {
                // Convert to WIB timezone
                $message->created_at = $message->created_at->setTimezone('Asia/Jakarta');
                return $message;
            });

        // Check if location has already been shared
        $locationShared = $event->messages()
            ->where('attachment_type', 'location')
            ->exists();

        // Get location message details if exists
        $locationMessage = null;
        if ($locationShared) {
            $locationMessage = $event->messages()
                ->where('attachment_type', 'location')
                ->with('participant')
                ->first();
            if ($locationMessage) {
                $locationMessage->created_at = $locationMessage->created_at->setTimezone('Asia/Jakarta');
            }
        }

        // Get videos from media for video call
        $videos = $event->media()
            ->where('type', 'video')
            ->get();

        // Get first video for main video call
        $mainVideo = $videos->first();

        // Get current participant info
        $currentParticipant = null;
        $participantId = session('participant_id');
        if ($participantId) {
            $currentParticipant = Participant::find($participantId);
        }
                    
        return view('chat.room', compact('event', 'messages', 'videos', 'mainVideo', 'currentParticipant', 'locationShared', 'locationMessage'));
    }

    public function sendMessage(Request $request, Event $event)
    {
        // Rate limiting untuk chat
        $participantId = session('participant_id');
        $key = 'chat:' . ($participantId ?: $request->ip());
                
        if (RateLimiter::tooManyAttempts($key, 30)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'error' => "Terlalu banyak pesan. Coba lagi dalam {$seconds} detik."
            ], 429);
        }

        RateLimiter::hit($key, 60); // 1 minute

        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            'location_lat' => 'nullable|numeric',
            'location_lng' => 'nullable|numeric',
            'location_name' => 'nullable|string|max:255',
            'location_url' => 'nullable|url'
        ]);
                        
        if (!$participantId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $participant = Participant::find($participantId);
                        
        if (!$participant || $participant->event_id !== $event->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Check if at least message or attachment is provided
        if (empty($request->message) && !$request->hasFile('image') && !$request->location_lat) {
            return response()->json([
                'error' => 'Please enter a message, upload an image, or share a location'
            ], 422);
        }

        // Update participant name
        $participant->update(['name' => $request->name]);

        // Prepare message data with WIB timezone - PERBAIKAN TIMEZONE
        $wibTime = Carbon::now('Asia/Jakarta');
        $messageData = [
            'event_id' => $event->id,
            'participant_id' => $participant->id,
            'sender_name' => $request->name,
            'message' => $request->message ?: '',
            'created_at' => $wibTime,
            'updated_at' => $wibTime
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('chat/images', $filename, 'public');
                        
            $messageData['attachment_type'] = 'image';
            $messageData['attachment_data'] = $path;
            $messageData['attachment_url'] = asset('storage/' . $path);
        }

        // Handle location sharing - REMOVED VALIDATION FOR MULTIPLE LOCATIONS
        if ($request->location_lat && $request->location_lng) {
            $locationData = [
                'lat' => $request->location_lat,
                'lng' => $request->location_lng,
                'name' => $request->location_name ?: 'Event Location',
                'url' => $request->location_url ?: "https://www.google.com/maps?q={$request->location_lat},{$request->location_lng}",
                'is_wedding_venue' => $request->is_wedding_venue === 'true'
            ];
                        
            $messageData['attachment_type'] = 'location';
            $messageData['attachment_data'] = json_encode($locationData);
            $messageData['attachment_url'] = $locationData['url'];
        }

        // Create message
        $message = Message::create($messageData);

        // Load participant relationship
        $message->load('participant');

        // Set timezone to WIB for response - PERBAIKAN TIMEZONE
        $message->created_at = $message->created_at->setTimezone('Asia/Jakarta');

        // Update participant last seen
        $participant->updateLastSeen();

        // BROADCAST THE MESSAGE EVENT FOR REALTIME
        event(new MessageSent($message));

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'message' => $message->message,
                'created_at' => $message->created_at->format('H:i'), // FORMAT WIB
                'created_at_full' => $message->created_at->format('Y-m-d H:i:s'), // FULL TIMESTAMP WIB
                'sender_name' => $message->sender_name,
                'attachment_type' => $message->attachment_type,
                'attachment_url' => $message->attachment_url,
                'attachment_data' => $message->attachment_data,
                'location_data' => $message->getLocationData(),
                'timezone' => 'WIB', // TAMBAHAN TIMEZONE INFO
                'participant' => [
                    'id' => $participant->id,
                    'name' => $participant->name
                ]
            ]
        ]);
    }

    public function getVideos(Event $event)
    {
        $videos = $event->media()
            ->where('type', 'video')
            ->get()
            ->map(function($video) {
                return [
                    'id' => $video->id,
                    'title' => $video->title,
                    'description' => $video->description,
                    'url' => $video->url,
                    'file_exists' => $video->fileExists()
                ];
            });

        return response()->json([
            'videos' => $videos,
            'main_video' => $videos->first()
        ]);
    }
}
