<?php if (isset($component)) { $__componentOriginal45d9cbba1e84739af2366cafaf311004 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal45d9cbba1e84739af2366cafaf311004 = $attributes; } ?>
<?php $component = App\View\Components\Admin\Header::resolve(['title' => 'Batch Management','breadcrumb' => 'Batch Management','msg' => 'Manage course batches and assigned teachers'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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

 <!-- PAGE HEADER -->

    <div class="page-header">

        <div>

            <h2>Batches</h2>

            <p>
                Create and manage training batches
            </p>

        </div>

        <button
        class="btn btn-primary"
        id="openBatchModal">

            + Add Batch

        </button>

    </div>

    <!-- =====================================
    STATISTICS
    ===================================== -->

        <div class="stats-grid">

        <div class="stat-card">

            <h4>Total Batches</h4>

            <h2><?php echo e($totalBatches); ?></h2>

        </div>

        <div class="stat-card">

            <h4>Active Batches</h4>

            <h2><?php echo e($activeBatches); ?></h2>

        </div>

        <div class="stat-card">

            <h4>Inactive Batches</h4>

            <h2><?php echo e($inactiveBatches); ?></h2>

        </div>

        <div class="stat-card">

            <h4>Total Students</h4>

            <h2><?php echo e($totalStudents); ?></h2>

        </div>

</div>

    <!-- =====================================
    FILTER SECTION
    ===================================== -->

    <div class="filter-card">

        <div class="filter-grid">

            <input
            type="text"
            class="form-control"
            placeholder="Search Batch Code / Name">
            <select
                class="form-control"
                name="course_id">

                <option value="">All Courses</option>

                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option
                        value="<?php echo e($course->id); ?>"
                        <?php echo e(request('course_id') == $course->id ? 'selected' : ''); ?>>

                        <?php echo e($course->course_name); ?>


                    </option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>

            <select
                class="form-control"
                name="teacher_id">

                <option value="">All Teachers</option>

                <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option
                        value="<?php echo e($teacher->id); ?>"
                        <?php echo e(request('teacher_id') == $teacher->id ? 'selected' : ''); ?>>

                        <?php echo e($teacher->teacher_name); ?>


                    </option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>

            <select class="form-control">

                <option>All Status</option>

                <option>Active</option>
                <option>Inactive</option>

            </select>

        </div>

        <div class="filter-actions">

            <button class="btn btn-primary">
                Search
            </button>

            <button class="btn btn-dark">
                Reset
            </button>

        </div>

    </div>

    <!-- =====================================
    BATCH TABLE
    ===================================== -->

    <div class="table-card">

        <div class="table-card-header">

            <h3>
                Batch List
            </h3>

        </div>

        <div class="table-responsive">

            <table class="custom-table">

                <thead>

                    <tr>

                        <th>Batch Code</th>
                        <th>Batch Name</th>
                        <th>Course</th>
                        <th>Teacher</th>
                        <th>Students</th>
                        <th>Start Date</th>
                        <th>Status</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>

                            <td><?php echo e($batch->batch_code); ?></td>

                            <td><?php echo e($batch->batch_name); ?></td>

                            <td><?php echo e($batch->course?->course_name); ?></td>

                            <td><?php echo e($batch->teacher?->teacher_name ?? '-'); ?></td>

                            <td><?php echo e($batch->students->count()); ?></td>

                            <td><?php echo e(\Carbon\Carbon::parse($batch->start_date)->format('d-M-Y')); ?></td>

                            <td>

                                <?php if($batch->is_active): ?>

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
                                        type="button"
                                        class="action-btn view-btn"
                                        data-id="<?php echo e($batch->id); ?>">

                                        View

                                    </button>

                                    <button
                                        type="button"
                                        class="action-btn edit-btn"
                                        data-id="<?php echo e($batch->id); ?>">

                                        Edit

                                    </button>

                                    <form
                                        action="<?php echo e(route('admin.batches.destroy',$batch->id)); ?>"
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

            <?php if($batches->onFirstPage()): ?>

                <button disabled>Previous</button>

            <?php else: ?>

                <button onclick="window.location='<?php echo e($batches->previousPageUrl()); ?>'">
                    Previous
                </button>

            <?php endif; ?>

            <?php for($i = 1; $i <= $batches->lastPage(); $i++): ?>

                <button
                    class="<?php echo e($batches->currentPage() == $i ? 'active' : ''); ?>"
                    onclick="window.location='<?php echo e($batches->url($i)); ?>'">

                    <?php echo e($i); ?>


                </button>

            <?php endfor; ?>

            <?php if($batches->hasMorePages()): ?>

                <button onclick="window.location='<?php echo e($batches->nextPageUrl()); ?>'">
                    Next
                </button>

            <?php else: ?>

                <button disabled>Next</button>

            <?php endif; ?>

        </div>

    </div>

</div>


<!-- ADD BATCH MODAL -->

<div class="modal" id="batchModal">

    <div class="modal-box">

        <form action="<?php echo e(route('admin.batches.store')); ?>" method="POST">

            <?php echo csrf_field(); ?>

            <div class="modal-header">

                <h3>Add Batch</h3>

                <button type="button" class="close-modal">
                    ×
                </button>

            </div>

            <div class="modal-body">

                <div class="form-grid">

                    <!-- Batch Code -->

                    <div>

                        <input
                            type="text"
                            class="form-control <?php $__errorArgs = ['batch_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="batch_code"
                            placeholder="Batch Code"
                            value="<?php echo e(old('batch_code', $batchCode)); ?>"
                            readonly>

                        <?php $__errorArgs = ['batch_code'];
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

                    <!-- Batch Name -->

                    <div>

                        <input
                            type="text"
                            class="form-control <?php $__errorArgs = ['batch_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="batch_name"
                            placeholder="Batch Name"
                            value="<?php echo e(old('batch_name')); ?>">

                        <?php $__errorArgs = ['batch_name'];
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

                    <!-- Course -->

                    <div>

                        <select
                            class="form-control <?php $__errorArgs = ['course_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="course_id">

                            <option disabled <?php echo e(old('course_id') ? '' : 'selected'); ?>>
                                Select Course
                            </option>

                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option
                                    value="<?php echo e($course->id); ?>"
                                    <?php echo e(old('course_id') == $course->id ? 'selected' : ''); ?>>

                                    <?php echo e($course->course_name); ?>


                                </option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                        <?php $__errorArgs = ['course_id'];
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

                    

                     <div>

                        <select
                            class="form-control <?php $__errorArgs = ['teacher_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="teacher_id">

                            <option disabled selected>
                                Select Teacher
                            </option>

                            <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option
                                    value="<?php echo e($teacher->id); ?>"
                                    <?php echo e(old('teacher_id') == $teacher->id ? 'selected' : ''); ?>>

                                    <?php echo e($teacher->teacher_name); ?>


                                </option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                        <?php $__errorArgs = ['teacher_id'];
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

                    <!-- Start Date -->

                    <div>

                        <input
                            type="date"
                            class="form-control <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="start_date"
                            value="<?php echo e(old('start_date')); ?>">

                        <?php $__errorArgs = ['start_date'];
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

                    <!-- End Date -->

                    <div>

                        <input
                            type="date"
                            class="form-control <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="end_date"
                            value="<?php echo e(old('end_date')); ?>">

                        <?php $__errorArgs = ['end_date'];
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
                            class="form-control <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="is_active">

                            <option value="1"
                                <?php echo e(old('is_active',1)=='1' ? 'selected' : ''); ?>>
                                Active
                            </option>

                            <option value="0"
                                <?php echo e(old('is_active')=='0' ? 'selected' : ''); ?>>
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

                    Save Batch

                </button>

            </div>

        </form>

    </div>

</div>


<!-- =========================
VIEW COURSE MODAL
========================= -->

<div class="modal" id="viewBatchModal">

    <div class="modal-box" style="max-width:700px;">

        <div class="modal-header">

            <h3>Batch Information</h3>

            <button class="close-modal">
                ×
            </button>

        </div>

        <div class="modal-body">

            <div class="form-grid">

                <div>
                    <strong>Batch Code</strong>
                    <p id="view_batch_code"></p>
                </div>

                <div>
                    <strong>Batch Name</strong>
                    <p id="view_batch_name"></p>
                </div>

                <div>
                    <strong>Course</strong>
                    <p id="view_course_name"></p>
                </div>

                <div>
                    <strong>Teacher</strong>
                    <p id="view_teacher_name"></p>
                </div>

                <div>
                    <strong>Start Date</strong>
                    <p id="view_start_date"></p>
                </div>

                <div>
                    <strong>End Date</strong>
                    <p id="view_end_date"></p>
                </div>

                <div>
                    <strong>Total Students</strong>
                    <p id="view_students"></p>
                </div>

                <div>
                    <strong>Status</strong>
                    <p id="view_status"></p>
                </div>


            </div>

        </div>

    </div>

</div>

<!-- =========================
EDIT BATCH MODAL
========================= -->

<div class="modal" id="editBatchModal">

    <div class="modal-box">

        <form id="editBatchForm" action="" method="POST">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="modal-header">

                <h3>Edit Batch</h3>

                <button type="button" class="close-modal">
                    ×
                </button>

            </div>

            <div class="modal-body">

                <div class="form-grid">

                    <!-- Batch Code -->

                    <div>

                        <input
                            type="text"
                            id="edit_batch_code"
                            class="form-control <?php $__errorArgs = ['batch_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Batch Code"
                            name="batch_code"
                            value="<?php echo e(old('batch_code')); ?>">

                        <?php $__errorArgs = ['batch_code'];
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

                    <!-- Batch Name -->

                    <div>

                        <input
                            type="text"
                            id="edit_batch_name"
                            class="form-control <?php $__errorArgs = ['batch_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Batch Name"
                            name="batch_name"
                            value="<?php echo e(old('batch_name')); ?>">

                        <?php $__errorArgs = ['batch_name'];
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

                    <!-- Course -->

                    <div>

                        <select
                            id="edit_course_id"
                            class="form-control <?php $__errorArgs = ['course_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="course_id">

                            <option disabled selected>
                                Select Course
                            </option>

                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option value="<?php echo e($course->id); ?>">

                                    <?php echo e($course->course_name); ?>


                                </option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                        <?php $__errorArgs = ['course_id'];
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

                    <!-- Teacher -->

                    <div>

                        <select
                            id="edit_teacher_id"
                            class="form-control <?php $__errorArgs = ['teacher_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="teacher_id">

                            <option disabled selected>
                                Select Teacher
                            </option>

                            <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option value="<?php echo e($teacher->id); ?>">

                                    <?php echo e($teacher->teacher_name); ?>


                                </option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                        <?php $__errorArgs = ['teacher_id'];
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

                    <!-- Start Date -->

                    <div>

                        <input
                            type="date"
                            id="edit_start_date"
                            class="form-control <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="start_date"
                            value="<?php echo e(old('start_date')); ?>">

                        <?php $__errorArgs = ['start_date'];
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

                    <!-- End Date -->

                    <div>

                        <input
                            type="date"
                            id="edit_end_date"
                            class="form-control <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="end_date"
                            value="<?php echo e(old('end_date')); ?>">

                        <?php $__errorArgs = ['end_date'];
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

                <!-- Status -->

                <select
                    id="edit_is_active"
                    class="form-control <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    name="is_active">

                    <option value="1">
                        Active
                    </option>

                    <option value="0">
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

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-dark close-modal">

                    Cancel

                </button>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Update Batch

                </button>

            </div>

        </form>

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

    $('#batchModal').fadeIn();

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
</html>
<?php /**PATH C:\xampp\htdocs\mtech_exam\resources\views/admin/batches.blade.php ENDPATH**/ ?>