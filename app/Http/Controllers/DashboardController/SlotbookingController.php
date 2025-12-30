<?php

namespace App\Http\Controllers\DashboardController;
use App\Http\Controllers\Controller;
use App\Models\Slotbooking;
use App\Models\User;
use App\Models\ExamList;
use App\Models\ExamRoom;
use Illuminate\Http\Request;

class SlotbookingController extends Controller
{

    public $user_id;
    public $max_slots;

    public function __construct()
    {
        $this->user_id = auth()->user()->id;
       
        $exam_room_status = ExamRoom::where('user_id', $this->user_id)->first();
        $this->max_slots = 100;
         
    }

    public function index()
    {
        $joined_subjects = [];
        $exam_room_collection = [];
        $get_current_student = auth()->user()->id;
        $exam_room_status = ExamRoom::where('user_id', $get_current_student)->get();
        foreach ($exam_room_status as $room) {
            if ($room['status'] === 'joined') {
                $joined_subjects[] = $room['subject_code'];
            }
        }
       
        $exam_list = ExamList::all();
       
        return view('Dashboard.Exam.all-exams', compact('joined_subjects', 'exam_list'));
    }



    public function joinSlot(Request $request)
    {
        $data = $request->all();
        $user_id = $this->user_id;
        $exam_code = $data['exam_code']; 
        $exam_room_status = ExamRoom::where('user_id', $user_id)->first();
      
        $exam = ExamList::where('subject_code', $exam_code)->first();

        if (is_null($exam)) {
            return response()->json(array('msg'=> 'Exam not found'), 404);
        } 
        
        $booked_slot_count = ExamRoom::where('status', 'joined')->where('subject_code', $exam_code)->count();
        
        if($booked_slot_count >  $this->max_slots){
            return response()->json(session()->flash('msg', 'Exam Room is full'), 404);
        }
        
        if($exam_room_status && $exam_room_status->id){
            return response()->json(session()->flash('msg', 'You have already in Examroom'), 404);
        }

       
       
        
        $get_exam_id = $exam->id;
              
 
        $examroom = ExamRoom::updateOrCreate([
            'exam_id' => $get_exam_id,
            'user_id' => $user_id,
            'exam_score' => 0,
            'status' => 'joined',    
           
        ]);

       

        return redirect()->route('examroom')->with('msg', 'You have successfully joined the exam room');
    
    }

    public function leaveSlot(Request $request)
    {

        $data = $request->all();
        $user_id =  $this->user_id;
   
        $exam_code = $request->exam_code; 

        ExamRoom::where('user_id', $user_id)->delete();
        return view('Dashboard.Exam.students-exam');
    }
}   
