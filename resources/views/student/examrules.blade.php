<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>M-TECH Examination Rules</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body class="login-page">

<div class="overlay"></div>

<!-- Header -->

<div class="top-header">

    <img src="https://mtechinstitute.com/wp-content/uploads/2025/03/weblogoblue.png">

</div>

<div class="login-wrapper">

    @if($message)

        <div class="instruction-box" style="width:760px;">

            <div class="login-header">

                <h2>Notice</h2>

            </div>

            <div class="login-body text-center">

                <div class="alert alert-danger">

                    {{ $message }}

                </div>

                <br>

                <a href="{{ route('student.logout') }}" class="btn btn-danger">

                    Logout

                </a>

            </div>

        </div>

    @else

        <div class="login-wrapper">

    <div class="instruction-box">

        <!-- Header -->

        <div class="login-header">

            <h2>

                Examination Instructions

            </h2>

        </div>

        <!-- Student Information -->

        <div style="padding:18px 25px;background:#fafafa;border-bottom:1px solid #eee;">

            <div class="form-grid">

                <div>
                    <strong>Student</strong><br>
                    {{ session('student_name') }}
                </div>

                <div>
                    <strong>Roll No</strong><br>
                    {{ session('roll_no') }}
                </div>
                
                <div>
                    <strong>Batch</strong><br>
                    {{ $student->batch->batch_name }}
                </div>

                <div>
                    <strong>Course</strong><br>
                    {{ $student->batch->course->course_name }}
                </div>

                <div>
                    <strong>Exam</strong><br>
                    {{ $assignment?->exam?->exam_title ?? 'N/A' }}
                </div>

                <div>
                    <strong>Duration</strong><br>
                    {{ $assignment?->exam?->duration ?? 'N/A' }} Minutes
                </div>

                <div>
                    <strong>Passing Marks</strong><br>
                    {{ $assignment?->exam?->passing_marks ?? 'N/A' }}
                </div

            </div>

        </div>

        <!-- Instructions -->

        <div style="height:350px;overflow-y:auto;padding:25px;line-height:2;border-bottom:1px solid #eee;">

            <h2 style="text-align:center;margin-bottom:25px;">

                Please Read Carefully

            </h2>

            <ol style="padding-left:20px;">

                <li>Do not refresh the browser during examination.</li>

                <li>Do not open another tab or browser window.</li>

                <li>Any attempt of cheating may immediately terminate your examination.</li>

                <li>Internet browsing is strictly prohibited.</li>

                <li>Do not close the examination window.</li>

                <li>Leaving the examination page for a long time may lock your paper.</li>

                <li>Your timer starts immediately after clicking Start Paper.</li>

                <li>Once submitted, the examination cannot be resumed.</li>

                <li>Answers are automatically saved while attempting.</li>

                <li>Please complete your examination before the timer expires.</li>

            </ol>

            <div style="margin-top:25px;padding:15px;background:#fff7e6;border-left:5px solid #FAA31D;">

                <strong>Warning</strong>

                <p style="margin-top:10px;">

                    Clicking <b>Start Paper</b> means you agree to all examination rules and your examination timer will begin immediately.

                </p>

            </div>

        </div>

        <!-- Footer -->

        <form action="{{ route('student.exam.start') }}" method="POST">

            @csrf

            <div style="padding:18px 25px;display:flex;justify-content:space-between;align-items:center;">

                <label>

                    <input type="checkbox" id="agree">

                    I hereby confirm that I have read all instructions carefully and agree to follow them.

                </label>

                <button type="submit" id="startBtn" class="btn btn-primary" disabled>
                    Start Paper
                </button>

            </div>

        </form>

    </div>

</div>

    @endif

</div>

<script>

document.addEventListener("DOMContentLoaded", function () {

    const agree = document.getElementById("agree");
    const startBtn = document.getElementById("startBtn");

    // Always keep disabled on page load
    startBtn.disabled = true;

    agree.addEventListener("change", function () {

        startBtn.disabled = !this.checked;

    });

});

</script>

</body>
</html>