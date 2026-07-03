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
            <h2>48</h2>

        </div>

        <div class="stat-card">

            <h4>Active Batches</h4>
            <h2>42</h2>

        </div>

        <div class="stat-card">

            <h4>Morning Batches</h4>
            <h2>25</h2>

        </div>

        <div class="stat-card">

            <h4>Evening Batches</h4>
            <h2>17</h2>

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

            <select class="form-control">

                <option>All Courses</option>

                <option>MS Office</option>
                <option>Web Designing</option>
                <option>Graphic Designing</option>
                <option>DIT</option>

            </select>

            <select class="form-control">

                <option>All Teachers</option>

                <option>Ali Raza</option>
                <option>Hassan Abbas</option>
                <option>Murtaza Rizvi</option>

            </select>

            <select class="form-control">

                <option>All Shifts</option>

                <option>Morning</option>
                <option>Evening</option>
                <option>Weekend</option>

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
                        <th>Shift</th>
                        <th>Students</th>
                        <th>Start Date</th>
                        <th>Status</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>MSO-MOR-01</td>

                        <td>
                            MS Office Morning
                        </td>

                        <td>MS Office</td>

                        <td>Ali Raza</td>

                        <td>Morning</td>

                        <td>25</td>

                        <td>01-Jan-2026</td>

                        <td>

                            <span class="badge-success">
                                Active
                            </span>

                        </td>

                        <td>

                            <div class="table-actions">

                                <button
                                class="action-btn view-btn">

                                    View

                                </button>

                                <button
                                class="action-btn student-btn">

                                    Students

                                </button>

                                <button
                                class="action-btn edit-btn">

                                    Edit

                                </button>

                                <button
                                class="action-btn delete-btn">

                                    Delete

                                </button>

                            </div>

                        </td>

                    </tr>

                    <tr>

                        <td>WEB-EVE-01</td>

                        <td>
                            Web Designing Evening
                        </td>

                        <td>Web Designing</td>

                        <td>Hassan Abbas</td>

                        <td>Evening</td>

                        <td>18</td>

                        <td>05-Jan-2026</td>

                        <td>

                            <span class="badge-success">
                                Active
                            </span>

                        </td>

                        <td>

                            <div class="table-actions">

                                <button
                                class="action-btn view-btn">

                                    View

                                </button>

                                <button
                                class="action-btn student-btn">

                                    Students

                                </button>

                                <button
                                class="action-btn edit-btn">

                                    Edit

                                </button>

                                <button
                                class="action-btn delete-btn">

                                    Delete

                                </button>

                            </div>

                        </td>

                    </tr>

                    <tr>

                        <td>GD-WKD-01</td>

                        <td>
                            Graphic Design Weekend
                        </td>

                        <td>Graphic Designing</td>

                        <td>Murtaza Rizvi</td>

                        <td>Weekend</td>

                        <td>15</td>

                        <td>10-Jan-2026</td>

                        <td>

                            <span class="badge-danger">
                                Inactive
                            </span>

                        </td>

                        <td>

                            <div class="table-actions">

                                <button
                                class="action-btn view-btn">

                                    View

                                </button>

                                <button
                                class="action-btn student-btn">

                                    Students

                                </button>

                                <button
                                class="action-btn edit-btn">

                                    Edit

                                </button>

                                <button
                                class="action-btn delete-btn">

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

            <button>
                Previous
            </button>

            <button class="active">
                1
            </button>

            <button>
                2
            </button>

            <button>
                3
            </button>

            <button>
                Next
            </button>

        </div>

    </div>

</div>


<div class="modal" id="batchModal">

    <div class="modal-box">

        <div class="modal-header">

            <h3>Add Batch</h3>

            <button class="close-modal">
                ×
            </button>

        </div>

        <div class="modal-body">

            <div class="form-grid">

                <input
                type="text"
                class="form-control"
                placeholder="Batch Code">

                <input
                type="text"
                class="form-control"
                placeholder="Batch Name">

                <select class="form-control">

                    <option>Select Course</option>
                    <option>MS Office</option>
                    <option>Web Designing</option>

                </select>

                <select class="form-control">

                    <option>Select Teacher</option>
                    <option>Ali Raza</option>
                    <option>Hassan Abbas</option>

                </select>

                <select class="form-control">

                    <option>Select Shift</option>
                    <option>Morning</option>
                    <option>Evening</option>
                    <option>Weekend</option>

                </select>

                <input
                type="number"
                class="form-control"
                placeholder="Maximum Students">

                <input
                type="date"
                class="form-control">

                <input
                type="date"
                class="form-control">

            </div>

            <br>

            <select class="form-control">

                <option>Active</option>
                <option>Inactive</option>

            </select>

        </div>

        <div class="modal-footer">

            <button
            class="btn btn-dark close-modal">

                Cancel

            </button>

            <button
            class="btn btn-primary"
            id="saveBatchBtn">

                Save Batch

            </button>

        </div>

    </div>

</div>

<div class="modal" id="viewBatchModal">

    <div class="modal-box">

        <div class="modal-header">

            <h3>Batch Information</h3>

            <button class="close-modal">
                ×
            </button>

        </div>

        <div class="modal-body">

            <div class="details-grid">

                <div>
                    <strong>Batch Code</strong>
                    <p>MSO-MOR-01</p>
                </div>

                <div>
                    <strong>Batch Name</strong>
                    <p>MS Office Morning</p>
                </div>

                <div>
                    <strong>Course</strong>
                    <p>MS Office</p>
                </div>

                <div>
                    <strong>Teacher</strong>
                    <p>Ali Raza</p>
                </div>

                <div>
                    <strong>Shift</strong>
                    <p>Morning</p>
                </div>

                <div>
                    <strong>Students</strong>
                    <p>25</p>
                </div>

                <div>
                    <strong>Status</strong>
                    <p>Active</p>
                </div>

            </div>

        </div>

    </div>

</div>



</body>
</html>
