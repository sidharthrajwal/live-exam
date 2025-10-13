<?php
namespace App\Http\Controllers\DashboardController;
use App\Http\Controllers\Controller;
use App\Models\ExamRoom;
use App\Models\ExamList;
use App\Models\User;

use Illuminate\Http\Request;

class ExamRoomController extends Controller
{
    public function index()
    {  
        $get_current_student = auth()->user()->id;
        $exam_room_detail = ExamRoom::where('user_id', $get_current_student)->first();
        $exam_code = ExamList::where('id', $exam_room_detail->exam_id)->first();

        $exam_room_status = $exam_room_detail->status;
        $exam_room_code = $exam_code->subject_code;
        $exam_room_duration = $exam_code->exam_duration;
        $exam_room_duration = sprintf('%02d:00', $exam_room_duration);
        $exam_room_subject_name = $exam_code->subject_name;

      
       
        return view('Dashboard.Exam.students-exam', compact('exam_room_status', 'exam_room_code', 'exam_room_duration', 'exam_room_subject_name'));
    }
}
