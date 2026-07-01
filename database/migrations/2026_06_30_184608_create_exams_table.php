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

            $table->foreignId('course_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('exam_code',20)->unique();

            $table->string('exam_title');

            $table->enum('exam_type',[
                'Practice',
                'Quiz',
                'Assignment',
                'Mid',
                'Final'
            ]);

            $table->text('description')->nullable();

            $table->unsignedInteger('duration');

            $table->decimal('total_marks',8,2);

            $table->decimal('passing_marks',8,2);

            $table->unsignedInteger('question_limit');

            $table->boolean('random_questions')->default(false);

            $table->boolean('negative_marking')->default(false);

            $table->decimal('negative_marks',5,2)->default(0);

            $table->boolean('is_active')->default(true);

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