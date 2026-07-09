<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exam;

class ExamsSeeder extends Seeder
{
    public function run(): void
    {
        Exam::create([

            'course_id'=>1,
            'exam_code'=>'EXM-0001',
            'exam_title'=>'MS Office Monthly Test',
            'duration'=>30,
            'passing_marks'=>40,
            'starts_at'=>now(),
            'ends_at'=>now()->addHour(),
            'status'=>'Published',
            'is_active'=>true,

            'created_by'=>null,
            'updated_by'=>null,

        ]);
    }
}