@extends('admin.layouts.app')

@section('title', 'Edit Contact Information')

@section('content')
<div class="mb-6">
    <div class="flex items-center text-gray-600 text-sm mb-4">
        <a href="{{ route('admin.contact-info.index') }}" class="hover:text-gray-900">Contact Information</a>
        <i class="fas fa-chevron-right mx-2 text-xs"></i>
        <span class="text-gray-900">Edit</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-800">Edit Contact Information</h1>
</div>

@if(session('success'))
    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<form action="{{ route('admin.contact-info.update', $contactInfo) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Contact Details</h2>
                
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Key *</label>
                            <input type="text" name="key" value="{{ old('key', $contactInfo->key) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('key') border-red-500 @enderror" 
                                required>
                            @error('key')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Label *</label>
                            <input type="text" name="label" value="{{ old('label', $contactInfo->label) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('label') border-red-500 @enderror" 
                                required>
                            @error('label')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Value *</label>
                        <input type="text" name="value" value="{{ old('value', $contactInfo->value) }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('value') border-red-500 @enderror" 
                            required>
                        @error('value')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Group *</label>
                            <select name="group" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('group') border-red-500 @enderror" 
                                required>
                                <option value="general" {{ old('group', $contactInfo->group) == 'general' ? 'selected' : '' }}>General</option>
                                <option value="contact" {{ old('group', $contactInfo->group) == 'contact' ? 'selected' : '' }}>Contact</option>
                                <option value="social" {{ old('group', $contactInfo->group) == 'social' ? 'selected' : '' }}>Social Media</option>
                            </select>
                            @error('group')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                            <select name="type" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('type') border-red-500 @enderror" 
                                required>
                                <option value="text" {{ old('type', $contactInfo->type) == 'text' ? 'selected' : '' }}>Text</option>
                                <option value="phone" {{ old('type', $contactInfo->type) == 'phone' ? 'selected' : '' }}>Phone</option>
                                <option value="email" {{ old('type', $contactInfo->type) == 'email' ? 'selected' : '' }}>Email</option>
                                <option value="url" {{ old('type', $contactInfo->type) == 'url' ? 'selected' : '' }}>URL</option>
                                <option value="address" {{ old('type', $contactInfo->type) == 'address' ? 'selected' : '' }}>Address</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                        <input type="number" name="order" value="{{ old('order', $contactInfo->order) }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('order') border-red-500 @enderror">
                        @error('order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
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
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $contactInfo->is_active) ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200 flex gap-3">
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-save mr-2"></i> Update
                    </button>
                    <a href="{{ route('admin.contact-info.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
