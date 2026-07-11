<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Exam;
use App\Models\ExamAssignment;
use App\Models\ExamAttempt;
use App\Models\ExamAttemptAnswer;
use Illuminate\Support\Facades\DB;

class StudentExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function rules()
    {
        
        // Check Login
        if (!session()->has('student_id')) {

            return redirect()
                ->route('student.login')
                ->with('error', 'Please login first.');

        }

        $student = Student::findOrFail(session('student_id'));

        /*
        |--------------------------------------------------------------------------
        | Find Exam Assignment
        |--------------------------------------------------------------------------
        */

        $assignment = ExamAssignment::with('exam')
            ->where('batch_id', $student->batch_id)
            ->where('is_active', true)
            ->latest()
            ->first();
        
        /*
        |--------------------------------------------------------------------------
        | No Assignment Found
        |--------------------------------------------------------------------------
        */

        if (!$assignment) {

            return view('student.examrules', [
                'student'    => $student,
                'assignment' => null,
                'message'    => 'No examination has been assigned to your batch.'
            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | Exam Not Started
        |--------------------------------------------------------------------------
        */
        
        if (now()->lt($assignment->start_datetime)) {

            return view('student.examrules', [
                'student'    => $student,
                'assignment' => $assignment,
                'message'    => 'Your examination has not started yet.'
            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | Exam Expired
        |--------------------------------------------------------------------------
        */

        if (now()->gt($assignment->end_datetime)) {

            return view('student.examrules', [
                'student'    => $student,
                'assignment' => $assignment,
                'message'    => 'This examination has already expired.'
            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | Assignment Cancelled
        |--------------------------------------------------------------------------
        */

        if ($assignment->status == 'Cancelled') {

            return view('student.examrules', [
                'student'    => $student,
                'assignment' => $assignment,
                'message'    => 'This examination has been cancelled.'
            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | Save Session
        |--------------------------------------------------------------------------
        */

        session([
            'assignment_id' => $assignment->id,
            'exam_id'       => $assignment->exam_id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Rules Page
        |--------------------------------------------------------------------------
        */

        return view('student.examrules', [
            'student'    => $student,
            'assignment' => $assignment,
            'message'    => null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout()
    {
        session()->forget([
            'student_id',
            'student_name',
            'roll_no',
            'assignment_id',
            'exam_id',
        ]);

        session()->invalidate();

        session()->regenerateToken();

        return redirect()
            ->route('student.login')
            ->with('success', 'You have been logged out successfully.');
    }


    /* Start Exam Controller */

    public function startExam()
    {
        
        $student = Student::findOrFail(session('student_id'));

        $assignment = ExamAssignment::with('exam.questions')
            ->findOrFail(session('assignment_id'));

        /*
        |--------------------------------------------------------------------------
        | Existing Attempt?
        |--------------------------------------------------------------------------
        */

        $attempt = ExamAttempt::where('assignment_id', $assignment->id)
            ->where('student_id', $student->id)
            ->latest()
            ->first();

        if ($attempt) {

            /*
            |--------------------------------------------------------------------------
            | Already Submitted
            |--------------------------------------------------------------------------
            */

            if ($attempt->status == 'Submitted') {

                return redirect()
                    ->route('student.result')
                    ->with('info', 'You have already completed this examination.');

            }

            /*
            |--------------------------------------------------------------------------
            | Resume Attempt
            |--------------------------------------------------------------------------
            */

            session([
                'attempt_id' => $attempt->id
            ]);

            return redirect()->route('student.exam');

        }

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Create Attempt
            |--------------------------------------------------------------------------
            */

            $attempt = ExamAttempt::create([

                'assignment_id' => $assignment->id,

                'student_id' => $student->id,

                'started_at' => now(),

                'remaining_seconds' => $assignment->exam->duration * 60,

                'status' => 'Started',

            ]);

            /*
            |--------------------------------------------------------------------------
            | Random Questions
            |--------------------------------------------------------------------------
            */

            $questions = $assignment->exam
                ->questions()
                ->inRandomOrder()
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Create Answer Rows
            |--------------------------------------------------------------------------
            */

            foreach ($questions as $index => $question) {

                ExamAttemptAnswer::create([

                    'attempt_id' => $attempt->id,

                    'question_id' => $question->id,

                    'display_order' => $index + 1,

                ]);

            }

            DB::commit();

            session([
                'attempt_id' => $attempt->id
            ]);
            
            return redirect()->route('student.exam');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }

    public function exam(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Student Login
        |--------------------------------------------------------------------------
        */

        if (!session()->has('student_id')) {

            return redirect()
                ->route('student.login')
                ->with('error', 'Please login first.');

        }

        /*
        |--------------------------------------------------------------------------
        | Attempt Exists
        |--------------------------------------------------------------------------
        */

        if (!session()->has('attempt_id')) {

            return redirect()
                ->route('student.rules')
                ->with('error', 'Please start your examination first.');

        }

        /*
        |--------------------------------------------------------------------------
        | Student
        |--------------------------------------------------------------------------
        */

        $student = Student::findOrFail(session('student_id'));

        /*
        |--------------------------------------------------------------------------
        | Attempt
        |--------------------------------------------------------------------------
        */

        $attempt = ExamAttempt::with([
            'assignment.exam',
            'answers.question'
        ])
        ->where('id', session('attempt_id'))
        ->where('student_id', $student->id)
        ->first();

        if (!$attempt) {

            session()->forget('attempt_id');

            return redirect()
                ->route('student.rules')
                ->with('error', 'Invalid examination session.');

        }

        /*
        |--------------------------------------------------------------------------
        | Security Checks
        |--------------------------------------------------------------------------
        */

        if ($attempt->status == 'Submitted') {

            return redirect()->route('student.result');

        }

        if ($attempt->assignment->status == 'Cancelled') {

            return redirect()
                ->route('student.rules')
                ->with('error', 'This examination has been cancelled.');

        }

        if (now()->gt($attempt->assignment->end_datetime)) {

            return redirect()
                ->route('student.result')
                ->with('warning', 'Your examination time has expired.');

        }

        /*
        |--------------------------------------------------------------------------
        | Total Questions
        |--------------------------------------------------------------------------
        */

        $totalQuestions = $attempt->answers()->count();

        /*
        |--------------------------------------------------------------------------
        | Current Question Number
        |--------------------------------------------------------------------------
        */

        $currentQuestion = $request->filled('question') ? (int) $request->question : $attempt->current_question;

        if ($currentQuestion < 1) 
        {
            $currentQuestion = 1;
        }

        if ($currentQuestion > $totalQuestions) 
        {
            $currentQuestion = $totalQuestions;
        }

        /*
        |--------------------------------------------------------------------------
        | Load Current Question
        |--------------------------------------------------------------------------
        */

        $attemptAnswer = $attempt->answers()
            ->with('question')
            ->orderBy('display_order')
            ->skip($currentQuestion - 1)
            ->first();

        $attemptAnswer->update([
            'visited' => true
        ]);

        if (!$attemptAnswer) {

            return redirect()
                ->route('student.rules')
                ->with('error', 'Question not found.');

        }

        return view('student.exam', [
            'student' => $student,
            'attempt' => $attempt,
            'assignment' => $attempt->assignment,
            'question' => $attemptAnswer->question,
            'attemptAnswer' => $attemptAnswer,
            'currentQuestion' => $currentQuestion,
            'totalQuestions' => $totalQuestions,

        ]);
    }

    public function saveAnswer(Request $request)
    {
        $request->validate([
            'attempt_answer_id' => 'required|exists:exam_attempt_answers,id',
            'selected_answer' => 'required',
        ]);

        $answer = ExamAttemptAnswer::findOrFail($request->attempt_answer_id);

        $answer->update([
            'selected_answer'=>$request->selected_answer,
            'answered_at'=>now(),
            'visited'=>true,
        ]);

        ExamAttempt::where(
            'id',
            $answer->attempt_id
        )->update([
            'updated_at'=>now()
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function navigateQuestion(Request $request)
    {
        $request->validate([
            'attempt_answer_id' => 'required|exists:exam_attempt_answers,id',
            'selected_answer' => 'nullable',
            'direction' => 'required|in:next,previous',
            'current_question' => 'required|integer',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Save Current Answer
        |--------------------------------------------------------------------------
        */

        $attemptAnswer = ExamAttemptAnswer::findOrFail(
            $request->attempt_answer_id
        );

        $attemptAnswer->update([
            'selected_answer'=>$request->selected_answer,
            'visited'=>true,
            'answered_at'=>now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Load Attempt
        |--------------------------------------------------------------------------
        */

        $attempt = ExamAttempt::with([
            'assignment.exam',
            'answers.question'
        ])->findOrFail(session('attempt_id'));

        $totalQuestions = $attempt->answers()->count();

        /*
        |--------------------------------------------------------------------------
        | Next / Previous Question Number
        |--------------------------------------------------------------------------
        */

        $questionNo = $request->current_question;

        /*
        |--------------------------------------------------------------------------
        | Next / Previous
        |--------------------------------------------------------------------------
        */

        if ($request->direction == 'next') {

            $questionNo++;

        } else {

            $questionNo--;

        }

        /*
        |--------------------------------------------------------------------------
        | Save Current Question
        |--------------------------------------------------------------------------
        */

        $attempt->update([

            'current_question' => $questionNo,

        ]);

        /*
        |--------------------------------------------------------------------------
        | Prevent Overflow
        |--------------------------------------------------------------------------
        */

        if ($questionNo < 1) {

            $questionNo = 1;

        }

        if ($questionNo > $totalQuestions) {

            return response()->json([

                'finished' => true

            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | Get Required Question
        |--------------------------------------------------------------------------
        */

        $nextAnswer = $attempt->answers()
            ->with('question')
            ->orderBy('display_order')
            ->skip($questionNo - 1)
            ->first();

            $nextAnswer->update([
                'visited' => true
            ]);

        /*
        |--------------------------------------------------------------------------
        | Render Component
        |--------------------------------------------------------------------------
        */

        $html = view(
            'components.student.question-card',
            [
                'question' => $nextAnswer->question,
                'attemptAnswer' => $nextAnswer,
            ]

        )->render();

        $sidebarHtml = view('components.student.sidebar', [
            'attempt' => $attempt->fresh('answers'),
            'currentQuestion' => $questionNo,
            'totalQuestions' => $totalQuestions
        ])->render();

        /*
        |--------------------------------------------------------------------------
        | Answered Count
        |--------------------------------------------------------------------------
        */

        $answered = $attempt->answers
            ->whereNotNull('selected_answer')
            ->count();

        $unanswered = $attempt->answers
            ->where('visited', true)
            ->whereNull('selected_answer')
            ->where('display_order', '!=', $questionNo)
            ->count();

        $remaining = $totalQuestions - ($answered + $unanswered);

        return response()->json([
        'question' => $html,
        'sidebar' => $sidebarHtml,
        'currentQuestion' => $questionNo,
        'totalQuestions' => $totalQuestions,
        'finished' => false,
        ]);

    }

    public function finishExam()
    {
        $attempt = ExamAttempt::findOrFail(session('attempt_id'));

        $attempt->update([
            'status' => 'Completed',   // ✅ Changed
            'ended_at' => now(),       // ✅ Migration me ended_at hai
        ]);

        session()->forget('attempt_id');

        return response()->json([
            'redirect' => route('student.result')
        ]);
    }

    public function result()
    {
        $student = Student::findOrFail(session('student_id'));

        $attempt = ExamAttempt::with([
            'answers.question',
            'assignment.exam'
        ])
        ->where('student_id', $student->id)
        ->latest()
        ->first();

        if (!$attempt) {

            return redirect()
                ->route('student.rules')
                ->with('error', 'No examination record found.');

        }

        $totalQuestions = $attempt->answers->count();

        $answered = $attempt->answers
            ->whereNotNull('selected_answer')
            ->count();

        $unanswered = $attempt->answers
            ->whereNull('selected_answer')
            ->count();

        return view('student.result', compact(

            'student',
            'attempt',
            'totalQuestions',
            'answered',
            'unanswered'

        ));
    }
}
