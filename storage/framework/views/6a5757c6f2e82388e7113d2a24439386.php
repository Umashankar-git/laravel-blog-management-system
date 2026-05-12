<?php $__env->startSection('title', $blog->title . ' — BlogHub'); ?>
<?php $__env->startSection('meta_description', $blog->excerpt); ?>
<?php $__env->startSection('og_title', $blog->title); ?>
<?php $__env->startSection('og_type', 'article'); ?>
<?php if($blog->image): ?>
    <?php $__env->startSection('og_image', asset('uploads/' . $blog->image)); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Image -->
<header class="blog-detail-hero">
    <?php if($blog->image): ?>
        <img src="<?php echo e(asset('uploads/' . $blog->image)); ?>" alt="<?php echo e($blog->title); ?>">
    <?php else: ?>
        <div style="position:absolute;inset:0;background:var(--bg-subtle);"></div>
    <?php endif; ?>
    <div class="blog-detail-hero-content">
        <span class="blog-detail-category"><?php echo e($blog->category); ?></span>
        <h1 class="blog-detail-title"><?php echo e($blog->title); ?></h1>
        <div class="blog-detail-meta">
            <time datetime="<?php echo e($blog->date->format('Y-m-d')); ?>">
                <i class="fas fa-calendar-day" aria-hidden="true"></i> <?php echo e($blog->date->format('F d, Y')); ?>

            </time>
            <span><i class="fas fa-clock" aria-hidden="true"></i> <?php echo e($blog->reading_time); ?> min read</span>
        </div>
    </div>
</header>

<!-- Article Content -->
<article class="blog-detail-content">
    <a href="<?php echo e(route('blogs.index')); ?>" class="back-link">
        <i class="fas fa-arrow-left" aria-hidden="true"></i> Back to Articles
    </a>

    <div class="article-body">
        <?php echo $blog->content; ?>

    </div>
</article>

<!-- Related Posts -->
<?php if($relatedPosts->count() > 0): ?>
<section class="related-section" aria-label="Related articles">
    <div class="container">
        <h2 class="section-title">More in <span><?php echo e($blog->category); ?></span></h2>
        <div class="blog-grid">
            <?php $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('blogs._card', ['blog' => $related], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Blog project\resources\views/blogs/show.blade.php ENDPATH**/ ?>