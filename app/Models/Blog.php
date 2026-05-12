<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'category',
        'date',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Boot the model and auto-generate slug from title.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);

                // Ensure uniqueness
                $originalSlug = $blog->slug;
                $count = 1;
                while (static::where('slug', $blog->slug)->exists()) {
                    $blog->slug = $originalSlug . '-' . $count++;
                }
            }
        });

        static::updating(function ($blog) {
            if ($blog->isDirty('title')) {
                $blog->slug = Str::slug($blog->title);

                $originalSlug = $blog->slug;
                $count = 1;
                while (static::where('slug', $blog->slug)->where('id', '!=', $blog->id)->exists()) {
                    $blog->slug = $originalSlug . '-' . $count++;
                }
            }
        });
    }

    /**
     * Get a short excerpt from the content.
     */
    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->content), 150);
    }

    /**
     * Get estimated reading time in minutes.
     */
    public function getReadingTimeAttribute(): int
    {
        $wordCount = str_word_count(strip_tags($this->content));
        return max(1, (int) ceil($wordCount / 200));
    }

    /**
     * Get the image URL or a placeholder.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image && file_exists(public_path('uploads/' . $this->image))) {
            return asset('uploads/' . $this->image);
        }

        // Generate a gradient placeholder based on category
        $colors = [
            'Technology' => '6366f1,8b5cf6',
            'Lifestyle'  => 'ec4899,f43f5e',
            'Travel'     => '06b6d4,0ea5e9',
            'Food'       => 'f59e0b,f97316',
            'Health'     => '10b981,14b8a6',
            'Business'   => '6366f1,3b82f6',
            'Education'  => '8b5cf6,a855f7',
            'Sports'     => 'ef4444,f97316',
        ];

        $color = $colors[$this->category] ?? '6366f1,8b5cf6';
        return "https://via.placeholder.com/800x400/{$color}?text=" . urlencode($this->category);
    }

    /**
     * Scope: filter by category.
     */
    public function scopeFilterCategory($query, $category)
    {
        if ($category) {
            return $query->where('category', $category);
        }
        return $query;
    }

    /**
     * Scope: filter by month.
     */
    public function scopeFilterMonth($query, $month)
    {
        if ($month) {
            return $query->whereMonth('date', $month);
        }
        return $query;
    }

    /**
     * Scope: filter by year.
     */
    public function scopeFilterYear($query, $year)
    {
        if ($year) {
            return $query->whereYear('date', $year);
        }
        return $query;
    }
}
