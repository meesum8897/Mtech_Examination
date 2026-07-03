<?php if (isset($component)) { $__componentOriginal45d9cbba1e84739af2366cafaf311004 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal45d9cbba1e84739af2366cafaf311004 = $attributes; } ?>
<?php $component = App\View\Components\Admin\Header::resolve(['title' => 'Courses Management','breadcrumb' => 'Courses Management','msg' => 'Manage institute courses and academic programs'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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

            <h2>Courses</h2>

            <p>
                Create and manage institute courses
            </p>

        </div>

        <button class="btn btn-primary" id="openCourseModal">

            + Add Course

        </button>

    </div>

    <!-- =========================
    STATISTICS
    ========================= -->

<div class="stats-grid">

    <div class="stat-card">

        <h4>Total Courses</h4>
        <h2><?php echo e($totalCourses); ?></h2>

    </div>

    <div class="stat-card">

        <h4>Active Courses</h4>
        <h2><?php echo e($activeCourses); ?></h2>

    </div>

    <div class="stat-card">

        <h4>Short Courses</h4>
        <h2><?php echo e($shortCourses); ?></h2>

    </div>

    <div class="stat-card">

        <h4>Diploma Courses</h4>
        <h2><?php echo e($diplomaCourses); ?></h2>

    </div>

</div>

    <!-- =========================
    FILTERS
    ========================= -->

    <div class="filter-card">

        <div class="filter-grid">

            <input
                type="text"
                class="form-control"
                placeholder="Search Course Name / Code">

            <select class="form-control">

                <option>All Types</option>
                <option>Short Course</option>
                <option>Diploma</option>
                <option>Certification</option>

            </select>

            <select class="form-control">

                <option>All Status</option>
                <option>Active</option>
                <option>Inactive</option>

            </select>

            <select class="form-control">

                <option>All Durations</option>
                <option>1 Month</option>
                <option>3 Months</option>
                <option>6 Months</option>
                <option>1 Year</option>

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

    <!-- =========================
    TABLE
    ========================= -->

    <div class="table-card">

        <div class="table-card-header">

            <h3>Courses List</h3>

        </div>

        <div class="table-responsive">

            <table class="custom-table">

                <thead>

                    <tr>

                        <th>Code</th>
                        <th>Course Name</th>
                        <th>Duration</th>
                        <th>Type</th>
                        <th>Students</th>
                        <th>Teachers</th>
                        <th>Status</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>

                        <td><?php echo e($course->course_code); ?></td>

                        <td><?php echo e($course->course_name); ?></td>

                        <td><?php echo e($course->duration); ?></td>

                        <td><?php echo e($course->type); ?></td>

                        <td><?php echo e($course->students_count ?? 0); ?></td>

                        <td><?php echo e($course->teachers_count ?? 0); ?></td>

                        <td>

                            <?php if($course->is_active): ?>

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
                                    class="action-btn view-teacher-btn"
                                    data-id="<?php echo e($course->id); ?>">

                                    View

                                </button>

                                <button
                                    type="button"
                                    class="action-btn edit-btn"
                                    data-id="<?php echo e($course->id); ?>">

                                    Edit

                                </button>

                                <form
                                    action="<?php echo e(route('admin.courses.destroy', $course->id)); ?>"
                                    method="POST"
                                    class="delete-course-form"
                                    style="display:inline;">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button
                                        type="submit"
                                        class="action-btn delete-btn">

                                        Delete

                                    </button>

                                </form>

                                <?php if(session('success')): ?>
                                        <script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: "<?php echo e(session('success')); ?>",
                                            timer: 2000,
                                            showConfirmButton: false
                                        });
                                    </script>
                                <?php endif; ?>

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

            <?php if($courses->onFirstPage()): ?>

                <button disabled>Previous</button>

            <?php else: ?>

                <button onclick="window.location='<?php echo e($courses->previousPageUrl()); ?>'">
                    Previous
                </button>

            <?php endif; ?>

            <?php for($i = 1; $i <= $courses->lastPage(); $i++): ?>

                <button
                    class="<?php echo e($courses->currentPage() == $i ? 'active' : ''); ?>"
                    onclick="window.location='<?php echo e($courses->url($i)); ?>'">

                    <?php echo e($i); ?>


                </button>

            <?php endfor; ?>

            <?php if($courses->hasMorePages()): ?>

                <button onclick="window.location='<?php echo e($courses->nextPageUrl()); ?>'">
                    Next
                </button>

            <?php else: ?>

                <button disabled>Next</button>

            <?php endif; ?>

        </div>

    </div>

</div>

<!-- =========================
ADD COURSE MODAL
========================= -->

<div class="modal" id="courseModal">

    <div class="modal-box">

        <form action="<?php echo e(route('admin.courses.store')); ?>" method="POST">

            <?php echo csrf_field(); ?>

            <div class="modal-header">

                <h3>Add Course</h3>

                <button type="button" class="close-modal">
                    ×
                </button>

            </div>

            <div class="modal-body">

                <div class="form-grid">

                    <div>

                        <input
                            type="text"
                            class="form-control <?php $__errorArgs = ['course_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Course Code"
                            name="course_code"
                            value="<?php echo e(old('course_code')); ?>">

                        <?php $__errorArgs = ['course_code'];
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

                        <input
                            type="text"
                            class="form-control <?php $__errorArgs = ['course_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Course Name"
                            name="course_name"
                            value="<?php echo e(old('course_name')); ?>">

                        <?php $__errorArgs = ['course_name'];
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

                        <select class="form-control <?php $__errorArgs = ['duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="duration">

                            <option disabled <?php echo e(old('duration') ? '' : 'selected'); ?>>
                                Select Duration
                            </option>

                            <option value="1 Month" <?php echo e(old('duration')=='1 Month' ? 'selected' : ''); ?>>1 Month</option>

                            <option value="3 Months" <?php echo e(old('duration')=='3 Months' ? 'selected' : ''); ?>>3 Months</option>

                            <option value="6 Months" <?php echo e(old('duration')=='6 Months' ? 'selected' : ''); ?>>6 Months</option>

                            <option value="1 Year" <?php echo e(old('duration')=='1 Year' ? 'selected' : ''); ?>>1 Year</option>

                        </select>

                        <?php $__errorArgs = ['duration'];
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
                            class="form-control <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="type">

                            <option disabled <?php echo e(old('type') ? '' : 'selected'); ?>>
                                Select Type
                            </option>

                            <option value="Short Course" <?php echo e(old('type')=='Short Course' ? 'selected' : ''); ?>>
                                Short Course
                            </option>

                            <option value="Diploma" <?php echo e(old('type')=='Diploma' ? 'selected' : ''); ?>>
                                Diploma
                            </option>

                            <option value="Certification" <?php echo e(old('type')=='Certification' ? 'selected' : ''); ?>>
                                Certification
                            </option>

                        </select>

                        <?php $__errorArgs = ['type'];
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

                <textarea
                    class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    style="height:120px; padding-top:15px;"
                    placeholder="Course Description"
                    name="description"><?php echo e(old('description')); ?></textarea>

                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="text-danger"><?php echo e($message); ?></small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <br>

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

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-dark close-modal">

                    Cancel

                </button>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Save Course

                </button>

            </div>

        </form>

    </div>

</div>

<?php if($errors->any()): ?>

<script>

document.addEventListener('DOMContentLoaded', function () {

    $('#courseModal').fadeIn();

});

</script>

<?php endif; ?>

<!-- =========================
VIEW COURSE MODAL
========================= -->

<div class="modal" id="viewCourseModal">

    <div class="modal-box" style="max-width:700px;">

        <div class="modal-header">

            <h3>Course Information</h3>

            <button class="close-modal">
                ×
            </button>

        </div>

        <div class="modal-body">

            <div class="form-grid">

                <div>

                    <label>Course Code</label>
                    <p><strong id="view_course_code"></strong></p>

                </div>

                <div>

                    <label>Course Name</label>
                    <p><strong id="view_course_name"></strong></p>

                </div>

                <div>

                    <label>Duration</label>
                    <p><strong id="view_duration"></strong></p>

                </div>

                <div>

                    <label>Type</label>
                    <p><strong id="view_type"></strong></p>

                </div>

                <div>

                    <label>Teachers</label>
                    <p><strong id="view_teachers"></strong></p>

                </div>

                <div>

                    <label>Students</label>
                    <p><strong id="view_students"></strong></p>

                </div>

                <div>

                    <label>Status</label>
                    <p><strong id="view_status"></strong></p>

                </div>

            </div>

        </div>

    </div>

</div>

<?php if(session('success')): ?>

<script>

Swal.fire({

    icon: 'success',

    title: 'Success',

    text: '<?php echo e(session('success')); ?>',

    confirmButtonColor: '#faa31d'

});

</script>

<?php endif; ?>


<!-- =========================
EDIT COURSE MODAL
========================= -->

<div class="modal" id="editCourseModal">

    <div class="modal-box">

        <form id="courseForm" action="<?php echo e(route('admin.courses.store')); ?>" method="POST">

            <?php echo csrf_field(); ?>

            <div class="modal-header">

                <h3 id="courseModalTitle">Add Course</h3>

                <button type="button" class="close-modal">
                    ×
                </button>

            </div>

            <div class="modal-body">

                <div class="form-grid">

                    <div>

                        <input
                            type="text"
                            id="course_code"
                            class="form-control <?php $__errorArgs = ['course_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Course Code"
                            name="course_code"
                            value="<?php echo e(old('course_code')); ?>">

                        <?php $__errorArgs = ['course_code'];
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

                        <input
                            type="text"
                            id="course_name"
                            class="form-control <?php $__errorArgs = ['course_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Course Name"
                            name="course_name"
                            value="<?php echo e(old('course_name')); ?>">

                        <?php $__errorArgs = ['course_name'];
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
                            id="duration"
                            class="form-control <?php $__errorArgs = ['duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="duration">

                            <option disabled <?php echo e(old('duration') ? '' : 'selected'); ?>>
                                Select Duration
                            </option>

                            <option value="1 Month" <?php echo e(old('duration')=='1 Month' ? 'selected' : ''); ?>>
                                1 Month
                            </option>

                            <option value="3 Months" <?php echo e(old('duration')=='3 Months' ? 'selected' : ''); ?>>
                                3 Months
                            </option>

                            <option value="6 Months" <?php echo e(old('duration')=='6 Months' ? 'selected' : ''); ?>>
                                6 Months
                            </option>

                            <option value="1 Year" <?php echo e(old('duration')=='1 Year' ? 'selected' : ''); ?>>
                                1 Year
                            </option>

                        </select>

                        <?php $__errorArgs = ['duration'];
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
                            id="type"
                            class="form-control <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="type">

                            <option disabled <?php echo e(old('type') ? '' : 'selected'); ?>>
                                Select Type
                            </option>

                            <option value="Short Course" <?php echo e(old('type')=='Short Course' ? 'selected' : ''); ?>>
                                Short Course
                            </option>

                            <option value="Diploma" <?php echo e(old('type')=='Diploma' ? 'selected' : ''); ?>>
                                Diploma
                            </option>

                            <option value="Certification" <?php echo e(old('type')=='Certification' ? 'selected' : ''); ?>>
                                Certification
                            </option>

                        </select>

                        <?php $__errorArgs = ['type'];
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

                <textarea
                    id="description"
                    class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    style="height:120px; padding-top:15px;"
                    placeholder="Course Description"
                    name="description"><?php echo e(old('description')); ?></textarea>

                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="text-danger"><?php echo e($message); ?></small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <br>

                <select
                    id="is_active"
                    class="form-control <?php $__errorArgs = ['is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    name="is_active">

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

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-dark close-modal">

                    Cancel

                </button>

                <button
                    type="submit"
                    id="courseSubmitBtn"
                    class="btn btn-primary">

                    Save Course

                </button>

            </div>

        </form>

    </div>

</div>
</body>
</html>

<?php /**PATH C:\xampp\htdocs\mtech_exam\resources\views/admin/courses.blade.php ENDPATH**/ ?>