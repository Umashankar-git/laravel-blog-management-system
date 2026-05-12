/**
 * BlogHub — AJAX Filter System (jQuery)
 * Handles category + date filtering with skeleton loaders and URL state
 * Filters trigger INSTANTLY on dropdown change — no manual button needed.
 */
$(document).ready(function () {
    const $grid = $('#blog-grid');
    const $pagination = $('#pagination-wrapper');
    const $resultsInfo = $('#results-info');
    const filterUrl = '/api/blogs/filter';

    // ─── Instant Filter on Dropdown Change ─────────────────────
    $('#filter-category, #filter-month, #filter-year').on('change', function () {
        fetchBlogs(1);
    });

    // ─── Apply Filter Button (kept as secondary trigger) ──────
    $('#btn-apply-filter').on('click', function () {
        fetchBlogs(1);
    });

    // ─── Clear Filters ─────────────────────────────────────────
    $('#btn-clear-filter').on('click', function () {
        $('#filter-category').val('');
        $('#filter-month').val('');
        $('#filter-year').val('');
        fetchBlogs(1);
        // Reset URL
        window.history.pushState({}, '', window.location.pathname);
    });

    // ─── Pagination Click ──────────────────────────────────────
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const page = $(this).attr('href').split('page=')[1];
        fetchBlogs(page);
        // Scroll to filter bar
        $('html, body').animate({
            scrollTop: $('#filter-bar').offset().top - 100
        }, 400);
    });

    // ─── Fetch Blogs via AJAX ──────────────────────────────────
    function fetchBlogs(page) {
        const params = {
            category: $('#filter-category').val(),
            month: $('#filter-month').val(),
            year: $('#filter-year').val(),
            page: page || 1
        };

        // Update URL with query params
        const queryString = $.param(params);
        window.history.pushState({}, '', '?' + queryString);

        // Show skeleton loaders
        showSkeletons();

        $.ajax({
            url: filterUrl,
            type: 'GET',
            data: params,
            dataType: 'json',
            success: function (response) {
                // Fade out skeletons, then insert real content
                $grid.css('opacity', 0);

                setTimeout(function () {
                    if (response.html.trim() === '') {
                        $grid.html(`
                            <div class="empty-state">
                                <div class="empty-state-icon"><i class="fas fa-search"></i></div>
                                <h3>No articles found</h3>
                                <p>Try adjusting your filters or check back later.</p>
                            </div>
                        `);
                    } else {
                        $grid.html(response.html);
                    }

                    // Update pagination
                    $pagination.html(response.pagination || '');

                    // Update results count
                    $resultsInfo.html(
                        '<i class="fas fa-file-alt"></i> ' +
                        '<span>Showing <strong>' + response.total + '</strong> articles</span>'
                    );

                    // Fade in
                    $grid.animate({ opacity: 1 }, 300);
                }, 250);
            },
            error: function () {
                $grid.html(`
                    <div class="empty-state">
                        <div class="empty-state-icon"><i class="fas fa-exclamation-triangle"></i></div>
                        <h3>Something went wrong</h3>
                        <p>Please try again later.</p>
                    </div>
                `);
                $grid.css('opacity', 1);
            }
        });
    }

    // ─── Skeleton Loader ───────────────────────────────────────
    function showSkeletons() {
        let skeletonHtml = '';
        for (let i = 0; i < 6; i++) {
            skeletonHtml += `
                <div class="skeleton-card">
                    <div class="skeleton-image"></div>
                    <div class="skeleton-body">
                        <div class="skeleton-line short"></div>
                        <div class="skeleton-line title"></div>
                        <div class="skeleton-line"></div>
                        <div class="skeleton-line"></div>
                        <div class="skeleton-line short"></div>
                    </div>
                </div>
            `;
        }
        $grid.html(skeletonHtml);
        $grid.css('opacity', 1);
    }

    // ─── Restore Filters from URL on Load ──────────────────────
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('category')) $('#filter-category').val(urlParams.get('category'));
    if (urlParams.has('month')) $('#filter-month').val(urlParams.get('month'));
    if (urlParams.has('year')) $('#filter-year').val(urlParams.get('year'));

    // If filters were in URL, apply them
    if (urlParams.has('category') || urlParams.has('month') || urlParams.has('year')) {
        fetchBlogs(urlParams.get('page') || 1);
    }
});
