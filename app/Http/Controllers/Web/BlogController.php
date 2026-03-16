<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // Cache blog categories for 1 hour
        $categories = Cache::remember('blog.categories', 3600, function () {
            return BlogCategory::active()->withCount('publishedPosts')->get();
        });
        
        $query = BlogPost::published()->latest();
        
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }
        
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }
        
        $posts = $query->paginate(9);
        
        return view('web.blog.index', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)->published()->firstOrFail();
        $post->incrementViews();
        
        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->latest()
            ->take(3)
            ->get();
        
        return view('web.blog.show', compact('post', 'relatedPosts'));
    }
}
