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
        
    
        $examroom = ExamRoom::with('exam')->where('user_id', auth()->id())->first();
        $examroom->exam->id;
        $questions = questions::where('exam_id', $examroom->exam->id)->get();
        Redis::set('questions', json_encode($questions));

        // Retrieve
        $data = json_decode(Redis::get('questions'), true);
        
        dd($data);
        
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
    public function ChangeQuestions()
    {

        $questions = Redis::get('name');
        

       // return view('Dashboard.Exam.students-exam', compact('questions'));

    }
    
}
