<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — BlogHub Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
</head>
<body>
    <div class="login-page">
        <div class="login-card">
            <div class="login-logo">
                <i class="fas fa-feather-alt"></i> Blog<span class="accent">Hub</span>
            </div>
            <p class="login-subtitle">Sign in to access the admin panel</p>

            <?php if($errors->any()): ?>
                <div class="login-error">
                    <i class="fas fa-exclamation-circle"></i> <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control"
                           value="<?php echo e(old('email')); ?>" placeholder="admin@blog.com" required autofocus>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="••••••••" required>
                </div>
                <div class="remember-group">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary btn-login">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </button>
            </form>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Blog project\resources\views/auth/login.blade.php ENDPATH**/ ?>