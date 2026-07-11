<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\QuestionCategoryController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\AssignExamController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ExamQuestionController;
use App\Http\Controllers\Student\AuthController as StudentAuthController;
use App\Http\Controllers\Student\StudentExamController;



/*
|--------------------------------------------------------------------------
| Welcome
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('admin.login');
});

/*
|--------------------------------------------------------------------------
| Admin Panel
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    */

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');

    /*
    |--------------------------------------------------------------------------
    | Protected Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('admin.auth')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Logout
        |--------------------------------------------------------------------------
        */

        Route::get('/logout', [AuthController::class, 'logout'])
            ->name('logout');

        /*
        |--------------------------------------------------------------------------
        | Masters
        |--------------------------------------------------------------------------
        */

        Route::resource('courses', CourseController::class);

        Route::get('courses/{course}/view', [CourseController::class, 'show'])->name('courses.view');

/*             Route::get('courses/{id}/edit-data', [CourseController::class, 'editData'])->name('courses.editData');
*/
        Route::resource('courses', CourseController::class);
        Route::get('courses/{course}/view', [CourseController::class, 'show']);

        Route::resource('batches', BatchController::class);

        Route::resource('students', StudentController::class);
        Route::get('/admin/students/next-roll/{batch}',[StudentController::class, 'nextRoll'])->name('admin.students.nextRoll');

        Route::resource('teachers', TeacherController::class);
        
        Route::resource('question-categories', QuestionCategoryController::class);

        Route::resource('questions', QuestionController::class);

        Route::get('exam/{exam}/questions',[ExamQuestionController::class, 'index'])->name('exam.questions');
        Route::post('exam/{exam}/questions',[ExamQuestionController::class, 'store'])->name('exam.questions.store');
        Route::delete('exam/{exam}/questions/{question}',[ExamQuestionController::class, 'destroy'])->name('exam.questions.destroy');

        


        /*
        |--------------------------------------------------------------------------
        | Examination
        |--------------------------------------------------------------------------
        */

        Route::resource('exams', ExamController::class);

        Route::resource('assign-exams', AssignExamController::class);

        Route::prefix('results')->name('results.')->group(function () {

            Route::get('/', [ResultController::class, 'index'])
                ->name('index');

            Route::get('/batch/{batch}/exams',
                [ResultController::class, 'getExams'])
                ->name('getExams');

            Route::get('/batch/{batch}/exam/{exam}',
                [ResultController::class, 'getResults'])
                ->name('getResults');

        });

        Route::get('assign-exams/course/{course}/batches',[AssignExamController::class, 'getBatches'])->name('assign-exams.batches');
        Route::get('assign-exams/course/{course}/exams',[AssignExamController::class, 'getExams'])->name('assign-exams.exams');
        Route::get('assign-exams/summary/{batch}/{exam}',[AssignExamController::class, 'getSummary'])->name('assign-exams.summary');
        Route::resource('assign-exams', AssignExamController::class);

        /*
        |--------------------------------------------------------------------------
        | Settings
        |--------------------------------------------------------------------------
        */

        Route::resource('settings', SettingController::class);

    });

});


/* SUTDENT ROUTES */

/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return redirect()->route('student.login');

});

/*
|--------------------------------------------------------------------------
| Student Panel
|--------------------------------------------------------------------------
*/

Route::prefix('student')
    ->name('student.')
    ->group(function () {

    // ===========================
    // Authentication
    // ===========================

    Route::get('/login', [StudentAuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [StudentAuthController::class, 'login'])
        ->name('login.submit');

    // ===========================
    // Protected Routes
    // ===========================

    Route::middleware('student.auth')->group(function () {

        Route::get('/rules', [StudentExamController::class, 'rules'])
            ->name('rules');

        Route::post('/exam/start', [StudentExamController::class, 'startExam'])
            ->name('exam.start');

        Route::get('/exam', [StudentExamController::class, 'exam'])
            ->name('exam');

        Route::post('/exam/save-answer', [StudentExamController::class, 'saveAnswer'])
            ->name('exam.save-answer');

        Route::post('/exam/navigate', [StudentExamController::class, 'navigateQuestion'])
            ->name('exam.navigate');

        Route::post('/exam/finish', [StudentExamController::class, 'finishExam'])
            ->name('exam.finish');

        Route::get('/result', [StudentExamController::class, 'result'])
            ->name('result');

        Route::get('/logout', [StudentAuthController::class, 'logout'])
            ->name('logout');

    });

});