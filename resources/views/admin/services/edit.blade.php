@extends('admin.layouts.app')

@section('title', 'Edit Service')

@section('content')
<div class="mb-6">
    <div class="flex items-center text-sm text-gray-600 mb-4">
        <a href="{{ route('admin.services.index') }}" class="hover:text-blue-600">Services</a>
        <i class="fas fa-chevron-right mx-2 text-xs"></i>
        <span class="text-gray-900">Edit: {{ $service->title }}</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-800">Edit Service</h1>
</div>

<form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Basic Information</h2>

                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Service Title *</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $service->title) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug (URL-friendly name)</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $service->slug) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('slug') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Leave blank to auto-generate from title</p>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">Short Description *</label>
                        <textarea name="short_description" id="short_description" rows="3" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('short_description') border-red-500 @enderror">{{ old('short_description', $service->short_description) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Brief description for cards and previews</p>
                        @error('short_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Full Description *</label>
                        <textarea name="description" id="description" rows="8" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description', $service->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Images -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Images</h2>

                <div class="space-y-4">
                    <div>
                        <label for="icon_image" class="block text-sm font-medium text-gray-700 mb-1">Icon/Thumbnail Image</label>
                        @if($service->icon_image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $service->icon_image) }}" alt="Current icon" class="w-32 h-32 object-cover rounded border border-gray-300">
                                <p class="text-xs text-gray-500 mt-1">Current image</p>
                            </div>
                        @endif
                        <input type="file" name="icon_image" id="icon_image" accept="image/*"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('icon_image') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Recommended: 400x400px, Max 2MB. Leave empty to keep current.</p>
                        @error('icon_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
                        @if($service->featured_image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $service->featured_image) }}" alt="Current featured" class="w-64 h-32 object-cover rounded border border-gray-300">
                                <p class="text-xs text-gray-500 mt-1">Current image</p>
                            </div>
                        @endif
                        <input type="file" name="featured_image" id="featured_image" accept="image/*"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('featured_image') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Recommended: 1200x600px, Max 2MB. Leave empty to keep current.</p>
                        @error('featured_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Publish Settings -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Publish Settings</h2>

                <div class="space-y-4">
                    <div class="p-3 rounded-lg {{ old('is_active', $service->is_active) ? 'bg-green-50' : 'bg-gray-50' }} transition">
                        <div class="flex items-center mb-2">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                                class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="is_active" class="ml-3 text-sm font-medium text-gray-900">
                                Active Status
                            </label>
                        </div>
                        <p class="text-xs text-gray-600 ml-8">
                            Current: <span class="font-semibold">{{ $service->is_active ? '✓ Active' : '✗ Inactive' }}</span>
                        </p>
                        <p class="text-xs text-gray-500 ml-8 mt-1">Display this service on the website</p>
                    </div>

                    <div class="p-3 rounded-lg {{ old('is_featured', $service->is_featured) ? 'bg-yellow-50' : 'bg-gray-50' }} transition">
                        <div class="flex items-center mb-2">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }}
                                class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="is_featured" class="ml-3 text-sm font-medium text-gray-900">
                                Featured Service
                            </label>
                        </div>
                        <p class="text-xs text-gray-600 ml-8">
                            Current: <span class="font-semibold">{{ $service->is_featured ? '★ Featured' : '☆ Not Featured' }}</span>
                        </p>
                        <p class="text-xs text-gray-500 ml-8 mt-1">Show on homepage and highlight in listings</p>
                    </div>
                </div>
            </div>

            <!-- Order -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Display Order</h2>

                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Order Number</label>
                    <input type="number" name="order" id="order" value="{{ old('order', $service->order) }}" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <p class="mt-1 text-xs text-gray-500">Lower numbers appear first</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="space-y-3">
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-save mr-2"></i> Update Service
                    </button>
                    <a href="{{ route('admin.services.index') }}" class="block w-full px-4 py-2 bg-gray-100 text-gray-700 text-center rounded-lg hover:bg-gray-200 transition">
                        <i class="fas fa-times mr-2"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Delete Service Section (Outside Main Form) -->
<div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2"></div>
    <div>
        <div class="bg-white rounded-lg shadow-md p-6 border-2 border-red-200">
            <h2 class="text-lg font-semibold text-red-600 mb-2">
                <i class="fas fa-exclamation-triangle mr-2"></i>Danger Zone
            </h2>
            <p class="text-sm text-gray-600 mb-4">Deleting this service is permanent and cannot be undone. All related data will be permanently removed.</p>
            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('⚠️ Are you ABSOLUTELY SURE you want to delete \\'{{ $service->title }}\\'?\\n\\nThis action:\\n• Cannot be undone\\n• Will permanently remove all service data\\n• May affect website navigation\\n\\nType YES in the confirmation to proceed.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                    <i class="fas fa-trash mr-2"></i> Delete Service Permanently
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Auto-generate slug from title
document.getElementById('title').addEventListener('input', function() {
    const slug = this.value
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
    document.getElementById('slug').value = slug;
});
</script>
@endpush
@endsection
