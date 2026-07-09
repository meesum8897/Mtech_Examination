<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Exam;
use App\Models\ExamResult;


class ResultController extends Controller
{
    public function index()
    {
        $batches = Batch::where('is_active', true)
                        ->orderBy('batch_name')
                        ->get();

        return view('admin.result', compact('batches'));
    }

    public function getExams(Batch $batch)
    {
        $exams = Exam::where('course_id', $batch->course_id)
            ->where('status', 'Published')
            ->where('is_active', true)
            ->orderBy('exam_title')
            ->get([
                'id',
                'exam_title'
            ]);

        return response()->json($exams);
    }

public function getResults($batchId, $examId)
{
    $query = ExamResult::with('student')
        ->where('exam_id', $examId)
        ->whereHas('student', function ($q) use ($batchId) {
            $q->where('batch_id', $batchId);
        });

    $results = (clone $query)->paginate(10);

    $stats = [

        'total_students' => (clone $query)->count(),

        'passed' => (clone $query)
            ->where('result_status', 'Pass')
            ->count(),

        'failed' => (clone $query)
            ->where('result_status', 'Fail')
            ->count(),

        'average_percentage' => round(
            (clone $query)->avg('percentage'),
            2
        ),

    ];

    return response()->json([
        'results' => $results,
        'stats'   => $stats
    ]);
}
}