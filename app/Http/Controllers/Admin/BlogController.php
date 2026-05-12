<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Admin dashboard with blog statistics.
     */
    public function dashboard()
    {
        $totalPosts    = Blog::count();
        $totalCategories = Blog::select('category')->distinct()->count();
        $thisMonthPosts  = Blog::whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->count();
        $recentPosts = Blog::orderBy('date', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalPosts',
            'totalCategories',
            'thisMonthPosts',
            'recentPosts'
        ));
    }

    /**
     * Display a listing of all blogs in admin.
     */
    public function index(Request $request)
    {
        $query = Blog::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $blogs = $query->orderBy('date', 'desc')->paginate(10);

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new blog.
     */
    public function create()
    {
        $categories = ['Technology', 'Lifestyle', 'Travel', 'Food', 'Health', 'Business', 'Education', 'Sports'];
        return view('admin.blogs.create', compact('categories'));
    }

    /**
     * Store a newly created blog in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'category' => 'required|string|max:100',
            'date'     => 'required|date',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
        }

        Blog::create([
            'title'    => $validated['title'],
            'content'  => $validated['content'],
            'category' => $validated['category'],
            'date'     => $validated['date'],
            'image'    => $imageName,
        ]);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully!');
    }

    /**
     * Show the form for editing the specified blog.
     */
    public function edit(Blog $blog)
    {
        $categories = ['Technology', 'Lifestyle', 'Travel', 'Food', 'Health', 'Business', 'Education', 'Sports'];
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified blog in the database.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'category' => 'required|string|max:100',
            'date'     => 'required|date',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($blog->image && file_exists(public_path('uploads/' . $blog->image))) {
                unlink(public_path('uploads/' . $blog->image));
            }

            $imageName = time() . '_' . Str::slug($request->title) . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $blog->image = $imageName;
        }

        $blog->update([
            'title'    => $validated['title'],
            'content'  => $validated['content'],
            'category' => $validated['category'],
            'date'     => $validated['date'],
            'image'    => $blog->image,
        ]);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully!');
    }

    /**
     * Remove the specified blog from the database.
     */
    public function destroy(Blog $blog)
    {
        // Delete associated image
        if ($blog->image && file_exists(public_path('uploads/' . $blog->image))) {
            unlink(public_path('uploads/' . $blog->image));
        }

        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post deleted successfully!');
    }
}
