<?php $__env->startSection('title', 'Blog — Explore Articles | BlogHub'); ?>
<?php $__env->startSection('meta_description', 'Browse our latest articles on technology, lifestyle, travel, food, health, and more. Filter by category or date.'); ?>
<?php $__env->startSection('og_title', 'BlogHub — Explore Articles'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero -->
<header class="hero">
    <div class="hero-content container">
        <h1>Explore Our Articles</h1>
        <p>Thoughtful writing on technology, lifestyle, travel, and more. Find what inspires you.</p>
    </div>
</header>

<!-- Filters -->
<section class="filter-section" aria-label="Filter articles">
    <div class="container">
        <div class="filter-bar" id="filter-bar">
            <div class="filter-group">
                <label for="filter-category">Category</label>
                <select class="filter-select" id="filter-category" name="category">
                    <option value="">All Categories</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat); ?>"><?php echo e($cat); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="filter-group">
                <label for="filter-month">Month</label>
                <select class="filter-select" id="filter-month" name="month">
                    <option value="">All Months</option>
                    <?php $__currentLoopData = range(1, 12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($m); ?>"><?php echo e(\Carbon\Carbon::create()->month($m)->format('F')); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="filter-group">
                <label for="filter-year">Year</label>
                <select class="filter-select" id="filter-year" name="year">
                    <option value="">All Years</option>
                    <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($y); ?>"><?php echo e($y); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div style="display:flex;gap:8px;">
                <button class="filter-btn btn-filter" id="btn-apply-filter" type="button">
                    <i class="fas fa-search" aria-hidden="true"></i> Filter
                </button>
                <button class="filter-btn btn-clear" id="btn-clear-filter" type="button">
                    Clear
                </button>
            </div>
        </div>
        <div class="results-info" id="results-info" aria-live="polite">
            <span>Showing <strong><?php echo e($blogs->total()); ?></strong> articles</span>
        </div>
    </div>
</section>

<!-- Blog Grid -->
<section class="blog-section" aria-label="Blog articles">
    <div class="container">
        <div class="blog-grid" id="blog-grid">
            <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php echo $__env->make('blogs._card', ['blog' => $blog], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="empty-state">
                    <div class="empty-state-icon"><i class="fas fa-newspaper" aria-hidden="true"></i></div>
                    <h3>No articles found</h3>
                    <p>Try adjusting your filters or check back later.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="pagination-wrapper" id="pagination-wrapper" aria-label="Pagination">
            <?php echo e($blogs->links('vendor.pagination.custom')); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/filters.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Blog project\resources\views/blogs/index.blade.php ENDPATH**/ ?>