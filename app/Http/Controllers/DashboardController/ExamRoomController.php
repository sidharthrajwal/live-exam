<?php
namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use App\Models\ExamList;
use App\Models\ExamRoom;
use App\Models\answers;
use App\Models\questions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\View\Component;

class ExamRoomController extends Controller
{
    public $joined_subjects;
    public $examId;
    public $exam_room;

    public array $remarked_question;

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

        Redis::set('questions', json_encode($questions));

        // / Retrieve
        $data = json_decode(Redis::get('questions'), true);

        // dd($data);

        $student_id = auth()->id();
        $remarked_question = $this->exam_room->is_marked;

        $saved_question = $this->exam_room->is_saved;
        $exam_room_code = null;
        $question_id = null;
        $option_id = null;
        $exam_room_duration = null;
        $exam_room_subject_name = null;
        $joined_subjects = $this->joined_subjects ?? [];

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
                $exam_room_subject_name = $exam->subject_name;
            }
        }

        return view('Dashboard.Exam.students-exam', compact(
            'joined_subjects',
            'exam_room_code',
            'exam_room_duration',
            'exam_room_subject_name',
            'booked_slot_count',
            'questions',
            'option_id',
            'remarked_question',
            'saved_question',
            'question_id',
            'question_title'
        ));
    }

    public function ChangeQuestions(Request $request)
    {
        $index = $request->index;
        // dd($index);
        $questions = Redis::get('questions');

        $questions = json_decode($questions, true);

        if ($index >= count($questions)) {
            return response()->json(['current_question' => null, 'current_options' => null,  'error_view' => view('components.erroralert-msg', [
        'msg' => 'No more questions'
    ])->render()]);
        }

        $current_id = $questions[$index]['id'];
        // dd($current_id);

        $current_question = $questions[$index]['question'];

        $current_options = $questions[$index]['answers'];

        return response()->json(['current_question' => $current_question, 'current_options' => $current_options, ]);
    }

   public function SubmitAnswer(Request $request)
{
    $examRoom = ExamRoom::where('user_id', auth()->id())
        ->where('exam_id', $this->exam_room->exam_id)
        ->firstOrFail();

    $saved = $examRoom->is_saved ?? [];

    if (in_array((int) $request->index, $saved, true)) {
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
        [$updatedList, $errorView] = $this->updateList(
            $examRoom->is_marked ?? [],
            (int) $request->index,
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
         

         $user_score = [];     

        $marked = $examRoom->is_marked ?? [];
        $index = (int) $request->index;
        
        if (in_array($index, $marked, true)) {
            $updatedMarked = array_values(array_diff($marked, [$index]));
            $examRoom->update(['is_marked' => $updatedMarked]);
        }

        [$updatedList, $errorView] = $this->updateList(
            $examRoom->is_saved ?? [],
            $index,
            'Question saved'
        );
     
        $examRoom->update(['is_saved' => $updatedList]);

        $examRoomAnswer = answers::where('id', $request->option_id)->select('c_answer')->first();
      
$user_score = [];

if ($examRoomAnswer === $request->answer) {
    $user_score[] = 'correct';
} else {
    $user_score[] = 'wrong';
}


      Redis::set('c_answer',json_encode($user_score));

    $c_answer = json_decode(Redis::get('c_answer'), true);
    


        return response()->json([
            'question_saved' => true,
            'saved_questions' => $updatedList,
            'error_view' => $errorView,
            'c_answer' => $c_answer
        ]);
    }

    private function updateList(array $list, int $index, string $message): array
    {
        if (!in_array($index, $list, true)) {
          
            $list[] = $index;
            $view = view('components.successalert-msg', ['msg' => $message])->render();
        } else {
          
            $list = array_values(array_diff($list, [$index]));
            $view = view('components.erroralert-msg', ['msg' => $message])->render();
        }

        return [$list, $view];
    }
}
