@extends('layouts.admin')
@section('title', 'Edit Post — BlogHub Admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Post</h1>
    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div class="form-card">
    <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" id="blog-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label" for="title">Title *</label>
            <input type="text" id="title" name="title" class="form-control"
                   value="{{ old('title', $blog->title) }}" required>
            @error('title') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Featured Image</label>
            @if($blog->image)
                <div style="margin-bottom:12px;">
                    <img src="{{ asset('uploads/' . $blog->image) }}" alt="Current"
                         style="max-height:150px;border-radius:var(--radius-sm);border:1px solid var(--border-color);">
                    <p class="form-hint">Current image — upload a new one to replace it</p>
                </div>
            @endif
            <div class="image-upload-area" id="upload-area">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>{{ $blog->image ? 'Upload new image to replace' : 'Drag & drop or click to browse' }}</p>
                <input type="file" name="image" id="image-input" accept="image/*">
            </div>
            <img id="image-preview" class="image-preview" alt="Preview">
            @error('image') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
            <div class="form-group">
                <label class="form-label" for="category">Category *</label>
                <select id="category" name="category" class="form-control" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category', $blog->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="date">Date *</label>
                <input type="date" id="date" name="date" class="form-control"
                       value="{{ old('date', $blog->date->format('Y-m-d')) }}" required>
                @error('date') <p class="form-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="content">Content *</label>
            <textarea id="content" name="content" class="form-control">{{ old('content', $blog->content) }}</textarea>
            @error('content') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="display:flex;gap:12px;padding-top:8px;">
            <button type="submit" class="btn btn-primary" id="submit-btn">
                <i class="fas fa-save"></i> Update Post
            </button>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@endsection

@section('scripts')
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
@endsection
