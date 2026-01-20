<?php

namespace App\Events;

use Carbon\Carbon;
use App\Models\ExamList;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExamStarted implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $message;
    public int $examId;
    public int $remainingSeconds;


    public function __construct(ExamList $exam , $message)
    {
        $this->message = $message;
        $this->examId = $exam->id;
      
        $end = Carbon::parse($exam->exam_start_time)
            ->addMinutes(((int)$exam->exam_duration));

        $this->remainingSeconds = max(0, now()->diffInSeconds($end, false));
    }
    /**     
     * Get the channe   ls the event should broadcast on.
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
        return 'ExamStarted';
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'examId' => $this->examId,
            'remainingSeconds' => $this->remainingSeconds,
        ];
    }
}
