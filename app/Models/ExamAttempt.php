<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamAttempt extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'assignment_id',
        'student_id',
        'started_at',
        'ended_at',
        'remaining_seconds',
        'current_question',
        'obtained_marks',
        'status',
    ];

    protected $casts = [

        'started_at' => 'datetime',
        'ended_at'   => 'datetime',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function assignment()
    {
        return $this->belongsTo(ExamAssignment::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function answers()
    {
        return $this->hasMany(
            ExamAttemptAnswer::class,
            'attempt_id'
        );
    }
}