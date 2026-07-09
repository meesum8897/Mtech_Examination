<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Support\Facades\DB;


class ExamQuestionController extends Controller
{
    /**
     * Display Questions of Selected Exam
     */
    public function index(Exam $exam)
    {   
        $questions = $exam->questions()->latest()->get();
        $totalMarks = $exam->questions()->sum('exam_questions.marks');
        $questions = $exam->questions()
        ->wherePivot('is_active', true)
        ->latest()
        ->get();

        return view('admin.questions', compact(
            'exam',
            'questions',
            'totalMarks'
        ));
    }

    /**
     * Store New Question
     */
    public function store(Request $request, Exam $exam)
    {
        $request->validate([

    'question' => 'required|string|max:1000',

    'question_type' => 'required|in:MCQ,TrueFalse',

    'marks' => 'required|numeric|min:1|max:100',

    'correct_answer' => 'required',

    'option_a' => 'required_if:question_type,MCQ|max:255',
    'option_b' => 'required_if:question_type,MCQ|max:255',
    'option_c' => 'required_if:question_type,MCQ|max:255',
    'option_d' => 'required_if:question_type,MCQ|max:255',

]);

        // Save Question
        $question = Question::create([

            'question' => $request->question,

            'question_type' => $request->question_type,

            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,

            'correct_answer' => $request->correct_answer,

            'is_active' => true,

            'created_by' => 1,

        ]);

        // Attach Question to Exam
        $exam->questions()->attach($question->id, [

            'marks' => $request->marks

        ]);

        

        return redirect()
            ->route('admin.exam.questions', $exam->id)
            ->with('success', 'Question Added Successfully.');
    }

    /**
     * Delete Question From Exam
     */
    public function destroy(Exam $exam, Question $question)
    {
        DB::table('exam_questions')
            ->where('exam_id', $exam->id)
            ->where('question_id', $question->id)
            ->update([
                'is_active' => false,
            ]);

        return back()->with('success', 'Question removed successfully.');
    }
}