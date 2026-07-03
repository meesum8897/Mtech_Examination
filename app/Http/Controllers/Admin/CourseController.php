<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Course::query();

        if ($request->filled('search')) {
            $query->where('course_name', 'like', '%' . $request->search . '%')
                ->orWhere('course_code', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }

        $courses = $query->latest()->paginate(10);

        $totalCourses = Course::count();

        $activeCourses = Course::where('is_active', 1)->count();

        $shortCourses = Course::where('type', 'Short Course')->count();

        $diplomaCourses = Course::where('type', 'Diploma')->count();

        return view('admin.courses', compact(
            'courses',
            'totalCourses',
            'activeCourses',
            'shortCourses',
            'diplomaCourses'
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
        'course_code' => 'required|max:20|unique:courses,course_code',
        'course_name' => 'required|max:150',
        'duration' => 'required',
        'type' => 'required',
        'description' => 'nullable',
        'is_active' => 'required|boolean',
    ]);

    Course::create([
        'course_code' => $request->course_code,
        'course_name' => $request->course_name,
        'duration' => $request->duration,
        'type' => $request->type,
        'description' => $request->description,
        'is_active' => $request->is_active,
        'created_by' => 1, // temporarily
    ]);

    return redirect()
        ->route('admin.courses.index')
        ->with('success', 'Course added successfully.');
}

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);

        return response()->json($course);
    }

    public function show(Course $course)
    {
        return response()->json($course);
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_code' => 'required|unique:courses,course_code,' . $course->id,
            'course_name' => 'required|max:255',
            'duration'    => 'required',
            'type'        => 'required',
            'description' => 'nullable',
            'is_active'   => 'required'
        ]);

        $course->update([
            'course_code' => $request->course_code,
            'course_name' => $request->course_name,
            'duration'    => $request->duration,
            'type'        => $request->type,
            'description' => $request->description,
            'is_active'   => $request->is_active,

            // Replace this later when proper authentication is implemented
            'updated_by'  => session('user_id') ?? 1,
        ]);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course deleted successfully.');
    }


}
