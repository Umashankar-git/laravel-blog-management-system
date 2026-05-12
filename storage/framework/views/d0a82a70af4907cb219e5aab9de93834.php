<?php $__env->startSection('title', 'Edit Post — BlogHub Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1 class="page-title">Edit Post</h1>
    <a href="<?php echo e(route('admin.blogs.index')); ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div class="form-card">
    <form action="<?php echo e(route('admin.blogs.update', $blog)); ?>" method="POST" enctype="multipart/form-data" id="blog-form">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label class="form-label" for="title">Title *</label>
            <input type="text" id="title" name="title" class="form-control"
                   value="<?php echo e(old('title', $blog->title)); ?>" required>
            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="form-error"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label class="form-label">Featured Image</label>
            <?php if($blog->image): ?>
                <div style="margin-bottom:12px;">
                    <img src="<?php echo e(asset('uploads/' . $blog->image)); ?>" alt="Current"
                         style="max-height:150px;border-radius:var(--radius-sm);border:1px solid var(--border-color);">
                    <p class="form-hint">Current image — upload a new one to replace it</p>
                </div>
            <?php endif; ?>
            <div class="image-upload-area" id="upload-area">
                <i class="fas fa-cloud-upload-alt"></i>
                <p><?php echo e($blog->image ? 'Upload new image to replace' : 'Drag & drop or click to browse'); ?></p>
                <input type="file" name="image" id="image-input" accept="image/*">
            </div>
            <img id="image-preview" class="image-preview" alt="Preview">
            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="form-error"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
            <div class="form-group">
                <label class="form-label" for="category">Category *</label>
                <select id="category" name="category" class="form-control" required>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat); ?>" <?php echo e(old('category', $blog->category) == $cat ? 'selected' : ''); ?>><?php echo e($cat); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="form-error"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label class="form-label" for="date">Date *</label>
                <input type="date" id="date" name="date" class="form-control"
                       value="<?php echo e(old('date', $blog->date->format('Y-m-d'))); ?>" required>
                <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="form-error"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="content">Content *</label>
            <textarea id="content" name="content" class="form-control"><?php echo e(old('content', $blog->content)); ?></textarea>
            <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="form-error"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div style="display:flex;gap:12px;padding-top:8px;">
            <button type="submit" class="btn btn-primary" id="submit-btn">
                <i class="fas fa-save"></i> Update Post
            </button>
            <a href="<?php echo e(route('admin.blogs.index')); ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
// ─── TinyMCE Initialization ─────────────────────────────────
tinymce.init({
    selector: '#content',
    height: 420,
    menubar: true,
    skin: 'oxide',
    content_css: 'default',
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'help', 'wordcount'
    ],
    toolbar: 'undo redo | blocks | ' +
        'bold italic underline strikethrough | subscript superscript | ' +
        'alignleft aligncenter alignright alignjustify | ' +
        'bullist numlist outdent indent | ' +
        'link image media table | ' +
        'fullscreen code | removeformat help',
    block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Blockquote=blockquote; Preformatted=pre',
    content_style: "body { font-family: 'Inter', system-ui, sans-serif; font-size: 16px; line-height: 1.75; color: #3d4250; }",
    branding: false,
    promotion: false,
    setup: function (editor) {
        // Sync content to textarea on every change
        editor.on('change', function () {
            tinymce.triggerSave();
        });
    }
});

// Also sync on form submit as a safety net
document.getElementById('blog-form').addEventListener('submit', function () {
    tinymce.triggerSave();
});

// Image preview
document.getElementById('image-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            const preview = document.getElementById('image-preview');
            preview.src = ev.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Blog project\resources\views/admin/blogs/edit.blade.php ENDPATH**/ ?>