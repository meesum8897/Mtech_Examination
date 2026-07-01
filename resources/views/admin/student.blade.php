<x-admin.header title="Students Management" breadcrumb="Students Management" msg="Manage all examination students"/>
<!-- STATISTICS -->

    <div class="student-stats">

        <div class="stat-card">

            <h4>Total Students</h4>
            <h2>1250</h2>

        </div>

        <div class="stat-card">

            <h4>Active Students</h4>
            <h2>1180</h2>

        </div>

        <div class="stat-card">

            <h4>Diploma Students</h4>
            <h2>450</h2>

        </div>

        <div class="stat-card">

            <h4>Short Courses</h4>
            <h2>730</h2>

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

    <!-- FILTERS -->

    <div class="filter-card">

        <div class="filter-grid">

            <input type="text"
                   class="form-control"
                   placeholder="Search Student Name, ID or Mobile">

            <select class="form-control">

                <option>All Courses</option>
                <option>MS Office</option>
                <option>Web Designing</option>
                <option>Graphic Designing</option>

            </select>

            <select class="form-control">

                <option>All Batches</option>
                <option>B-2401</option>
                <option>B-2402</option>

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

            <button class="btn btn-light">
                Reset
            </button>

        </div>

    </div>

    <!-- TABLE -->

    <div class="table-card">

        <div class="table-card-header">

            <h3>Teachers List</h3>

        </div>

        <div class="table-responsive">
        <table class="admin-table">

            <thead>

                <tr>

                    <th>Student ID</th>
                    <th>Full Name</th>
                    <th>Father Name</th>
                    <th>Batch</th>
                    <th>Course</th>
                    <th>Semester</th>
                    <th>Status</th>
                    <th width="180">Actions</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>ST2026-001</td>
                    <td>Ali Raza</td>
                    <td>Hassan Raza</td>
                    <td>B-2401</td>
                    <td>MS Office</td>
                    <td>1</td>

                    <td>
                        <span class="badge-success">
                            Active
                        </span>
                    </td>

                    <td>

                        <div class="action-buttons">

                            <button class="btn-view">
                                View
                            </button>

                            <button class="btn-edit editStudentBtn">
                                Edit
                            </button>

                            <button class="btn-delete deleteStudentBtn">
                                Delete
                            </button>

                        </div>

                    </td>

                </tr>

                <tr>

                    <td>ST2026-002</td>
                    <td>Ahmed Khan</td>
                    <td>Rashid Khan</td>
                    <td>B-2401</td>
                    <td>Web Designing</td>
                    <td>1</td>

                    <td>
                        <span class="badge-success">
                            Active
                        </span>
                    </td>

                    <td>

                        <div class="action-buttons">

                            <button class="btn-view">
                                View
                            </button>

                            <button class="btn-edit editStudentBtn">
                                Edit
                            </button>

                            <button class="btn-delete deleteStudentBtn">
                                Delete
                            </button>

                        </div>

                    </td>

                </tr>

                <tr>

                    <td>ST2026-003</td>
                    <td>Bilal Ahmed</td>
                    <td>Akram Ahmed</td>
                    <td>B-2402</td>
                    <td>Graphic Designing</td>
                    <td>2</td>

                    <td>
                        <span class="badge-danger">
                            Inactive
                        </span>
                    </td>

                    <td>

                        <div class="action-buttons">

                            <button class="btn-view">
                                View
                            </button>

                            <button class="btn-edit editStudentBtn">
                                Edit
                            </button>

                            <button class="btn-delete deleteStudentBtn">
                                Delete
                            </button>

                        </div>

                    </td>

                </tr>

            </tbody>

        </table>
        </div>

    <!-- PAGINATION -->

    <div class="pagination">

        <button>Previous</button>

        <button class="active">1</button>
        <button>2</button>
        <button>3</button>

        <button>Next</button>

    </div>
    </div>


</div>

<!-- ADD STUDENT MODAL -->

<div class="modal" id="studentModal">

    <div class="modal-box">

        <div class="modal-header">

            <h3>Add Student</h3>

            <button class="closeModal">
                ×
            </button>

        </div>

        <div class="modal-body">

            <div class="form-grid">

                <input type="text" class="form-control" placeholder="Student ID">
                <input type="text" class="form-control" placeholder="Batch Code">

                <input type="text" class="form-control" placeholder="Full Name">
                <input type="text" class="form-control" placeholder="Father Name">

                <input type="text" class="form-control" placeholder="Mobile">
                <input type="email" class="form-control" placeholder="Email">

                <select class="form-control">

                    <option>Select Course</option>

                </select>

                <select class="form-control">

                    <option>Select Semester</option>

                </select>

                <input type="password" class="form-control" placeholder="Password">
                <input type="password" class="form-control" placeholder="Confirm Password">

                <select class="form-control">

                    <option>Active</option>
                    <option>Inactive</option>

                </select>

            </div>

        </div>

        <div class="modal-footer">

            <button class="btn btn-light closeModal cancelbtn">
                Cancel
            </button>

            <button class="btn btn-primary">
                Save Student
            </button>

        </div>

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
</html>