<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeachersSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [

            [
                'teacher_code' => 'TCH-001',
                'teacher_name' => 'Muhammad Ali',
                'father_name' => 'Abdul Kareem',
                'cnic' => '42101-1234567-1',
                'mobile' => '03001234567',
                'email' => 'ali@mtech.com',
                'gender' => 'Male',
                'qualification' => 'BS Computer Science',
                'designation' => 'Senior Instructor',
                'experience' => 5,
                'joining_date' => '2024-01-15',
                'salary' => 60000,
                'address' => 'Karachi',
                'remarks' => 'PHP & Laravel Trainer'
            ],

            [
                'teacher_code' => 'TCH-002',
                'teacher_name' => 'Ahmed Raza',
                'father_name' => 'Muhammad Raza',
                'cnic' => '42101-1234567-2',
                'mobile' => '03011234567',
                'email' => 'ahmed@mtech.com',
                'gender' => 'Male',
                'qualification' => 'BS Software Engineering',
                'designation' => 'Instructor',
                'experience' => 4,
                'joining_date' => '2024-02-01',
                'salary' => 55000,
                'address' => 'Karachi',
                'remarks' => 'Web Development'
            ],

            [
                'teacher_code' => 'TCH-003',
                'teacher_name' => 'Fatima Khan',
                'father_name' => 'Imran Khan',
                'cnic' => '42101-1234567-3',
                'mobile' => '03021234567',
                'email' => 'fatima@mtech.com',
                'gender' => 'Female',
                'qualification' => 'MBA',
                'designation' => 'Instructor',
                'experience' => 6,
                'joining_date' => '2023-10-01',
                'salary' => 65000,
                'address' => 'Karachi',
                'remarks' => 'Office Automation'
            ],

            [
                'teacher_code' => 'TCH-004',
                'teacher_name' => 'Usman Tariq',
                'father_name' => 'Tariq Mehmood',
                'cnic' => '42101-1234567-4',
                'mobile' => '03031234567',
                'email' => 'usman@mtech.com',
                'gender' => 'Male',
                'qualification' => 'BS IT',
                'designation' => 'Instructor',
                'experience' => 3,
                'joining_date' => '2025-01-01',
                'salary' => 50000,
                'address' => 'Karachi',
                'remarks' => 'C# Trainer'
            ],

            [
                'teacher_code' => 'TCH-005',
                'teacher_name' => 'Ayesha Noor',
                'father_name' => 'Noor Ahmed',
                'cnic' => '42101-1234567-5',
                'mobile' => '03041234567',
                'email' => 'ayesha@mtech.com',
                'gender' => 'Female',
                'qualification' => 'BS Multimedia',
                'designation' => 'Graphic Instructor',
                'experience' => 5,
                'joining_date' => '2024-06-01',
                'salary' => 58000,
                'address' => 'Karachi',
                'remarks' => 'Graphic Designing'
            ]

        ];

        foreach ($teachers as $teacher) {

            Teacher::create([

                'teacher_code' => $teacher['teacher_code'],
                'teacher_name' => $teacher['teacher_name'],
                'father_name' => $teacher['father_name'],
                'cnic' => $teacher['cnic'],
                'mobile' => $teacher['mobile'],
                'email' => $teacher['email'],
                'gender' => $teacher['gender'],
                'qualification' => $teacher['qualification'],
                'designation' => $teacher['designation'],
                'experience' => $teacher['experience'],
                'joining_date' => $teacher['joining_date'],
                'salary' => $teacher['salary'],
                'address' => $teacher['address'],
                'remarks' => $teacher['remarks'],

                'is_active' => true,

                'created_by' => null,
                'updated_by' => null,

            ]);

        }
    }
}