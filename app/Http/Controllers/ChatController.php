<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Message;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function room($eventId)
    {
        $participantId = session('participant_id');
        
        if (!$participantId) {
            return redirect()->route('join.form');
        }

        $event = Event::with(['participants', 'media'])->findOrFail($eventId);
        $participant = Participant::findOrFail($participantId);
        
        // Verify participant belongs to this event
        if ($participant->event_id != $eventId) {
            return redirect()->route('join.form');
        }

        $messages = Message::with('participant')
                          ->where('event_id', $eventId)
                          ->orderBy('created_at', 'asc')
                          ->get();

        return view('chat.room', compact('event', 'participant', 'messages'));
    }

    public function sendMessage(Request $request, $eventId)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $participantId = session('participant_id');
        $participant = Participant::findOrFail($participantId);

        $message = Message::create([
            'event_id' => $eventId,
            'participant_id' => $participantId,
            'message' => $request->message,
            'type' => 'text'
        ]);

        $message->load('participant');

        // Broadcast message (you'll need to set up Pusher or WebSockets)
        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    public function profile($eventId, $participantId)
    {
        $event = Event::with('media')->findOrFail($eventId);
        $participant = Participant::findOrFail($participantId);

        return view('chat.profile', compact('event', 'participant'));
    }
}
