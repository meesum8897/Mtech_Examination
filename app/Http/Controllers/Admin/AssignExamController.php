<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Batch;
use App\Models\Exam;
use App\Models\ExamAssignment;
use App\Models\Student;
use App\Models\ExamAssignmentStudent;
use Illuminate\Support\Facades\DB;
use App\Models\AssignExam;

class AssignExamController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Listing
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $courses = Course::where('is_active', true)
                        ->orderBy('course_name')
                        ->get();

        $assignments = ExamAssignment::with([
                'exam',
                'batch.course'
            ])
            ->latest()
            ->paginate(10);

        return view(
            'admin.assign-exams',
            compact('courses', 'assignments')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $courses = Course::where('is_active', true)
                    ->orderBy('course_name')
                    ->get();

        return view(
            'admin.assign-exams',
            compact('courses')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'exam_id' => 'required|exists:exams,id',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'status' => 'required',
        ],[
            'batch_id.required' => 'Please select a batch.',
            'exam_id.required' => 'Please select an examination.',
            'start_datetime.required' => 'Please select the start date & time.',
            'end_datetime.required' => 'Please select the end date & time.',
            'end_datetime.after' => 'End date & time must be after the start date & time.',
            'status.required' => 'Please select the assignment status.',
        ]);

        if (ExamAssignment::where('exam_id', $request->exam_id)
        ->where('batch_id', $request->batch_id)
        ->exists()
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'batch_id' => 'This examination has already been assigned to the selected batch.'
                ]);
        }

        DB::beginTransaction();

        try {

            $assignment = ExamAssignment::create([

                'exam_id'        => $request->exam_id,

                'batch_id'       => $request->batch_id,

                'start_datetime' => $request->start_datetime,

                'end_datetime'   => $request->end_datetime,

                'show_result'    => $request->show_result ?? false,

                'status'         => $request->status,

                'is_active'      => true,

                'created_by'     => 1,

            ]);

            $students = Student::where(
                'batch_id',
                $request->batch_id
            )->get();

            foreach ($students as $student) {

                ExamAssignmentStudent::create([

                    'assignment_id' => $assignment->id,

                    'student_id'    => $student->id,

                    'status'        => 'Pending',

                ]);

            }

            DB::commit();

            return redirect()
                    ->route('admin.assign-exams.index')
                    ->with(
                        'success',
                        'Exam Assigned Successfully.'
                    );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                    ->withInput()
                    ->with(
                        'error',
                        $e->getMessage()
                    );

        }
    }

    public function getBatches($courseId)
    {
        $batches = Batch::where('course_id', $courseId)
                        ->where('is_active', true)
                        ->orderBy('batch_name')
                        ->get();

        return response()->json($batches);
    }

    /* public function getExams($courseId)
    {
        $exams = Exam::where('course_id', $courseId)
                    ->where('is_active', true)
                    ->where('status', 'Published')
                    ->orderBy('exam_title')
                    ->get();

        return response()->json($exams);
    } */

        public function getExams($courseId)
    {
        $exams = Exam::where('course_id', $courseId)
                    ->where('is_active', true)
                    ->orderBy('exam_title')
                    ->get();

        return response()->json($exams);
    }

    public function getSummary($batchId, $examId)
    {
        $studentCount = Student::where('batch_id', $batchId)
                                ->where('is_active', true)
                                ->count();

        $exam = Exam::with('questions')
                    ->findOrFail($examId);

        return response()->json([

            'students' => $studentCount,

            'duration' => $exam->duration,

            'passing_marks' => $exam->passing_marks,

            'total_marks' => $exam->questions->sum(function ($question) {
                return $question->pivot->marks;
            }),

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    */

    public function show(ExamAssignment $assign_exam)
    {
        //
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(ExamAssignment $assign_exam)
    {
        //
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, ExamAssignment $assign_exam)
    {
        //
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy(ExamAssignment $assign_exam)
    {
        //
    }
}