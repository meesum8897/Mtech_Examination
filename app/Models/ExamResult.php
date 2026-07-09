<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamResult extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'student_id',
        'exam_id',

        'total_questions',
        'correct_answers',
        'wrong_answers',
        'not_attempted',

        'total_marks',
        'obtained_marks',

        'percentage',

        'grade',

        'result_status',

        'started_at',
        'submitted_at',
        'time_taken',

        'is_active',

        'created_by',
        'updated_by',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}