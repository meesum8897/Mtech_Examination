<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_assignments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('exam_id')
                ->constrained('exams')
                ->cascadeOnDelete();

            $table->foreignId('batch_id')
                ->constrained('batches')
                ->cascadeOnDelete();

            $table->foreignId('assigned_by')
                ->constrained('users');

            $table->dateTime('start_datetime');

            $table->dateTime('end_datetime');

            // Override exam settings if needed
            $table->unsignedInteger('duration')->nullable();

            $table->unsignedTinyInteger('attempts')->default(1);

            $table->boolean('shuffle_questions')->default(false);

            $table->boolean('shuffle_options')->default(false);

            $table->boolean('show_result')->default(false);

            $table->enum('status',[
                'Draft',
                'Scheduled',
                'Active',
                'Completed',
                'Cancelled'
            ])->default('Draft');

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_assignments');
    }
};