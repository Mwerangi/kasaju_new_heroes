<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;

class TestimonialController extends Controller
{
    public function index()
    {
        // Cache testimonials for 1 hour
        $testimonials = Cache::remember('testimonials.list', 3600, function () {
            return Testimonial::active()->ordered()->paginate(12);
        });
        
        return view('web.testimonials', compact('testimonials'));
    }
}
