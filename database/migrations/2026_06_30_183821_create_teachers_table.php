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
        Schema::create('teachers', function (Blueprint $table) {

            $table->id();

            $table->string('teacher_code',20)->unique();

            $table->string('name');

            $table->string('email')->unique();

            $table->string('phone',20);

            $table->string('cnic',20)->unique();

            $table->enum('gender',['Male','Female','Other']);

            $table->string('qualification')->nullable();

            $table->unsignedTinyInteger('experience')->default(0);

            $table->date('joining_date');

            $table->decimal('salary',10,2)->default(0);

            $table->text('address')->nullable();

            $table->string('photo')->nullable();

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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};