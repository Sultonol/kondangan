<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Show join form untuk event aktif
     */
    public function showJoinForm()
    {
        $event = Event::where('is_active', true)->first();
        
        if (!$event) {
            return view('join')->with('error', 'Tidak ada acara yang aktif saat ini');
        }
        
        return view('join', compact('event'));
    }

    /**
     * Handle join request (anonymous join tanpa nama)
     */
    public function join(Request $request)
    {
        // Ambil event aktif pertama
        $event = Event::where('is_active', true)->first();
        
        if (!$event) {
            return back()->withErrors(['event' => 'Tidak ada acara yang aktif saat ini.']);
        }

        // Generate unique session ID jika belum ada
        $sessionId = session()->getId();
        
        // Check if participant with same session already exists in this event
        $existingParticipant = Participant::where('event_id', $event->id)
            ->where('session_id', $sessionId)
            ->first();

        if ($existingParticipant) {
            // If participant exists, just update status
            $existingParticipant->setOnline();

            session([
                'participant_id' => $existingParticipant->id,
                'event_id' => $event->id
            ]);

            return redirect()->route('chat.room', $event->id)
                ->with('success', 'Selamat datang kembali!');
        }

        // Create new participant tanpa nama (akan diisi saat kirim pesan pertama)
        $participant = Participant::create([
            'event_id' => $event->id,
            'name' => null, // Nama akan diisi saat kirim pesan pertama
            'phone' => null,
            'session_id' => $sessionId,
            'is_online' => true,
        ]);

        session([
            'participant_id' => $participant->id,
            'event_id' => $event->id
        ]);

        return redirect()->route('chat.room', $event->id)
            ->with('success', 'Berhasil bergabung ke grup chat!');
    }

    /**
     * Show event description page
     */
    public function description(Event $event)
    {
        // Load all necessary relationships
        $event->load([
            'participants',
            'media',
            'schedules' => function($query) {
                $query->orderBy('order')->orderBy('start_time');
            },
            'banks'
        ]);

        // Get images and videos from media
        $images = $event->media()->where('type', 'image')->get();
        $videos = $event->media()->where('type', 'video')->get();
        
        // Get first video for main display
        $mainVideo = $videos->first();
        
        // Get schedules and banks
        $schedules = $event->schedules;
        $banks = $event->banks;

        return view('event.description', compact(
            'event', 
            'images', 
            'videos', 
            'mainVideo',
            'schedules', 
            'banks'
        ));
    }

    public function gallery(Event $event){
        $images = $event->media()->where('type', 'image')->get();
        return view('event.gallery', compact('event', 'images'));
    }
}
