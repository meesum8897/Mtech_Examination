<x-admin.header title="Students Management" breadcrumb="Students Management" msg="Manage all examination students"/>
<!-- STATISTICS -->

    <div class="student-stats">

        <div class="stat-card">

            <h4>Total Students</h4>

            <h2>{{ $totalStudents }}</h2>

        </div>

        <div class="stat-card">

            <h4>Active Students</h4>

            <h2>{{ $activeStudents }}</h2>

        </div>

        <div class="stat-card">

            <h4>Diploma Students</h4>

            <h2>{{ $diplomaStudents }}</h2>

        </div>

        <div class="stat-card">

            <h4>Short Course Students</h4>

            <h2>{{ $shortCourseStudents }}</h2>

        </div>

    </div>

    <!-- ACTION BAR -->

    <div class="page-header">

        <div>

            <h3>Students Directory</h3>
            <p>Search, Add, Edit and Manage Students</p>

        </div>

        <div class="page-actions">

            <button class="btn btn-outline">
                Import Excel
            </button>

            <button class="btn btn-primary" id="addStudentBtn">
                + Add Student
            </button>

        </div>

    </div>

<form method="GET" action="{{ route('admin.students.index') }}">

    <div class="filter-card">

        <div class="filter-grid">

            <!-- Search -->

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search Student Name, ID or Mobile"
                value="{{ request('search') }}">

            <!-- Course -->

            <select
                name="course_id"
                class="form-control">

                <option value="">
                    All Courses
                </option>

                @foreach($courses as $course)

                    <option
                        value="{{ $course->id }}"
                        {{ request('course_id') == $course->id ? 'selected' : '' }}>

                        {{ $course->course_name }}

                    </option>

                @endforeach

            </select>

            <!-- Batch -->

            <select
                name="batch_id"
                class="form-control">

                <option value="">
                    All Batches
                </option>

                @foreach($batches as $batch)

                    <option
                        value="{{ $batch->id }}"
                        {{ request('batch_id') == $batch->id ? 'selected' : '' }}>

                        {{ $batch->batch_name }}

                    </option>

                @endforeach

            </select>

            <!-- Status -->

            <select
                name="status"
                class="form-control">

                <option value="">
                    All Status
                </option>

                <option
                    value="1"
                    {{ request('status') === '1' ? 'selected' : '' }}>

                    Active

                </option>

                <option
                    value="0"
                    {{ request('status') === '0' ? 'selected' : '' }}>

                    Inactive

                </option>

            </select>

        </div>

        <div class="filter-actions">

            <button
                type="submit"
                class="btn btn-primary">

                Search

            </button>

            <button class="btn btn-light">
                Reset
            </button>

        </div>

    </div>

</form>

    <!-- TABLE -->

<div class="table-card">

    <div class="table-card-header">

        <h3>
            Student List
        </h3>

    </div>

    <div class="table-responsive">

        <table class="custom-table">

            <thead>

                <tr>

                    <th>Student Code</th>
                    <th>Roll No</th>
                    <th>Student Name</th>
                    <th>Father Name</th>
                    <th>Course</th>
                    <th>Batch</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                @forelse($students as $student)

                    <tr>

                        <td>{{ $student->student_code }}</td>

                        <td>{{ $student->roll_no }}</td>

                        <td>

                            {{ $student->first_name }}

                            {{ $student->last_name }}

                        </td>

                        <td>{{ $student->father_name }}</td>

                        <td>

                            {{ $student->batch->course->course_name ?? '-' }}

                        </td>

                        <td>

                            {{ $student->batch->batch_name ?? '-' }}

                        </td>

                        <td>{{ $student->phone }}</td>

                        <td>

                            @if($student->is_active)

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
                                    class="action-btn view-btn"
                                    data-id="{{ $student->id }}">

                                    View

                                </button>

                                <button
                                    class="action-btn edit-btn"
                                    data-id="{{ $student->id }}">

                                    Edit

                                </button>

                                <form
                                    action="{{ route('admin.students.destroy',$student->id) }}"
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

        @if ($students->onFirstPage())

            <button disabled>

                Previous

            </button>

        @else

            <button onclick="window.location='{{ $students->previousPageUrl() }}'">

                Previous

            </button>

        @endif

        @for ($i = 1; $i <= $students->lastPage(); $i++)

            <button
                class="{{ $students->currentPage() == $i ? 'active' : '' }}"
                onclick="window.location='{{ $students->url($i) }}'">

                {{ $i }}

            </button>

        @endfor

        @if ($students->hasMorePages())

            <button onclick="window.location='{{ $students->nextPageUrl() }}'">

                Next

            </button>

        @else

            <button disabled>

                Next

            </button>

        @endif

    </div>


<!-- =========================
ADD STUDENT MODAL
========================= -->

<div class="modal" id="studentModal">

    <div class="modal-box">

        <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="modal-header">

                <h3>Add Student</h3>

                <button type="button" class="close-modal">
                    ×
                </button>

            </div>

            <div class="modal-body">

                <div class="form-grid">

                    <!-- Student Code -->

                    <div>

                        <input
                            type="text"
                            id="student_code"
                            class="form-control @error('student_code') is-invalid @enderror"
                            name="student_code"
                            value="{{ old('student_code', $studentCode) }}"
                            readonly/>

                        @error('student_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- Roll No -->

                        <div>

                            <input
                                type="text"
                                id="roll_no"
                                class="form-control @error('roll_no') is-invalid @enderror"
                                name="roll_no"
                                value="{{ old('roll_no', $generatedRollNo) }}"
                                placeholder="Roll No"
                                readonly>

                            @error('roll_no')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                    <!-- Batch -->

    <div>

        <select id="batch_id" name="batch_id" class="form-control">

            <option value="">Select Batch</option>

            @foreach($batches as $batch)

                <option value="{{ $batch->id }}">

                    {{ $batch->batch_code }} - {{ $batch->batch_name }}

                </option>

            @endforeach

        </select>

        @error('batch_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

                    <!-- Gender -->

                <div>

                    <select
                        name="gender"
                        class="form-control @error('gender') is-invalid @enderror">

                        <option selected disabled>
                            Select Gender
                        </option>

                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>

                    </select>

                    @error('gender')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <!-- First Name -->

                <div>

                    <input
                        type="text"
                        class="form-control @error('first_name') is-invalid @enderror"
                        name="first_name"
                        placeholder="First Name"
                        value="{{ old('first_name') }}">

                    @error('first_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Last Name -->

                <div>

                    <input
                        type="text"
                        class="form-control @error('last_name') is-invalid @enderror"
                        name="last_name"
                        placeholder="Last Name"
                        value="{{ old('last_name') }}">

                    @error('last_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Father Name -->

                <div>

                    <input
                        type="text"
                        class="form-control @error('father_name') is-invalid @enderror"
                        name="father_name"
                        placeholder="Father Name"
                        value="{{ old('father_name') }}">

                    @error('father_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Date of Birth -->

                <div>

                    <input
                        type="date"
                        class="form-control @error('dob') is-invalid @enderror"
                        name="dob"
                        value="{{ old('dob') }}">

                    @error('dob')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <!-- CNIC -->

                <div>

                    <input
                        type="text"
                        class="form-control @error('cnic') is-invalid @enderror"
                        name="cnic"
                        placeholder="CNIC / B-Form"
                        value="{{ old('cnic') }}">

                    @error('cnic')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Phone -->

                <div>

                    <input
                        type="text"
                        class="form-control @error('phone') is-invalid @enderror"
                        name="phone"
                        placeholder="Mobile"
                        value="{{ old('phone') }}">

                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Guardian Phone -->

                <div>

                    <input
                        type="text"
                        class="form-control @error('guardian_phone') is-invalid @enderror"
                        name="guardian_phone"
                        placeholder="Guardian Phone"
                        value="{{ old('guardian_phone') }}">

                    @error('guardian_phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Email -->

                <div>

                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email"
                        placeholder="Email"
                        value="{{ old('email') }}">

                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Admission Date -->

                <div>

                    <input
                        type="date"
                        class="form-control @error('admission_date') is-invalid @enderror"
                        name="admission_date"
                        value="{{ old('admission_date') }}">

                    @error('admission_date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Status -->

                <div>

                <select
                    name="is_active"
                    class="form-control @error('is_active') is-invalid @enderror">

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

            </div>

            <br>

            <!-- Address -->
            <div>
                <textarea
                    class="form-control @error('address') is-invalid @enderror"
                    name="address"
                    placeholder="Address"
                    style="height:100px;">{{ old('address') }}</textarea>

                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <br>

            <div class="form-grid">

                <!-- Password -->

                <div>

                    <input
                        type="text"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        value="{{ old('password', $generatedPassword) }}"
                        readonly>

                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Confirm Password -->

                <div>

                    <input
                        type="text"
                        id="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror""
                        name="password_confirmation"
                        value="{{ old('password_confirmation', $generatedPassword) }}"
                        readonly>

                </div>

            </div>

            <br>

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

                Save Student

            </button>

        </div>

        </form>

    </div>

</div>

<!-- DELETE MODAL -->

<div class="modal" id="deleteModal">

    <div class="confirm-box">

        <h3>Delete Student</h3>

        <p>
            Are you sure you want to delete this student?
        </p>

        <div class="confirm-actions">

            <button class="btn btn-light closeModal cancelbtn">
                Cancel
            </button>

            <button class="btn btn-danger">
                Delete
            </button>

        </div>

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

    $('#studentModal').fadeIn();

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