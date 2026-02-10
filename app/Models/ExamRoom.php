<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamRoom extends Model
{
    protected $table = "examroom";

    protected $fillable = [
        'exam_id',
        'user_id',
        'score',
        'subject_code',
        'status',
        'is_marked', 
        'is_saved',
        'examlivestatus',
    ];

    protected $casts = [
        'is_marked' => 'array',
        'is_saved' => 'array',
    ];
    
    protected $attributes = [
        'is_marked' => '[]',
        'is_saved' => '[]',
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
