<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- SEO Meta -->
    <title><?php echo $__env->yieldContent('title', 'BlogHub — Insightful Articles on Tech, Lifestyle & More'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Discover thoughtful articles on technology, lifestyle, travel, food, health, and more. Written for curious minds.'); ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo $__env->yieldContent('og_title', 'BlogHub'); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('meta_description', 'Discover thoughtful articles on technology, lifestyle, travel, food, health, and more.'); ?>">
    <meta property="og:type" content="<?php echo $__env->yieldContent('og_type', 'website'); ?>">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <?php if (! empty(trim($__env->yieldContent('og_image')))): ?>
        <meta property="og:image" content="<?php echo $__env->yieldContent('og_image'); ?>">
    <?php endif; ?>

    <!-- Google Fonts — Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome (minimal icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">

    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <!-- ─── Navigation ─────────────────────────────────────── -->
    <nav class="navbar" id="main-navbar" aria-label="Main navigation">
        <div class="container navbar-inner">
            <a href="<?php echo e(route('blogs.index')); ?>" class="navbar-brand" aria-label="BlogHub Home">
                <span class="brand-icon"><i class="fas fa-feather-alt" aria-hidden="true"></i></span>
                <span class="brand-text">Blog<span class="brand-accent">Hub</span></span>
            </a>

            <button class="navbar-toggle" id="navbar-toggle" aria-label="Toggle navigation" aria-expanded="false">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>

            <ul class="navbar-menu" id="navbar-menu" role="menubar">
                <li role="none"><a href="<?php echo e(route('blogs.index')); ?>" class="nav-link <?php echo e(request()->routeIs('blogs.index') ? 'active' : ''); ?>" role="menuitem">
                    Blog
                </a></li>
                <?php if(auth()->guard()->check()): ?>
                    <li role="none"><a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link" role="menuitem">
                        Dashboard
                    </a></li>
                    <li role="none">
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="nav-form">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="nav-link nav-btn" role="menuitem">
                                Logout
                            </button>
                        </form>
                    </li>
                <?php else: ?>
                    <li role="none"><a href="<?php echo e(route('login')); ?>" class="nav-link btn-nav-login" role="menuitem">
                        Admin
                    </a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- ─── Main Content ───────────────────────────────────── -->
    <main class="main-content" id="main-content">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- ─── Footer ─────────────────────────────────────────── -->
    <footer class="footer" role="contentinfo">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="<?php echo e(route('blogs.index')); ?>" class="footer-logo">
                        <i class="fas fa-feather-alt" aria-hidden="true"></i> Blog<span>Hub</span>
                    </a>
                    <p class="footer-desc">Thoughtful articles on technology, lifestyle, travel, and more. Stay curious.</p>
                </div>
                <nav class="footer-links" aria-label="Footer navigation">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="<?php echo e(route('blogs.index')); ?>">All Posts</a></li>
                        <li><a href="<?php echo e(route('login')); ?>">Admin Panel</a></li>
                    </ul>
                </nav>
                <div class="footer-social">
                    <h4>Connect</h4>
                    <div class="social-icons">
                        <a href="#" class="social-icon" aria-label="Twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                        <a href="#" class="social-icon" aria-label="GitHub"><i class="fab fa-github" aria-hidden="true"></i></a>
                        <a href="#" class="social-icon" aria-label="LinkedIn"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo e(date('Y')); ?> BlogHub. Built with Laravel.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile menu toggle -->
    <script>
        document.getElementById('navbar-toggle').addEventListener('click', function () {
            const menu = document.getElementById('navbar-menu');
            const expanded = this.getAttribute('aria-expanded') === 'true';
            menu.classList.toggle('open');
            this.classList.toggle('active');
            this.setAttribute('aria-expanded', !expanded);
        });
    </script>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Blog project\resources\views/layouts/app.blade.php ENDPATH**/ ?>