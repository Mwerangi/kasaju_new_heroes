<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProcessStep;
use App\Models\ActivityLog;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ProcessStepController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    public function index()
    {
        $steps = ProcessStep::orderBy('order')->paginate(20);
        return view('admin.process-steps.index', compact('steps'));
    }

    public function create()
    {
        return view('admin.process-steps.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'step_number' => 'required|integer',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $result = $this->imageService->uploadAndOptimize(
                $request->file('image'),
                'process-steps',
                ['max_width' => 800, 'thumbnail' => false]
            );
            $validated['image'] = $result['path'];
        }

        $step = ProcessStep::create($validated);
        
        ActivityLog::log('created', "Created process step: {$step->title}", ProcessStep::class, $step->id);

        return redirect()->route('admin.process-steps.index')
            ->with('success', 'Process step created successfully.');
    }

    public function edit(ProcessStep $processStep)
    {
        return view('admin.process-steps.edit', compact('processStep'));
    }

    public function update(Request $request, ProcessStep $processStep)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'step_number' => 'required|integer',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($processStep->image) {
                $this->imageService->deleteImage($processStep->image);
            }
            
            $result = $this->imageService->uploadAndOptimize(
                $request->file('image'),
                'process-steps',
                ['max_width' => 800, 'thumbnail' => false]
            );
            $validated['image'] = $result['path'];
        }

        $processStep->update($validated);
        
        ActivityLog::log('updated', "Updated process step: {$processStep->title}", ProcessStep::class, $processStep->id);

        return redirect()->route('admin.process-steps.index')
            ->with('success', 'Process step updated successfully.');
    }

    public function destroy(ProcessStep $processStep)
    {
        $title = $processStep->title;
        $processStep->delete();
        
        ActivityLog::log('deleted', "Deleted process step: {$title}", ProcessStep::class, $processStep->id);

        return redirect()->route('admin.process-steps.index')
            ->with('success', 'Process step deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'steps' => 'required|array',
            'steps.*.id' => 'required|exists:process_steps,id',
            'steps.*.order' => 'required|integer',
        ]);

        foreach ($request->steps as $stepData) {
            ProcessStep::where('id', $stepData['id'])->update(['order' => $stepData['order']]);
        }

        return response()->json(['success' => true]);
    }
}
