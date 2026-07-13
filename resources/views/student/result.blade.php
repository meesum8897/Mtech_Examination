<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Exam Result</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body class="exam-page">

<!-- HEADER -->

<div class="exam-header">

    <!-- LEFT -->

    <div class="exam-logo">

        <h2>M-TECH Examination System</h2>
        <p>Student Result Card</p>

    </div>

    <!-- CENTER -->

    <div class="flex justify-center items-center">

    </div>

    <!-- RIGHT -->

    @php
        $initials = strtoupper(
            substr($student->first_name,0,1).
            substr($student->last_name,0,1)
        );
    @endphp

    <div class="exam-user">

        <div>

            <h4>{{ $student->first_name }} {{ $student->last_name }}</h4>
            <small>{{ $student->student_code }}</small>

        </div>

        <div class="profile">
            {{ $initials }}
        </div>

    </div>

</div>

<!-- RESULT CONTAINER -->

<div class="result-container">

    <div class="result-card">

        <!-- TOP -->

        <div class="result-top">

            <div>

                <h2>Online Examination Result</h2>

                <p>
                    Examination Performance Report
                </p>

            </div>

            <div class="result-badge {{ strtolower($result->result_status) == 'pass' ? 'pass' : 'fail' }}">

                {{ strtoupper($result->result_status) }}

            </div>

        </div>

        <!-- TABLE -->

        <div class="result-table-wrapper">

            <table class="result-table">

                <tr>
                    <th>Student Roll Number</th>
                    <td>Student{{ $student->roll_no }}</td>

                    <th>Batch Code</th>
                    <td>{{ $student->batch->batch_code }}</td>
                </tr>

                <tr>
                    <th>Full Name</th>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>

                    <th>Father Name</th>
                    <td>{{ $student->father_name }}</td>
                </tr>

                <tr>
                    <th>Exam Date</th>
                    <td>{{ \Carbon\Carbon::parse($result->submitted_at)->format('d M Y') }}</td>

                    <th>Exam Name</th>
                    <td>{{ $exam->exam_title }}</td>
                </tr>

                <tr>
                    <th>Total Questions</th>
                    <td>{{ $result->total_questions }}</td>

                    <th>Attempted Questions</th>
                    <td>{{ $result->correct_answers + $result->wrong_answers }}</td>
                </tr>

                <tr>
                    <th>Correct Questions</th>
                    <td>{{ $result->correct_answers }}</td>

                    <th>Wrong Questions</th>
                    <td>{{ $result->wrong_answers }}</td>
                </tr>

                <tr>
                    <th>Not Attempted</th>
                    <td>{{ $result->not_attempted }}</td>

                    <th>Time Taken</th>
                    <td>{{ $result->time_taken }} Minutes</td>
                </tr>

                <tr>
                    <th>Total Marks</th>
                    <td>{{ $result->total_marks }}</td>

                    <th>Marks Obtained</th>
                    <td>{{ $result->obtained_marks }}</td>
                </tr>

                <tr>
                    <th>Percentage</th>
                    <td>{{ $result->percentage }}%</td>

                    <th>Grade</th>
                    <td>{{ $result->grade }}</td>
                </tr>

                <tr>
                    <th>Started At</th>
                    <td>
                        {{ \Carbon\Carbon::parse($result->started_at)->format('d M Y h:i A') }}
                    </td>

                    <th>Submitted At</th>
                    <td>
                        {{ \Carbon\Carbon::parse($result->submitted_at)->format('d M Y h:i A') }}
                    </td>
                </tr>

                <tr>
                    <th>Final Status</th>

                    <td colspan="3">

                        <span class="{{ strtolower($result->result_status)=='pass' ? 'status-pass' : 'status-fail' }}">

                            {{ strtoupper($result->result_status) }}

                        </span>

                    </td>

                </tr>

            </table>

        </div>

        <!-- FOOTER -->

        <div class="result-footer">

            <a href="{{ route('student.logout') }}" class="btn btn-danger">
                Logout
            </a>

        </div>

    </div>

</div>

</body>
</html>