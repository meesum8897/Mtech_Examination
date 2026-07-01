<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>M.T.E.S | {{ $title }}</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
<script src="{{ asset('assets/admin/js/script.js') }}"></script>

</head>

<body class="admin-body">

<!-- SIDEBAR -->

<div class="admin-sidebar">

    <div class="admin-logo">

        <img src="https://mtechinstitute.com/wp-content/uploads/2025/03/weblogoblue.png">

    </div>

<ul class="admin-menu">

    <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>

    <li class="{{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
        <a href="{{ route('admin.students.index') }}">Students</a>
    </li>

    <li class="{{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}">
        <a href="{{ route('admin.teachers.index') }}">Teachers</a>
    </li>

    <li class="{{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
        <a href="{{ route('admin.courses.index') }}">Courses</a>
    </li>

    <li class="{{ request()->routeIs('admin.batches.*') ? 'active' : '' }}">
        <a href="{{ route('admin.batches.index') }}">Batches</a>
    </li>

    <li class="{{ request()->routeIs('admin.question-categories.*') || request()->routeIs('admin.questions.*') ? 'active' : '' }}">
        <a href="{{ route('admin.questions.index') }}">Question Bank</a>
    </li>

    <li class="{{ request()->routeIs('admin.exams.*') ? 'active' : '' }}">
        <a href="{{ route('admin.exams.index') }}">Exams</a>
    </li>

    <li class="{{ request()->routeIs('admin.assign-exams.*') ? 'active' : '' }}">
        <a href="{{ route('admin.assign-exams.index') }}">Assign Exams</a>
    </li>

    <li class="{{ request()->routeIs('admin.results.*') ? 'active' : '' }}">
        <a href="{{ route('admin.results.index') }}">Results</a>
    </li>

    <li class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
        <a href="{{ route('admin.settings.index') }}">Settings</a>
    </li>

</ul>

</div>

<div class="admin-main">

    <!-- TOPBAR -->

    <div class="admin-topbar">

        <div>

            <h2>
                {{ $breadcrumb }}
            </h2>

            <p>
                {{$msg}}
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
                    <small>{{ Auth::user()->name }}</small>
                </div>
            </div>
            <!-- DROPDOWN -->
            <div class="admin-dropdown-menu" id="profileMenu">
                <a href="#">
                    Settings
                </a>
                <a href="{{ route('admin.logout') }}">
                    Logout
                </a>
            </div>
        </div>

    </div>
