@extends('layouts.app')

@section('title', $blog->title . ' — BlogHub')
@section('meta_description', $blog->excerpt)
@section('og_title', $blog->title)
@section('og_type', 'article')
@section('og_image', $blog->image ? asset('uploads/' . $blog->image) : 'https://picsum.photos/seed/' . $blog->id . '/1200/600')

@section('content')
<!-- Hero Image -->
<header class="blog-detail-hero">
    <img src="{{ $blog->image ? asset('uploads/' . $blog->image) : 'https://picsum.photos/seed/' . $blog->id . '/1200/600' }}"
         alt="{{ $blog->title }}"
         onerror="this.onerror=null;this.src='https://picsum.photos/seed/fallback{{ $blog->id }}/1200/600';">
    <div class="blog-detail-hero-content">
        <span class="blog-detail-category">{{ $blog->category }}</span>
        <h1 class="blog-detail-title">{{ $blog->title }}</h1>
        <div class="blog-detail-meta">
            <time datetime="{{ $blog->date->format('Y-m-d') }}">
                <i class="fas fa-calendar-day" aria-hidden="true"></i> {{ $blog->date->format('F d, Y') }}
            </time>
            <span><i class="fas fa-clock" aria-hidden="true"></i> {{ $blog->reading_time }} min read</span>
        </div>
    </div>
</header>

<!-- Article Content -->
<article class="blog-detail-content">
    <a href="{{ route('blogs.index') }}" class="back-link">
        <i class="fas fa-arrow-left" aria-hidden="true"></i> Back to Articles
    </a>

    <div class="article-body">
        {!! $blog->content !!}
    </div>
</article>

<!-- Related Posts -->
@if($relatedPosts->count() > 0)
<section class="related-section" aria-label="Related articles">
    <div class="container">
        <h2 class="section-title">More in <span>{{ $blog->category }}</span></h2>
        <div class="blog-grid">
            @foreach($relatedPosts as $related)
                @include('blogs._card', ['blog' => $related])
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
