<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAttemptAnswer extends Model
{
      protected $fillable = [
        'attempt_id',
        'question_id',
        'display_order',
        'selected_answer',
        'is_correct',
        'marks_obtained',
        'answered_at',
        'visited',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function attempt()
    {
        return $this->belongsTo(
            ExamAttempt::class,
            'attempt_id'
        );
    }

    public function question()
    {
        return $this->belongsTo(
            Question::class
        );
    }
}