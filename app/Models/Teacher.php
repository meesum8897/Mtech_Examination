<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'teacher_code',
        'name',
        'email',
        'phone',
        'cnic',
        'gender',
        'qualification',
        'experience',
        'joining_date',
        'salary',
        'address',
        'photo',
        'is_active',
        'created_by',
        'updated_by'

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