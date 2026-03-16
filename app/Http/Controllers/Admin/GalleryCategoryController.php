<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class GalleryCategoryController extends Controller
{
    public function index()
    {
        $categories = GalleryCategory::orderBy('order')->paginate(20);
        return view('admin.gallery-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.gallery-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:gallery_categories,slug',
            'description' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $category = GalleryCategory::create($validated);
        
        ActivityLog::log('created', "Created gallery category: {$category->name}", GalleryCategory::class, $category->id);

        return redirect()->route('admin.gallery-categories.index')
            ->with('success', 'Gallery category created successfully.');
    }

    public function edit(GalleryCategory $galleryCategory)
    {
        return view('admin.gallery-categories.edit', compact('galleryCategory'));
    }

    public function update(Request $request, GalleryCategory $galleryCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:gallery_categories,slug,' . $galleryCategory->id,
            'description' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $galleryCategory->update($validated);
        
        ActivityLog::log('updated', "Updated gallery category: {$galleryCategory->name}", GalleryCategory::class, $galleryCategory->id);

        return redirect()->route('admin.gallery-categories.index')
            ->with('success', 'Gallery category updated successfully.');
    }

    public function destroy(GalleryCategory $galleryCategory)
    {
        $name = $galleryCategory->name;
        $galleryCategory->delete();
        
        ActivityLog::log('deleted', "Deleted gallery category: {$name}", GalleryCategory::class, $galleryCategory->id);

        return redirect()->route('admin.gallery-categories.index')
            ->with('success', 'Gallery category deleted successfully.');
    }
}
