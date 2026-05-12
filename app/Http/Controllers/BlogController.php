<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    /**
     * Display the blog listing page.
     */
    public function index()
    {
        $categories = Blog::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $years = Blog::selectRaw('YEAR(date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $blogs = Blog::orderBy('date', 'desc')->paginate(9);

        return view('blogs.index', compact('blogs', 'categories', 'years'));
    }

    /**
     * AJAX endpoint: return filtered & paginated blog posts as JSON.
     */
    public function filter(Request $request): JsonResponse
    {
        $query = Blog::query();

        // Apply filters
        if ($request->filled('category')) {
            $query->filterCategory($request->category);
        }

        if ($request->filled('month')) {
            $query->filterMonth($request->month);
        }

        if ($request->filled('year')) {
            $query->filterYear($request->year);
        }

        $blogs = $query->orderBy('date', 'desc')->paginate(9);

        // Build HTML for the blog cards
        $html = '';
        foreach ($blogs as $blog) {
            $html .= view('blogs._card', compact('blog'))->render();
        }

        // Build pagination HTML
        $pagination = $blogs->appends($request->query())->links('vendor.pagination.custom')->render();

        return response()->json([
            'html'         => $html,
            'pagination'   => $pagination,
            'total'        => $blogs->total(),
            'current_page' => $blogs->currentPage(),
            'last_page'    => $blogs->lastPage(),
        ]);
    }

    /**
     * Display a single blog post by slug.
     */
    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        // Get related posts from the same category (excluding current)
        $relatedPosts = Blog::where('category', $blog->category)
            ->where('id', '!=', $blog->id)
            ->orderBy('date', 'desc')
            ->limit(3)
            ->get();

        return view('blogs.show', compact('blog', 'relatedPosts'));
    }
}
