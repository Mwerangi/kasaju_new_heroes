@extends('admin.layouts.app')

@section('title', 'SEO Settings')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">SEO Settings</h1>
    <p class="text-sm text-gray-600 mt-1">Manage search engine optimization for each page</p>
</div>

@if(session('success'))
    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="space-y-6">
    @foreach($pages as $page)
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 capitalize flex items-center">
                <i class="fas fa-search text-blue-600 mr-3"></i>
                {{ ucfirst($page) }} Page SEO
            </h2>
            
            <form action="{{ route('admin.seo-settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="page" value="{{ $page }}">
                
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                            <input type="text" name="meta_title" 
                                value="{{ $seoSettings[$page]->meta_title ?? '' }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <p class="mt-1 text-xs text-gray-500">Recommended: 50-60 characters</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Canonical URL</label>
                            <input type="url" name="canonical_url" 
                                value="{{ $seoSettings[$page]->canonical_url ?? '' }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                        <textarea name="meta_description" rows="2" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ $seoSettings[$page]->meta_description ?? '' }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Recommended: 150-160 characters</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Keywords</label>
                        <input type="text" name="meta_keywords" 
                            value="{{ $seoSettings[$page]->meta_keywords ?? '' }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <p class="mt-1 text-xs text-gray-500">Separate keywords with commas</p>
                    </div>

                    <div class="border-t pt-4">
                        <h3 class="text-sm font-semibold text-gray-700 mb-3">
                            <i class="fab fa-facebook mr-2 text-blue-600"></i>
                            Open Graph (Social Media)
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">OG Title</label>
                                <input type="text" name="og_title" 
                                    value="{{ $seoSettings[$page]->og_title ?? '' }}" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">OG Image</label>
                                @if(isset($seoSettings[$page]) && $seoSettings[$page]->og_image)
                                    <img src="{{ asset('storage/' . $seoSettings[$page]->og_image) }}" alt="OG Image" class="w-32 h-32 object-cover rounded mb-2">
                                @endif
                                <input type="file" name="og_image" accept="image/*" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <p class="mt-1 text-xs text-gray-500">Recommended: 1200x630px</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">OG Description</label>
                            <textarea name="og_description" rows="2" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ $seoSettings[$page]->og_description ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-save mr-2"></i> Save {{ ucfirst($page) }} SEO
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endforeach
</div>
@endsection
