@extends('layouts.admin')
@section('title', 'All Posts — BlogHub Admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">All Posts</h1>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> New Post
    </a>
</div>

<div class="table-wrapper">
    <div class="search-bar">
        <form action="{{ route('admin.blogs.index') }}" method="GET" style="display:flex;gap:12px;width:100%;">
            <input type="text" name="search" class="search-input"
                   placeholder="Search by title or category..."
                   value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($blogs as $blog)
            <tr>
                <td>
                    <img src="{{ $blog->image ? asset('uploads/' . $blog->image) : 'https://picsum.photos/seed/' . $blog->id . '/100/100' }}"
                         alt="" class="post-image"
                         onerror="this.onerror=null;this.src='https://picsum.photos/seed/fallback{{ $blog->id }}/100/100';">
                </td>
                <td class="post-title">{{ Str::limit($blog->title, 50) }}</td>
                <td><span class="category-pill">{{ $blog->category }}</span></td>
                <td style="color:var(--text-muted);white-space:nowrap;">{{ $blog->date->format('M d, Y') }}</td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-sm btn-secondary" target="_blank" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button class="btn btn-sm btn-danger" title="Delete"
                                onclick="openDeleteModal('{{ $blog->id }}', '{{ addslashes($blog->title) }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted);">
                    No posts found. <a href="{{ route('admin.blogs.create') }}" style="color:var(--accent-purple);">Create one →</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div style="display:flex;justify-content:center;padding:24px 0;">
    {{ $blogs->appends(request()->query())->links('vendor.pagination.custom') }}
</div>

<!-- Delete Confirmation Modal -->
<div class="modal-overlay" id="delete-modal">
    <div class="modal-box">
        <div class="modal-icon"><i class="fas fa-exclamation-triangle"></i></div>
        <h3>Delete Post</h3>
        <p>Are you sure you want to delete "<span id="delete-title"></span>"? This cannot be undone.</p>
        <div class="modal-actions">
            <button class="btn btn-secondary" onclick="closeDeleteModal()">Cancel</button>
            <form id="delete-form" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
            </form>
        </div>
    </div>
</div>

<script>
function openDeleteModal(id, title) {
    document.getElementById('delete-title').textContent = title;
    document.getElementById('delete-form').action = '/admin/blogs/' + id;
    document.getElementById('delete-modal').classList.add('active');
}
function closeDeleteModal() {
    document.getElementById('delete-modal').classList.remove('active');
}
document.getElementById('delete-modal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});
</script>
@endsection
