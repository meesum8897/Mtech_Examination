<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_results', function (Blueprint $table) {

            $table->id();

            $table->foreignId('attempt_id')
                ->constrained('exam_attempts')
                ->cascadeOnDelete();

            $table->decimal('total_marks',8,2);

            $table->decimal('obtained_marks',8,2);

            $table->decimal('percentage',5,2);

            $table->string('grade',10)->nullable();

            $table->boolean('is_pass')->default(false);

            $table->unsignedInteger('rank')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};