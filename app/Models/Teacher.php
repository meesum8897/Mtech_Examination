<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'teacher_code',
        'teacher_name',
        'father_name',
        'cnic',
        'mobile',
        'email',
        'qualification',
        'designation',
        'experience',
        'joining_date',
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
        return $this->belongsToMany(

            Batch::class,

            'batch_teachers'

        )->withTimestamps();
    }
}