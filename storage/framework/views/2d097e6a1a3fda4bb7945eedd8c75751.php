<?php if (isset($component)) { $__componentOriginal45d9cbba1e84739af2366cafaf311004 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal45d9cbba1e84739af2366cafaf311004 = $attributes; } ?>
<?php $component = App\View\Components\Admin\Header::resolve(['title' => 'Dashboard','breadcrumb' => 'Dashboard'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Admin\Header::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal45d9cbba1e84739af2366cafaf311004)): ?>
<?php $attributes = $__attributesOriginal45d9cbba1e84739af2366cafaf311004; ?>
<?php unset($__attributesOriginal45d9cbba1e84739af2366cafaf311004); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal45d9cbba1e84739af2366cafaf311004)): ?>
<?php $component = $__componentOriginal45d9cbba1e84739af2366cafaf311004; ?>
<?php unset($__componentOriginal45d9cbba1e84739af2366cafaf311004); ?>
<?php endif; ?>
    
    <!-- CARDS -->

    <div class="admin-cards">

        <div class="admin-card">

            <h3>Total Students</h3>

            <h1>1,250</h1>

        </div>

        <div class="admin-card">

            <h3>Total Teachers</h3>

            <h1>45</h1>

        </div>

        <div class="admin-card">

            <h3>Active Exams</h3>

            <h1>12</h1>

        </div>

        <div class="admin-card">

            <h3>Courses</h3>

            <h1>18</h1>

        </div>

    </div>

    <!-- TABLE -->

    <div class="admin-table-card">

        <div class="table-header">

            <h3>
                Recent Exams
            </h3>
        </div>

        <table class="admin-table">

            <thead>

                <tr>

                    <th>Exam</th>
                    <th>Course</th>
                    <th>Students</th>
                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>MS Office Monthly</td>
                    <td>MS Office</td>
                    <td>120</td>
                    <td>
                        <span class="status active-status">
                            Active
                        </span>
                    </td>

                </tr>

                <tr>

                    <td>Web Designing Final</td>
                    <td>Web Designing</td>
                    <td>85</td>
                    <td>
                        <span class="status pending-status">
                            Pending
                        </span>
                    </td>

                </tr>

                <tr>

                    <td>Graphic Design Quiz</td>
                    <td>Graphic Design</td>
                    <td>65</td>
                    <td>
                        <span class="status completed-status">
                            Completed
                        </span>
                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\mtech_exam\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>