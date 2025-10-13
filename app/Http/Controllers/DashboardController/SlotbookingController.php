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
    public function index()
    {
        $get_current_student = auth()->user()->id;
        $exam_room_status = ExamRoom::where('user_id', $get_current_student)->value('status');
       
        return view('Dashboard.Exam.all-exams', compact('exam_room_status'));
    }
    public function joinSlot(Request $request)
    {
        $data = $request->all();
        $user_id = auth()->user()->id;
        $exam_id = $data['exam_code']; 
        
        $exam = ExamList::where('subject_code', $exam_id)->first();

        if (is_null($exam)) {
            return response()->json(array('msg'=> 'Exam not found'), 404);
        }
        
        $get_exam_id = $exam->id;
              
 
        $examroom = ExamRoom::updateOrCreate([
            'exam_id' => $get_exam_id,
            'user_id' => $user_id,
            'exam_score' => 0,
            'status' => 'joined',    
           
        ]);

       

        return response()->json(array('status'=> 'joined'), 200);
    
    }
}   
