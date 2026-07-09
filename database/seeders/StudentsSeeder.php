<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentsSeeder extends Seeder
{
    public function run(): void
    {
        $students = [

            [
                'batch_id' => 1,
                'student_code' => 'STD-001',
                'roll_no' => 'MSO-001',
                'first_name' => 'Ali',
                'last_name' => 'Raza',
                'father_name' => 'Syed Raza',
                'gender' => 'Male',
                'dob' => '2002-05-10',
                'cnic' => '42101-1234567-1',
                'email' => 'ali@example.com',
                'phone' => '03001234567',
                'guardian_phone' => '03111234567',
                'address' => 'Karachi',
                'admission_date' => '2026-07-01',
            ],

            [
                'batch_id' => 1,
                'student_code' => 'STD-002',
                'roll_no' => 'MSO-002',
                'first_name' => 'Ahmed',
                'last_name' => 'Khan',
                'father_name' => 'Imran Khan',
                'gender' => 'Male',
                'dob' => '2001-03-15',
                'cnic' => '42101-1234567-2',
                'email' => 'ahmed@example.com',
                'phone' => '03011234567',
                'guardian_phone' => '03121234567',
                'address' => 'Karachi',
                'admission_date' => '2026-07-01',
            ],

            [
                'batch_id' => 2,
                'student_code' => 'STD-003',
                'roll_no' => 'MSO-003',
                'first_name' => 'Fatima',
                'last_name' => 'Noor',
                'father_name' => 'Noor Ahmed',
                'gender' => 'Female',
                'dob' => '2003-01-20',
                'cnic' => '42101-1234567-3',
                'email' => 'fatima@example.com',
                'phone' => '03021234567',
                'guardian_phone' => '03131234567',
                'address' => 'Karachi',
                'admission_date' => '2026-07-05',
            ],

            [
                'batch_id' => 3,
                'student_code' => 'STD-004',
                'roll_no' => 'WEB-001',
                'first_name' => 'Usman',
                'last_name' => 'Ali',
                'father_name' => 'Muhammad Ali',
                'gender' => 'Male',
                'dob' => '2000-11-11',
                'cnic' => '42101-1234567-4',
                'email' => 'usman@example.com',
                'phone' => '03031234567',
                'guardian_phone' => '03141234567',
                'address' => 'Karachi',
                'admission_date' => '2026-07-10',
            ],

            [
                'batch_id' => 4,
                'student_code' => 'STD-005',
                'roll_no' => 'PHP-001',
                'first_name' => 'Ayesha',
                'last_name' => 'Siddiqui',
                'father_name' => 'Abdul Hameed',
                'gender' => 'Female',
                'dob' => '2002-09-08',
                'cnic' => '42101-1234567-5',
                'email' => 'ayesha@example.com',
                'phone' => '03041234567',
                'guardian_phone' => '03151234567',
                'address' => 'Karachi',
                'admission_date' => '2026-07-15',
            ],

        ];

        foreach ($students as $student) {

            Student::create([

                'batch_id' => $student['batch_id'],
                'student_code' => $student['student_code'],
                'roll_no' => $student['roll_no'],
                'first_name' => $student['first_name'],
                'last_name' => $student['last_name'],
                'father_name' => $student['father_name'],
                'gender' => $student['gender'],
                'dob' => $student['dob'],
                'cnic' => $student['cnic'],
                'email' => $student['email'],
                'phone' => $student['phone'],
                'guardian_phone' => $student['guardian_phone'],
                'address' => $student['address'],
                'admission_date' => $student['admission_date'],

                'password' => Hash::make('123456'),

                'is_active' => true,

                'created_by' => null,
                'updated_by' => null,

            ]);

        }
    }
}