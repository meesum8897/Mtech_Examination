<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('exam_attempt_answers', function (Blueprint $table) {

    $table->id();

    $table->foreignId('attempt_id')
          ->constrained('exam_attempts')
          ->cascadeOnDelete();

    $table->foreignId('question_id')
          ->constrained('questions')
          ->cascadeOnDelete();

    // Random question order for this student
    $table->unsignedInteger('display_order');

    // Student selected option (A, B, C, D or True/False)
    $table->string('selected_answer')->nullable();

    // Whether the answer is correct
    $table->boolean('is_correct')->nullable();

    // Marks obtained for this question
    $table->decimal('marks_obtained', 5, 2)->default(0);

    // Time when student answered the question
    $table->timestamp('answered_at')->nullable();

    $table->boolean('visited')->default(false);

    $table->timestamps();

    // Prevent Duplicate Question in Same Attempt
    $table->unique([
        'attempt_id',
        'question_id'
    ]);

});
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_attempt_answers');
    }
};