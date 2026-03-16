<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        // Cache gallery categories for 1 hour
        $categories = Cache::remember('gallery.categories', 3600, function () {
            return GalleryCategory::active()->withCount('activeGalleries')->get();
        });
        
        $query = Gallery::active()->ordered();
        
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }
        
        $galleries = $query->paginate(12);
        
        return view('web.gallery', compact('galleries', 'categories'));
    }
}
