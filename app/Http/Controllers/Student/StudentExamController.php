<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Exam;
use App\Models\ExamAssignment;

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
    public function destroy(string $id)
    {
        //
    }
}
