<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Batch;
use App\Models\Teacher;
use App\Models\Student;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batches = Batch::with('course')
            ->latest()
            ->paginate(10);

        $totalBatches = Batch::count();
        $activeBatches = Batch::where('is_active', 1)->count();
        $inactiveBatches = Batch::where('is_active', 0)->count();
        $totalStudents = Student::count();
        $batchCode = $this->generateBatchCode();
        
        return view('admin.batches', [

            'batches' => $batches,

            'teachers' => Teacher::where('is_active', 1)
                ->orderBy('teacher_name')
                ->get(),

            'courses' => Course::where('is_active', 1)
                ->orderBy('course_name')
                ->get(),
            'batchCode' => $batchCode,
            'totalBatches' => $totalBatches,
            'activeBatches' => $activeBatches,
            'inactiveBatches' => $inactiveBatches,
            'totalStudents' => $totalStudents,

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
        $request->validate([

            'course_id'  => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id',
            'batch_code' => 'required|max:20|unique:batches,batch_code',
            'batch_name' => 'required|max:150',
            'start_date' => 'required|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
            'is_active'  => 'required',

        ]);

        Batch::create([

            'course_id'  => $request->course_id,
            'teacher_id' => $request->teacher_id,
            'batch_code' => $this->generateBatchCode(),
            'batch_name' => $request->batch_name,
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'is_active'  => $request->is_active,
            'created_by' => 1

        ]);

        return redirect()
            ->route('admin.batches.index')
            ->with('success', 'Batch added successfully.');
    }

    private function generateBatchCode()
    {
        // Prefix = YYMM (e.g. 2607)
        $prefix = now()->format('ym');

        // Total batches created this month
        $count = Batch::whereYear('created_at', now()->year)
                    ->whereMonth('created_at', now()->month)
                    ->count();

        // Convert 0=A, 1=B, ..., 25=Z, 26=AA...
        $suffix = $this->numberToLetters($count);

        return $prefix . $suffix;
    }

    private function numberToLetters($number)
    {
        $letters = '';

        do {

            $letters = chr(65 + ($number % 26)) . $letters;

            $number = intdiv($number, 26) - 1;

        } while ($number >= 0);

        return $letters;
    }

    /**
     * Display the specified resource.
     */
    public function show(Batch $batch)
    {
        $batch->load(['course','teacher'])
            ->loadCount('students');

        return response()->json($batch);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Batch $batch)
    {
        return response()->json($batch);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Batch $batch)
    {
        $request->validate([

            'course_id'  => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id',
            'batch_code' => 'required|max:20|unique:batches,batch_code,' . $batch->id,
            'batch_name' => 'required|max:150',
            'start_date' => 'required|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
            'is_active'  => 'required'

        ]);

        $batch->update([

            'course_id'  => $request->course_id,
            'teacher_id' => $request->teacher_id,
            'batch_code' => $request->batch_code,
            'batch_name' => $request->batch_name,
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'is_active'  => $request->is_active,
            'updated_by' => 1

        ]);

        return redirect()
            ->route('admin.batches.index')
            ->with('success','Batch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Batch $Batch)
    {
        $Batch->delete();

        return redirect()
            ->route('admin.batches.index')
            ->with('success', 'Batch deleted successfully.');
    }
    
}
