@extends('admin.layouts.app')

@section('title', 'Edit Gallery Image')

@section('content')
<div class="mb-6">
    <div class="flex items-center text-sm text-gray-600 mb-4">
        <a href="{{ route('admin.galleries.index') }}" class="hover:text-blue-600">Gallery</a>
        <i class="fas fa-chevron-right mx-2 text-xs"></i>
        <span class="text-gray-900">Edit: {{ $gallery->title }}</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-800">Edit Gallery Image</h1>
</div>

<form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Image Details</h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="w-full max-w-md rounded-lg shadow-md">
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Replace Image</label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('image') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Leave empty to keep current image</p>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $gallery->title) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" id="description" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $gallery->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="space-y-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Settings</h2>

                    <div class="space-y-4">
                        <div>
                            <label for="gallery_category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select name="gallery_category_id" id="gallery_category_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="">No Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('gallery_category_id', $gallery->gallery_category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="is_active" class="ml-2 text-sm text-gray-700 font-medium">Active</label>
                        </div>

                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                            <input type="number" name="order" id="order" value="{{ old('order', $gallery->order) }}" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="space-y-3">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            <i class="fas fa-save mr-2"></i> Update Image
                        </button>
                        <a href="{{ route('admin.galleries.index') }}" class="block w-full px-4 py-2 bg-gray-100 text-gray-700 text-center rounded-lg hover:bg-gray-200">
                            Cancel
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 border-2 border-red-200">
                    <h2 class="text-lg font-semibold text-red-600 mb-2">Delete Image</h2>
                    <p class="text-sm text-gray-600 mb-4">This action cannot be undone.</p>
                    <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Delete this image?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            <i class="fas fa-trash mr-2"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
