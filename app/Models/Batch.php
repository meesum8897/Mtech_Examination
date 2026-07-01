<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batch extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'course_id',
        'batch_code',
        'batch_name',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'capacity',
        'remarks',
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

    public function teachers()
    {
        return $this->belongsToMany(

            Teacher::class,

            'batch_teachers'

        )->withTimestamps();
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function assignments()
    {
        return $this->hasMany(ExamAssignment::class);
    }
}