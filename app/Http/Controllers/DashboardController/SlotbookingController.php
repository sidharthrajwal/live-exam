<?php

namespace App\Http\Controllers\DashboardController;
use App\Http\Controllers\Controller;
use App\Models\Slotbooking;
use App\Models\User;
use App\Models\ExamList;
use App\Models\ExamRoom;
use App\Models\ExamRoomHistory;
use Illuminate\Http\Request;


        class SlotbookingController extends Controller
        {

        public $user_id;
        public $max_slots;
        public $exam_room_status;

        public function __construct()
        {
            $this->user_id = auth()->user()->id;
        
            $exam_room_status = ExamRoom::where('user_id', $this->user_id)->first();
            $this->max_slots = 100;
            $this->exam_room_status = $exam_room_status;
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
            $user_id = $this->user_id;
            $exam_code = $request->exam_code;

           
            $exam = ExamList::where('subject_code', $exam_code)->first();

            if (!$exam) {
                return response()->json(['message' => 'Exam not found'], 404);
            }

            $booked_slot_count = ExamRoom::where('status', 'joined')
            ->where('exam_id', $exam->id)
            ->count();

        if ($booked_slot_count >= $this->max_slots) {
            return response()->json(['message' => 'Exam Room is full'], 400);
        }

        $alreadyJoined = ExamRoom::where('user_id', $user_id)
            ->where('exam_id', $exam->id)
            ->exists();

        if ($alreadyJoined) {
            return response()->json(['message' => 'You already joined Exam Room' , 'status' => 'warning'], 200);
        }

        ExamRoom::create([
            'exam_id' => $exam->id,
            'user_id' => $user_id,
            'exam_score' => 0,
            'status' => 'joined',
            'subject_code' => $exam->subject_code
        ]);

        return response()->json(['message' => 'Joined successfully', 'status' => 'success']);
    }

        public function leaveSlot(Request $request)
        {

            $data = $request->all();
         //   dd($data);
            $user_id =  $this->user_id;
    
            $exam_code = $request->exam_code; 

            ExamRoom::where('user_id', $user_id)->delete();
            return view('Dashboard.Exam.students-exam');
        }

        public function finalSubmit(Request $request)
        {

          $exam_final_data = $this->exam_room_status;
          $exam_final_data->exam_id;
          $exam_final_data->user_id;
          $exam_final_data->exam_score;
          $exam_final_data->status;
          $exam_final_data->subject_code;
          $exam_final_data->score;
          $exam_final_data->is_marked;
          $exam_final_data->is_saved;
 
	

       $data = $exam_final_data->save([
            'user_id' => $this->user_id,
            'exam_id' => $exam_final_data->exam_id,
            'score' => $exam_final_data->exam_score,
            'complete_exam' => $exam_final_data->status,
            'created_at' => now(),
            'updated_at' => now(),
            'total_mark' => $exam_final_data->exam_score,
            'total_saved' => $exam_final_data->exam_score,
            'exam_end_time' => $exam_final_data->exam_score,
            'exam_count' => $exam_final_data->exam_score,
            'total_correct_answer' => $exam_final_data->exam_score,
        ]);
        

        ExamRoomHistory::create([
            'user_id' => $this->user_id,
            'exam_id' => $exam_final_data->exam_id,
            'score' => $exam_final_data->exam_score ?? 0,
            'complete_exam' => $exam_final_data->status,
            'created_at' => now(),
            'updated_at' => now(),
            'total_mark' => $exam_final_data->exam_score,
            'total_saved' => $exam_final_data->exam_score,
            'exam_end_time' => $exam_final_data->exam_score,
            'exam_count' => $exam_final_data->exam_score,
            'total_correct_answer' => $exam_final_data->exam_score,
        ]);

            $data = $request->all();
     
            $user_id =  $this->user_id;
    
            $exam_code = $request->exam_code; 

          
            return view('Dashboard.Exam.students-exam');

        }



    }   
