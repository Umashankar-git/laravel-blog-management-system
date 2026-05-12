<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Admin — BlogHub'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-logo">
                    <i class="fas fa-feather-alt"></i>
                    <span>Blog<span class="accent">Hub</span></span>
                </a>
                <button class="sidebar-close" id="sidebar-close"><i class="fas fa-times"></i></button>
            </div>
            <nav class="sidebar-nav">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="<?php echo e(route('admin.blogs.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.blogs.*') ? 'active' : ''); ?>">
                    <i class="fas fa-newspaper"></i> All Posts
                </a>
                <a href="<?php echo e(route('admin.blogs.create')); ?>" class="sidebar-link">
                    <i class="fas fa-plus-circle"></i> Create Post
                </a>
                <div class="sidebar-divider"></div>
                <a href="<?php echo e(route('blogs.index')); ?>" class="sidebar-link" target="_blank">
                    <i class="fas fa-external-link-alt"></i> View Site
                </a>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="sidebar-link sidebar-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main -->
        <div class="admin-main">
            <header class="admin-topbar">
                <button class="topbar-toggle" id="sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="topbar-right">
                    <span class="topbar-user"><i class="fas fa-user-circle"></i> <?php echo e(Auth::user()->name); ?></span>
                </div>
            </header>
            <div class="admin-content">
                <?php if(session('success')): ?>
                    <div class="alert alert-success" id="alert-success">
                        <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

                        <button class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
                    </div>
                <?php endif; ?>
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('open');
        });
        document.getElementById('sidebar-close').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('open');
        });
        // Auto-hide alert
        const alert = document.getElementById('alert-success');
        if (alert) setTimeout(() => { alert.style.opacity = '0'; setTimeout(() => alert.remove(), 300); }, 4000);
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Blog project\resources\views/layouts/admin.blade.php ENDPATH**/ ?>