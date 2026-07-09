<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Exam;
use App\Models\Question;
use App\Models\ExamQuestion;

class ExamQuestionSeeder extends Seeder
{
    public function run(): void
    {
        
        $exam = Exam::first();

        $questions = Question::all();

        foreach ($questions as $question) {

            ExamQuestion::create([

                'exam_id' => $exam->id,
                'question_id' => $question->id,
                'marks' => 1,

            ]);

        }
    }
}