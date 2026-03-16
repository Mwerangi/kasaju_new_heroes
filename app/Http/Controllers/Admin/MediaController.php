<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    public function index(Request $request)
    {
        $query = Media::with('uploader')->orderBy('created_at', 'desc');

        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        $media = $query->paginate(24);

        return view('admin.media.index', compact('media'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
        ]);

        $file = $request->file('file');
        
        $type = 'document';
        if (Str::startsWith($file->getMimeType(), 'image/')) {
            $type = 'image';
        } elseif (Str::startsWith($file->getMimeType(), 'video/')) {
            $type = 'video';
        }

        // Optimize images, store other files normally
        if ($type === 'image') {
            $result = $this->imageService->uploadAndOptimize(
                $file,
                'media',
                ['max_width' => 1920, 'thumbnail' => false]
            );
            $path = $result['path'];
        } else {
            $path = $file->store('media', 'public');
        }

        $media = Media::create([
            'name' => $file->getClientOriginalName(),
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'disk' => 'public',
            'mime_type' => $file->getMimeType(),
            'extension' => $file->getClientOriginalExtension(),
            'size' => $file->getSize(),
            'type' => $type,
            'uploaded_by' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'media' => $media,
            'url' => asset('storage/' . $path),
        ]);
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        $media->delete();

        return response()->json(['success' => true]);
    }
}
