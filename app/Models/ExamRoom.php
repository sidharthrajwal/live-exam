<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamRoom extends Model
{
    protected $table = "examroom";

    protected $fillable = [
        'exam_id',
        'user_id',
        'exam_score',
        'subject_code',
        'status',
    ];


    public function exam()
    {
        return $this->belongsTo(ExamList::class, 'exam_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
