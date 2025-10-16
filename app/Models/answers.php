<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class answers extends Model
{
    protected $table = 'questions_option';

    protected $fillable = [
        'question_id',
        'option_text',
        'is_correct',
    ];


    public function questions(): BelongsTo
    {
        return $this->belongsTo(questions::class);
    }
}
