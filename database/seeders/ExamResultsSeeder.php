<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExamResult;

class ExamResultsSeeder extends Seeder
{
    public function run(): void
    {
        $results = [

            [
                'student_id' => 1,
                'exam_id' => 1,
                'total_questions' => 20,
                'correct_answers' => 18,
                'wrong_answers' => 2,
                'not_attempted' => 0,
                'total_marks' => 20,
                'obtained_marks' => 18,
                'percentage' => 90,
                'grade' => 'A+',
                'result_status' => 'Pass',
                'started_at' => now()->subMinutes(30),
                'submitted_at' => now(),
                'time_taken' => 28,
                'is_active' => true,
                'created_by' => null,
                'updated_by' => null,
            ],

            [
                'student_id' => 2,
                'exam_id' => 1,
                'total_questions' => 20,
                'correct_answers' => 15,
                'wrong_answers' => 4,
                'not_attempted' => 1,
                'total_marks' => 20,
                'obtained_marks' => 15,
                'percentage' => 75,
                'grade' => 'B',
                'result_status' => 'Pass',
                'started_at' => now()->subMinutes(30),
                'submitted_at' => now(),
                'time_taken' => 29,
                'is_active' => true,
                'created_by' => null,
                'updated_by' => null,
            ],

            [
                'student_id' => 3,
                'exam_id' => 1,
                'total_questions' => 20,
                'correct_answers' => 9,
                'wrong_answers' => 8,
                'not_attempted' => 3,
                'total_marks' => 20,
                'obtained_marks' => 9,
                'percentage' => 45,
                'grade' => 'D',
                'result_status' => 'Fail',
                'started_at' => now()->subMinutes(30),
                'submitted_at' => now(),
                'time_taken' => 30,
                'is_active' => true,
                'created_by' => null,
                'updated_by' => null,
            ],

        ];

        foreach ($results as $result) {
            ExamResult::create($result);
        }
    }
}