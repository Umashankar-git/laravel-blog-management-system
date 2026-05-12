{{-- Blog Card Partial — semantic <article> element --}}
<article class="blog-card">
    <a href="{{ route('blogs.show', $blog->slug) }}" class="card-image" aria-label="Read {{ $blog->title }}">
        <img src="{{ $blog->image ? asset('uploads/' . $blog->image) : 'https://picsum.photos/seed/' . $blog->id . '/800/420' }}"
             alt="{{ $blog->title }}"
             loading="lazy"
             onerror="this.onerror=null;this.src='https://picsum.photos/seed/fallback{{ $blog->id }}/800/420';">
        <span class="card-category-badge">{{ $blog->category }}</span>
    </a>
    <div class="card-body">
        <div class="card-meta">
            <time datetime="{{ $blog->date->format('Y-m-d') }}">
                <i class="fas fa-calendar-day" aria-hidden="true"></i> {{ $blog->date->format('M d, Y') }}
            </time>
            <span><i class="fas fa-clock" aria-hidden="true"></i> {{ $blog->reading_time }} min read</span>
        </div>
        <h2 class="card-title">
            <a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->title }}</a>
        </h2>
        <p class="card-excerpt">{{ $blog->excerpt }}</p>
        <div class="card-footer">
            <a href="{{ route('blogs.show', $blog->slug) }}" class="read-more">
                Read More <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
            <span class="card-reading-time">{{ $blog->reading_time }} min</span>
        </div>
    </div>
</article>
