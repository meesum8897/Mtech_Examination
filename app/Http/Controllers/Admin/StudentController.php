<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Batch;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{

public function index(Request $request)
{
    // Student Query
    $query = Student::with('batch.course');

    // Search
    if ($request->filled('search')) {

        $query->where(function ($q) use ($request) {

            $q->where('student_code', 'like', '%' . $request->search . '%')
                ->orWhere('roll_no', 'like', '%' . $request->search . '%')
                ->orWhere('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');

        });

    }

    // Course Filter
    if ($request->filled('course_id')) {

        $query->whereHas('batch', function ($q) use ($request) {

            $q->where('course_id', $request->course_id);

        });

    }

    // Batch Filter
    if ($request->filled('batch_id')) {

        $query->where('batch_id', $request->batch_id);

    }

    // Status Filter
    if ($request->status !== null && $request->status !== '') {

        $query->where('is_active', $request->status);

    }

    // Students List
    $students = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    // Statistics
    $totalStudents = Student::count();

    $activeStudents = Student::where('is_active', 1)->count();

    $inactiveStudents = Student::where('is_active', 0)->count();

    // Active Batches
    $batches = Batch::where('is_active', 1)
        ->orderBy('batch_name')
        ->get();

    // Active Courses
    $courses = Course::where('is_active', 1)
        ->orderBy('course_name')
        ->get();

    // Generated Values
    $studentCode = $this->generateStudentCode();

    $generatedRollNo = $this->generateRollNo();

    $generatedPassword = Str::upper(Str::random(8));

    $diplomaStudents = Student::whereHas('batch.course', function ($q) {
    $q->where('type', 'Diploma');
    })->count();

    $shortCourseStudents = Student::whereHas('batch.course', function ($q) {
        $q->where('type', 'Short Course');
    })->count();

    return view('admin.student', compact(
        'students',
        'batches',
        'courses',
        'totalStudents',
        'activeStudents',
        'inactiveStudents',
        'diplomaStudents',
        'shortCourseStudents',
        'studentCode',
        'generatedPassword',
        'generatedRollNo'

    ));
}


    public function store(Request $request)
    {
        $request->validate([

            'batch_id'          => 'required|exists:batches,id',
            'first_name'        => 'required|max:100',
            'last_name'         => 'nullable|max:100',
            'father_name'       => 'required|max:150',
            'gender'            => 'required|in:Male,Female,Other',
            'dob'               => 'nullable|date',
            'cnic'              => 'nullable|unique:students,cnic',
            'email'             => 'nullable|email|unique:students,email',
            'phone'             => 'required|max:20',
            'guardian_phone'    => 'nullable|max:20',
            'address'           => 'nullable',
            'admission_date'    => 'required|date',
            'is_active'         => 'required|boolean',

        ]);


        Student::create([

            'batch_id'          => $request->batch_id,
            'student_code'      => $request->student_code,
            'roll_no'           => $request->roll_no,
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'father_name'       => $request->father_name,
            'gender'            => $request->gender,
            'dob'               => $request->dob,
            'cnic'              => $request->cnic,
            'email'             => $request->email,
            'phone'             => $request->phone,
            'guardian_phone'    => $request->guardian_phone,
            'address'           => $request->address,
            'admission_date'    => $request->admission_date,
            'password'          => $request->password,
            'is_active'         => $request->is_active,
            'created_by'        => 1

        ]);

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student added successfully.');
    }

    private function generateStudentCode()
    {
        $lastStudent = Student::withTrashed()
            ->orderBy('id', 'desc')
            ->first();

        $nextId = $lastStudent ? $lastStudent->id + 1 : 1;

        return 'STD-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
    }
    private function generateRollNo()
    {
        do {

            $rollNo = random_int(1000000, 9999999);

        } while (Student::where('roll_no', $rollNo)->exists());

        return $rollNo;
    }

/*     public function nextRoll(Batch $batch)
    {
        $nextRoll = str_pad(

            Student::where('batch_id', $batch->id)->count() + 1,

            3,

            '0',

            STR_PAD_LEFT

        );

        return response()->json([

            'roll_no' => $nextRoll

        ]);
    } */

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student deleted successfully.');
    }
}
