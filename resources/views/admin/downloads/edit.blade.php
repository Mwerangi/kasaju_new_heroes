@extends('admin.layouts.app')

@section('title', 'Edit File')

@section('content')
<div class="mb-6">
    <div class="flex items-center text-gray-600 text-sm mb-4">
        <a href="{{ route('admin.downloads.index') }}" class="hover:text-gray-900">Downloads</a>
        <i class="fas fa-chevron-right mx-2 text-xs"></i>
        <span class="text-gray-900">Edit File</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-800">Edit File</h1>
</div>

@if(session('success'))
    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<form action="{{ route('admin.downloads.update', $download) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">File Information</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" name="title" value="{{ old('title', $download->title) }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror" 
                            required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="4" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description', $download->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                        <select name="category" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category') border-red-500 @enderror" 
                            required>
                            <option value="Brochures" {{ old('category', $download->category) == 'Brochures' ? 'selected' : '' }}>Brochures</option>
                            <option value="Forms" {{ old('category', $download->category) == 'Forms' ? 'selected' : '' }}>Forms</option>
                            <option value="Guides" {{ old('category', $download->category) == 'Guides' ? 'selected' : '' }}>Guides</option>
                            <option value="Documentation" {{ old('category', $download->category) == 'Documentation' ? 'selected' : '' }}>Documentation</option>
                            <option value="Reports" {{ old('category', $download->category) == 'Reports' ? 'selected' : '' }}>Reports</option>
                            <option value="Other" {{ old('category', $download->category) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Replace File</label>
                        <div class="mb-3 p-3 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-700 font-medium">Current: {{ $download->file_name }}</p>
                            <p class="text-xs text-gray-500 mt-1">Size: {{ number_format($download->file_size / 1024, 2) }} KB</p>
                        </div>
                        <input type="file" name="file" accept=".pdf,.doc,.docx" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('file') border-red-500 @enderror">
                        @error('file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Leave empty to keep current file. Max: 10MB</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Publish -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Publish</h2>
                
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $download->is_active) ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="is_active" class="ml-2 text-sm text-gray-700">Active (available for download)</label>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200 flex gap-3">
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-save mr-2"></i> Update File
                    </button>
                    <a href="{{ route('admin.downloads.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Cancel
                    </a>
                </div>
            </div>

            <!-- File Info -->
            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">File Information</h3>
                <div class="space-y-2 text-xs text-gray-600">
                    <div class="flex justify-between">
                        <span>Uploaded:</span>
                        <span>{{ $download->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Downloads:</span>
                        <span class="font-semibold">{{ $download->download_count ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
