<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Question extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'question',
        'question_type',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
        'is_active',
        'created_by',
        'updated_by',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function category()
    {
        return $this->belongsTo(QuestionCategory::class,'question_category_id');
    }

    public function exams()
    {
        return $this->belongsToMany(
            Exam::class,
            'exam_questions'
        )->withPivot('marks')
        ->withTimestamps();
    }

    public function generatedQuestions()
    {
        return $this->hasMany(ExamGeneratedQuestion::class);
    }

    public function options()
    {
        return $this->hasMany(QuestionOption::class)
                    ->orderBy('display_order');
    }
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    

    /* public function subject()
    {
        return $this->belongsTo(Subject::class);
    } */
}