<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('question_categories', function (Blueprint $table) {

            $table->id();

            $table->foreignId('course_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('category_code',20)->unique();

            $table->string('category_name',150);

            $table->text('description')->nullable();

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
        Schema::dropIfExists('question_categories');
    }
};