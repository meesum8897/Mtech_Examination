<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exam_results', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relationships
            |--------------------------------------------------------------------------
            */

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->foreignId('exam_id')
                ->constrained('exams')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Result
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('total_questions');

            $table->unsignedInteger('correct_answers')->default(0);

            $table->unsignedInteger('wrong_answers')->default(0);

            $table->unsignedInteger('not_attempted')->default(0);

            $table->decimal('total_marks', 8, 2);

            $table->decimal('obtained_marks', 8, 2)->default(0);

            $table->decimal('percentage', 5, 2)->default(0);

            $table->string('grade', 5)->nullable();

            $table->enum('result_status', [
                'Pass',
                'Fail'
            ]);

            /*
            |--------------------------------------------------------------------------
            | Exam Timing
            |--------------------------------------------------------------------------
            */

            $table->dateTime('started_at')->nullable();

            $table->dateTime('submitted_at')->nullable();

            $table->unsignedInteger('time_taken')->nullable(); // Minutes

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')->default(true);

            /*
            |--------------------------------------------------------------------------
            | Audit
            |--------------------------------------------------------------------------
            */

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

            /*
            |--------------------------------------------------------------------------
            | One Result Per Student Per Exam
            |--------------------------------------------------------------------------
            */

            $table->unique(['student_id', 'exam_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};