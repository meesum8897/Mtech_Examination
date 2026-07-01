<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamQuestionRule extends Model
{
    protected $fillable = [

        'exam_id',
        'question_category_id',
        'question_count',
        'marks_per_question',
        'difficulty_level',
        'randomize'

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function category()
    {
        return $this->belongsTo(
            QuestionCategory::class,
            'question_category_id'
        );
    }
}