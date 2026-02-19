<?php
namespace App\Http\Controllers\DashboardController;

use App\Events\ExamStarted;
use App\Http\Controllers\Controller;
use App\Models\ExamList;
use App\Models\ExamRoom;
use App\Models\answers;
use App\Models\questions;
use App\Models\User;
use App\Events\livescore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class ExamRoomController extends Controller
{

    protected $correct_answer;
    public $joined_subjects;
    public $examId;
    public $exam_room;
    public $livescore;

    public array $remarkedQuestion;

    public function __construct()
    {
        $student_id = auth()->id();

        $exam_room_status = ExamRoom::where('user_id', $student_id)->get();
        foreach ($exam_room_status as $room) {
            if ($room['status'] === 'joined') {
                $this->joined_subjects[] = $room['subject_code'];
            }
        }

        $this->exam_room = ExamRoom::where('user_id', $student_id)->first();
    }

    public function index()
    {
        $examroom = ExamRoom::where('user_id', auth()->id())->first();
        // dd($examroom);
        if ($examroom == null) {
            return redirect()->route('join-slot');
        }
            $this->examId = $this->exam_room->exam_id;

        $questions = Questions::with(['answers' => function ($query) {
            $query->select('id', 'question_id', 'option_value', 'c_answer');
        }])
        
            ->where('exam_id', $this->examId)
            ->get();

        $exam_room_total_questions = $questions->count();

        Redis::set('questions'. $this->examId, json_encode($questions));

        // / Retrieve
        $data = json_decode(Redis::get('questions'. $this->examId), true);


        $student_id = auth()->id();
        $remarkedQuestion = $this->exam_room->is_marked;
        $questionCount = null;
        $saved_question = $this->exam_room->is_saved;
        $exam_room_code = null;
        $question_id = null;
        $option_id = null;
        $exam_room_duration = null;
        $exam_room_subject_name = null;
        $joined_subjects = $this->joined_subjects ?? [];
        $livescore = null;

        $booked_slot_count = null;

        if ($this->exam_room) {
            $booked_slot_count = ExamRoom::where('status', 'joined')->where('exam_id', $this->examId)->count();
           
            $exam = ExamList::find($this->examId);

            if ($exam) {
                $exam_room_code = $exam->subject_code;
                $questions = Questions::with('answers')->where('exam_id', $this->examId)->select('id','question')->first();
                $question_id = $questions->id;
                $question_title = $questions->question;
              
                $option_id = $questions->answers->where('c_answer', true)->first()->id;
                $exam_room_duration = sprintf('%02d:00', $exam->exam_duration);
                $exam_room_start_time = $exam->exam_start_time;
                $exam_room_id = $exam->id;
                $livescore = $examroom->score;
                $exam_room_subject_name = $exam->subject_name;
                $questionCount = Questions::get()->where('exam_id', $this->examId)->all();
            }
        }

        return view('Dashboard.Exam.students-exam', compact(
            'joined_subjects',
            'exam_room_code',
            'exam_room_duration',
            'exam_room_start_time',
            'exam_room_subject_name',
            'booked_slot_count',
            'questionCount',
            'questions',
            'option_id',
            'remarkedQuestion',
            'saved_question',
            'question_id',
            'question_title',
            'exam_room_total_questions',
            'exam_room_id',
            'livescore'
            
        ));
    }
public function ChangeQuestions(Request $request)
{
    $request->validate([
        'index'   => 'required|integer|min:0',
        'exam_id' => 'required|integer'
    ]);

    $index  = (int) $request->index;
    $examId = $request->exam_id;

    $questions = Redis::get('questions' . $examId);

    if (!$questions) {
        return response()->json([
            'current_question' => null,
            'current_options'  => null,
            'error_view' => view('components.erroralert-msg', [
                'msg' => 'Questions not found. Please refresh exam.'
            ])->render()
        ]);
    }

    $questions = json_decode($questions, true);
  //  dd($questions);

    if (!isset($questions[$index])) {
        return response()->json([
            'current_question' => null,
            'current_options'  => null,
            'error_view' => view('components.erroralert-msg', [
                'msg' => 'No more questions'
            ])->render()
        ]);
    }

    return response()->json([
        'current_question' => $questions[$index]['question'],
        'current_options'  => $questions[$index]['answers'],
    ]);
    
}


    public function SubmitAnswer(Request $request)
    {

       $examquestionid = $request->question_id;
        $examAnswerId = $request->option_id;
     
        $examRoom = ExamRoom::where('user_id', auth()->id())
            ->where('exam_id', $this->exam_room->exam_id)
            ->firstOrFail();
  
        $saved = $examRoom->is_saved ?? [];
    
        if (in_array((int) $examquestionid, $saved, true)) {
            return response()->json([
                'remark_added' => false,
                'marked_questions' => $examRoom->is_marked ?? [],
                'error_view' => view('components.erroralert-msg', [
                    'msg' => 'Question already saved'
                ])->render()
            ]);
        }
    
        if ($request->marked_value === 'review_makred') {
            return $this->ReviewMarked($request, $examRoom);
        }
    
        if ($request->marked_value === 'save_answer') {
            return $this->SaveAnswer($request, $examRoom);
        }
    }
    
    public function ReviewMarked(Request $request, ExamRoom $examRoom)
    {


       $examquestionid = $request->question_id;
        $examAnswerId = $request->option_id;
     
        [$updatedList, $errorView] = $this->updateList(
            $examRoom->is_marked ?? [],
            (int) $examquestionid,
            'Question marked for review'
        );

       $examRoom->update(['is_marked' => $updatedList]);
    
        return response()->json([
            'remark_added' => true,
            'marked_questions' => $updatedList,
            'error_view' => $errorView
        ]);
    }
    
public function SaveAnswer(Request $request, ExamRoom $examRoom)
{
    $questionId = (int) $request->question_id;
    $selectedOptionId = (int) $request->option_id;

    
    if (!$selectedOptionId) {
        return response()->json([
            'question_saved' => false,
            'error_view' => view('components.erroralert-msg', ['msg' => 'No option selected'])->render()
        ]);
    }

    $question = Questions::with('answers')->findOrFail($questionId);

    $correctAnswer = $question->answers->firstWhere('c_answer', 1);

    $isCorrect = $correctAnswer && (int)$correctAnswer->id === $selectedOptionId;

    if ($isCorrect) {
        $examRoom->increment('score', 10);
    }
    $marked = $examRoom->is_marked ?? [];
    if (in_array($questionId, $marked, true)) {
        $marked = array_values(array_diff($marked, [$questionId]));
        $examRoom->is_marked = $marked;
    }

    $saved = $examRoom->is_saved ?? [];
    if (!in_array($questionId, $saved, true)) {
        $saved[] = $questionId;
        $examRoom->is_saved = $saved;
    }


    $examRoom->save();

    [$updatedList, $errorView] = $this->updateList(
        $saved,
        $questionId,
        'Question saved',
        true,
        'success'
    );


    
  $response = response()->json([
        'question_saved'  => true,
        'saved_questions' => $updatedList,
        'error_view'      => $errorView,
        'was_correct'     => $isCorrect,
        'current_score'   => (int) $examRoom->score,
    ]);

    if($response){
        $livescore = new livescore($examRoom->score);
        broadcast($livescore)->toOthers();
    }
    return $response;

  
    
}
    private function updateList(array $list, int $question_id, string $message, bool $forceAdd = false, string $type = 'info'): array
    {
        if ($forceAdd || !in_array($question_id, $list, true)) {
            $list[] = $question_id;
            if ($type === 'success') {
                $view = view('components.successalert-msg', ['msg' => $message])->render();
            } elseif ($type === 'warning') {
                $view = view('components.warningalert-msg', ['msg' => $message])->render();
            } else {
                $view = view('components.infoalert-msg', ['msg' => $message])->render();
            }
        } else {
            $list = array_values(array_diff($list, [$question_id]));
            if ($type === 'success') {
                $view = view('components.successalert-msg', ['msg' => $message])->render();
            } elseif ($type === 'warning') {
                $view = view('components.warningalert-msg', ['msg' => $message])->render();
            } else {
                $view = view('components.infoalert-msg', ['msg' => $message])->render();
            }
        }
    
        return [$list, $view];
    }
    
}