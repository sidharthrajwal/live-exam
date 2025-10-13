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
        return view('Dashboard.Exam.all-exam');
    }
    public function joinSlot(Request $request)
    {
        $data = $request->all();
        $user_id = auth()->user()->id;
        $exam_id = $data['exam_code']; 
        
        $exam = ExamList::where('subject_code', $exam_id)->first();
        $get_exam_id = $exam->id;
        
        $examroom = ExamRoom::updateOrCreate([
            'exam_id' => $get_exam_id,
            'user_id' => $user_id,
            'score' => 0,
            'status' => 'active',    
           
        ]);

        return back()->with('success', 'Join slot successfully');
    
    }
}
