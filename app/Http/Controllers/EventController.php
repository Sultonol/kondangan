<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function join(Request $request)
    {
        $request->validate([
            'invitation_code' => 'required|string',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20'
        ]);

        $event = Event::where('invitation_code', $request->invitation_code)
                     ->where('is_active', true)
                     ->first();

        if (!$event) {
            return back()->withErrors(['invitation_code' => 'Kode undangan tidak valid atau acara sudah berakhir.']);
        }

        // Check if participant already exists
        $participant = Participant::where('event_id', $event->id)
                                 ->where('name', $request->name)
                                 ->first();

        if (!$participant) {
            $participant = Participant::create([
                'event_id' => $event->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'joined_at' => now(),
                'is_online' => true,
                'last_seen' => now()
            ]);
        } else {
            $participant->update([
                'is_online' => true,
                'last_seen' => now()
            ]);
        }

        session(['participant_id' => $participant->id]);

        return redirect()->route('chat.room', $event->id);
    }

    public function showJoinForm()
    {
        return view('join');
    }
}
