<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use SoftDeletes, Notifiable;

    protected $fillable = [

        'batch_id',
        'student_code',
        'roll_no',
        'first_name',
        'last_name',
        'father_name',
        'gender',
        'dob',
        'cnic',
        'email',
        'phone',
        'guardian_phone',
        'address',
        'admission_date',
        'photo',
        'password',
        'last_login_at',
        'is_active',
        'created_by',
        'updated_by'
    ];

  protected $hidden = [

        'password',

        'remember_token'

    ];

    protected function casts(): array
    {
        return [

            'password' => 'hashed',
            'dob' => 'date',
            'admission_date' => 'date',
            'last_login_at' => 'datetime',
            'is_active' => 'boolean',

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    */

    public function getAuthIdentifierName()
    {
        return 'student_code';
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
    

    public function examAssignments()
    {
        return $this->hasMany(ExamAssignmentStudent::class);
    }
    

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
}