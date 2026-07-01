<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'course_id',
        'category_code',
        'category_name',
        'description',
        'is_active',
        'created_by',
        'updated_by'

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
        return $this->hasMany(Question::class);
    }

    public function examRules()
    {
        return $this->hasMany(ExamQuestionRule::class);
    }
}