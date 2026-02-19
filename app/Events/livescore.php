<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\ExamRoom;
use Illuminate\Support\Facades\Log;

class livescore implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $livescore;
    /**
     * Create a new event instance.
     */
    public function __construct($livescore)
    {

        Log::info('LiveScore Event Fired: ' . $livescore); 
        $this->livescore = $livescore;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('test'),
        ];
    }

    public function broadcastAs()
    {
        return 'livescore';
    }

    public function broadcastWith()
    {
        return [
            'livescore' => $this->livescore,
        ];
    }
}
