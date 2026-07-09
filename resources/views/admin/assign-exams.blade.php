<x-admin.header title="Assign Examination" breadcrumb="Assign Examination" msg="Assign examination to a batch" />

<div class="table-card">

    <div class="table-card-header">

        <h3>

            Assign Examination

        </h3>

    </div>

    <div class="table-card-body">

        <form action="{{ route('admin.assign-exams.store') }}" method="POST">
            @csrf

            {{-- ===============================
            COURSE / BATCH
            =============================== --}}

            <div class="form-grid">

                <div>

                    <label>

                        Course <span class="text-danger">*</span>

                    </label>

                    <select
                        id="course"
                        class="form-control" name="course_id">

                        <option value="">

                            Select Course

                        </option>

                        @foreach($courses as $course)

                            <option value="{{ $course->id }}">

                                {{ $course->course_name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div>

                    <label>

                        Batch <span class="text-danger">*</span>

                    </label>

                    <select
                        id="batch" class="form-control" name="batch_id" disabled>

                        <option value="">

                            Select Batch

                        </option>

                    </select>

                    @error('batch_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

            </div>

            <br>

            {{-- ===============================
            EXAM
            =============================== --}}

            <div class="form-group">

                <label>

                    Examination <span class="text-danger">*</span>

                </label>

                <select id="exam" class="form-control" name="exam_id" disabled>

                    <option value="">

                        Select Examination

                    </option>

                </select>
                @error('exam_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>

            <br>

            {{-- ===============================
            START / END
            =============================== --}}

            <div class="form-grid">

                <div>

                    <label>

                        Start Date & Time

                    </label>

                    <input type="datetime-local" name="start_datetime" class="form-control">

                    @error('start_datetime')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror

                </div>

                <div>

                    <label>

                        End Date & Time

                    </label>

                    <input type="datetime-local" name="end_datetime" class="form-control">

                    @error('end_datetime')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror

                </div>

            </div>

            <br>

            {{-- ===============================
            SETTINGS
            =============================== --}}

            <div class="form-grid">
                <div>
                    <label> Status </label>
                    <select class="form-control" name="status">
                        <option value="Draft">Draft</option>
                        <option value="Scheduled" selected>Scheduled</option>
                        <option value="Active">Active</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>

                    @error('status')
                        <small class="text-danger"> {{ $message }} </small>
                    @enderror
                </div>

                <div>

                    <label> Show Result After Submission </label>

                    <div style="display:flex;align-items:center;height:42px;gap:25px;">

                        <label>

                            <input
                                type="radio"
                                name="show_result"
                                value="1">

                            Yes

                        </label>

                        <label>

                            <input
                                type="radio"
                                name="show_result"
                                value="0"
                                checked>

                            No

                        </label>

                        @error('show_result')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror

                    </div>

                </div>

            </div>

            <br>

            <div class="text-end">

                <button
                    type="submit"
                    class="btn btn-primary">

                    Assign Examination

                </button>

            </div>

        </form>

    </div>

</div>

</body>

@if(session('success'))

<script>

Swal.fire({

    icon:'success',

    title:'Success',

    text:'{{ session('success') }}',

    timer:2500,

    showConfirmButton:false

});

</script>
@endif



<script>
    
$(document).ready(function () {

    /*
    |--------------------------------------------------------------------------
    | Course Change
    |--------------------------------------------------------------------------
    */

    $('#course').change(function () {

        let course = $(this).val();

        $('#batch')
            .html('<option value="">Select Batch</option>')
            .prop('disabled', true);

        $('#exam')
            .html('<option value="">Select Examination</option>')
            .prop('disabled', true);

        $('#totalStudents').text('-');
        $('#examDuration').text('-');
        $('#passingMarks').text('-');
        $('#totalMarks').text('-');

        if (course == '')
            return;

        /*
        |--------------------------------------------------------------------------
        | Load Batches
        |--------------------------------------------------------------------------
        */

        $.ajax({

            url: '/admin/assign-exams/course/' + course + '/batches',

            type: 'GET',

            success: function (response) {

                let html = '<option value="">Select Batch</option>';

                $.each(response, function (index, batch) {

                    html += `
                        <option value="${batch.id}">
                            ${batch.batch_name}
                        </option>
                    `;

                });

                $('#batch')
                    .html(html)
                    .prop('disabled', false);

            }

        });

        /*
        |--------------------------------------------------------------------------
        | Load Exams
        |--------------------------------------------------------------------------
        */

        $.ajax({

            url: '/admin/assign-exams/course/' + course + '/exams',

            type: 'GET',

            success: function (response) {

                let html = '<option value="">Select Examination</option>';

                $.each(response, function (index, exam) {

                    html += `
                        <option value="${exam.id}">
                            ${exam.exam_title}
                        </option>
                    `;

                });

                $('#exam')
                    .html(html)
                    .prop('disabled', false);

            }

        });

    });

    /*
    |--------------------------------------------------------------------------
    | Batch OR Exam Change
    |--------------------------------------------------------------------------
    */

    $('#batch, #exam').change(function () {

        let batch = $('#batch').val();

        let exam = $('#exam').val();

        if (batch == '' || exam == '')
            return;

        $.ajax({

            url: '/admin/assign-exams/summary/' + batch + '/' + exam,

            type: 'GET',

            success: function (response) {

                $('#totalStudents').text(response.students);

                $('#examDuration').text(response.duration + ' Minutes');

                $('#passingMarks').text(response.passing_marks);

                $('#totalMarks').text(response.total_marks);

            }

        });

    });

});
</script>
</html>

