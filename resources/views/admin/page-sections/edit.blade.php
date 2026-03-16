@extends('admin.layouts.app')

@section('title', 'Edit Page Section')

@section('content')
<div class="mb-6">
    <div class="flex items-center text-sm text-gray-600 mb-4">
        <a href="{{ route('admin.pages.index') }}" class="hover:text-blue-600">Pages</a>
        <i class="fas fa-chevron-right mx-2 text-xs"></i>
        <a href="{{ route('admin.pages.edit', $page) }}" class="hover:text-blue-600">{{ $page->title }}</a>
        <i class="fas fa-chevron-right mx-2 text-xs"></i>
        <span class="text-gray-900">Edit: {{ $pageSection->section_key }}</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-800">Edit Section: {{ $pageSection->title ?: $pageSection->section_key }}</h1>
</div>

<form id="updateSectionForm" action="{{ route('admin.page-sections.update', $pageSection) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>Section Information
                </h2>

                <div class="space-y-4">
                    <div>
                        <label for="section_key" class="block text-sm font-medium text-gray-700 mb-1">Section Key *</label>
                        <input type="text" name="section_key" id="section_key" value="{{ old('section_key', $pageSection->section_key) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('section_key') border-red-500 @enderror"
                            placeholder="e.g., mission, vision, overview">
                        <p class="mt-1 text-xs text-gray-500">Unique identifier for this section</p>
                        @error('section_key')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Section Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $pageSection->title) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                        <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $pageSection->subtitle) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('subtitle') border-red-500 @enderror">
                        @error('subtitle')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                        <textarea name="content" id="content" rows="10"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('content') border-red-500 @enderror"
                            placeholder="Section content (HTML supported)">{{ old('content', $pageSection->content) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">You can use HTML tags for formatting</p>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="additional_data" class="block text-sm font-medium text-gray-700 mb-1">
                            Additional Data (JSON)
                            <span class="text-xs text-gray-500 font-normal">- For complex sections like values, services, etc.</span>
                        </label>
                        <textarea name="additional_data" id="additional_data" rows="12"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent font-mono text-sm @error('additional_data') border-red-500 @enderror"
                            placeholder='[{"icon": "fa-star", "color": "blue", "title": "Example", "description": "Description"}]'>{{ old('additional_data', $pageSection->additional_data ? json_encode($pageSection->additional_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">
                            Must be valid JSON format. Used for lists like core values, services, industries. 
                            <a href="#" onclick="validateJSON(); return false;" class="text-blue-600 hover:underline">Validate JSON</a>
                        </p>
                        @error('additional_data')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <div id="json-validation-result" class="mt-2 hidden"></div>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Section Image</label>
                        @if($pageSection->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $pageSection->image) }}" alt="Current image" class="w-48 h-32 object-cover rounded border border-gray-300">
                                <p class="text-xs text-gray-500 mt-1">Current image</p>
                            </div>
                        @endif
                        <input type="file" name="image" id="image" accept="image/*"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Leave empty to keep current image</p>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="button_text" class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
                            <input type="text" name="button_text" id="button_text" value="{{ old('button_text', $pageSection->button_text) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('button_text') border-red-500 @enderror">
                            @error('button_text')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="button_link" class="block text-sm font-medium text-gray-700 mb-1">Button Link</label>
                            <input type="text" name="button_link" id="button_link" value="{{ old('button_link', $pageSection->button_link) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('button_link') border-red-500 @enderror">
                            @error('button_link')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Section Order & Status -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Settings</h2>
                
                <div class="space-y-4">
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $pageSection->order) }}" min="1"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="mt-1 text-xs text-gray-500">Lower numbers appear first</p>
                    </div>

                    <div class="border border-gray-200 rounded-lg p-4 {{ $pageSection->is_active ? 'bg-green-50 border-green-300' : 'bg-gray-50' }}">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" id="is_active_checkbox"
                                {{ old('is_active', $pageSection->is_active) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 w-5 h-5">
                            <span class="ml-3 text-sm font-medium text-gray-900">Active (visible on frontend)</span>
                        </label>
                        <p class="mt-2 text-xs text-gray-600 ml-8">
                            Current status: 
                            <span class="font-semibold {{ $pageSection->is_active ? 'text-green-600' : 'text-gray-500' }}">
                                {{ $pageSection->is_active ? '✓ Active' : '✗ Inactive' }}
                            </span>
                        </p>
                        <p class="mt-1 text-xs text-gray-500 ml-8">
                            Check this box to make the section visible on the website
                        </p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="space-y-3">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>Update Section
                    </button>
                    
                    <a href="{{ route('admin.pages.edit', $page) }}" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2 rounded-lg transition">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Delete Section - MUST BE OUTSIDE THE UPDATE FORM -->
<div class="max-w-7xl mx-auto px-6 mt-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2"></div>
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500">
                <h3 class="text-sm font-semibold text-gray-800 mb-2">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>Danger Zone
                </h3>
                <p class="text-xs text-gray-600 mb-3">Delete this section permanently. This action cannot be undone.</p>
                <form action="{{ route('admin.page-sections.destroy', $pageSection) }}" method="POST" 
                      onsubmit="return confirm('⚠️ Are you ABSOLUTELY SURE you want to delete this section?\n\nSection: {{ $pageSection->title ?: $pageSection->section_key }}\n\nThis action CANNOT be undone!');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg transition text-sm">
                        <i class="fas fa-trash mr-2"></i>Delete Section Permanently
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function validateJSON() {
    const textarea = document.getElementById('additional_data');
    const resultDiv = document.getElementById('json-validation-result');
    const value = textarea.value.trim();
    
    resultDiv.classList.remove('hidden');
    
    if (!value) {
        resultDiv.className = 'mt-2 p-3 bg-gray-100 border border-gray-300 rounded text-sm text-gray-700';
        resultDiv.innerHTML = '<i class="fas fa-info-circle mr-2"></i>No JSON data provided (this is okay if not needed)';
        return;
    }
    
    try {
        const parsed = JSON.parse(value);
        resultDiv.className = 'mt-2 p-3 bg-green-50 border border-green-300 rounded text-sm text-green-700';
        resultDiv.innerHTML = '<i class="fas fa-check-circle mr-2"></i><strong>Valid JSON!</strong> Found ' + 
            (Array.isArray(parsed) ? parsed.length + ' items' : 'object with ' + Object.keys(parsed).length + ' properties');
        
        // Auto-format JSON
        textarea.value = JSON.stringify(parsed, null, 2);
    } catch (e) {
        resultDiv.className = 'mt-2 p-3 bg-red-50 border border-red-300 rounded text-sm text-red-700';
        resultDiv.innerHTML = '<i class="fas fa-exclamation-triangle mr-2"></i><strong>Invalid JSON:</strong> ' + e.message;
    }
}

// Auto-validate on page load if there's content
window.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('additional_data');
    if (textarea.value.trim()) {
        validateJSON();
    }
});
</script>

@endsection
