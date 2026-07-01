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

            Route::resource('batches', BatchController::class);

            Route::resource('students', StudentController::class);

            Route::resource('teachers', TeacherController::class);

            Route::resource('question-categories', QuestionCategoryController::class);

            Route::resource('questions', QuestionController::class);

            /*
            |--------------------------------------------------------------------------
            | Examination
            |--------------------------------------------------------------------------
            */

            Route::resource('exams', ExamController::class);

            Route::resource('assign-exams', AssignExamController::class);

            Route::resource('results', ResultController::class);

            /*
            |--------------------------------------------------------------------------
            | Settings
            |--------------------------------------------------------------------------
            */

            Route::resource('settings', SettingController::class);

        });

    });