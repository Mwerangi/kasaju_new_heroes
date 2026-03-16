<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use App\Models\ActivityLog;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GalleryController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    public function index(Request $request)
    {
        $query = Gallery::with('category')->orderBy('order');

        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        $galleries = $query->paginate(20);
        $categories = GalleryCategory::all();

        return view('admin.galleries.index', compact('galleries', 'categories'));
    }

    public function create()
    {
        $categories = GalleryCategory::all();
        return view('admin.galleries.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:gallery_categories,id',
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $result = $this->imageService->uploadAndOptimize(
                $request->file('image'),
                'gallery',
                ['thumbnail' => true, 'thumbnail_width' => 400, 'thumbnail_height' => 400]
            );
            $validated['image'] = $result['path'];
            $validated['thumbnail'] = $result['thumbnail'];
        }

        $gallery = Gallery::create($validated);
        
        // Clear gallery caches
        Cache::forget('gallery.categories');
        Cache::forget('home.gallery_preview');
        
        ActivityLog::log('created', "Uploaded gallery image: {$gallery->title}", Gallery::class, $gallery->id);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery image uploaded successfully.');
    }

    public function edit(Gallery $gallery)
    {
        $categories = GalleryCategory::all();
        return view('admin.galleries.edit', compact('gallery', 'categories'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:gallery_categories,id',
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old images
            if ($gallery->image) {
                $this->imageService->deleteImage($gallery->image, $gallery->thumbnail);
            }
            
            $result = $this->imageService->uploadAndOptimize(
                $request->file('image'),
                'gallery',
                ['thumbnail' => true, 'thumbnail_width' => 400, 'thumbnail_height' => 400]
            );
            $validated['image'] = $result['path'];
            $validated['thumbnail'] = $result['thumbnail'];
        }

        $gallery->update($validated);
        
        // Clear gallery caches
        Cache::forget('gallery.categories');
        Cache::forget('home.gallery_preview');
        
        ActivityLog::log('updated', "Updated gallery image: {$gallery->title}", Gallery::class, $gallery->id);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery image updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        $title = $gallery->title;
        $gallery->delete();
        
        // Clear gallery caches
        Cache::forget('gallery.categories');
        Cache::forget('home.gallery_preview');
        
        ActivityLog::log('deleted', "Deleted gallery image: {$title}", Gallery::class, $gallery->id);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery image deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'galleries' => 'required|array',
            'galleries.*.id' => 'required|exists:galleries,id',
            'galleries.*.order' => 'required|integer',
        ]);

        foreach ($request->galleries as $galleryData) {
            Gallery::where('id', $galleryData['id'])->update(['order' => $galleryData['order']]);
        }

        return response()->json(['success' => true]);
    }
}
