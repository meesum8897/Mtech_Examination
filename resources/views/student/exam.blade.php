<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Online Quiz System</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="exam-page">

<!-- HEADER -->

<div class="exam-header">

    <!-- LEFT -->

    <div class="exam-logo">

        <h2>{{ $assignment->exam->exam_code }} - {{ $student->batch->course->course_name }}</h2>
        <p>{{ $assignment->exam->exam_title }}</p>

    </div>

    <!-- CENTER TIMER -->

    <div class="timer-wrapper">

        <div class="timer">

            <span>Time Left</span>
            <h1 id="time">45</h1>

        </div>

    </div>

    <!-- RIGHT -->

    @php
    $initials = strtoupper(
        substr($student->first_name,0,1) .
        substr($student->last_name,0,1)
    );
    @endphp
    <div class="exam-user">

        <div>

            <h4> {{ $student->first_name }} {{ $student->last_name }}</h4>
            <small>{{ $student->roll_no }}</small>

        </div>

        <div class="profile">
            {{ $initials }}
        </div>

    </div>

</div>

<!-- MAIN -->

<div class="exam-container">

    <!-- LEFT SIDE -->

<div class="exam-main">

    <!-- QUESTION HEADER -->

    <div class="question-top">

        <div>

            <h3 id="questionHeading">
                Question {{ $currentQuestion }} of {{ $totalQuestions }}
            </h3>

            <p>
                Marks: 1
            </p>

        </div>

        <div class="exam-badge">

            {{ $assignment->exam->exam_title }}

        </div>

    </div>

    <!-- QUESTION FORM -->

    <form id="questionForm">

        @csrf
        <input type="hidden" id="currentQuestion" value="{{ $currentQuestion }}">

        <div id="questionContainer">

            <x-student.question-card
                :question="$question"
                :attemptAnswer="$attemptAnswer" />

        </div>

    </form>

    <!-- BUTTONS -->
<div class="bottom-buttons">

    <div class="flex gap-10">

        <button
            type="button"
            id="saveNext"
            class="btn btn-primary">

            Save & Next

        </button>

        <button
            type="button"
            id="finishExamBtn"
            class="btn btn-danger"
            disabled>

            Finish Exam

        </button>

    </div>

</div>

</div>

<!-- SIDEBAR -->

    
    <div id="sidebarContainer">

        <x-student.sidebar
            :attempt="$attempt"
            :currentQuestion="$currentQuestion"
            :totalQuestions="$totalQuestions" />

    </div>
        @php

            $answered = $attempt->answers->whereNotNull('selected_answer')->count();

            $unanswered = $attempt->answers
                            ->where('visited',true)
                            ->whereNull('selected_answer')
                            ->count();

            $remaining = $attempt->answers
                            ->where('visited',false)
                            ->count();

            $progress = $totalQuestions
                        ? round(($answered / $totalQuestions) * 100)
                        : 0;

        @endphp


    </div>
</div>

<div class="finish-modal" id="finishModal">

    <div class="finish-modal-box">

        <div class="finish-modal-header">

            <h2>Finish Examination</h2>

        </div>

        <div class="finish-modal-body">

            <p class="finish-text">

                Please make sure the following before 
                <strong>FINISHING</strong> the exam.

            </p>

            <ul class="finish-list">

                <li>
                    You have attempted maximum number of questions.
                </li>

                <li>
                    All the solved questions have been reviewed carefully.
                </li>

                <li>
                    You have signed the attendance sheet.
                </li>

            </ul>

            <label class="confirm-check">

                <input type="checkbox" id="confirmFinish">

                <span>
                    I have read it carefully, 
                    I still want to finish the Test.
                </span>

            </label>

        </div>

        <div class="finish-modal-footer">
            <button type="button" class="btn btn-dark" id="cancelFinish">
                Cancel
            </button>

            <button type="button" class="btn btn-danger" id="finalFinishBtn" disabled>
                Finish Exam
            </button>
        </div>

    </div>

</div>
<script>
window.examConfig = {
    navigateUrl: "{{ route('student.exam.navigate') }}",
    finishUrl: "{{ route('student.exam.finish') }}",
    csrfToken: "{{ csrf_token() }}"
};
</script>
<script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
