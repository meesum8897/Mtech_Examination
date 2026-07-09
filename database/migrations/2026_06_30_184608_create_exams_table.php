<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {

            $table->id();

            // Course
            $table->foreignId('course_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Exam Information
            $table->string('exam_code',20)->unique();

            $table->string('exam_title');

            // Duration (Minutes)
            $table->unsignedInteger('duration');

            // Passing Marks
            $table->decimal('passing_marks',8,2);

            // Schedule
            $table->dateTime('starts_at');

            $table->dateTime('ends_at');

            // Status
            $table->enum('status',[
                'Draft',
                'Published',
                'Cancelled'
            ])->default('Draft');

            // Active / Inactive
            $table->boolean('is_active')->default(true);

            // Audit
            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->foreignId('updated_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamps();

            $table->softDeletes();

        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};