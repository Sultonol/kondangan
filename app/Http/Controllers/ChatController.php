<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Message;
use App\Models\Participant;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function room(Event $event)
    {
        // Load participants and messages
        $event->load(['participants', 'messages.participant']);
        
        // Get messages for this event
        $messages = $event->messages()->with('participant')->latest()->take(50)->get()->reverse();
        
        return view('chat.room', compact('event', 'messages'));
    }

    public function sendMessage(Request $request, Event $event)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $participantId = session('participant_id');
        
        if (!$participantId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $participant = Participant::find($participantId);
        
        if (!$participant || $participant->event_id !== $event->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Create message
        $message = Message::create([
            'event_id' => $event->id,
            'participant_id' => $participant->id,
            'message' => $request->message,
            'sent_at' => now()
        ]);

        // Load participant relationship
        $message->load('participant');

        // Update participant last seen
        $participant->update(['last_seen' => now()]);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'message' => $message->message,
                'sent_at' => $message->sent_at,
                'participant' => [
                    'id' => $participant->id,
                    'name' => $participant->name
                ]
            ]
        ]);
    }

    public function profile(Event $event, Participant $participant)
    {
        // Make sure participant belongs to this event
        if ($participant->event_id !== $event->id) {
            abort(404);
        }

        return view('chat.profile', compact('event', 'participant'));
    }
}
