<?php $__env->startSection('title', 'Dashboard — BlogHub Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <a href="<?php echo e(route('admin.blogs.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> New Post
    </a>
</div>

<!-- Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-newspaper"></i></div>
        <div>
            <div class="stat-value"><?php echo e($totalPosts); ?></div>
            <div class="stat-label">Total Posts</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-layer-group"></i></div>
        <div>
            <div class="stat-value"><?php echo e($totalCategories); ?></div>
            <div class="stat-label">Categories</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-calendar-check"></i></div>
        <div>
            <div class="stat-value"><?php echo e($thisMonthPosts); ?></div>
            <div class="stat-label">This Month</div>
        </div>
    </div>
</div>

<!-- Recent Posts -->
<div class="table-wrapper">
    <div class="search-bar" style="border-bottom:1px solid var(--border-color);">
        <h3 style="font-size:1rem;font-weight:700;">Recent Posts</h3>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $recentPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="post-title"><?php echo e(Str::limit($post->title, 50)); ?></td>
                <td><span class="category-pill"><?php echo e($post->category); ?></span></td>
                <td style="color:var(--text-muted);"><?php echo e($post->date->format('M d, Y')); ?></td>
                <td>
                    <div class="actions">
                        <a href="<?php echo e(route('admin.blogs.edit', $post)); ?>" class="btn btn-sm btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?php echo e(route('blogs.show', $post->slug)); ?>" class="btn btn-sm btn-secondary" target="_blank">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Blog project\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>