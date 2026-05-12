
<article class="blog-card">
    <a href="<?php echo e(route('blogs.show', $blog->slug)); ?>" class="card-image" aria-label="Read <?php echo e($blog->title); ?>">
        <img src="<?php echo e($blog->image ? asset('uploads/' . $blog->image) : 'https://picsum.photos/seed/' . $blog->id . '/800/420'); ?>"
             alt="<?php echo e($blog->title); ?>"
             loading="lazy"
             onerror="this.onerror=null;this.src='https://picsum.photos/seed/fallback<?php echo e($blog->id); ?>/800/420';">
        <span class="card-category-badge"><?php echo e($blog->category); ?></span>
    </a>
    <div class="card-body">
        <div class="card-meta">
            <time datetime="<?php echo e($blog->date->format('Y-m-d')); ?>">
                <i class="fas fa-calendar-day" aria-hidden="true"></i> <?php echo e($blog->date->format('M d, Y')); ?>

            </time>
            <span><i class="fas fa-clock" aria-hidden="true"></i> <?php echo e($blog->reading_time); ?> min read</span>
        </div>
        <h2 class="card-title">
            <a href="<?php echo e(route('blogs.show', $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
        </h2>
        <p class="card-excerpt"><?php echo e($blog->excerpt); ?></p>
        <div class="card-footer">
            <a href="<?php echo e(route('blogs.show', $blog->slug)); ?>" class="read-more">
                Read More <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
            <span class="card-reading-time"><?php echo e($blog->reading_time); ?> min</span>
        </div>
    </div>
</article>
<?php /**PATH C:\Blog project\resources\views/blogs/_card.blade.php ENDPATH**/ ?>