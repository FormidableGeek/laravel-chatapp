<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class sendMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct($message,$chatId)
    {
        // Store the message so that it can be broadcasted
        $this->message = $message;
        $this->chatId=$chatId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // Broadcasting on a private channel, with a unique identifier (e.g., User ID)
        return [
            new Channel('send-message.'.$this->chatId),
        ];
    }

    /**
     * Set the event alias name (optional).
     */
    public function broadcastAs() {
        return 'message.sent';
    }

    /**
     * Broadcast the data that will be sent with the event.
     */
    public function broadcastWith() {
        return [
            'message' => $this->message
        ];
    }
}
