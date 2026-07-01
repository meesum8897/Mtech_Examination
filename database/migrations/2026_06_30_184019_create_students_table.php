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
        Schema::create('students', function (Blueprint $table) {

        $table->id();

        $table->foreignId('batch_id')
            ->constrained('batches')
            ->cascadeOnDelete();

        $table->string('student_code',20)->unique();

        $table->string('roll_no',20)->unique();

        $table->string('first_name',100);

        $table->string('last_name',100)->nullable();

        $table->string('father_name',150);

        $table->enum('gender',[
            'Male',
            'Female',
            'Other'
        ]);

        $table->date('dob')->nullable();

        $table->string('cnic',20)->nullable()->unique();

        $table->string('email')->nullable()->unique();

        $table->string('phone',20);

        $table->string('guardian_phone',20)->nullable();

        $table->text('address')->nullable();

        $table->date('admission_date');

        $table->string('photo')->nullable();

        /*
        |--------------------------------------------------------------------------
        | Student Login
        |--------------------------------------------------------------------------
        */

        $table->string('password');

        $table->rememberToken();

        $table->timestamp('last_login_at')->nullable();

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
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};