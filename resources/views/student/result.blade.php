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

    <div class="exam-user">

        <div>

            <h4>Student</h4>
            <small>ST2026-001</small>

        </div>

        <div class="profile">
            M
        </div>

    </div>

</div>

<!-- RESULT CONTAINER -->

<div class="result-container">

    <!-- RESULT CARD -->

    <div class="result-card">

        <!-- TOP -->

        <div class="result-top">

            <div>

                <h2>Online Examination Result</h2>

                <p>
                    Examination Performance Report
                </p>

            </div>

            <div class="result-badge pass">

                PASS

            </div>

        </div>

        <!-- RESULT TABLE -->

        <div class="result-table-wrapper">

            <table class="result-table">

                <tr>
                    <th>Student ID</th>
                    <td>ST2026-001</td>

                    <th>Batch Code</th>
                    <td>MS-OFFICE-23A</td>
                </tr>

                <tr>
                    <th>Full Name</th>
                    <td>Meesum Ali</td>

                    <th>Father Name</th>
                    <td>Syed Ali Raza</td>
                </tr>

                <tr>
                    <th>Exam Date</th>
                    <td>02 May 2026</td>

                    <th>Exam Name</th>
                    <td>MS Office Final Exam</td>
                </tr>

                <tr>
                    <th>Total Questions</th>
                    <td>50</td>

                    <th>Attempted Questions</th>
                    <td>48</td>
                </tr>

                <tr>
                    <th>Right Questions</th>
                    <td>42</td>

                    <th>Wrong Questions</th>
                    <td>6</td>
                </tr>

                <tr>
                    <th>Total Marks</th>
                    <td>50</td>

                    <th>Marks Obtained</th>
                    <td>42</td>
                </tr>

                <tr>
                    <th>Percentage</th>
                    <td>84%</td>

                    <th>Grade</th>
                    <td>A</td>
                </tr>

                <tr>
                    <th>Final Status</th>
                    <td colspan="3">

                        <span class="status-pass">
                            PASS
                        </span>

                    </td>
                </tr>

            </table>

        </div>

        <!-- FOOTER BUTTONS -->

        <div class="result-footer">

            <button class="btn btn-dark">

                Print Result

            </button>

            <button class="btn btn-primary">

                Download PDF

            </button>

        </div>

    </div>

</div>

</body>
</html>