<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Batch;
use App\Models\Teacher;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Teacher::query();

        if ($request->filled('search')) {
            $query->where('course_name', 'like', '%' . $request->search . '%')
                ->orWhere('course_code', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }

        $teachers = $query->latest()->paginate(10);

         $courses = Course::where('is_active', 1)
        ->orderBy('course_name')
        ->get();

        $batches = Batch::where('is_active', 1)
            ->orderBy('batch_name')
            ->get();
        $totalteachers = Teacher::count();

        $activeteachers = Teacher::where('is_active', 1)->count();

        $assignedbatches = Teacher::where('is_active', '1')->count();
        $sno = 0;
        return view('admin.teacher', compact(
            'teachers',
            'totalteachers',
            'activeteachers',
            'assignedbatches',
            'courses',
            'batches'
        ));
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
    $request->validate([

        'teacher_code' => 'required|unique:teachers,teacher_code',

        'teacher_name' => 'required|max:150',

        'father_name' => 'required|max:150',

        'cnic' => 'required|unique:teachers,cnic',

        'mobile' => 'required|unique:teachers,mobile',

        'email' => 'nullable|email',

        'qualification' => 'nullable|max:150',

        'designation' => 'nullable|max:150',

        'experience' => 'nullable|max:100',

        'joining_date' => 'required|date',

    ]);

    Teacher::create([

        'teacher_code' => $request->teacher_code,
        'teacher_name' => $request->teacher_name,
        'father_name' => $request->father_name,
        'cnic' => $request->cnic,
        'mobile' => $request->mobile,
        'email' => $request->email,
        'qualification' => $request->qualification,
        'designation' => $request->designation,
        'experience' => $request->experience,
        'joining_date' => $request->joining_date,
        'is_active' => 1,
        'created_by' => 1,

    ]);

    return redirect()
        ->route('admin.teachers.index')
        ->with('success', 'Teacher added successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return response()->json($teacher);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return response()->json($teacher);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        
        $request->validate([

            'teacher_code' => 'required|unique:teachers,teacher_code,' . $teacher->id,

            'teacher_name' => 'required',

            'cnic' => 'required|unique:teachers,cnic,' . $teacher->id,

            'mobile' => 'required|unique:teachers,mobile,' . $teacher->id,

            'email' => 'nullable|email|unique:teachers,email,' . $teacher->id,

            'joining_date' => 'date',

        ]);

        $teacher->update([

            'teacher_code' => $request->teacher_code,
            'teacher_name' => $request->teacher_name,
            'father_name' => $request->father_name,
            'cnic' => $request->cnic,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'gender' => $request->gender,
            'qualification' => $request->qualification,
            'designation' => $request->designation,
            'experience' => $request->experience,
            'joining_date' => $request->joining_date,
            'salary' => $request->salary,
            'address' => $request->address,
            'remarks' => $request->remarks,
            'is_active' => $request->is_active,
            'updated_by' => 1,

        ]);

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }
}
