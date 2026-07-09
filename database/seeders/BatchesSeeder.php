<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Batch;

class BatchesSeeder extends Seeder
{
    public function run(): void
    {
        Batch::insert([

            [
                'course_id' => 1,
                'batch_code' => 'MSO-001',
                'batch_name' => 'MS Office Morning',
                'teacher_id' => 1,
                'start_date' => '2026-07-01',
                'end_date' => '2026-10-01',
                'is_active' => true,
                'created_by' => null,
                'updated_by' => null,
            ],

            [
                'course_id' => 1,
                'batch_code' => 'MSO-002',
                'batch_name' => 'MS Office Evening',
                'teacher_id' => 1,
                'start_date' => '2026-07-15',
                'end_date' => '2026-10-15',
                'is_active' => true,
                'created_by' => null,
                'updated_by' => null,
            ],

            [
                'course_id' => 2,
                'batch_code' => 'GD-001',
                'batch_name' => 'Graphic Designing Weekend',
                'teacher_id' => 1,
                'start_date' => '2026-07-05',
                'end_date' => '2027-01-05',
                'is_active' => true,
                'created_by' => null,
                'updated_by' => null,
            ],

            [
                'course_id' => 3,
                'batch_code' => 'WEB-001',
                'batch_name' => 'Web Development Morning',
                'teacher_id' => 1,
                'start_date' => '2026-07-08',
                'end_date' => '2027-01-08',
                'is_active' => true,
                'created_by' => null,
                'updated_by' => null,
            ],

            [
                'course_id' => 4,
                'batch_code' => 'PHP-001',
                'batch_name' => 'PHP Batch A',
                'teacher_id' => 1,
                'start_date' => '2026-07-12',
                'end_date' => '2026-11-12',
                'is_active' => true,
                'created_by' => null,
                'updated_by' => null,
            ],

            [
                'course_id' => 5,
                'batch_code' => 'LAR-001',
                'batch_name' => 'Laravel Professional',
                'teacher_id' => 1,
                'start_date' => '2026-07-20',
                'end_date' => '2026-10-20',
                'is_active' => true,
                'created_by' => null,
                'updated_by' => null,
            ],

            [
                'course_id' => 6,
                'batch_code' => 'CS-001',
                'batch_name' => 'C# Programming Batch',
                'teacher_id' => 1,
                'start_date' => '2026-08-01',
                'end_date' => '2026-12-01',
                'is_active' => true,
                'created_by' => null,
                'updated_by' => null,
            ],

            [
                'course_id' => 7,
                'batch_code' => 'MVC-001',
                'batch_name' => 'ASP.NET MVC Batch',
                'teacher_id' => 1,
                'start_date' => '2026-08-05',
                'end_date' => '2026-12-05',
                'is_active' => true,
                'created_by' => null,
                'updated_by' => null,
            ],

            [
                'course_id' => 8,
                'batch_code' => 'WP-001',
                'batch_name' => 'WordPress Development',
                'teacher_id' => 1,
                'start_date' => '2026-08-10',
                'end_date' => '2026-10-10',
                'is_active' => true,
                'created_by' => null,
                'updated_by' => null,
            ],

            [
                'course_id' => 9,
                'batch_code' => 'PS-001',
                'batch_name' => 'Photoshop Professional',
                'teacher_id' => 1,
                'start_date' => '2026-08-15',
                'end_date' => '2026-10-15',
                'is_active' => true,
                'created_by' => null,
                'updated_by' => null,
            ],

        ]);
    }
}