<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignExam extends Model
{
    protected $fillable = [
        'batch_id',
        'exam_id',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}