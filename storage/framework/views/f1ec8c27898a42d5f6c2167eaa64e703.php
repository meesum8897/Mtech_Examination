<?php if (isset($component)) { $__componentOriginal45d9cbba1e84739af2366cafaf311004 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal45d9cbba1e84739af2366cafaf311004 = $attributes; } ?>
<?php $component = App\View\Components\Admin\Header::resolve(['title' => 'Students Management','breadcrumb' => 'Students Management','msg' => 'Manage all examination students'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Admin\Header::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal45d9cbba1e84739af2366cafaf311004)): ?>
<?php $attributes = $__attributesOriginal45d9cbba1e84739af2366cafaf311004; ?>
<?php unset($__attributesOriginal45d9cbba1e84739af2366cafaf311004); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal45d9cbba1e84739af2366cafaf311004)): ?>
<?php $component = $__componentOriginal45d9cbba1e84739af2366cafaf311004; ?>
<?php unset($__componentOriginal45d9cbba1e84739af2366cafaf311004); ?>
<?php endif; ?>
<!-- STATISTICS -->

    <div class="student-stats">

        <div class="stat-card">

            <h4>Total Students</h4>

            <h2><?php echo e($totalStudents); ?></h2>

        </div>

        <div class="stat-card">

            <h4>Active Students</h4>

            <h2><?php echo e($activeStudents); ?></h2>

        </div>

        <div class="stat-card">

            <h4>Diploma Students</h4>

            <h2><?php echo e($diplomaStudents); ?></h2>

        </div>

        <div class="stat-card">

            <h4>Short Course Students</h4>

            <h2><?php echo e($shortCourseStudents); ?></h2>

        </div>

    </div>

    <!-- ACTION BAR -->

    <div class="page-header">

        <div>

            <h3>Students Directory</h3>
            <p>Search, Add, Edit and Manage Students</p>

        </div>

        <div class="page-actions">

            <button class="btn btn-outline">
                Import Excel
            </button>

            <button class="btn btn-primary" id="addStudentBtn">
                + Add Student
            </button>

        </div>

    </div>

<form method="GET" action="<?php echo e(route('admin.students.index')); ?>">

    <div class="filter-card">

        <div class="filter-grid">

            <!-- Search -->

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search Student Name, ID or Mobile"
                value="<?php echo e(request('search')); ?>">

            <!-- Course -->

            <select
                name="course_id"
                class="form-control">

                <option value="">
                    All Courses
                </option>

                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option
                        value="<?php echo e($course->id); ?>"
                        <?php echo e(request('course_id') == $course->id ? 'selected' : ''); ?>>

                        <?php echo e($course->course_name); ?>


                    </option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>

            <!-- Batch -->

            <select
                name="batch_id"
                class="form-control">

                <option value="">
                    All Batches
                </option>

                <?php $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option
                        value="<?php echo e($batch->id); ?>"
                        <?php echo e(request('batch_id') == $batch->id ? 'selected' : ''); ?>>

                        <?php echo e($batch->batch_name); ?>


                    </option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>

            <!-- Status -->

            <select
                name="status"
                class="form-control">

                <option value="">
                    All Status
                </option>

                <option
                    value="1"
                    <?php echo e(request('status') === '1' ? 'selected' : ''); ?>>

                    Active

                </option>

                <option
                    value="0"
                    <?php echo e(request('status') === '0' ? 'selected' : ''); ?>>

                    Inactive

                </option>

            </select>

        </div>

        <div class="filter-actions">

            <button
                type="submit"
                class="btn btn-primary">

                Search

            </button>

            <button class="btn btn-light">
                Reset
            </button>

        </div>

    </div>

</form>

    <!-- TABLE -->

<div class="table-card">

    <div class="table-card-header">

        <h3>
            Student List
        </h3>

    </div>

    <div class="table-responsive">

        <table class="custom-table">

            <thead>

                <tr>

                    <th>Student Code</th>
                    <th>Roll No</th>
                    <th>Student Name</th>
                    <th>Father Name</th>
                    <th>Course</th>
                    <th>Batch</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>

                        <td><?php echo e($student->student_code); ?></td>

                        <td><?php echo e($student->roll_no); ?></td>

                        <td>

                            <?php echo e($student->first_name); ?>


                            <?php echo e($student->last_name); ?>


                        </td>

                        <td><?php echo e($student->father_name); ?></td>

                        <td>

                            <?php echo e($student->batch->course->course_name ?? '-'); ?>


                        </td>

                        <td>

                            <?php echo e($student->batch->batch_name ?? '-'); ?>


                        </td>

                        <td><?php echo e($student->phone); ?></td>

                        <td>

                            <?php if($student->is_active): ?>

                                <span class="badge-success">

                                    Active

                                </span>

                            <?php else: ?>

                                <span class="badge-danger">

                                    Inactive

                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <div class="table-actions">

                                <button
                                    class="action-btn view-btn"
                                    data-id="<?php echo e($student->id); ?>">

                                    View

                                </button>

                                <button
                                    class="action-btn edit-btn"
                                    data-id="<?php echo e($student->id); ?>">

                                    Edit

                                </button>

                                <form
                                    action="<?php echo e(route('admin.students.destroy',$student->id)); ?>"
                                    method="POST"
                                    class="delete-form"
                                    style="display:inline;">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button
                                        type="submit"
                                        class="action-btn delete-btn">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" style="text-align:center;padding:25px;">
                            No courses found.
                        </td>
                    </tr>
                <?php endif; ?>

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->

    <div class="pagination">

        <?php if($students->onFirstPage()): ?>

            <button disabled>

                Previous

            </button>

        <?php else: ?>

            <button onclick="window.location='<?php echo e($students->previousPageUrl()); ?>'">

                Previous

            </button>

        <?php endif; ?>

        <?php for($i = 1; $i <= $students->lastPage(); $i++): ?>

            <button
                class="<?php echo e($students->currentPage() == $i ? 'active' : ''); ?>"
                onclick="window.location='<?php echo e($students->url($i)); ?>'">

                <?php echo e($i); ?>


            </button>

        <?php endfor; ?>

        <?php if($students->hasMorePages()): ?>

            <button onclick="window.location='<?php echo e($students->nextPageUrl()); ?>'">

                Next

            </button>

        <?php else: ?>

            <button disabled>

                Next

            </button>

        <?php endif; ?>

    </div>


<!-- =========================
ADD STUDENT MODAL
========================= -->

<div class="modal" id="studentModal">

    <div class="modal-box">

        <form action="<?php echo e(route('admin.students.store')); ?>" method="POST" enctype="multipart/form-data">

            <?php echo csrf_field(); ?>

            <div class="modal-header">

                <h3>Add Student</h3>

                <button type="button" class="close-modal">
                    ×
                </button>

            </div>

            <div class="modal-body">

                <div class="form-grid">

                    <!-- Student Code -->

                    <div>

                        <input
                            type="text"
                            id="student_code"
                            class="form-control <?php $__errorArgs = ['student_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="student_code"
                            value="<?php echo e(old('student_code', $studentCode)); ?>"
                            readonly/>

                        <?php $__errorArgs = ['student_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>

                    <!-- Roll No -->

                        <div>

                            <input
                                type="text"
                                id="roll_no"
                                class="form-control <?php $__errorArgs = ['roll_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="roll_no"
                                value="<?php echo e(old('roll_no', $generatedRollNo)); ?>"
                                placeholder="Roll No"
                                readonly>

                            <?php $__errorArgs = ['roll_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>

                    <!-- Batch -->

    <div>

        <select id="batch_id" name="batch_id" class="form-control">

            <option value="">Select Batch</option>

            <?php $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <option value="<?php echo e($batch->id); ?>">

                    <?php echo e($batch->batch_code); ?> - <?php echo e($batch->batch_name); ?>


                </option>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </select>

        <?php $__errorArgs = ['batch_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="text-danger"><?php echo e($message); ?></small>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    </div>

                    <!-- Gender -->

                <div>

                    <select
                        name="gender"
                        class="form-control <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                        <option selected disabled>
                            Select Gender
                        </option>

                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>

                    </select>

                    <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                <!-- First Name -->

                <div>

                    <input
                        type="text"
                        class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="first_name"
                        placeholder="First Name"
                        value="<?php echo e(old('first_name')); ?>">

                    <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                <!-- Last Name -->

                <div>

                    <input
                        type="text"
                        class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="last_name"
                        placeholder="Last Name"
                        value="<?php echo e(old('last_name')); ?>">

                    <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                <!-- Father Name -->

                <div>

                    <input
                        type="text"
                        class="form-control <?php $__errorArgs = ['father_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="father_name"
                        placeholder="Father Name"
                        value="<?php echo e(old('father_name')); ?>">

                    <?php $__errorArgs = ['father_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                <!-- Date of Birth -->

                <div>

                    <input
                        type="date"
                        class="form-control <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="dob"
                        value="<?php echo e(old('dob')); ?>">

                    <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                <!-- CNIC -->

                <div>

                    <input
                        type="text"
                        class="form-control <?php $__errorArgs = ['cnic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="cnic"
                        placeholder="CNIC / B-Form"
                        value="<?php echo e(old('cnic')); ?>">

                    <?php $__errorArgs = ['cnic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                <!-- Phone -->

                <div>

                    <input
                        type="text"
                        class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="phone"
                        placeholder="Mobile"
                        value="<?php echo e(old('phone')); ?>">

                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                <!-- Guardian Phone -->

                <div>

                    <input
                        type="text"
                        class="form-control <?php $__errorArgs = ['guardian_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="guardian_phone"
                        placeholder="Guardian Phone"
                        value="<?php echo e(old('guardian_phone')); ?>">

                    <?php $__errorArgs = ['guardian_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                <!-- Email -->

                <div>

                    <input
                        type="email"
                        class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="email"
                        placeholder="Email"
                        value="<?php echo e(old('email')); ?>">

                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                <!-- Admission Date -->

                <div>

                    <input
                        type="date"
                        class="form-control <?php $__errorArgs = ['admission_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="admission_date"
                        value="<?php echo e(old('admission_date')); ?>">

                    <?php $__errorArgs = ['admission_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                <!-- Status -->

                <div>

                <select
                    name="is_active"
                    class="form-control <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                    <option value="1" <?php echo e(old('is_active','1')=='1' ? 'selected' : ''); ?>>
                        Active
                    </option>

                    <option value="0" <?php echo e(old('is_active')=='0' ? 'selected' : ''); ?>>
                        Inactive
                    </option>

                </select>

                    <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

            </div>

            <br>

            <!-- Address -->
            <div>
                <textarea
                    class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    name="address"
                    placeholder="Address"
                    style="height:100px;"><?php echo e(old('address')); ?></textarea>

                <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="text-danger"><?php echo e($message); ?></small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <br>

            <div class="form-grid">

                <!-- Password -->

                <div>

                    <input
                        type="text"
                        id="password"
                        class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="password"
                        value="<?php echo e(old('password', $generatedPassword)); ?>"
                        readonly>

                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                <!-- Confirm Password -->

                <div>

                    <input
                        type="text"
                        id="password_confirmation"
                        class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>""
                        name="password_confirmation"
                        value="<?php echo e(old('password_confirmation', $generatedPassword)); ?>"
                        readonly>

                </div>

            </div>

            <br>

        </div>

        <div class="modal-footer">

            <button
                type="button"
                class="btn btn-dark close-modal">

                Cancel

            </button>

            <button
                type="submit"
                class="btn btn-primary">

                Save Student

            </button>

        </div>

        </form>

    </div>

</div>

<!-- DELETE MODAL -->

<div class="modal" id="deleteModal">

    <div class="confirm-box">

        <h3>Delete Student</h3>

        <p>
            Are you sure you want to delete this student?
        </p>

        <div class="confirm-actions">

            <button class="btn btn-light closeModal cancelbtn">
                Cancel
            </button>

            <button class="btn btn-danger">
                Delete
            </button>

        </div>

    </div>

</div>

</body>
<?php if(session('success')): ?>

<script>

Swal.fire({

    icon:'success',

    title:'Success',

    text:'<?php echo e(session('success')); ?>',

    timer:2500,

    showConfirmButton:false

});

</script>

<?php endif; ?>

<?php if($errors->any()): ?>

<script>

document.addEventListener('DOMContentLoaded', function(){

    $('#studentModal').fadeIn();

});

</script>

<?php endif; ?>

<?php if(session('success')): ?>

<script>

Swal.fire({

    icon: 'success',

    title: 'Success',

    text: '<?php echo e(session('success')); ?>',

    timer: 2500,

    showConfirmButton: false

});

</script>

<?php endif; ?>
</html><?php /**PATH C:\xampp\htdocs\mtech_exam\resources\views/admin/student.blade.php ENDPATH**/ ?>