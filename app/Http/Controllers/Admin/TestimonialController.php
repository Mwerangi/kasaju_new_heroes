<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\ActivityLog;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TestimonialController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    public function index()
    {
        $testimonials = Testimonial::orderBy('order')->paginate(20);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'testimonial' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'rating' => 'nullable|integer|min:1|max:5',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $result = $this->imageService->uploadAndOptimize(
                $request->file('image'),
                'testimonials',
                ['max_width' => 800, 'thumbnail' => false]
            );
            $validated['image'] = $result['path'];
        }

        if ($request->hasFile('logo')) {
            $result = $this->imageService->uploadAndOptimize(
                $request->file('logo'),
                'testimonials/logos',
                ['max_width' => 400, 'thumbnail' => false]
            );
            $validated['logo'] = $result['path'];
        }

        $testimonial = Testimonial::create($validated);
        
        // Clear testimonial caches
        Cache::forget('testimonials.list');
        Cache::forget('home.testimonials');
        
        ActivityLog::log('created', "Created testimonial from: {$testimonial->client_name}", Testimonial::class, $testimonial->id);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'testimonial' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'rating' => 'nullable|integer|min:1|max:5',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($testimonial->image) {
                $this->imageService->deleteImage($testimonial->image);
            }
            
            $result = $this->imageService->uploadAndOptimize(
                $request->file('image'),
                'testimonials',
                ['max_width' => 800, 'thumbnail' => false]
            );
            $validated['image'] = $result['path'];
        }

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($testimonial->logo) {
                $this->imageService->deleteImage($testimonial->logo);
            }
            
            $result = $this->imageService->uploadAndOptimize(
                $request->file('logo'),
                'testimonials/logos',
                ['max_width' => 400, 'thumbnail' => false]
            );
            $validated['logo'] = $result['path'];
        }

        $testimonial->update($validated);
        
        // Clear testimonial caches
        Cache::forget('testimonials.list');
        Cache::forget('home.testimonials');
        
        ActivityLog::log('updated', "Updated testimonial from: {$testimonial->client_name}", Testimonial::class, $testimonial->id);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $name = $testimonial->client_name;
        $testimonial->delete();
        
        // Clear testimonial caches
        Cache::forget('testimonials.list');
        Cache::forget('home.testimonials');
        
        ActivityLog::log('deleted', "Deleted testimonial from: {$name}", Testimonial::class, $testimonial->id);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'testimonials' => 'required|array',
            'testimonials.*.id' => 'required|exists:testimonials,id',
            'testimonials.*.order' => 'required|integer',
        ]);

        foreach ($request->testimonials as $testimonialData) {
            Testimonial::where('id', $testimonialData['id'])->update(['order' => $testimonialData['order']]);
        }

        return response()->json(['success' => true]);
    }
}
