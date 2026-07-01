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

            $table->foreignId('assignment_student_id')
                ->constrained('exam_assignment_students')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('attempt_no');

            $table->dateTime('started_at')->nullable();

            $table->dateTime('submitted_at')->nullable();

            $table->unsignedInteger('time_taken')->nullable();

            $table->enum('status',[
                'In Progress',
                'Submitted',
                'Auto Submitted'
            ])->default('In Progress');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_attempts');
    }
};