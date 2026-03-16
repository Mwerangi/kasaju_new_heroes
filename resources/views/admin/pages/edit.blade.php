@extends('admin.layouts.app')

@section('title', 'Edit Page - ' . $page->title)

@section('content')
<div class="mb-6">
    <div class="flex items-center text-sm text-gray-600 mb-4">
        <a href="{{ route('admin.pages.index') }}" class="hover:text-blue-600">Pages</a>
        <i class="fas fa-chevron-right mx-2 text-xs"></i>
        <span class="text-gray-900">Edit: {{ $page->title }}</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-800">Edit Page: {{ $page->title }}</h1>
</div>

<form action="{{ route('admin.pages.update', $page) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>Basic Information
                </h2>

                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Page Title *</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $page->title) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-blue-500 mt-1 mr-2"></i>
                            <div class="text-sm text-gray-600">
                                <strong>Slug:</strong> <code class="bg-white px-2 py-1 rounded">{{ $page->slug }}</code>
                                <p class="mt-1 text-xs">The URL identifier for this page. This cannot be changed to maintain existing links.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-search text-blue-600 mr-2"></i>SEO Settings
                </h2>

                <div class="space-y-4">
                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $page->meta_title) }}" maxlength="255"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('meta_title') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Recommended: 50-60 characters</p>
                        @error('meta_title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="3" maxlength="500"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('meta_description') border-red-500 @enderror">{{ old('meta_description', $page->meta_description) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Recommended: 150-160 characters</p>
                        @error('meta_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-1">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}" maxlength="500"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('meta_keywords') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Comma-separated keywords (e.g., logistics, shipping, cargo)</p>
                        @error('meta_keywords')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Page Sections -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-th-large text-blue-600 mr-2"></i>Page Sections ({{ $page->sections->count() }})
                    </h2>
                    <a href="{{ route('admin.page-sections.create', ['page_id' => $page->id]) }}" 
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm">
                        <i class="fas fa-plus mr-2"></i> Add Section
                    </a>
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-600 text-xl mr-3 mt-0.5"></i>
                        <div>
                            <h4 class="text-sm font-semibold text-blue-900 mb-1">How to Add Sections</h4>
                            <p class="text-sm text-blue-800 mb-2">
                                Click "Add Section" to create content blocks like Mission, Vision, Our Values, Team, etc. 
                                Each section can have a title, content, images, and buttons.
                            </p>
                            <div class="flex flex-wrap gap-2 mt-2">
                                <span class="text-xs bg-white text-blue-700 px-2 py-1 rounded">✨ Quick templates available</span>
                                <span class="text-xs bg-white text-blue-700 px-2 py-1 rounded">📝 HTML supported</span>
                                <span class="text-xs bg-white text-blue-700 px-2 py-1 rounded">🖼️ Image uploads</span>
                                <span class="text-xs bg-white text-blue-700 px-2 py-1 rounded">🔄 Reorderable</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if($page->sections->count() > 0)
                    <div class="space-y-3">
                        @foreach($page->sections->sortBy('order') as $section)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start flex-1">
                                    <span class="text-sm font-bold text-gray-400 mr-4 mt-1">{{ str_pad($section->order, 2, '0', STR_PAD_LEFT) }}</span>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <h4 class="text-sm font-semibold text-gray-900">
                                                {{ $section->title ?: $section->section_key }}
                                            </h4>
                                            @if($section->is_active)
                                                <span class="px-2 py-0.5 text-xs bg-green-100 text-green-700 rounded-full">
                                                    <i class="fas fa-check-circle"></i> Active
                                                </span>
                                            @else
                                                <span class="px-2 py-0.5 text-xs bg-gray-100 text-gray-600 rounded-full">
                                                    <i class="fas fa-times-circle"></i> Inactive
                                                </span>
                                            @endif
                                        </div>
                                        @if($section->subtitle)
                                            <p class="text-xs text-gray-600 mb-1">{{ $section->subtitle }}</p>
                                        @endif
                                        <div class="flex items-center gap-3 text-xs text-gray-500">
                                            <code class="bg-gray-100 px-2 py-0.5 rounded">{{ $section->section_key }}</code>
                                            @if($section->image)
                                                <span><i class="fas fa-image mr-1"></i> Has image</span>
                                            @endif
                                            @if($section->button_text)
                                                <span><i class="fas fa-link mr-1"></i> Has button</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 ml-4">
                                    <a href="{{ route('admin.page-sections.edit', $section) }}" 
                                       class="text-blue-600 hover:text-blue-800 p-2" title="Edit section">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="submit" form="delete-section-{{ $section->id }}" 
                                            class="text-red-600 hover:text-red-800 p-2" title="Delete section"
                                            onclick="return confirm('Are you sure you want to delete this section?');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-th-large text-gray-300 text-5xl mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">No sections added yet</h3>
                        <p class="text-gray-500 mb-6 max-w-md mx-auto">
                            Start building your page by adding content sections. You can add Mission, Vision, Our Values, Team, and more!
                        </p>
                        <a href="{{ route('admin.page-sections.create', ['page_id' => $page->id]) }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition shadow-lg">
                            <i class="fas fa-plus-circle mr-2"></i> Add Your First Section
                        </a>
                        
                        <!-- Example sections -->
                        <div class="mt-8 pt-8 border-t border-gray-200">
                            <p class="text-sm text-gray-600 mb-4">Popular sections to add:</p>
                            <div class="flex flex-wrap justify-center gap-2">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">
                                    <i class="fas fa-bullseye mr-1"></i> Mission
                                </span>
                                <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs">
                                    <i class="fas fa-eye mr-1"></i> Vision
                                </span>
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">
                                    <i class="fas fa-heart mr-1"></i> Core Values
                                </span>
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs">
                                    <i class="fas fa-users mr-1"></i> Our Team
                                </span>
                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs">
                                    <i class="fas fa-history mr-1"></i> Company History
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Page Status -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Status</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $page->is_active) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Active (visible to users)</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Page Info -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Page Information</h2>
                
                <div class="space-y-3 text-sm">
                    <div>
                        <span class="text-gray-600">Created:</span>
                        <div class="text-gray-900 font-medium">{{ $page->created_at->format('M d, Y H:i') }}</div>
                    </div>
                    <div>
                        <span class="text-gray-600">Last Updated:</span>
                        <div class="text-gray-900 font-medium">{{ $page->updated_at->format('M d, Y H:i') }}</div>
                    </div>
                    <div>
                        <span class="text-gray-600">Sections:</span>
                        <div class="text-gray-900 font-medium">{{ $page->sections->count() }} content sections</div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="space-y-3">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>Update Page
                    </button>
                    
                    <a href="{{ route('admin.pages.index') }}" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2 rounded-lg transition">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                    
                    <a href="{{ route($page->slug) }}" target="_blank" class="block w-full text-center bg-green-50 hover:bg-green-100 text-green-700 font-semibold px-4 py-2 rounded-lg transition">
                        <i class="fas fa-external-link-alt mr-2"></i>View Page
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Delete Section Forms (outside main form to avoid nesting) -->
@foreach($page->sections as $section)
<form id="delete-section-{{ $section->id }}" 
      action="{{ route('admin.page-sections.destroy', $section) }}" 
      method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endforeach

@endsection
