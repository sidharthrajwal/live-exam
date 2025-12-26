<?php
namespace App\Http\Controllers\DashboardController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Models\ExamRoom;
use App\Models\ExamList;
use App\Models\questions;
use Illuminate\View\Component;
use App\Models\User;

use Illuminate\Http\Request;

class ExamRoomController extends Controller
{

    public $joined_subjects;

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
    }

  
    public function index()
    {
        
    
        $examroom = ExamRoom::where('user_id', auth()->id())->first();
        // dd($examroom);
        if($examroom == null){
            return redirect()->route('join-slot');
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
        $remarked_question =  $exam_room->is_marked;
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
            'questions',
            'remarked_question'
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
        if ($request->has('marked_value')) {
          return $this->ReviewMarked($request);
        }
    
     
    }
    
    public function ReviewMarked(Request $request)
    {
        $examRoom = ExamRoom::where('subject_code', $request->exam_code)
                            ->where('user_id', auth()->id())
                            ->firstOrFail();
    
        // Ensure $marked is an array
        $marked = is_array($examRoom->is_marked) ? $examRoom->is_marked : [];
    
        $index = (int) $request->index;
    
        // Only add if not already marked
        if (!in_array($index, $marked, true)) {
            $marked[] = $index;
        }
    
        // Save back to DB — this **updates the same column**, preserving existing values
        $examRoom->update(['is_marked' => $marked]);
    
        return response()->json([
            'remark_added' => true,
            'marked_questions' => $marked
        ]);
    }
    
    
}