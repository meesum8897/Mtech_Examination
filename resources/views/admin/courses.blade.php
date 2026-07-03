<x-admin.header title="Courses Management" breadcrumb="Courses Management" msg="Manage institute courses and academic programs"/>


    <!-- PAGE HEADER -->

    <div class="page-header">

        <div>

            <h2>Courses</h2>

            <p>
                Create and manage institute courses
            </p>

        </div>

        <button class="btn btn-primary" id="openCourseModal">

            + Add Course

        </button>

    </div>

    <!-- =========================
    STATISTICS
    ========================= -->

<div class="stats-grid">

    <div class="stat-card">

        <h4>Total Courses</h4>
        <h2>{{ $totalCourses }}</h2>

    </div>

    <div class="stat-card">

        <h4>Active Courses</h4>
        <h2>{{ $activeCourses }}</h2>

    </div>

    <div class="stat-card">

        <h4>Short Courses</h4>
        <h2>{{ $shortCourses }}</h2>

    </div>

    <div class="stat-card">

        <h4>Diploma Courses</h4>
        <h2>{{ $diplomaCourses }}</h2>

    </div>

</div>

    <!-- =========================
    FILTERS
    ========================= -->

    <div class="filter-card">

        <div class="filter-grid">

            <input
                type="text"
                class="form-control"
                placeholder="Search Course Name / Code">

            <select class="form-control">

                <option>All Types</option>
                <option>Short Course</option>
                <option>Diploma</option>
                <option>Certification</option>

            </select>

            <select class="form-control">

                <option>All Status</option>
                <option>Active</option>
                <option>Inactive</option>

            </select>

            <select class="form-control">

                <option>All Durations</option>
                <option>1 Month</option>
                <option>3 Months</option>
                <option>6 Months</option>
                <option>1 Year</option>

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

    <!-- =========================
    TABLE
    ========================= -->

    <div class="table-card">

        <div class="table-card-header">

            <h3>Courses List</h3>

        </div>

        <div class="table-responsive">

            <table class="custom-table">

                <thead>

                    <tr>

                        <th>Code</th>
                        <th>Course Name</th>
                        <th>Duration</th>
                        <th>Type</th>
                        <th>Students</th>
                        <th>Teachers</th>
                        <th>Status</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($courses as $course)

                    <tr>

                        <td>{{ $course->course_code }}</td>

                        <td>{{ $course->course_name }}</td>

                        <td>{{ $course->duration }}</td>

                        <td>{{ $course->type }}</td>

                        <td>{{ $course->students_count ?? 0 }}</td>

                        <td>{{ $course->teachers_count ?? 0 }}</td>

                        <td>

                            @if($course->is_active)

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
                                    class="action-btn view-teacher-btn"
                                    data-id="{{ $course->id }}">

                                    View

                                </button>

                                <button
                                    type="button"
                                    class="action-btn edit-btn"
                                    data-id="{{ $course->id }}">

                                    Edit

                                </button>

                                <form
                                    action="{{ route('admin.courses.destroy', $course->id) }}"
                                    method="POST"
                                    class="delete-course-form"
                                    style="display:inline;">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-btn delete-btn">

                                        Delete

                                    </button>

                                </form>

                                @if(session('success'))
                                        <script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: "{{ session('success') }}",
                                            timer: 2000,
                                            showConfirmButton: false
                                        });
                                    </script>
                                @endif

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

            @if ($courses->onFirstPage())

                <button disabled>Previous</button>

            @else

                <button onclick="window.location='{{ $courses->previousPageUrl() }}'">
                    Previous
                </button>

            @endif

            @for ($i = 1; $i <= $courses->lastPage(); $i++)

                <button
                    class="{{ $courses->currentPage() == $i ? 'active' : '' }}"
                    onclick="window.location='{{ $courses->url($i) }}'">

                    {{ $i }}

                </button>

            @endfor

            @if ($courses->hasMorePages())

                <button onclick="window.location='{{ $courses->nextPageUrl() }}'">
                    Next
                </button>

            @else

                <button disabled>Next</button>

            @endif

        </div>

    </div>

</div>

<!-- =========================
ADD COURSE MODAL
========================= -->

<div class="modal" id="courseModal">

    <div class="modal-box">

        <form action="{{ route('admin.courses.store') }}" method="POST">

            @csrf

            <div class="modal-header">

                <h3>Add Course</h3>

                <button type="button" class="close-modal">
                    ×
                </button>

            </div>

            <div class="modal-body">

                <div class="form-grid">

                    <div>

                        <input
                            type="text"
                            class="form-control @error('course_code') is-invalid @enderror"
                            placeholder="Course Code"
                            name="course_code"
                            value="{{ old('course_code') }}">

                        @error('course_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div>

                        <input
                            type="text"
                            class="form-control @error('course_name') is-invalid @enderror"
                            placeholder="Course Name"
                            name="course_name"
                            value="{{ old('course_name') }}">

                        @error('course_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div>

                        <select class="form-control @error('duration') is-invalid @enderror" name="duration">

                            <option disabled {{ old('duration') ? '' : 'selected' }}>
                                Select Duration
                            </option>

                            <option value="1 Month" {{ old('duration')=='1 Month' ? 'selected' : '' }}>1 Month</option>

                            <option value="3 Months" {{ old('duration')=='3 Months' ? 'selected' : '' }}>3 Months</option>

                            <option value="6 Months" {{ old('duration')=='6 Months' ? 'selected' : '' }}>6 Months</option>

                            <option value="1 Year" {{ old('duration')=='1 Year' ? 'selected' : '' }}>1 Year</option>

                        </select>

                        @error('duration')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div>

                        <select
                            class="form-control @error('type') is-invalid @enderror"
                            name="type">

                            <option disabled {{ old('type') ? '' : 'selected' }}>
                                Select Type
                            </option>

                            <option value="Short Course" {{ old('type')=='Short Course' ? 'selected' : '' }}>
                                Short Course
                            </option>

                            <option value="Diploma" {{ old('type')=='Diploma' ? 'selected' : '' }}>
                                Diploma
                            </option>

                            <option value="Certification" {{ old('type')=='Certification' ? 'selected' : '' }}>
                                Certification
                            </option>

                        </select>

                        @error('type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                </div>

                <br>

                <textarea
                    class="form-control @error('description') is-invalid @enderror"
                    style="height:120px; padding-top:15px;"
                    placeholder="Course Description"
                    name="description">{{ old('description') }}</textarea>

                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <select
                    class="form-control @error('is_active') is-invalid @enderror"
                    name="is_active">

                    <option value="1" {{ old('is_active','1')=='1' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0" {{ old('is_active')=='0' ? 'selected' : '' }}>
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

                    Save Course

                </button>

            </div>

        </form>

    </div>

</div>

@if ($errors->any())

<script>

document.addEventListener('DOMContentLoaded', function () {

    $('#courseModal').fadeIn();

});

</script>

@endif

<!-- =========================
VIEW COURSE MODAL
========================= -->

<div class="modal" id="viewCourseModal">

    <div class="modal-box" style="max-width:700px;">

        <div class="modal-header">

            <h3>Course Information</h3>

            <button class="close-modal">
                ×
            </button>

        </div>

        <div class="modal-body">

            <div class="form-grid">

                <div>

                    <label>Course Code</label>
                    <p><strong id="view_course_code"></strong></p>

                </div>

                <div>

                    <label>Course Name</label>
                    <p><strong id="view_course_name"></strong></p>

                </div>

                <div>

                    <label>Duration</label>
                    <p><strong id="view_duration"></strong></p>

                </div>

                <div>

                    <label>Type</label>
                    <p><strong id="view_type"></strong></p>

                </div>

                <div>

                    <label>Teachers</label>
                    <p><strong id="view_teachers"></strong></p>

                </div>

                <div>

                    <label>Students</label>
                    <p><strong id="view_students"></strong></p>

                </div>

                <div>

                    <label>Status</label>
                    <p><strong id="view_status"></strong></p>

                </div>

            </div>

        </div>

    </div>

</div>

@if(session('success'))

<script>

Swal.fire({

    icon: 'success',

    title: 'Success',

    text: '{{ session('success') }}',

    confirmButtonColor: '#faa31d'

});

</script>

@endif


<!-- =========================
EDIT COURSE MODAL
========================= -->

<div class="modal" id="editCourseModal">

    <div class="modal-box">

        <form id="courseForm" action="{{ route('admin.courses.store') }}" method="POST">

            @csrf

            <div class="modal-header">

                <h3 id="courseModalTitle">Add Course</h3>

                <button type="button" class="close-modal">
                    ×
                </button>

            </div>

            <div class="modal-body">

                <div class="form-grid">

                    <div>

                        <input
                            type="text"
                            id="course_code"
                            class="form-control @error('course_code') is-invalid @enderror"
                            placeholder="Course Code"
                            name="course_code"
                            value="{{ old('course_code') }}">

                        @error('course_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div>

                        <input
                            type="text"
                            id="course_name"
                            class="form-control @error('course_name') is-invalid @enderror"
                            placeholder="Course Name"
                            name="course_name"
                            value="{{ old('course_name') }}">

                        @error('course_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div>

                        <select
                            id="duration"
                            class="form-control @error('duration') is-invalid @enderror"
                            name="duration">

                            <option disabled {{ old('duration') ? '' : 'selected' }}>
                                Select Duration
                            </option>

                            <option value="1 Month" {{ old('duration')=='1 Month' ? 'selected' : '' }}>
                                1 Month
                            </option>

                            <option value="3 Months" {{ old('duration')=='3 Months' ? 'selected' : '' }}>
                                3 Months
                            </option>

                            <option value="6 Months" {{ old('duration')=='6 Months' ? 'selected' : '' }}>
                                6 Months
                            </option>

                            <option value="1 Year" {{ old('duration')=='1 Year' ? 'selected' : '' }}>
                                1 Year
                            </option>

                        </select>

                        @error('duration')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div>

                        <select
                            id="type"
                            class="form-control @error('type') is-invalid @enderror"
                            name="type">

                            <option disabled {{ old('type') ? '' : 'selected' }}>
                                Select Type
                            </option>

                            <option value="Short Course" {{ old('type')=='Short Course' ? 'selected' : '' }}>
                                Short Course
                            </option>

                            <option value="Diploma" {{ old('type')=='Diploma' ? 'selected' : '' }}>
                                Diploma
                            </option>

                            <option value="Certification" {{ old('type')=='Certification' ? 'selected' : '' }}>
                                Certification
                            </option>

                        </select>

                        @error('type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                </div>

                <br>

                <textarea
                    id="description"
                    class="form-control @error('description') is-invalid @enderror"
                    style="height:120px; padding-top:15px;"
                    placeholder="Course Description"
                    name="description">{{ old('description') }}</textarea>

                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <select
                    id="is_active"
                    class="form-control @error('is_active') is-invalid @enderror"
                    name="is_active">

                    <option value="1" {{ old('is_active','1')=='1' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0" {{ old('is_active')=='0' ? 'selected' : '' }}>
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
                    id="courseSubmitBtn"
                    class="btn btn-primary">

                    Save Course

                </button>

            </div>

        </form>

    </div>

</div>
</body>
</html>

