<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CoursesSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [

            [
                'course_code' => 'MSO',
                'course_name' => 'Microsoft Office',
                'duration'    => '3 Months',
                'type'        => 'Short Course',
                'description' => 'Microsoft Office Professional Course'
            ],

            [
                'course_code' => 'GD',
                'course_name' => 'Graphic Designing',
                'duration'    => '6 Months',
                'type'        => 'Diploma',
                'description' => 'Graphic Designing using Adobe Photoshop & Illustrator'
            ],

            [
                'course_code' => 'WEB',
                'course_name' => 'Web Development',
                'duration'    => '6 Months',
                'type'        => 'Diploma',
                'description' => 'HTML, CSS, Bootstrap, JavaScript'
            ],

            [
                'course_code' => 'PHP',
                'course_name' => 'PHP Development',
                'duration'    => '4 Months',
                'type'        => 'Professional',
                'description' => 'Core PHP with MySQL'
            ],

            [
                'course_code' => 'LAR',
                'course_name' => 'Laravel Development',
                'duration'    => '3 Months',
                'type'        => 'Professional',
                'description' => 'Laravel Framework with Live Projects'
            ],

            [
                'course_code' => 'CS',
                'course_name' => 'C# Programming',
                'duration'    => '4 Months',
                'type'        => 'Professional',
                'description' => 'C# Windows Application Development'
            ],

            [
                'course_code' => 'MVC',
                'course_name' => 'ASP.NET MVC',
                'duration'    => '4 Months',
                'type'        => 'Professional',
                'description' => 'ASP.NET MVC with SQL Server'
            ],

            [
                'course_code' => 'WP',
                'course_name' => 'WordPress Development',
                'duration'    => '2 Months',
                'type'        => 'Short Course',
                'description' => 'WordPress Theme & Plugin Development'
            ],

            [
                'course_code' => 'PS',
                'course_name' => 'Adobe Photoshop',
                'duration'    => '2 Months',
                'type'        => 'Short Course',
                'description' => 'Professional Image Editing'
            ],

            [
                'course_code' => 'AI',
                'course_name' => 'Adobe Illustrator',
                'duration'    => '2 Months',
                'type'        => 'Short Course',
                'description' => 'Vector Graphic Designing'
            ]

        ];

        foreach ($courses as $course) {

            Course::create([

                'course_code' => $course['course_code'],
                'course_name' => $course['course_name'],
                'duration'    => $course['duration'],
                'type'        => $course['type'],
                'description' => $course['description'],

                'is_active'   => true,

                'created_by'  => null,
                'updated_by'  => null,

            ]);

        }
    }
}