<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>M.T.E.S | <?php echo e($title); ?></title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/style.css')); ?>">
<script src="<?php echo e(asset('assets/admin/js/script.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="admin-body">

<!-- SIDEBAR -->

<div class="admin-sidebar">

    <div class="admin-logo">

        <img src="https://mtechinstitute.com/wp-content/uploads/2025/03/weblogoblue.png">

    </div>

<ul class="admin-menu">

    <li class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
    </li>

    <li class="<?php echo e(request()->routeIs('admin.students.*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('admin.students.index')); ?>">Students</a>
    </li>

    <li class="<?php echo e(request()->routeIs('admin.teachers.*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('admin.teachers.index')); ?>">Teachers</a>
    </li>

    <li class="<?php echo e(request()->routeIs('admin.courses.*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('admin.courses.index')); ?>">Courses</a>
    </li>

    <li class="<?php echo e(request()->routeIs('admin.batches.*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('admin.batches.index')); ?>">Batches</a>
    </li>

    <li class="<?php echo e(request()->routeIs('admin.question-categories.*') || request()->routeIs('admin.questions.*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('admin.questions.index')); ?>">Question Bank</a>
    </li>

    <li class="<?php echo e(request()->routeIs('admin.exams.*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('admin.exams.index')); ?>">Exams</a>
    </li>

    <li class="<?php echo e(request()->routeIs('admin.assign-exams.*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('admin.assign-exams.index')); ?>">Assign Exams</a>
    </li>

    <li class="<?php echo e(request()->routeIs('admin.results.*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('admin.results.index')); ?>">Results</a>
    </li>

    <li class="<?php echo e(request()->routeIs('admin.settings.*') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('admin.settings.index')); ?>">Settings</a>
    </li>

</ul>

</div>

<div class="admin-main">

    <!-- TOPBAR -->

    <div class="admin-topbar">

        <div>

            <h2>
                <?php echo e($breadcrumb); ?>

            </h2>

            <p>
                <?php echo e($msg); ?>

            </p>

        </div>

        <div class="admin-profile-dropdown">
        <!-- PROFILE BUTTON -->
            <div class="admin-profile-btn" id="profileToggle">
                <div class="admin-avatar">
                    M
                </div>
                <div>
                    <h4>Administrator</h4>
                    <small><?php echo e(Auth::user()->name); ?></small>
                </div>
            </div>
            <!-- DROPDOWN -->
            <div class="admin-dropdown-menu" id="profileMenu">
                <a href="#">
                    Settings
                </a>
                <a href="<?php echo e(route('admin.logout')); ?>">
                    Logout
                </a>
            </div>
        </div>

    </div>
<?php /**PATH C:\xampp\htdocs\mtech_exam\resources\views/components/admin/header.blade.php ENDPATH**/ ?>