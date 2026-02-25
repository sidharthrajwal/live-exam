<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamRoomHistory extends Model
{

    protected $table = "student_exam_history";

    protected $fillable = [
        'user_id',
        'exam_id',
        'score',
        'complete_exam',
        'created_at',
        'updated_at',
        'total_mark',
        'total_saved',
        'exam_end_time',
        'exam_count',
        'total_correct_answer',
        'total_wrong_answer',
    ];


 public function exam()
    {
        return $this->belongsTo(ExamRoom::class, 'exam_id');
    }
 public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}