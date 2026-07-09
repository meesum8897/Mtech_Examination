<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamAssignment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'exam_id',
        'batch_id',
        'start_datetime',
        'end_datetime',
        'show_result',
        'status',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function students()
    {
        return $this->hasMany(ExamAssignmentStudent::class,'assignment_id');
    }

}