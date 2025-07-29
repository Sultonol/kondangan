<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function showJoinForm()
    {
        $event = Event::where('is_active', true)->first();

        if (!$event) {
            return view('join')->with('error', 'Tidak ada acara yang aktif saat ini');
        }

        return view('join', compact('event'));
    }

    public function join(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20'
        ]);

        // Ambil event aktif pertama atau sesuaikan dengan kebutuhan
        $event = Event::where('is_active', true)->first();

        if (!$event) {
            return back()->withErrors(['event' => 'Tidak ada acara yang aktif saat ini.']);
        }

        // Check if participant with same name already exists in this event
        $existingParticipant = Participant::where('event_id', $event->id)
            ->where('name', $request->name)
            ->first();

        if ($existingParticipant) {
            // If participant exists, just login (update status and phone if provided)
            $existingParticipant->update([
                'phone' => $request->phone ?: $existingParticipant->phone,
                'is_online' => true,
                'last_seen' => now()
            ]);

            session([
                'participant_id' => $existingParticipant->id,
                'event_id' => $event->id
            ]);

            return redirect()->route('chat.room', $event->id)
                ->with('success', 'Selamat datang kembali, ' . $existingParticipant->name . '!');
        }

        // Create new participant
        $participant = Participant::create([
            'event_id' => $event->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'joined_at' => now(),
            'is_online' => true,
            'last_seen' => now()
        ]);

        session([
            'participant_id' => $participant->id,
            'event_id' => $event->id
        ]);

        return redirect()->route('chat.room', $event->id)
            ->with('success', 'Berhasil bergabung ke grup chat!');
    }

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

        // Get images and videos from media - Perbaiki query untuk video
        $images = $event->media()->where('type', 'image')->get();
        $videos = $event->media()->where('type', 'video')->first(); // Ambil video pertama
        
        // Debug videos
        // \Log::info('Videos Query Result: ', $videos ? $videos->toArray() : ['No video found']);
        
        // Get schedules and banks
        $schedules = $event->schedules;
        $banks = $event->banks;
        
        return view('event.description', compact('event', 'images', 'videos', 'schedules', 'banks'));
    }
}
