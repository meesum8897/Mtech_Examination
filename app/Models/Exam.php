<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

    class Exam extends Model
    {
        use SoftDeletes;

        protected $fillable = [

        'course_id',
        'exam_code',
        'exam_title',
        'duration',
        'total_marks',
        'passing_marks',
        'starts_at',
        'ends_at',
        'status',
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

    public function questions()
    {
        return $this->belongsToMany(
            Question::class,
            'exam_questions'
        )->withPivot('marks')
        ->withTimestamps();
    }

    public function rules()
    {
        return $this->hasMany(ExamQuestionRule::class);
    }

    public function assignments()
    {
        return $this->hasMany(ExamAssignment::class);
    }

}