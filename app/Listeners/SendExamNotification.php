<?php

namespace App\Listeners;

use App\Events\ExamStarted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendExamNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ExamStarted $event): void
    {
       
        echo "Exam started";
    }
}
