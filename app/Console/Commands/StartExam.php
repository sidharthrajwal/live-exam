<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ExamList;
use App\Events\ExamStarted;
use App\Models\ExamRoom;
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

    $examEndlist = ExamList::get();

    // ---------- END EXAMS ----------
  foreach ($examEndlist as $exam) {

    $examStart = Carbon::parse($exam->exam_start_time);
    $secondsPassed = $examStart->diffInSeconds($now, false);
    $durationInSec = ((int)$exam->exam_duration) * 60;

    if ($secondsPassed >= $durationInSec) {

        $updated = ExamRoom::where('exam_id', $exam->id)
            ->where('examlivestatus', 'running')
            ->update(['examlivestatus' => 'ended']);

        if ($updated) {
            event(new ExamStarted($exam, 'exam ended'));
            Log::info("Exam {$exam->subject_code} ended");
        }
    }
}


    // ---------- START EXAMS ----------
    $examsToStart = ExamList::whereTime('exam_start_time', '<=', $now->format('H:i:s'))->get();

    Log::info('Found ' . $examsToStart->count() . ' exams to start.');

    foreach ($examsToStart as $exam) {
        

        $examRoom = ExamRoom::where('exam_id', $exam->id)->first();

        if (!$examRoom) {
            Log::warning("No ExamRoom found for exam_id: {$exam->id}");
            continue;
        }

        $examStart = Carbon::parse($exam->exam_start_time);

        Log::info("Exam Start: {$examStart->format('H:i:s')}");
        Log::info("Current Time: {$now->format('H:i:s')}");

$diff = $examStart->diffInSeconds($now, false); // can be negative
if ($now->greaterThanOrEqualTo($examStart)
    && $examRoom->examlivestatus !== 'running') {

            event(new ExamStarted($exam, 'exam started'));
            $examRoom->update(['examlivestatus' => 'running']);

            Log::info('Exam running status set');
        }
    }

    $this->info('Exam scheduler executed successfully.');
}



}
