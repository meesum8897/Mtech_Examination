<x-admin.header title="Batch Management" breadcrumb="Batch Management" msg="Manage course batches and assigned teachers"/>

 <!-- PAGE HEADER -->

    <div class="page-header">

        <div>

            <h2>Batches</h2>

            <p>
                Create and manage training batches
            </p>

        </div>

        <button
        class="btn btn-primary"
        id="openBatchModal">

            + Add Batch

        </button>

    </div>

    <!-- =====================================
    STATISTICS
    ===================================== -->

        <div class="stats-grid">

        <div class="stat-card">

            <h4>Total Batches</h4>

            <h2>{{ $totalBatches }}</h2>

        </div>

        <div class="stat-card">

            <h4>Active Batches</h4>

            <h2>{{ $activeBatches }}</h2>

        </div>

        <div class="stat-card">

            <h4>Inactive Batches</h4>

            <h2>{{ $inactiveBatches }}</h2>

        </div>

        <div class="stat-card">

            <h4>Total Students</h4>

            <h2>{{ $totalStudents }}</h2>

        </div>

</div>

    <!-- =====================================
    FILTER SECTION
    ===================================== -->

    <div class="filter-card">

        <div class="filter-grid">

            <input
            type="text"
            class="form-control"
            placeholder="Search Batch Code / Name">
            <select
                class="form-control"
                name="course_id">

                <option value="">All Courses</option>

                @foreach($courses as $course)

                    <option
                        value="{{ $course->id }}"
                        {{ request('course_id') == $course->id ? 'selected' : '' }}>

                        {{ $course->course_name }}

                    </option>

                @endforeach

            </select>

            <select
                class="form-control"
                name="teacher_id">

                <option value="">All Teachers</option>

                @foreach($teachers as $teacher)

                    <option
                        value="{{ $teacher->id }}"
                        {{ request('teacher_id') == $teacher->id ? 'selected' : '' }}>

                        {{ $teacher->teacher_name }}

                    </option>

                @endforeach

            </select>

            <select class="form-control">

                <option>All Status</option>

                <option>Active</option>
                <option>Inactive</option>

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

    <!-- =====================================
    BATCH TABLE
    ===================================== -->

    <div class="table-card">

        <div class="table-card-header">

            <h3>
                Batch List
            </h3>

        </div>

        <div class="table-responsive">

            <table class="custom-table">

                <thead>

                    <tr>

                        <th>Batch Code</th>
                        <th>Batch Name</th>
                        <th>Course</th>
                        <th>Teacher</th>
                        <th>Students</th>
                        <th>Start Date</th>
                        <th>Status</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($batches as $batch)

                        <tr>

                            <td>{{ $batch->batch_code }}</td>

                            <td>{{ $batch->batch_name }}</td>

                            <td>{{ $batch->course?->course_name }}</td>

                            <td>{{ $batch->teacher?->teacher_name ?? '-' }}</td>

                            <td>{{ $batch->students->count() }}</td>

                            <td>{{ \Carbon\Carbon::parse($batch->start_date)->format('d-M-Y') }}</td>

                            <td>

                                @if($batch->is_active)

                                    <span class="badge-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge-danger">
                                        Inactive
                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="table-actions">

                                    <button
                                        type="button"
                                        class="action-btn view-btn"
                                        data-id="{{ $batch->id }}">

                                        View

                                    </button>

                                    <button
                                        type="button"
                                        class="action-btn edit-btn"
                                        data-id="{{ $batch->id }}">

                                        Edit

                                    </button>

                                    <form
                                        action="{{ route('admin.batches.destroy',$batch->id) }}"
                                        method="POST"
                                        class="delete-form"
                                        style="display:inline;">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-btn delete-btn">

                                            Delete

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

            @if ($batches->onFirstPage())

                <button disabled>Previous</button>

            @else

                <button onclick="window.location='{{ $batches->previousPageUrl() }}'">
                    Previous
                </button>

            @endif

            @for ($i = 1; $i <= $batches->lastPage(); $i++)

                <button
                    class="{{ $batches->currentPage() == $i ? 'active' : '' }}"
                    onclick="window.location='{{ $batches->url($i) }}'">

                    {{ $i }}

                </button>

            @endfor

            @if ($batches->hasMorePages())

                <button onclick="window.location='{{ $batches->nextPageUrl() }}'">
                    Next
                </button>

            @else

                <button disabled>Next</button>

            @endif

        </div>

    </div>

</div>


<!-- ADD BATCH MODAL -->

<div class="modal" id="batchModal">

    <div class="modal-box">

        <form action="{{ route('admin.batches.store') }}" method="POST">

            @csrf

            <div class="modal-header">

                <h3>Add Batch</h3>

                <button type="button" class="close-modal">
                    ×
                </button>

            </div>

            <div class="modal-body">

                <div class="form-grid">

                    <!-- Batch Code -->

                    <div>

                        <input
                            type="text"
                            class="form-control @error('batch_code') is-invalid @enderror"
                            name="batch_code"
                            placeholder="Batch Code"
                            value="{{ old('batch_code', $batchCode) }}"
                            readonly>

                        @error('batch_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- Batch Name -->

                    <div>

                        <input
                            type="text"
                            class="form-control @error('batch_name') is-invalid @enderror"
                            name="batch_name"
                            placeholder="Batch Name"
                            value="{{ old('batch_name') }}">

                        @error('batch_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- Course -->

                    <div>

                        <select
                            class="form-control @error('course_id') is-invalid @enderror"
                            name="course_id">

                            <option disabled {{ old('course_id') ? '' : 'selected' }}>
                                Select Course
                            </option>

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

                    {{-- Start Teacher --}}

                     <div>

                        <select
                            class="form-control @error('teacher_id') is-invalid @enderror"
                            name="teacher_id">

                            <option disabled selected>
                                Select Teacher
                            </option>

                            @foreach($teachers as $teacher)

                                <option
                                    value="{{ $teacher->id }}"
                                    {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>

                                    {{ $teacher->teacher_name }}

                                </option>

                            @endforeach

                        </select>

                        @error('teacher_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- Start Date -->

                    <div>

                        <input
                            type="date"
                            class="form-control @error('start_date') is-invalid @enderror"
                            name="start_date"
                            value="{{ old('start_date') }}">

                        @error('start_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- End Date -->

                    <div>

                        <input
                            type="date"
                            class="form-control @error('end_date') is-invalid @enderror"
                            name="end_date"
                            value="{{ old('end_date') }}">

                        @error('end_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- Status -->

                    <div>

                        <select
                            class="form-control @error('is_active') is-invalid @enderror"
                            name="is_active">

                            <option value="1"
                                {{ old('is_active',1)=='1' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ old('is_active')=='0' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                        @error('is_active')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

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
                    class="btn btn-primary">

                    Save Batch

                </button>

            </div>

        </form>

    </div>

</div>


<!-- =========================
VIEW COURSE MODAL
========================= -->

<div class="modal" id="viewBatchModal">

    <div class="modal-box" style="max-width:700px;">

        <div class="modal-header">

            <h3>Batch Information</h3>

            <button class="close-modal">
                ×
            </button>

        </div>

        <div class="modal-body">

            <div class="form-grid">

                <div>
                    <strong>Batch Code</strong>
                    <p id="view_batch_code"></p>
                </div>

                <div>
                    <strong>Batch Name</strong>
                    <p id="view_batch_name"></p>
                </div>

                <div>
                    <strong>Course</strong>
                    <p id="view_course_name"></p>
                </div>

                <div>
                    <strong>Teacher</strong>
                    <p id="view_teacher_name"></p>
                </div>

                <div>
                    <strong>Start Date</strong>
                    <p id="view_start_date"></p>
                </div>

                <div>
                    <strong>End Date</strong>
                    <p id="view_end_date"></p>
                </div>

                <div>
                    <strong>Total Students</strong>
                    <p id="view_students"></p>
                </div>

                <div>
                    <strong>Status</strong>
                    <p id="view_status"></p>
                </div>


            </div>

        </div>

    </div>

</div>

<!-- =========================
EDIT BATCH MODAL
========================= -->

<div class="modal" id="editBatchModal">

    <div class="modal-box">

        <form id="editBatchForm" action="" method="POST">

            @csrf
            @method('PUT')

            <div class="modal-header">

                <h3>Edit Batch</h3>

                <button type="button" class="close-modal">
                    ×
                </button>

            </div>

            <div class="modal-body">

                <div class="form-grid">

                    <!-- Batch Code -->

                    <div>

                        <input
                            type="text"
                            id="edit_batch_code"
                            class="form-control @error('batch_code') is-invalid @enderror"
                            placeholder="Batch Code"
                            name="batch_code"
                            value="{{ old('batch_code') }}">

                        @error('batch_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- Batch Name -->

                    <div>

                        <input
                            type="text"
                            id="edit_batch_name"
                            class="form-control @error('batch_name') is-invalid @enderror"
                            placeholder="Batch Name"
                            name="batch_name"
                            value="{{ old('batch_name') }}">

                        @error('batch_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- Course -->

                    <div>

                        <select
                            id="edit_course_id"
                            class="form-control @error('course_id') is-invalid @enderror"
                            name="course_id">

                            <option disabled selected>
                                Select Course
                            </option>

                            @foreach($courses as $course)

                                <option value="{{ $course->id }}">

                                    {{ $course->course_name }}

                                </option>

                            @endforeach

                        </select>

                        @error('course_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- Teacher -->

                    <div>

                        <select
                            id="edit_teacher_id"
                            class="form-control @error('teacher_id') is-invalid @enderror"
                            name="teacher_id">

                            <option disabled selected>
                                Select Teacher
                            </option>

                            @foreach($teachers as $teacher)

                                <option value="{{ $teacher->id }}">

                                    {{ $teacher->teacher_name }}

                                </option>

                            @endforeach

                        </select>

                        @error('teacher_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- Start Date -->

                    <div>

                        <input
                            type="date"
                            id="edit_start_date"
                            class="form-control @error('start_date') is-invalid @enderror"
                            name="start_date"
                            value="{{ old('start_date') }}">

                        @error('start_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- End Date -->

                    <div>

                        <input
                            type="date"
                            id="edit_end_date"
                            class="form-control @error('end_date') is-invalid @enderror"
                            name="end_date"
                            value="{{ old('end_date') }}">

                        @error('end_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                </div>

                <br>

                <!-- Status -->

                <select
                    id="edit_is_active"
                    class="form-control @error('is_active') is-invalid @enderror"
                    name="is_active">

                    <option value="1">
                        Active
                    </option>

                    <option value="0">
                        Inactive
                    </option>

                </select>

                @error('is_active')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-dark close-modal">

                    Cancel

                </button>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Update Batch

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

@if ($errors->any())

<script>

document.addEventListener('DOMContentLoaded', function(){

    $('#batchModal').fadeIn();

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
