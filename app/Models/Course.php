<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'course_code',
        'course_name',
        'duration',
        'type',
        'description',
        'is_active',
        'created_by',
        'updated_by',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }
    

    public function questionCategories()
    {
        return $this->hasMany(QuestionCategory::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}