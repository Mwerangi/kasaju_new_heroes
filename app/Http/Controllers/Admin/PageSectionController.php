<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use App\Models\Page;
use App\Models\ActivityLog;
use App\Services\ImageService;
use Illuminate\Http\Request;

class PageSectionController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    public function create(Request $request)
    {
        $pageId = $request->get('page_id');
        $page = Page::findOrFail($pageId);
        return view('admin.page-sections.create', compact('page'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'section_key' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        // Handle checkbox - if not present, it means unchecked (false)
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            $result = $this->imageService->uploadAndOptimize(
                $request->file('image'),
                'pages',
                ['max_width' => 1200, 'thumbnail' => false]
            );
            $validated['image'] = $result['path'];
        }

        $section = PageSection::create($validated);
        
        ActivityLog::log('created', "Created page section: {$section->section_key}", PageSection::class, $section->id);

        return redirect()->route('admin.pages.edit', $validated['page_id'])
            ->with('success', 'Page section created successfully.');
    }

    public function edit(PageSection $pageSection)
    {
        $page = $pageSection->page;
        return view('admin.page-sections.edit', compact('pageSection', 'page'));
    }

    public function update(Request $request, PageSection $pageSection)
    {
        $validated = $request->validate([
            'section_key' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'additional_data' => 'nullable|json',
        ]);

        // Handle checkbox - if not present, it means unchecked (false)
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        // Handle additional_data JSON
        if ($request->has('additional_data')) {
            $validated['additional_data'] = json_decode($request->additional_data, true);
        }

        // Handle image upload - only update if new image is provided
        if ($request->hasFile('image')) {
            // Delete old image
            if ($pageSection->image) {
                $this->imageService->deleteImage($pageSection->image);
            }
            
            $result = $this->imageService->uploadAndOptimize(
                $request->file('image'),
                'pages',
                ['max_width' => 1200, 'thumbnail' => false]
            );
            $validated['image'] = $result['path'];
        } else {
            // Remove image from validated array to keep existing image
            unset($validated['image']);
        }

        $pageSection->update($validated);
        
        ActivityLog::log('updated', "Updated page section: {$pageSection->section_key}", PageSection::class, $pageSection->id);

        return redirect()->route('admin.pages.edit', $pageSection->page_id)
            ->with('success', 'Page section updated successfully.');
    }

    public function destroy(PageSection $pageSection)
    {
        $pageId = $pageSection->page_id;
        $pageSection->delete();
        
        ActivityLog::log('deleted', "Deleted page section", PageSection::class, $pageSection->id);

        return redirect()->route('admin.pages.edit', $pageId)
            ->with('success', 'Page section deleted successfully.');
    }
}
