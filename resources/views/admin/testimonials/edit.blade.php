@extends('admin.layouts.app')

@section('title', 'Edit Testimonial')

@section('content')
<div class="mb-6">
    <div class="flex items-center text-sm text-gray-600 mb-4">
        <a href="{{ route('admin.testimonials.index') }}" class="hover:text-blue-600">Testimonials</a>
        <i class="fas fa-chevron-right mx-2 text-xs"></i>
        <span class="text-gray-900">Edit: {{ $testimonial->client_name }}</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-800">Edit Testimonial</h1>
</div>

<form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Client Information</h2>

                <div class="space-y-4">
                    <div>
                        <label for="client_name" class="block text-sm font-medium text-gray-700 mb-1">Client Name *</label>
                        <input type="text" name="client_name" id="client_name" value="{{ old('client_name', $testimonial->client_name) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('client_name') border-red-500 @enderror">
                        @error('client_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="client_position" class="block text-sm font-medium text-gray-700 mb-1">Position *</label>
                            <input type="text" name="client_position" id="client_position" value="{{ old('client_position', $testimonial->client_position) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('client_position') border-red-500 @enderror">
                            @error('client_position')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="client_company" class="block text-sm font-medium text-gray-700 mb-1">Company</label>
                            <input type="text" name="client_company" id="client_company" value="{{ old('client_company', $testimonial->client_company) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('client_company') border-red-500 @enderror">
                            @error('client_company')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="feedback" class="block text-sm font-medium text-gray-700 mb-1">Testimonial Text *</label>
                        <textarea name="feedback" id="feedback" rows="6" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('feedback') border-red-500 @enderror">{{ old('feedback', $testimonial->feedback) }}</textarea>
                        @error('feedback')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating *</label>
                        <select name="rating" id="rating" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('rating') border-red-500 @enderror">
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>
                                    {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>
                        @error('rating')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="client_image" class="block text-sm font-medium text-gray-700 mb-1">Client Photo</label>
                            @if($testimonial->client_image)
                                <img src="{{ asset('storage/' . $testimonial->client_image) }}" alt="{{ $testimonial->client_name }}" class="w-24 h-24 rounded-full object-cover mb-2">
                            @endif
                            <input type="file" name="client_image" id="client_image" accept="image/*"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('client_image') border-red-500 @enderror">
                            @error('client_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="company_logo" class="block text-sm font-medium text-gray-700 mb-1">Company Logo</label>
                            @if($testimonial->company_logo)
                                <img src="{{ asset('storage/' . $testimonial->company_logo) }}" alt="Logo" class="w-24 h-24 object-contain mb-2 bg-gray-50 rounded">
                            @endif
                            <input type="file" name="company_logo" id="company_logo" accept="image/*"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('company_logo') border-red-500 @enderror">
                            @error('company_logo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="space-y-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Settings</h2>

                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="is_active" class="ml-2 text-sm text-gray-700 font-medium">Active</label>
                        </div>

                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                            <input type="number" name="order" id="order" value="{{ old('order', $testimonial->order) }}" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="space-y-3">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            <i class="fas fa-save mr-2"></i> Update Testimonial
                        </button>
                        <a href="{{ route('admin.testimonials.index') }}" class="block w-full px-4 py-2 bg-gray-100 text-gray-700 text-center rounded-lg hover:bg-gray-200">
                            Cancel
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 border-2 border-red-200">
                    <h2 class="text-lg font-semibold text-red-600 mb-2">Delete</h2>
                    <p class="text-sm text-gray-600 mb-4">This action cannot be undone.</p>
                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Delete this testimonial?');">
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
