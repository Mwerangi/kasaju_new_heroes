<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('title')->paginate(20);
        return view('admin.pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        $page->load('sections');
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
        ]);

        // Handle checkbox for page active status
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $page->update($validated);
        
        ActivityLog::log('updated', "Updated page: {$page->title}", Page::class, $page->id);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page updated successfully.');
    }

    public function show(Page $page)
    {
        // Redirect to edit page since we don't have a separate show view
        return redirect()->route('admin.pages.edit', $page);
    }

    public function create()
    {
        // Pages are seeded, not created manually
        return redirect()->route('admin.pages.index')
            ->with('info', 'Pages are predefined and cannot be created manually. You can edit existing pages or add sections to them.');
    }

    public function store(Request $request)
    {
        // Pages are seeded, not created manually
        return redirect()->route('admin.pages.index')
            ->with('info', 'Pages are predefined and cannot be created manually. You can edit existing pages or add sections to them.');
    }

    public function destroy(Page $page)
    {
        // Prevent deletion of core pages
        return redirect()->route('admin.pages.index')
            ->with('error', 'Pages cannot be deleted as they are core to the website structure. You can deactivate them instead by editing the page.');
    }
}
