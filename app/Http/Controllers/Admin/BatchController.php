<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Batch;

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

        return view('admin.batches', [

            'batches' => $batches,

            'courses' => Course::where('is_active', 1)
                ->orderBy('course_name')
                ->get(),

            'totalBatches' => Batch::count(),

            'activeBatches' => Batch::where('is_active', 1)->count(),

            'inactiveBatches' => Batch::where('is_active', 0)->count(),

            'runningBatches' => Batch::whereDate('end_date', '>=', now())->count(),

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
