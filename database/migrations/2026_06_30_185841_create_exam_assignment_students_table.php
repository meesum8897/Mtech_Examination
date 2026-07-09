<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_assignment_students', function (Blueprint $table) {

            $table->id();

            $table->foreignId('assignment_id')
                ->constrained('exam_assignments')
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->enum('status',[
                'Pending',
                'Started',
                'Completed',
                'Absent'
            ])->default('Pending');

            $table->timestamps();

            $table->unique([
                'assignment_id',
                'student_id'
            ]);

        });
    }
    
    

    public function down(): void
    {
        Schema::dropIfExists('exam_assignment_students');
    }
};