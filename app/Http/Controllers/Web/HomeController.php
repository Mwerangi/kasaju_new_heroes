<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Gallery;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // Get home page content
        $page = Page::where('slug', 'home')->with('activeSections')->first();
        
        // Get featured services (cached for 1 hour)
        $featuredServices = Cache::remember('home.featured_services', 3600, function () {
            return Service::featured()->ordered()->take(6)->get();
        });
        
        // Get testimonials (cached for 1 hour)
        $testimonials = Cache::remember('home.testimonials', 3600, function () {
            return Testimonial::active()->ordered()->take(6)->get();
        });
        
        // Get gallery preview (cached for 30 minutes)
        $galleryImages = Cache::remember('home.gallery_preview', 1800, function () {
            return Gallery::active()->ordered()->take(8)->get();
        });
        
        // Get latest blog posts (cached for 15 minutes)
        $latestPosts = Cache::remember('home.latest_posts', 900, function () {
            return BlogPost::published()->latest()->take(3)->get();
        });
        
        return view('web.home', compact(
            'page',
            'featuredServices',
            'testimonials',
            'galleryImages',
            'latestPosts'
        ));
    }
}
