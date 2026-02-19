<?php
namespace App\Http\Controllers\DashboardController;
use App\Http\Controllers\Controller;
use Illuminate\View\Component;
use Illuminate\Http\Request;
use App\Models\ExamRoom;
use Illuminate\Support\Facades\Log;

class LiveScoreController extends Controller
{
  public function saveAnswer(Request $request)
{
    $examRoom = Examroom::where('exam_id', $request->exam_id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $saved = $examRoom->is_saved ?? [];

    $saved[$request->question_id] = $request->option_id;

    $examRoom->is_saved = $saved;

    // Recalculate score
    $score = $this->calculateScore($saved, $request->exam_id);

    $examRoom->score = $score;
    $examRoom->save();

    broadcast(new livescore($score));

    return response()->json(['success' => true]);
}

}
