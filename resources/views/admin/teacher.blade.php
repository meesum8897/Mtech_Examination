<x-admin.header title="Teachers Management" breadcrumb="Manage institute teachers and batch assignments"/>

  <!-- PAGE HEADER -->
        <!-- STATISTICS -->

    <div class="stats-grid">

        <div class="stat-card">

            <h4>Total Teachers</h4>
            <h2>{{$totalteachers}}</h2>

        </div>

        <div class="stat-card">

            <h4>Active Teachers</h4>
            <h2>{{$activeteachers}}</h2>

        </div>

        <div class="stat-card">

            <h4>Assigned Batches</h4>
            <h2>{{$assignedbatches}}</h2>

        </div>

        <div class="stat-card">

            <h4>Assigned Batches</h4>
            <h2>{{$assignedbatches}}</h2>

        </div>
    </div>
    
    <div class="page-header">
        
        <div>

            <h2>Teachers</h2>

            <p>
                Add, edit and manage teachers
            </p>

        </div>

        <button class="btn btn-primary" id="openTeacherModal">
            + Add Teacher
        </button>

    </div>
    

    <!-- FILTER CARD -->

    <div class="filter-card">

        <div class="filter-grid">

            <input
                type="text"
                class="form-control"
                name="search"
                placeholder="Search Teacher Name / ID / Mobile"
                value="{{ request('search') }}"/>

            <select class="form-control" name="course_id">
                <option value="">All Courses</option>
                @foreach($courses as $course)
                    <option
                        value="{{ $course->id }}"
                        {{ request('course_id') == $course->id ? 'selected' : '' }}>

                        {{ $course->course_name }}
                    </option>
                @endforeach
            </select>

            <select class="form-control" name="batch_id">
                <option value="">All Batches</option>
                @foreach($batches as $batch)
                    <option
                        value="{{ $batch->id }}"
                        {{ request('batch_id') == $batch->id ? 'selected' : '' }}>

                        {{ $batch->batch_name }}
                    </option>
                @endforeach
            </select>

            <select class="form-control" name="status">
                <option value="">All Status</option>
                <option
                    value="1"
                    {{ request('status') == '1' ? 'selected' : '' }}>
                    Active
                </option>

                <option
                    value="0"
                    {{ request('status') == '0' ? 'selected' : '' }}>
                    Inactive
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

    <!-- TABLE CARD -->

    <div class="table-card">

        <div class="table-card-header">

            <h3>Teachers List</h3>

        </div>

        <div class="table-responsive">

            <table class="admin-table">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Teacher Name</th>
                        <th>Mobile</th>
                        <th>Qualification</th>
                        <th>Courses</th>
                        <th>Batches</th>
                        <th>Status</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($teachers as $teacher)

                    <tr>

                        <td>{{ $teacher->teacher_code }}</td>

                        <td>{{ $teacher->teacher_name }}</td>

                        <td>{{ $teacher->mobile }}</td>

                        <td>{{ $teacher->qualification }}</td>

                        <td>{{ $teacher->students_count ?? 0 }}</td>

                        <td>{{ $teacher->teachers_count ?? 0 }}</td>

                        <td>

                            @if($teacher->is_active)

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
                                    data-id="{{ $teacher->id }}">

                                    View

                                </button>

                                <button
                                    type="button"
                                    class="action-btn edit-btn"
                                    data-id="{{ $teacher->id }}">

                                    Edit

                                </button>

                                <form
                                    action="{{ route('admin.teachers.destroy', $teacher->id) }}"
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

            @if ($teachers->onFirstPage())

                <button disabled>Previous</button>

            @else

                <button onclick="window.location='{{ $teachers->previousPageUrl() }}'">
                    Previous
                </button>

            @endif

            @for ($i = 1; $i <= $teachers->lastPage(); $i++)

                <button
                    class="{{ $teachers->currentPage() == $i ? 'active' : '' }}"
                    onclick="window.location='{{ $teachers->url($i) }}'">

                    {{ $i }}

                </button>

            @endfor

            @if ($teachers->hasMorePages())

                <button onclick="window.location='{{ $teachers->nextPageUrl() }}'">
                    Next
                </button>

            @else

                <button disabled>Next</button>

            @endif

        </div>

    </div>

</div>

<!-- ADD TEACHER MODAL -->

<div class="modal" id="teacherModal">

    <div class="modal-box">
        <form action="{{ route('admin.teachers.store') }}" method="POST">

            @csrf
            <div class="modal-header">

                <h3>Add Teacher</h3>

                <button type="button" class="close-modal">
                    ×
                </button>

            </div>

            <div class="modal-body">

                <div class="form-grid">
                    
                    <div>
                        <input
                            type="text"
                            class="form-control @error('teacher_code') is-invalid @enderror"
                            name="teacher_code"
                            placeholder="Teacher ID"
                            value="{{ old('teacher_code') }}">

                        @error('teacher_code')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <input
                            type="text"
                            class="form-control @error('teacher_name') is-invalid @enderror"
                            name="teacher_name"
                            placeholder="Full Name"
                            value="{{ old('teacher_name') }}">

                        @error('teacher_code')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
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
                    <div>
                        <input
                        type="text"
                        class="form-control @error('cnic') is-invalid @enderror"
                        name="cnic"
                        placeholder="CNIC"
                        value="{{ old('cnic') }}">

                        @error('cnic')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <input
                        type="text"
                        class="form-control @error('mobile') is-invalid @enderror"
                        name="mobile"
                        placeholder="Mobile"
                        value="{{ old('mobile') }}">

                        @error('mobile')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
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

                    <div>
                        <input
                        type="text"
                        class="form-control @error('qualification') is-invalid @enderror"
                        name="qualification"
                        placeholder="Qualification"
                        value="{{ old('qualification') }}">

                        @error('qualification')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <input
                        type="text"
                        class="form-control @error('designation') is-invalid @enderror"
                        name="designation"
                        placeholder="Designation"
                        value="{{ old('designation') }}">

                        @error('designation')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <input
                        type="text"
                        class="form-control @error('experience') is-invalid @enderror"
                        name="experience"
                        placeholder="Experience"
                        value="{{ old('experience') }}">

                        @error('experience')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <input
                        type="date"
                        class="form-control @error('joining_date') is-invalid @enderror"
                        name="joining_date"
                        value="{{ old('joining_date') }}">

                        @error('joining_date')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-dark close-modal">
                    Cancel
                </button>

                <button type="submit" class="btn btn-primary">
                    Save Teacher
                </button>

            </div>
        </form>
    </div>
    
</div>
{{-- End Add Teacher Modal --}}


<!-- VIEW TEACHER MODAL -->

<div class="modal" id="viewTeacherModal">

    <div class="modal-box" style="max-width:850px;">

        <div class="modal-header">

            <h3>Teacher Information</h3>

            <button type="button" class="close-modal">
                ×
            </button>

        </div>

        <div class="modal-body">

            <div class="form-grid">

                <div>
                    <label>Teacher ID</label>
                    <p><strong id="view_teacher_code"></strong></p>
                </div>

                <div>
                    <label>Teacher Name</label>
                    <p><strong id="view_teacher_name"></strong></p>
                </div>

                <div>
                    <label>Father Name</label>
                    <p><strong id="view_father_name"></strong></p>
                </div>

                <div>
                    <label>CNIC</label>
                    <p><strong id="view_cnic"></strong></p>
                </div>

                <div>
                    <label>Mobile</label>
                    <p><strong id="view_mobile"></strong></p>
                </div>

                <div>
                    <label>Email</label>
                    <p><strong id="view_email"></strong></p>
                </div>

                <div>
                    <label>Gender</label>
                    <p><strong id="view_gender"></strong></p>
                </div>

                <div>
                    <label>Qualification</label>
                    <p><strong id="view_qualification"></strong></p>
                </div>

                <div>
                    <label>Designation</label>
                    <p><strong id="view_designation"></strong></p>
                </div>

                <div>
                    <label>Experience</label>
                    <p><strong id="view_experience"></strong></p>
                </div>

                <div>
                    <label>Joining Date</label>
                    <p><strong id="view_joining_date"></strong></p>
                </div>

                <div>
                    <label>Salary</label>
                    <p><strong id="view_salary"></strong></p>
                </div>

                <div>
                    <label>Status</label>
                    <p><strong id="view_status"></strong></p>
                </div>

            </div>

            <br>

            <div>

                <label>Address</label>

                <p id="view_address"></p>

            </div>

            <br>

            <div>

                <label>Remarks</label>

                <p id="view_remarks"></p>

            </div>

        </div>

    </div>

</div>
{{-- End View Teacher Modal --}}
</body>

@if(session('success'))

<script>

Swal.fire({

    icon: 'success',

    title: 'Success!',

    text: '{{ session('success') }}',

    confirmButtonColor: '#3085d6',

    timer: 2500,

    showConfirmButton: false

});

</script>

@endif

@if ($errors->any())

<script>

document.addEventListener('DOMContentLoaded', function () {

    $('#editTeacherModal').fadeIn();

});

</script>

@endif

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

{{-- Delete Modal --}}
<script>

$(document).on('submit', '.delete-form', function(e){

    e.preventDefault();

    let form = this;

    Swal.fire({

        title: 'Delete Teacher?',

        text: "This teacher will be moved to trash.",

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#d33',

        cancelButtonColor: '#3085d6',

        confirmButtonText: 'Yes, Delete',

        cancelButtonText: 'Cancel'

    }).then((result) => {

        if(result.isConfirmed){

            form.submit();

        }

    });

});

</script>
{{-- Delete Modal End --}}

{{-- After Deletion --}}

@if(session('success'))

<script>

Swal.fire({

    icon:'success',

    title:'Success',

    text:"{{ session('success') }}",

    timer:2000,

    showConfirmButton:false

});

</script>

@endif

<!-- =========================
EDIT TEACHER MODAL
========================= -->

<div class="modal" id="editTeacherModal">

    <div class="modal-box">

        <form id="editTeacherForm" action="{{ route('admin.teachers.store') }}" method="POST">

            @csrf
            @method('PUT')

            <div class="modal-header">

                <h3 id="courseModalTitle">Edit Teacher</h3>

                <button type="button" class="close-modal">
                    ×
                </button>

            </div>

            <div class="modal-body">

                <div class="form-grid">

                    <div>

                        <input
                            type="text"
                            id="edit_teacher_code"
                            class="form-control @error('edit_teacher_code') is-invalid @enderror"
                            placeholder="Teacher Code"
                            name="teacher_code"
                            value="{{ old('edit_teacher_code') }}">

                        @error('edit_teacher_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div>

                        <input
                            type="text"
                            id="edit_teacher_name"
                            class="form-control @error('edit_teacher_name') is-invalid @enderror"
                            placeholder="Teacher Name"
                            name="teacher_name"
                            value="{{ old('edit_teacher_name') }}">

                        @error('course_name')
                            <small edit_teacher_name="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div>

                        <input
                            type="text"
                            id="edit_father_name"
                            class="form-control @error('edit_father_name') is-invalid @enderror"
                            placeholder="Father Name"
                           name="father_name"
                            value="{{ old('edit_father_name') }}">

                        @error('course_name')
                            <small edit_father_name="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div>

                        <input
                            type="text"
                            id="edit_cnic"
                            class="form-control @error('edit_cnic') is-invalid @enderror"
                            placeholder="CNIC"
                           name="cnic"
                            value="{{ old('edit_cnic') }}">

                        @error('course_name')
                            <small edit_cnic="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div>

                        <input
                            type="text"
                            id="edit_mobile"
                            class="form-control @error('edit_mobile') is-invalid @enderror"
                            placeholder="Mobile"
                           name="mobile"
                            value="{{ old('edit_mobile') }}">

                        @error('course_name')
                            <small edit_mobile="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div>

                        <input
                            type="text"
                            id="edit_qualification"
                            class="form-control @error('edit_qualification') is-invalid @enderror"
                            placeholder="Qualification"
                           name="qualification"
                            value="{{ old('edit_qualification') }}">

                        @error('course_name')
                            <small edit_qualification="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div>

                        <input
                            type="text"
                            id="edit_designation"
                            class="form-control @error('edit_designation') is-invalid @enderror"
                            placeholder="Designation"
                           name="designation"
                            value="{{ old('edit_designation') }}">

                        @error('course_name')
                            <small edit_designation="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div>

                        <input
                            type="text"
                            id="edit_experience"
                            class="form-control @error('edit_experience') is-invalid @enderror"
                            placeholder="Experience"
                            name="experience"
                            value="{{ old('edit_experience') }}">

                        @error('course_name')
                            <small edit_experience="text-danger">{{ $message }}</small>
                        @enderror

                    </div>


                    <div>

                        <select
                    id="edit_is_active"
                    class="form-control @error('edit_is_active') is-invalid @enderror"
                    name="is_active">

                    <option value="1" {{ old('edit_is_active','1')=='1' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0" {{ old('edit_is_active')=='0' ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>

                @error('edit_is_active')
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
                    id="courseSubmitBtn"
                    class="btn btn-primary">

                    Save

                </button>

            </div>

        </form>

    </div>

</div>
</html>

