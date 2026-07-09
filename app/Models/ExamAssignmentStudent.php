<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAssignmentStudent extends Model
{
    protected $fillable = [

        'assignment_id',
        'student_id',
        'status'

    ];

    public function assignment()
    {
        return $this->belongsTo(ExamAssignment::class,'assignment_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}