<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_active', 1)
            ->orderBy('course_name')
            ->get();

        $exams = Exam::with('course')
            ->latest()
            ->paginate(10);

        return view('admin.exam', compact(
            'courses',
            'exams'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'exam_title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'duration' => 'required|integer|min:1',
            'passing_marks' => 'required|numeric|min:1',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date|after:starts_at',
            'status' => 'required|in:Draft,Published',
        ]);

        $exam = Exam::create([
            'course_id'      => $validated['course_id'],
            'exam_code'      => $this->generateExamCode(),
            'exam_title'     => $validated['exam_title'],
            'duration'       => $validated['duration'],
            'passing_marks'  => $validated['passing_marks'],
            'starts_at'      => $validated['starts_at'],
            'ends_at'        => $validated['ends_at'],
            'status'         => $validated['status'],
            'is_active'      => true,
            'created_by'     => Auth::id(),
        ]);

        return redirect()
            ->route('admin.exams.index')
            ->with('success', 'Exam created successfully.');
    }

    private function generateExamCode()
    {
        $lastExam = Exam::withTrashed()
            ->orderByDesc('id')
            ->first();

        if (!$lastExam) {

            return 'EXM-0001';

        }

        $lastNumber = (int) str_replace('EXM-', '', $lastExam->exam_code);

        return 'EXM-' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
    }

    public function destroy(Exam $exam)
    {
        $exam->update([

            'status' => 'Cancelled',

            'is_active' => false,

            'updated_by' => 1,

        ]);

        $exam->delete();

        return redirect()
            ->route('admin.exams.index')
            ->with('success', 'Exam cancelled successfully.');
    }
}