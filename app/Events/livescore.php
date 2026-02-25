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
    public $topThree;
    public $examId;

    /**
     * Create a new event instance.
     */
    public function __construct($livescore, $topThree = [], $examId)
    {

        Log::info('LiveScore Event Fired: ' . $livescore); 
   Log::info('LiveScore Event Fired', [
    'topThree' => $topThree
]);
        Log::info('LiveScore Event Fired: ' . $examId); 
        $this->livescore = $livescore;
        $this->topThree = $topThree;
        $this->examId = $examId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
                 new Channel('exam.' . $this->examId),
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
            'topThree' => $this->topThree,
            'examId' => $this->examId,
        ];
    }
}
