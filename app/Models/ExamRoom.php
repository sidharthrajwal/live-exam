<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamRoom extends Model
{
    protected $table = "exam_user";

    protected $fillable = [
        'exam_id',
        'user_id',
        'password',
    ];


   
}
