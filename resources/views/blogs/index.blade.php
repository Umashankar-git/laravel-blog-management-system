@extends('layouts.app')

@section('title', 'Blog — Explore Articles | BlogHub')
@section('meta_description', 'Browse our latest articles on technology, lifestyle, travel, food, health, and more. Filter by category or date.')
@section('og_title', 'BlogHub — Explore Articles')

@section('content')
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
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label for="filter-month">Month</label>
                <select class="filter-select" id="filter-month" name="month">
                    <option value="">All Months</option>
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label for="filter-year">Year</label>
                <select class="filter-select" id="filter-year" name="year">
                    <option value="">All Years</option>
                    @foreach($years as $y)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endforeach
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
            <span>Showing <strong>{{ $blogs->total() }}</strong> articles</span>
        </div>
    </div>
</section>

<!-- Blog Grid -->
<section class="blog-section" aria-label="Blog articles">
    <div class="container">
        <div class="blog-grid" id="blog-grid">
            @forelse($blogs as $blog)
                @include('blogs._card', ['blog' => $blog])
            @empty
                <div class="empty-state">
                    <div class="empty-state-icon"><i class="fas fa-newspaper" aria-hidden="true"></i></div>
                    <h3>No articles found</h3>
                    <p>Try adjusting your filters or check back later.</p>
                </div>
            @endforelse
        </div>

        <div class="pagination-wrapper" id="pagination-wrapper" aria-label="Pagination">
            {{ $blogs->links() }}
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/filters.js') }}"></script>
@endsection
