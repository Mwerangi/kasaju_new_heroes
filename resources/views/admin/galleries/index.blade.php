@extends('admin.layouts.app')

@section('title', 'Manage Gallery')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manage Gallery</h1>
        <p class="text-sm text-gray-600 mt-1">Upload and organize gallery images</p>
    </div>
    <a href="{{ route('admin.galleries.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i> Upload Image
    </a>
</div>

<!-- Filters -->
<div class="bg-white rounded-lg shadow-md p-4 mb-6">
    <form method="GET" action="{{ route('admin.galleries.index') }}" class="flex flex-wrap gap-4">
        <div>
            <select name="category" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
            <i class="fas fa-filter mr-1"></i> Filter
        </button>
    </form>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <div class="text-sm text-gray-600">
            <span class="font-semibold">{{ $galleries->total() }}</span> total images
        </div>
    </div>

    @if($galleries->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 p-6">
            @foreach($galleries as $gallery)
                <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-48 object-cover">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="absolute bottom-0 left-0 right-0 p-3">
                            <p class="text-white text-sm font-medium truncate">{{ $gallery->title }}</p>
                            @if($gallery->category)
                                <p class="text-white/80 text-xs">{{ $gallery->category->name }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                        <a href="{{ route('admin.galleries.edit', $gallery) }}" class="p-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Delete this image?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 bg-red-600 text-white rounded hover:bg-red-700 text-xs">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>

                    @if($gallery->is_active)
                        <div class="absolute top-2 left-2">
                            <span class="px-2 py-1 text-xs bg-green-500 text-white rounded">Active</span>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $galleries->links() }}
        </div>
    @else
        <div class="p-12 text-center">
            <i class="fas fa-images text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500 mb-4">No gallery images found</p>
            <a href="{{ route('admin.galleries.create') }}" class="text-blue-600 hover:text-blue-700">
                <i class="fas fa-plus mr-1"></i> Upload your first image
            </a>
        </div>
    @endif
</div>
@endsection
