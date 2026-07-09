<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    $this->call([
        UsersSeeder::class,
        CoursesSeeder::class,
        TeachersSeeder::class,
        BatchesSeeder::class,
        StudentsSeeder::class,
        ExamsSeeder::class,
        QuestionsSeeder::class,
        ExamQuestionSeeder::class,
        ExamResultsSeeder::class,
    ]);
}
}
