<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('course_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('question_category_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('question_code',20)->unique();

            // Question
            $table->longText('question');

            // For programming questions
            $table->longText('code_snippet')->nullable();

            $table->string('programming_language',50)->nullable();

            // Question Type
            $table->enum('question_type',[
                'MCQ',
                'TrueFalse',
                'ShortAnswer',
                'LongAnswer',
                'CodeMCQ',
                'CodeOutput',
                'FillInTheBlank'
            ])->default('MCQ');

            // Only for MCQ/TrueFalse
            $table->boolean('has_options')->default(true);

            // Marks
            $table->decimal('marks',5,2)->default(1);

            // 1 = Easy, 2 = Medium, 3 = Hard
            $table->tinyInteger('difficulty_level')->default(1);

            // Explanation shown after exam (optional)
            $table->longText('explanation')->nullable();

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
        Schema::dropIfExists('questions');
    }
};