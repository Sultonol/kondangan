<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
        // Pastikan timezone WIB
        $this->message->created_at = $this->message->created_at->setTimezone('Asia/Jakarta');
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('chat.' . $this->message->event_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'message.sent';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->message->id,
            'message' => $this->message->message,
            'sender_name' => $this->message->sender_name,
            'attachment_type' => $this->message->attachment_type,
            'attachment_url' => $this->message->attachment_url,
            'attachment_data' => $this->message->attachment_data,
            'location_data' => $this->message->getLocationData(),
            'participant' => [
                'id' => $this->message->participant->id,
                'name' => $this->message->participant->name,
                'avatar' => $this->message->participant->avatar ?? null
            ],
            'created_at' => $this->message->created_at->format('H:i'), // Format WIB
            'created_at_full' => $this->message->created_at->format('Y-m-d H:i:s'), // Full timestamp WIB
            'timezone' => 'WIB'
        ];
    }
}
