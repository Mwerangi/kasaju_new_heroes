<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.downloads.index', compact('downloads'));
    }

    public function create()
    {
        return view('admin.downloads.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('downloads', 'public');
            
            $validated['file_path'] = $path;
            $validated['file_name'] = $file->getClientOriginalName();
            $validated['file_type'] = $file->getClientMimeType();
            $validated['file_size'] = $file->getSize();
        }

        $download = Download::create($validated);
        
        ActivityLog::log('created', "Uploaded file: {$download->title}", Download::class, $download->id);

        return redirect()->route('admin.downloads.index')
            ->with('success', 'File uploaded successfully.');
    }

    public function edit(Download $download)
    {
        return view('admin.downloads.edit', compact('download'));
    }

    public function update(Request $request, Download $download)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('downloads', 'public');
            
            $validated['file_path'] = $path;
            $validated['file_name'] = $file->getClientOriginalName();
            $validated['file_type'] = $file->getClientMimeType();
            $validated['file_size'] = $file->getSize();
        }

        $download->update($validated);
        
        ActivityLog::log('updated', "Updated file: {$download->title}", Download::class, $download->id);

        return redirect()->route('admin.downloads.index')
            ->with('success', 'File updated successfully.');
    }

    public function destroy(Download $download)
    {
        $title = $download->title;
        $download->delete();
        
        ActivityLog::log('deleted', "Deleted file: {$title}", Download::class, $download->id);

        return redirect()->route('admin.downloads.index')
            ->with('success', 'File deleted successfully.');
    }
}
