<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class questions extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'exam_id',
        'question',
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(answers::class, 'question_id');
    }
}
