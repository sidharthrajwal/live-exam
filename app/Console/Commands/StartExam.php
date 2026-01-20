<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ExamList;
use App\Events\ExamStarted;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class StartExam extends Command
{
    protected $signature = 'app:start-exam';
    protected $description = 'Trigger exam start/end events based on start time';

    public function handle()
    {
        $now = Carbon::now();

        Log::info('Current Time: ' . $now->format('H:i:s'));

        $exams = ExamList::whereTime('exam_start_time', '>=', $now->format('H:i:s'))->get();

        Log::info('Found ' . $exams->count() . ' exams.');
       

        foreach ($exams as $exam) {

            $examStart = Carbon::parse($exam->exam_start_time);
            $minutesPassed = $examStart->diffInMinutes($now, false);

            Log::info("Exam Start: {$examStart->format('H:i:s')}");
            Log::info("Current Time: {$now->format('H:i:s')}");
            Log::info("Minutes Passed: $minutesPassed");

            // Exam ended
            if ($minutesPassed >= $exam->exam_duration) {
                event(new ExamStarted( $exam,'exam ended'));
                Log::info('Exam ended event fired');
            } 
            // Exam running
              
            elseif($now->greaterThanOrEqualTo($examStart)) {
                event(new ExamStarted($exam,'exam started'));
                Log::info('Exam started event fired');
            }
            // Log::info("new", $now->greaterThanOrEqualTo($examStart));
        }

        $this->info('Exam scheduler executed successfully.');
    }
}
