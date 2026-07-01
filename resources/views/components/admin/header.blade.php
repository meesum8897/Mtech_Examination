<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard</title>

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

        <li class="active">
            <a href="index.html">Dashboard</a>
        </li>

        <li>
            <a href="students.html">Students</a>
        </li>

        <li>
            <a href="teachers.html">Teachers</a>
        </li>

        <li>
            <a href="courses.html">Courses</a>
        </li>

        <li>
            <a href="batches.html">Batches</a>
        </li>

        <li>
             <a href="questionbank.html">Question Bank</a>
        </li>

        <li>
            <a href="#">Exams</a>
        </li>

        <li>
            <a href="Assignexams.html">Assign Exams</a>
        </li>

        <li>
            <a href="#">Results</a>
        </li>

        <li>
            <a href="#">Settings</a>
        </li>

    </ul>

</div>

<div class="admin-main">

    <!-- TOPBAR -->

    <div class="admin-topbar">

        <div>

            <h2>
                Dashboard
            </h2>

            <p>
                Welcome back Admin
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
                    <small>Super Admin</small>
                </div>
            </div>
            <!-- DROPDOWN -->
            <div class="admin-dropdown-menu" id="profileMenu">
                <a href="#">
                    Settings
                </a>
                <a href="#">
                    Logout
                </a>
            </div>
        </div>

    </div>
