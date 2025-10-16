<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamList extends Model
{
    protected $table = 'exams';



    protected $fillable = [

        'subject_name',
        'subject_code',
        'exam_duration',
        // 'exam_room',
        'start_date',
        'status',

    ];

    protected function exams_for_room() 
    {

        return $this->belongsToMany(User::class, 'examroom', 'exam_id', 'user_id');

    } 
}
