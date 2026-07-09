<x-admin.header
    title="Exam Results"
    breadcrumb="Results"
    msg="View examination results by Batch and Exam" />

{{-- ==========================================================
FILTERS
========================================================== --}}

<div class="table-card">

    <div class="table-card-header">

        <h3>

            Search Results

        </h3>

    </div>

    <div class="table-card-body">

        <div class="form-grid">

            <div>

                <label>

                    Batch

                </label>

                <select name="batch" id="batch" class="form-control">

                    <option value=""> Select Batch </option>

                    @foreach($batches as $batch)

                        <option value="{{ $batch->id }}">

                            {{ $batch->batch_name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label>

                    Exam

                </label>

                <select id="exam" class="form-control" disabled>
                    <option value="">Select Exam</option>
                </select>

            </div>

            <div>

                <label>

                    Search Student

                </label>


                    <input type="text" id="searchResult" class="form-control" placeholder="Search Student / Roll No">

            </div>

        </div>

    </div>

</div>



{{-- ==========================================================
SUMMARY
========================================================== --}}

<div class="table-card mt-4">

    <div class="table-card-header">

        <h3>

            Exam Summary

        </h3>

    </div>

    <div class="table-card-body">

        <div class="form-grid">

            <div>
                <strong>Total Students</strong><br>
                <span id="totalStudents">0</span>
            </div>

            <div>
                <strong>Passed</strong><br>
                <span class="text-success" id="passedStudents">0</span>
            </div>

            <div>
                <strong>Failed</strong><br>
                <span class="text-danger" id="failedStudents">0</span>
            </div>

            <div>
                <strong>Average Percentage</strong><br>
                <span id="averagePercentage">0%</span>
            </div>

        </div>

    </div>

</div>



{{-- ==========================================================
RESULT TABLE
========================================================== --}}

<div class="table-card mt-4">

    <div class="table-card-header">

        <h3>

            Student Results

        </h3>

    </div>

    <div class="table-responsive">

        <table class="custom-table">

            <thead>

                <tr>

                    <th>Roll No</th>

                    <th>Student</th>

                    <th>Correct</th>

                    <th>Wrong</th>

                    <th>Not Attempted</th>

                    <th>Marks</th>

                    <th>%</th>

                    <th>Grade</th>

                    <th>Status</th>

                    <th>Action</th>

                </tr>

            </thead>

            <tbody id="resultTable">

            <tr>

            <td colspan="8" style="text-align:center;padding:25px;">

            Select Batch & Exam

            </td>

            </tr>

            </tbody>

        </table>

    </div>

            <!-- PAGINATION -->

        <div id="pagination"></div>

</div>

</body>
<script>
$(document).ready(function () {

    // Initial State
    $('#exam').prop('disabled', true);
    $('#searchResult').prop('disabled', true);


    function resetSummary() {

    $('#totalStudents').text('0');
    $('#passedStudents').text('0');
    $('#failedStudents').text('0');
    $('#averagePercentage').text('0%');

}

    $('#batch').on('change', function () {

        let batchId = $(this).val();

        // Reset
        $('#exam')
            .html('<option value="">Select Exam</option>')
            .prop('disabled', true);

        $('#resultTable').html(`
            <tr>
                <td colspan='8' style="text-align:center;padding:25px;">
                    Select Exam
                </td>
            </tr>
        `);

        $('#searchResult')
            .val('')
            .prop('disabled', true);

        if (batchId == '') {
            return;
        }
            resetSummary();


        $.ajax({

            url: '/admin/results/batch/' + batchId + '/exams',

            type: 'GET',

            dataType: 'json',

            success: function (response) {

                let html = '<option value="">Select Exam</option>';

                $.each(response, function (index, exam) {

                    html += `<option value="${exam.id}">
                                ${exam.exam_title}
                             </option>`;

                });

                $('#exam').html(html);

                // Enable after loading exams
                $('#exam').prop('disabled', false);
                $('#searchResult').prop('disabled', false);

            },

            error: function (xhr) {

                console.log(xhr.responseText);

            }

        });

    });

});

$('#exam').change(function(){

    let batch = $('#batch').val();

    let exam = $(this).val();

    if(batch=='' || exam=='')
        return;

    $.ajax({

        url:'/admin/results/batch/'+batch+'/exam/'+exam,

        type:'GET',

            success: function (response) {

                let stats = response.stats;

                $('#totalStudents').text(stats.total_students);
                $('#passedStudents').text(stats.passed);
                $('#failedStudents').text(stats.failed);
                $('#averagePercentage').text(stats.average_percentage + '%');

                let rows = '';

                if (response.results.data.length === 0) {

                    rows = `
                        <tr>
                            <td colspan="9" class="text-center">
                                No Result Found
                            </td>
                        </tr>
                    `;

                } else {

                    $.each(response.results.data, function (index, item) {

                        rows += `
                            <tr>

                                <td>${item.student.roll_no}</td>

                                <td>${item.student.first_name} ${item.student.last_name ?? ''}</td>

                                <td>${item.correct_answers}</td>

                                <td>${item.wrong_answers}</td>

                                <td>${item.not_attempted}</td>

                                <td>${item.obtained_marks}/${item.total_marks}</td>

                                <td>${item.percentage}%</td>

                                <td>${item.grade}</td>

                                <td>${item.result_status}</td>

                                <td><button
                                    class="action-btn view-btn">

                                    View

                                </button></td>

                            </tr>
                        `;

                    });

                }

                $('#resultTable').html(rows);

            }

    });

});

/* Search Bar */
$('#searchResult').on('keyup', function () {

    let value = $(this).val().toLowerCase();

    $('#resultTable tr').filter(function () {

        $(this).toggle(
            $(this).text().toLowerCase().indexOf(value) > -1
        );

    });

});


</script>
</html>