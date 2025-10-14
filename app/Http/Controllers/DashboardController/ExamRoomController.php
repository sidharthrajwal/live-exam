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
        $student_id = auth()->id();
        $exam_room = ExamRoom::where('user_id', $student_id)->first();
        if($exam_room){
            $exam_room_id = ExamList::where('id', $exam_room->exam_id)->first();
        }
        $exam_room_status = null;
        $exam_room_code = null;
        $exam_room_duration = null;
        $exam_room_subject_name = null;
    
        $booked_slot_count = ExamRoom::where('status', 'joined')->where('user_id', $student_id)
                                     ->count();

    
        if ($exam_room) {
            $exam = ExamList::find($exam_room->exam_id);
    
            if ($exam) {
                $exam_room_status = $exam_room->status;
                $exam_room_code = $exam->subject_code;
                $exam_room_duration = sprintf('%02d:00', $exam->exam_duration);
                $exam_room_subject_name = $exam->subject_name;
            }
        }
    
        return view('Dashboard.Exam.students-exam', compact(
            'exam_room_status',
            'exam_room_code',
            'exam_room_duration',
            'exam_room_subject_name',
            'booked_slot_count'
        ));
    }
    
}
