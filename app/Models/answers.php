<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class answers extends Model
{
    protected $table = 'q_answer';

    protected $fillable = [
        'question_id',
        'option_value',
        'c_answer',
    ];


    public function questions(): BelongsTo
    {
        return $this->belongsTo(questions::class);
    }
}
