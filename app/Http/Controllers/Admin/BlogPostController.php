<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\ActivityLog;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogPostController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    public function index()
    {
        $posts = BlogPost::with(['category', 'author'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        $categories = BlogCategory::active()->get();
        return view('admin.blog-posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = BlogCategory::active()->get();
        return view('admin.blog-posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug',
            'category_id' => 'nullable|exists:blog_categories,id',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['author_id'] = auth()->id();

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $post = BlogPost::create($validated);
        
        // Clear blog caches
        Cache::forget('blog.categories');
        Cache::forget('home.latest_posts');
        
        ActivityLog::log('created', "Created blog post: {$post->title}", BlogPost::class, $post->id);

        return redirect()->route('admin.blog-posts.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $blogPost)
    {
        $categories = BlogCategory::active()->get();
        $post = $blogPost;
        return view('admin.blog-posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug,' . $blogPost->id,
            'category_id' => 'nullable|exists:blog_categories,id',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($blogPost->featured_image) {
                $this->imageService->deleteImage($blogPost->featured_image);
            }
            
            $result = $this->imageService->uploadAndOptimize(
                $request->file('featured_image'),
                'blog',
                ['max_width' => 1200, 'thumbnail' => false]
            );
            $validated['featured_image'] = $result['path'];
        }

        $blogPost->update($validated);
        
        // Clear blog caches
        Cache::forget('blog.categories');
        Cache::forget('home.latest_posts');
        
        ActivityLog::log('updated', "Updated blog post: {$blogPost->title}", BlogPost::class, $blogPost->id);

        return redirect()->route('admin.blog-posts.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blogPost)
    {
        $title = $blogPost->title;
        $blogPost->delete();
        
        // Clear blog caches
        Cache::forget('blog.categories');
        Cache::forget('home.latest_posts');
        
        ActivityLog::log('deleted', "Deleted blog post: {$title}", BlogPost::class, $blogPost->id);

        return redirect()->route('admin.blog-posts.index')
            ->with('success', 'Blog post deleted successfully.');
    }

    public function publish($id)
    {
        $post = BlogPost::findOrFail($id);
        $post->update([
            'is_published' => true,
            'published_at' => now(),
        ]);
        
        ActivityLog::log('published', "Published blog post: {$post->title}", BlogPost::class, $post->id);

        return back()->with('success', 'Blog post published successfully.');
    }

    public function unpublish($id)
    {
        $post = BlogPost::findOrFail($id);
        $post->update(['is_published' => false]);
        
        ActivityLog::log('unpublished', "Unpublished blog post: {$post->title}", BlogPost::class, $post->id);

        return back()->with('success', 'Blog post unpublished successfully.');
    }
}
