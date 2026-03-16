<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;

class AboutController extends Controller
{
    public function index()
    {
        // Try to load the about page from database, fall back to static content if not found
        $page = Page::where('slug', 'about')
            ->where('is_active', true)
            ->with(['sections' => function($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
            ->first();
        
        return view('web.about', compact('page'));
    }
}
