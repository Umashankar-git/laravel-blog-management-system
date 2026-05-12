@extends('layouts.admin')
@section('title', 'Create Post — BlogHub Admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">Create New Post</h1>
    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div class="form-card">
    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="form-label" for="title">Title *</label>
            <input type="text" id="title" name="title" class="form-control"
                   value="{{ old('title') }}" placeholder="Enter blog title..." required>
            @error('title') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Featured Image</label>
            <div class="image-upload-area" id="upload-area">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Drag & drop an image or click to browse</p>
                <p style="font-size:0.78rem;color:var(--text-muted);margin-top:4px;">JPEG, PNG, WebP — Max 2MB</p>
                <input type="file" name="image" id="image-input" accept="image/*">
            </div>
            <img id="image-preview" class="image-preview" alt="Preview">
            @error('image') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
            <div class="form-group">
                <label class="form-label" for="category">Category *</label>
                <select id="category" name="category" class="form-control" required>
                    <option value="">Select category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="date">Date *</label>
                <input type="date" id="date" name="date" class="form-control"
                       value="{{ old('date', date('Y-m-d')) }}" required>
                @error('date') <p class="form-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="content">Content *</label>
            <textarea id="content" name="content" class="form-control"
                      placeholder="Write your blog content here... (HTML supported)" required>{{ old('content') }}</textarea>
            <p class="form-hint">You can use HTML tags for formatting (h2, p, ul, blockquote, etc.)</p>
            @error('content') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="display:flex;gap:12px;padding-top:8px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Publish Post
            </button>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
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
