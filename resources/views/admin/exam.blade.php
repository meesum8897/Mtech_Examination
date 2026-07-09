<x-admin.header title="Assign Exams" breadcrumb="Assign Exams" msg="Schedule and assign exams to batches and students"/>
    <!-- PAGE HEADER -->

    <div class="page-header">

        <div>

            <h2>
                Assign Exams
            </h2>

            <p>
                Schedule and assign exams to batches and students
            </p>

        </div>

        <div class="header-actions">

            <button
            class="btn btn-primary"
            id="create_exam_modal">

                + Create Exam

            </button>

        </div>

    </div>

    <!-- STATS -->

    <div class="stats-grid">

        <div class="stat-card">

            <h4>
                Total Assignments
            </h4>

            <h2>
                248
            </h2>

        </div>

        <div class="stat-card">

            <h4>
                Active Exams
            </h4>

            <h2>
                32
            </h2>

        </div>

        <div class="stat-card">

            <h4>
                Scheduled Exams
            </h4>

            <h2>
                15
            </h2>

        </div>

        <div class="stat-card">

            <h4>
                Completed Exams
            </h4>

            <h2>
                201
            </h2>

        </div>

    </div>

    <!-- FILTERS -->

    <div class="filter-card">

        <div class="filter-grid">

            <input
            type="text"
            class="form-control"
            placeholder="Search Assignment">

            <select class="form-control">

                <option>
                    All Exams
                </option>

                <option>
                    MS Excel Monthly Test
                </option>

                <option>
                    HTML Final Exam
                </option>

                <option>
                    Graphic Design Quiz
                </option>

            </select>

            <select class="form-control">

                <option>
                    All Batches
                </option>

                <option>
                    Batch A
                </option>

                <option>
                    Batch B
                </option>

                <option>
                    Batch C
                </option>

            </select>

            <select class="form-control">

                <option>
                    All Status
                </option>

                <option>
                    Scheduled
                </option>

                <option>
                    Active
                </option>

                <option>
                    Completed
                </option>

                <option>
                    Cancelled
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

    <!-- TABLE -->

    <div class="table-card">

        <div class="table-card-header">

            <h3>
                Exam Assignments
            </h3>

        </div>

        <div class="table-responsive">

            <table class="custom-table">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Exam Name</th>

                        <th>Batch</th>

                        <th>Students</th>

                        <th>Start Date</th>

                        <th>End Date</th>

                        <th>Status</th>

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($exams as $exam)

                        <tr>

                            <td>{{ $exam->exam_code }}</td>

                            <td>{{ $exam->exam_title }}</td>

                            <td>{{ $exam->course->course_name ?? '-' }}</td>

                            <td>{{ $exam->duration }} Minutes</td>

                            <td>{{ \Carbon\Carbon::parse($exam->starts_at)->format('d M Y h:i A') }}</td>

                            <td>{{ \Carbon\Carbon::parse($exam->ends_at)->format('d M Y h:i A') }}</td>

                            <td>

                                @if($exam->status == 'Draft')

                                    <span class="badge-warning">
                                        Draft
                                    </span>

                                @else

                                    <span class="badge-success">
                                        Published
                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="table-actions">

                                    <button
                                        class="action-btn edit-btn"
                                        data-id="{{ $exam->id }}">

                                        Edit

                                    </button>

                                    <a class="action-btn view-btn" href="{{ route('admin.exam.questions', $exam->id) }}">
                                        Add Questions
                                    </a>

                                    <form
                                        action="{{ route('admin.exams.destroy', $exam->id) }}"
                                        method="POST"
                                        class="cancelExamForm"
                                        style="display:inline;">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-btn delete-btn">

                                            Cancel Exam

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                    <tr>

                        <td colspan="8" style="text-align:center;padding:25px;">

                            No courses found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    <!-- PAGINATION -->

    <div class="pagination">

        @if ($exams->onFirstPage())

            <button disabled>

                Previous

            </button>

        @else

            <button onclick="window.location='{{ $exams->previousPageUrl() }}'">

                Previous

            </button>

        @endif

        @for ($i = 1; $i <= $exams->lastPage(); $i++)

            <button
                class="{{ $exams->currentPage() == $i ? 'active' : '' }}"
                onclick="window.location='{{ $exams->url($i) }}'">

                {{ $i }}

            </button>

        @endfor

        @if ($exams->hasMorePages())

            <button onclick="window.location='{{ $exams->nextPageUrl() }}'">

                Next

            </button>

        @else

            <button disabled>

                Next

            </button>

        @endif

    </div>

    </div>

</div>

<!-- ==========================================
ADD EXAM MODAL
========================================== -->

<div class="modal" id="examModal">

    <div class="modal-box small-modal">

        <form id="examForm" action="{{ route('admin.exams.store') }}" method="POST">

            @csrf

            <div class="modal-header">

                <h3>
                    Add New Exam
                </h3>

                <button
                    type="button"
                    class="close-modal">

                    &times;

                </button>

            </div>

                <div class="modal-body">

        <!-- Exam Title -->

        <div class="form-group">

            <label>
                Exam Title <span class="text-danger">*</span>
            </label>

            <input
                type="text"
                name="exam_title"
                class="form-control @error('exam_title') is-invalid @enderror"
                value="{{ old('exam_title') }}"
                placeholder="Enter Exam Title">

            @error('exam_title')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        <br>

        <!-- Course -->

        <div class="form-group">

            <label>
                Course <span class="text-danger">*</span>
            </label>

            <select
                name="course_id"
                class="form-control @error('course_id') is-invalid @enderror">

                <option value="">Select Course</option>

                @foreach($courses as $course)

                    <option
                        value="{{ $course->id }}"
                        {{ old('course_id') == $course->id ? 'selected' : '' }}>

                        {{ $course->course_name }}

                    </option>

                @endforeach

            </select>

            @error('course_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        <br>

        <!-- Duration -->

        <div class="form-grid">

            <div class="form-group">

                <label>Duration (Minutes)</label>

                <input
                    type="number"
                    name="duration"
                    class="form-control @error('duration') is-invalid @enderror"
                    value="{{ old('duration',30) }}">

                @error('duration')
                <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>

            <div class="form-group">

                <label>Passing Marks</label>

                <input
                    type="number"
                    name="passing_marks"
                    class="form-control @error('passing_marks') is-invalid @enderror"
                    value="{{ old('passing_marks',40) }}">

                @error('passing_marks')
                <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>

        </div>

        <br>

        <!-- Start -->

        <div class="form-grid">

            <div class="form-group">

                <label>Starts At</label>

                <input
                    type="datetime-local"
                    name="starts_at"
                    class="form-control @error('starts_at') is-invalid @enderror"
                    value="{{ old('starts_at') }}">

                @error('starts_at')
                <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>

            <div class="form-group">

                <label>Ends At</label>

                <input
                    type="datetime-local"
                    name="ends_at"
                    class="form-control @error('ends_at') is-invalid @enderror"
                    value="{{ old('ends_at') }}">

                @error('ends_at')
                <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>

        </div>

        <br>

        <!-- Status -->

        <div class="form-group">

            <label>Status</label>

           <select
                name="status"
                class="form-control @error('status') is-invalid @enderror">

                <option value="Draft" {{ old('status')=='Draft' ? 'selected' : '' }}>
                    Draft
                </option>

                <option value="Published" {{ old('status')=='Published' ? 'selected' : '' }}>
                    Published
                </option>

            </select>

            @error('status')
            <small class="text-danger">{{ $message }}</small>
            @enderror

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
                    id="saveExamBtn"
                    class="btn btn-primary">

                    Save & Continue

                </button>

            </div>

        </form>

    </div>

</div>


</body>

<script>
$(document).on("click", "#create_exam_modal", function () {

    $("#examModal").css("display", "flex");

});
</script>

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

@if ($errors->any())

<script>

document.addEventListener('DOMContentLoaded', function(){

    $('#examModal').fadeIn();

});

</script>

@endif

@if(session('success'))

<script>

Swal.fire({

    icon: 'success',

    title: 'Success',

    text: '{{ session('success') }}',

    timer: 2500,

    showConfirmButton: false

});

</script>

@endif
</html>
</html>