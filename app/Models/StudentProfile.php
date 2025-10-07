<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentProfile extends Model
{
    use HasFactory;

    protected $table = 'student_profile';
    
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'city',
        'region',
        'country',
        'postal_code',
        'phone',
        'profile_image',
         'dob'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
