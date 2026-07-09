<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Course;

class QuestionController extends Controller
{
    public function index($id)
    {
        $exam = Exam::with('course')->findOrFail($id);

        $questions = Question::whereHas('exams', function ($q) use ($id) {
            $q->where('exam_id', $id);
        })->get();
        

        return view('admin.questions', compact(
            'exam',
            'questions'
        ));
    }

    public function store(Request $request, Exam $exam)
    {
        dd($exam->id);
        $request->validate([
            'question'        => 'required|string',
            'question_type'   => 'required|in:MCQ,TrueFalse',
            'correct_answer'  => 'required',
            'marks'           => 'required|numeric|min:1',
            'option_a' => 'nullable|string',
            'option_b' => 'nullable|string',
            'option_c' => 'nullable|string',
            'option_d' => 'nullable|string',
        ]);

        // Save Question
        $question = Question::create([

            'question'        => $request->question,
            'question_type'   => $request->question_type,
            'option_a'        => $request->option_a,
            'option_b'        => $request->option_b,
            'option_c'        => $request->option_c,
            'option_d'        => $request->option_d,
            'correct_answer'  => $request->correct_answer,
            'is_active'       => true,
            'created_by'      => 1,

        ]);

        

        // Attach Question to Exam
        $exam->questions()->attach($question->id, [

            'marks' => $request->marks

        ]);

        return redirect()
            ->route('admin.questions', $exam->id)
            ->with('success', 'Question added successfully.');
    }
}
