<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_assignments', function (Blueprint $table) 
        {

            $table->id();

            $table->foreignId('exam_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('batch_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->dateTime('start_datetime');

            $table->dateTime('end_datetime');

            $table->boolean('show_result')->default(false);

            $table->enum('status',[
                'Draft',
                'Scheduled',
                'Active',
                'Completed',
                'Cancelled'
            ])->default('Draft');

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

            $table->unique([
                'exam_id',
                'batch_id'
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_assignments');
    }
};