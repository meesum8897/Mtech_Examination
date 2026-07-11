<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_attempts', function (Blueprint $table) {

            $table->id();

            // Assigned Exam
            $table->foreignId('assignment_id')
                ->constrained('exam_assignments')
                ->cascadeOnDelete();

            // Student
            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            // Exam Start
            $table->dateTime('started_at');

            // Exam End
            $table->dateTime('ended_at')->nullable();

            // Remaining Seconds
            $table->unsignedInteger('remaining_seconds');
            
            $table->integer('current_question')->default(1);

            // Marks Obtained
            $table->decimal('obtained_marks',8,2)->default(0);

            // Status
            $table->enum('status',[
                'Started',
                'Completed',
                'Expired'
            ])->default('Started');

            $table->timestamps();

            $table->softDeletes();

            // One Attempt Per Student Per Assignment
            $table->unique([
                'assignment_id',
                'student_id'
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_attempts');
    }
};