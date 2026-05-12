<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $categories = ['Technology', 'Lifestyle', 'Travel', 'Food', 'Health', 'Business', 'Education', 'Sports'];

        $titles = [
            'Technology' => [
                'The Future of Artificial Intelligence in Everyday Life',
                'Building Scalable Web Applications with Modern Frameworks',
                'Cybersecurity Best Practices for Small Businesses',
                'The Rise of Quantum Computing: What You Need to Know',
                'How 5G is Transforming the Digital Landscape',
            ],
            'Lifestyle' => [
                'Minimalist Living: A Guide to Decluttering Your Life',
                '10 Morning Habits That Will Change Your Day',
                'The Art of Mindful Living in a Digital Age',
                'Creating Your Perfect Work-From-Home Setup',
                'Finding Balance: Work, Life, and Everything Between',
            ],
            'Travel' => [
                'Hidden Gems: Unexplored Destinations in Southeast Asia',
                'A Complete Guide to Backpacking Through Europe',
                'Sustainable Travel: How to Reduce Your Carbon Footprint',
                'The Ultimate Road Trip Planning Checklist',
                'Top 10 Budget-Friendly Travel Destinations for 2026',
            ],
            'Food' => [
                'Farm-to-Table: The Revolution in Modern Dining',
                'Mastering the Art of Sourdough Bread Making',
                'Exploring Street Food Culture Around the World',
                'Plant-Based Cooking: Delicious Recipes for Beginners',
                'The Science Behind Perfect Coffee Brewing',
            ],
            'Health' => [
                'Understanding the Gut-Brain Connection',
                'A Beginners Guide to Meditation and Mindfulness',
                'The Benefits of High-Intensity Interval Training',
                'Sleep Hygiene: Tips for Better Rest Tonight',
                'Nutrition Myths Debunked by Science',
            ],
            'Business' => [
                'Startup Funding: A Complete Guide for Entrepreneurs',
                'Remote Team Management: Tools and Strategies',
                'The Power of Personal Branding in the Digital Age',
                'Understanding Blockchain Beyond Cryptocurrency',
                'Building a Sustainable Business Model for 2026',
            ],
            'Education' => [
                'The Future of Online Learning Platforms',
                'How Gamification is Changing Education',
                'Self-Directed Learning: A Roadmap to Success',
                'The Importance of Lifelong Learning in Tech',
                'Effective Study Techniques Backed by Research',
            ],
            'Sports' => [
                'The Evolution of Sports Analytics and Data Science',
                'Mental Health and Athletic Performance',
                'How Technology is Changing Professional Sports',
                'The Rise of Esports: A New Era of Competition',
                'Training Like a Pro: Home Workout Routines',
            ],
        ];

        $contentBlocks = [
            "<p>In today's rapidly evolving world, staying ahead of the curve requires constant adaptation and learning. This comprehensive guide explores the latest trends and provides actionable insights that you can implement immediately.</p>",
            "<h2>Understanding the Fundamentals</h2><p>Before diving into advanced concepts, it's crucial to establish a solid foundation. The fundamentals serve as building blocks that support more complex ideas and strategies.</p>",
            "<p>Research conducted by leading institutions has revealed fascinating insights into how these principles work in practice. The data suggests that early adopters tend to see significantly better outcomes compared to those who wait.</p>",
            "<h2>Practical Applications</h2><p>Theory without practice is incomplete. Here are some real-world applications that demonstrate the power of these concepts:</p><ul><li>Implementing structured daily routines for maximum productivity</li><li>Leveraging technology to automate repetitive tasks</li><li>Building meaningful connections through authentic engagement</li><li>Creating sustainable habits that compound over time</li></ul>",
            "<blockquote>\"The only way to do great work is to love what you do. If you haven't found it yet, keep looking. Don't settle.\" — Steve Jobs</blockquote>",
            "<h2>Looking Ahead</h2><p>As we move forward, the landscape continues to shift in exciting ways. Those who embrace change and remain curious will find themselves well-positioned for success. The key is to start small, stay consistent, and never stop learning.</p>",
            "<p>Whether you're a seasoned professional or just starting your journey, the principles outlined here provide a roadmap for growth. Remember, every expert was once a beginner — the important thing is to take that first step.</p>",
            "<h2>Key Takeaways</h2><ol><li>Start with a clear vision of where you want to go</li><li>Break down large goals into manageable daily actions</li><li>Seek feedback and iterate continuously</li><li>Surround yourself with people who inspire growth</li><li>Celebrate small wins along the way</li></ol>",
        ];

        $category = $this->faker->randomElement($categories);
        $title = $this->faker->randomElement($titles[$category]);

        // Build rich content from blocks
        $numBlocks = $this->faker->numberBetween(4, 7);
        $selectedBlocks = $this->faker->randomElements($contentBlocks, $numBlocks);
        $content = implode("\n\n", $selectedBlocks);

        return [
            'title'    => $title,
            'slug'     => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1, 9999),
            'image'    => null,
            'content'  => $content,
            'category' => $category,
            'date'     => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
        ];
    }
}
