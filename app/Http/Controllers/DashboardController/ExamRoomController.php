<?php
namespace App\Http\Controllers\DashboardController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Models\ExamRoom;
use App\Models\ExamList;
use App\Models\questions;

use App\Models\User;

use Illuminate\Http\Request;

class ExamRoomController extends Controller
{

    public $joined_subjects;
    public function __construct()
    {
        $student_id = auth()->id();
 
        $exam_room_status = ExamRoom::where('user_id', $student_id)->get();
        foreach ($exam_room_status as $room) {
            if ($room['status'] === 'joined') {
               $this->joined_subjects[] = $room['subject_code'];
            }
        }
    }

    public function index()
    {
        
    
        $examroom = ExamRoom::where('user_id', auth()->id())->first();
        if($examroom == null){
            return redirect()->route('dashboard');
        }
        $examId = $examroom->exam->id;

      

        $questions = Questions::with(['answers' => function ($query) {
            $query->select('id', 'question_id', 'option_value', 'c_answer');
        }])
        ->where('exam_id', $examId)
        ->get();
        
        Redis::set('questions', json_encode($questions));

        // Retrieve
        // $data = json_decode(Redis::get('questions'), true);
        
        // dd($data);
        
        $student_id = auth()->id();
        $exam_room = ExamRoom::where('user_id', $student_id)->first();
        $exam_room_code = null;
        $exam_room_duration = null;
        $exam_room_subject_name = null;
        $joined_subjects = $this->joined_subjects ?? [];
       
        $booked_slot_count = null;

        if ($exam_room) {
            $booked_slot_count = ExamRoom::where('status', 'joined')->where('exam_id', $exam_room->exam_id)->count();
            $exam = ExamList::find($exam_room->exam_id);
    
            if ($exam) {
                
                $exam_room_code = $exam->subject_code;
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
            'questions'
        ));
    }
    public function ChangeQuestions(Request $request)
    {

        // dd($request->all());
        $index = $request->index;
        $questions = Redis::get('questions');
       
        $questions = json_decode($questions, true);

        if($index >= count($questions)){
            return response()->json(['current_question' => null, 'current_options' => null]);
        }

  
        $current_id = $questions[$index]['id'];
       
        $current_question = $questions[$index]['question'];
        

        $current_options = $questions[$index]['answers'];
        
 
        return response()->json(['current_question' => $current_question, 'current_options' => $current_options]);
  

      

    }
    public function SubmitAnswer(Request $request)
    {
        // dd($request->all());
    }

    public function SubmitExam(Request $request)
    {
        // dd($request->all());
    }
    
}
