<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use App\Models\ActivityLog;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SeoSettingController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    public function index()
    {
        $pages = ['home', 'about', 'services', 'gallery', 'blog', 'contact'];
        $seoSettings = [];
        
        foreach ($pages as $page) {
            $seoSettings[$page] = SeoSetting::where('page', $page)->first();
        }

        return view('admin.seo-settings.index', compact('seoSettings', 'pages'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'page' => 'required|string|max:100',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'canonical_url' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('og_image')) {
            // Delete old OG image if exists
            $existingSetting = SeoSetting::where('page', $validated['page'])->first();
            if ($existingSetting && $existingSetting->og_image) {
                $this->imageService->deleteImage($existingSetting->og_image);
            }
            
            $result = $this->imageService->uploadAndOptimize(
                $request->file('og_image'),
                'seo',
                ['max_width' => 1200, 'max_height' => 630, 'thumbnail' => false]
            );
            $validated['og_image'] = $result['path'];
        }

        $seoSetting = SeoSetting::updateOrCreate(
            ['page' => $validated['page']],
            $validated
        );

        ActivityLog::log('updated', "Updated SEO settings for page: {$validated['page']}", SeoSetting::class, $seoSetting->id);

        return back()->with('success', 'SEO settings updated successfully.');
    }
}
