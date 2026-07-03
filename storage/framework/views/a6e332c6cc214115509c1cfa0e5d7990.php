<?php if (isset($component)) { $__componentOriginal45d9cbba1e84739af2366cafaf311004 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal45d9cbba1e84739af2366cafaf311004 = $attributes; } ?>
<?php $component = App\View\Components\Admin\Header::resolve(['title' => 'Teachers Management','breadcrumb' => 'Manage institute teachers and batch assignments'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
        <!-- STATISTICS -->

    <div class="stats-grid">

        <div class="stat-card">

            <h4>Total Teachers</h4>
            <h2><?php echo e($totalteachers); ?></h2>

        </div>

        <div class="stat-card">

            <h4>Active Teachers</h4>
            <h2><?php echo e($activeteachers); ?></h2>

        </div>

        <div class="stat-card">

            <h4>Assigned Batches</h4>
            <h2><?php echo e($assignedbatches); ?></h2>

        </div>

        <div class="stat-card">

            <h4>Assigned Batches</h4>
            <h2><?php echo e($assignedbatches); ?></h2>

        </div>
    </div>
    
    <div class="page-header">
        
        <div>

            <h2>Teachers</h2>

            <p>
                Add, edit and manage teachers
            </p>

        </div>

        <button class="btn btn-primary" id="openTeacherModal">
            + Add Teacher
        </button>

    </div>
    

    <!-- FILTER CARD -->

    <div class="filter-card">

        <div class="filter-grid">

            <input
                type="text"
                class="form-control"
                name="search"
                placeholder="Search Teacher Name / ID / Mobile"
                value="<?php echo e(request('search')); ?>"/>

            <select class="form-control" name="course_id">
                <option value="">All Courses</option>
                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option
                        value="<?php echo e($course->id); ?>"
                        <?php echo e(request('course_id') == $course->id ? 'selected' : ''); ?>>

                        <?php echo e($course->course_name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <select class="form-control" name="batch_id">
                <option value="">All Batches</option>
                <?php $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option
                        value="<?php echo e($batch->id); ?>"
                        <?php echo e(request('batch_id') == $batch->id ? 'selected' : ''); ?>>

                        <?php echo e($batch->batch_name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <select class="form-control" name="status">
                <option value="">All Status</option>
                <option
                    value="1"
                    <?php echo e(request('status') == '1' ? 'selected' : ''); ?>>
                    Active
                </option>

                <option
                    value="0"
                    <?php echo e(request('status') == '0' ? 'selected' : ''); ?>>
                    Inactive
                </option>
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

    <!-- TABLE CARD -->

    <div class="table-card">

        <div class="table-card-header">

            <h3>Teachers List</h3>

        </div>

        <div class="table-responsive">

            <table class="admin-table">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Teacher Name</th>
                        <th>Mobile</th>
                        <th>Qualification</th>
                        <th>Courses</th>
                        <th>Batches</th>
                        <th>Status</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                <?php $__empty_1 = true; $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>

                        <td><?php echo e($teacher->teacher_code); ?></td>

                        <td><?php echo e($teacher->teacher_name); ?></td>

                        <td><?php echo e($teacher->mobile); ?></td>

                        <td><?php echo e($teacher->qualification); ?></td>

                        <td><?php echo e($teacher->students_count ?? 0); ?></td>

                        <td><?php echo e($teacher->teachers_count ?? 0); ?></td>

                        <td>

                            <?php if($teacher->is_active): ?>

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
                                    data-id="<?php echo e($teacher->id); ?>">

                                    View

                                </button>

                                <button
                                    type="button"
                                    class="action-btn edit-btn"
                                    data-id="<?php echo e($teacher->id); ?>">

                                    Edit

                                </button>

                                <form
                                    action="<?php echo e(route('admin.teachers.destroy', $teacher->id)); ?>"
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

            <?php if($teachers->onFirstPage()): ?>

                <button disabled>Previous</button>

            <?php else: ?>

                <button onclick="window.location='<?php echo e($teachers->previousPageUrl()); ?>'">
                    Previous
                </button>

            <?php endif; ?>

            <?php for($i = 1; $i <= $teachers->lastPage(); $i++): ?>

                <button
                    class="<?php echo e($teachers->currentPage() == $i ? 'active' : ''); ?>"
                    onclick="window.location='<?php echo e($teachers->url($i)); ?>'">

                    <?php echo e($i); ?>


                </button>

            <?php endfor; ?>

            <?php if($teachers->hasMorePages()): ?>

                <button onclick="window.location='<?php echo e($teachers->nextPageUrl()); ?>'">
                    Next
                </button>

            <?php else: ?>

                <button disabled>Next</button>

            <?php endif; ?>

        </div>

    </div>

</div>

<!-- ADD TEACHER MODAL -->

<div class="modal" id="teacherModal">

    <div class="modal-box">
        <form action="<?php echo e(route('admin.teachers.store')); ?>" method="POST">

            <?php echo csrf_field(); ?>
            <div class="modal-header">

                <h3>Add Teacher</h3>

                <button type="button" class="close-modal">
                    ×
                </button>

            </div>

            <div class="modal-body">

                <div class="form-grid">
                    
                    <div>
                        <input
                            type="text"
                            class="form-control <?php $__errorArgs = ['teacher_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="teacher_code"
                            placeholder="Teacher ID"
                            value="<?php echo e(old('teacher_code')); ?>">

                        <?php $__errorArgs = ['teacher_code'];
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
                            class="form-control <?php $__errorArgs = ['teacher_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="teacher_name"
                            placeholder="Full Name"
                            value="<?php echo e(old('teacher_name')); ?>">

                        <?php $__errorArgs = ['teacher_code'];
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
                        placeholder="CNIC"
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

                    <div>
                        <input
                        type="text"
                        class="form-control <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="mobile"
                        placeholder="Mobile"
                        value="<?php echo e(old('mobile')); ?>">

                        <?php $__errorArgs = ['mobile'];
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

                    <div>
                        <input
                        type="text"
                        class="form-control <?php $__errorArgs = ['qualification'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="qualification"
                        placeholder="Qualification"
                        value="<?php echo e(old('qualification')); ?>">

                        <?php $__errorArgs = ['qualification'];
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
                        class="form-control <?php $__errorArgs = ['designation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="designation"
                        placeholder="Designation"
                        value="<?php echo e(old('designation')); ?>">

                        <?php $__errorArgs = ['designation'];
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
                        class="form-control <?php $__errorArgs = ['experience'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="experience"
                        placeholder="Experience"
                        value="<?php echo e(old('experience')); ?>">

                        <?php $__errorArgs = ['experience'];
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
                        type="date"
                        class="form-control <?php $__errorArgs = ['joining_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="joining_date"
                        value="<?php echo e(old('joining_date')); ?>">

                        <?php $__errorArgs = ['joining_date'];
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

                <button type="button" class="btn btn-dark close-modal">
                    Cancel
                </button>

                <button type="submit" class="btn btn-primary">
                    Save Teacher
                </button>

            </div>
        </form>
    </div>
    
</div>



<!-- VIEW TEACHER MODAL -->

<div class="modal" id="viewTeacherModal">

    <div class="modal-box" style="max-width:850px;">

        <div class="modal-header">

            <h3>Teacher Information</h3>

            <button type="button" class="close-modal">
                ×
            </button>

        </div>

        <div class="modal-body">

            <div class="form-grid">

                <div>
                    <label>Teacher ID</label>
                    <p><strong id="view_teacher_code"></strong></p>
                </div>

                <div>
                    <label>Teacher Name</label>
                    <p><strong id="view_teacher_name"></strong></p>
                </div>

                <div>
                    <label>Father Name</label>
                    <p><strong id="view_father_name"></strong></p>
                </div>

                <div>
                    <label>CNIC</label>
                    <p><strong id="view_cnic"></strong></p>
                </div>

                <div>
                    <label>Mobile</label>
                    <p><strong id="view_mobile"></strong></p>
                </div>

                <div>
                    <label>Email</label>
                    <p><strong id="view_email"></strong></p>
                </div>

                <div>
                    <label>Gender</label>
                    <p><strong id="view_gender"></strong></p>
                </div>

                <div>
                    <label>Qualification</label>
                    <p><strong id="view_qualification"></strong></p>
                </div>

                <div>
                    <label>Designation</label>
                    <p><strong id="view_designation"></strong></p>
                </div>

                <div>
                    <label>Experience</label>
                    <p><strong id="view_experience"></strong></p>
                </div>

                <div>
                    <label>Joining Date</label>
                    <p><strong id="view_joining_date"></strong></p>
                </div>

                <div>
                    <label>Salary</label>
                    <p><strong id="view_salary"></strong></p>
                </div>

                <div>
                    <label>Status</label>
                    <p><strong id="view_status"></strong></p>
                </div>

            </div>

            <br>

            <div>

                <label>Address</label>

                <p id="view_address"></p>

            </div>

            <br>

            <div>

                <label>Remarks</label>

                <p id="view_remarks"></p>

            </div>

        </div>

    </div>

</div>

</body>

<?php if(session('success')): ?>

<script>

Swal.fire({

    icon: 'success',

    title: 'Success!',

    text: '<?php echo e(session('success')); ?>',

    confirmButtonColor: '#3085d6',

    timer: 2500,

    showConfirmButton: false

});

</script>

<?php endif; ?>

<?php if($errors->any()): ?>

<script>

document.addEventListener('DOMContentLoaded', function () {

    $('#editTeacherModal').fadeIn();

});

</script>

<?php endif; ?>

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


<script>

$(document).on('submit', '.delete-form', function(e){

    e.preventDefault();

    let form = this;

    Swal.fire({

        title: 'Delete Teacher?',

        text: "This teacher will be moved to trash.",

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#d33',

        cancelButtonColor: '#3085d6',

        confirmButtonText: 'Yes, Delete',

        cancelButtonText: 'Cancel'

    }).then((result) => {

        if(result.isConfirmed){

            form.submit();

        }

    });

});

</script>




<?php if(session('success')): ?>

<script>

Swal.fire({

    icon:'success',

    title:'Success',

    text:"<?php echo e(session('success')); ?>",

    timer:2000,

    showConfirmButton:false

});

</script>

<?php endif; ?>

<!-- =========================
EDIT TEACHER MODAL
========================= -->

<div class="modal" id="editTeacherModal">

    <div class="modal-box">

        <form id="editTeacherForm" action="<?php echo e(route('admin.teachers.store')); ?>" method="POST">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="modal-header">

                <h3 id="courseModalTitle">Edit Teacher</h3>

                <button type="button" class="close-modal">
                    ×
                </button>

            </div>

            <div class="modal-body">

                <div class="form-grid">

                    <div>

                        <input
                            type="text"
                            id="edit_teacher_code"
                            class="form-control <?php $__errorArgs = ['edit_teacher_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Teacher Code"
                            name="teacher_code"
                            value="<?php echo e(old('edit_teacher_code')); ?>">

                        <?php $__errorArgs = ['edit_teacher_code'];
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
                            id="edit_teacher_name"
                            class="form-control <?php $__errorArgs = ['edit_teacher_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Teacher Name"
                            name="teacher_name"
                            value="<?php echo e(old('edit_teacher_name')); ?>">

                        <?php $__errorArgs = ['course_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small edit_teacher_name="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>

                    <div>

                        <input
                            type="text"
                            id="edit_father_name"
                            class="form-control <?php $__errorArgs = ['edit_father_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Father Name"
                           name="father_name"
                            value="<?php echo e(old('edit_father_name')); ?>">

                        <?php $__errorArgs = ['course_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small edit_father_name="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>

                    <div>

                        <input
                            type="text"
                            id="edit_cnic"
                            class="form-control <?php $__errorArgs = ['edit_cnic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="CNIC"
                           name="cnic"
                            value="<?php echo e(old('edit_cnic')); ?>">

                        <?php $__errorArgs = ['course_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small edit_cnic="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>

                    <div>

                        <input
                            type="text"
                            id="edit_mobile"
                            class="form-control <?php $__errorArgs = ['edit_mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Mobile"
                           name="mobile"
                            value="<?php echo e(old('edit_mobile')); ?>">

                        <?php $__errorArgs = ['course_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small edit_mobile="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>

                    <div>

                        <input
                            type="text"
                            id="edit_qualification"
                            class="form-control <?php $__errorArgs = ['edit_qualification'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Qualification"
                           name="qualification"
                            value="<?php echo e(old('edit_qualification')); ?>">

                        <?php $__errorArgs = ['course_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small edit_qualification="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>

                    <div>

                        <input
                            type="text"
                            id="edit_designation"
                            class="form-control <?php $__errorArgs = ['edit_designation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Designation"
                           name="designation"
                            value="<?php echo e(old('edit_designation')); ?>">

                        <?php $__errorArgs = ['course_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small edit_designation="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>

                    <div>

                        <input
                            type="text"
                            id="edit_experience"
                            class="form-control <?php $__errorArgs = ['edit_experience'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Experience"
                            name="experience"
                            value="<?php echo e(old('edit_experience')); ?>">

                        <?php $__errorArgs = ['course_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small edit_experience="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>


                    <div>

                        <select
                    id="edit_is_active"
                    class="form-control <?php $__errorArgs = ['edit_is_active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    name="is_active">

                    <option value="1" <?php echo e(old('edit_is_active','1')=='1' ? 'selected' : ''); ?>>
                        Active
                    </option>

                    <option value="0" <?php echo e(old('edit_is_active')=='0' ? 'selected' : ''); ?>>
                        Inactive
                    </option>

                </select>

                <?php $__errorArgs = ['edit_is_active'];
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
                    id="courseSubmitBtn"
                    class="btn btn-primary">

                    Save

                </button>

            </div>

        </form>

    </div>

</div>
</html>

<?php /**PATH C:\xampp\htdocs\mtech_exam\resources\views/admin/teacher.blade.php ENDPATH**/ ?>