<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    protected $fillable = [
        'student_number',
        'first_name',
        'last_name',
        'email',
        'date_of_birth',
    ];



    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(StudentProfile::class);
    }
}
