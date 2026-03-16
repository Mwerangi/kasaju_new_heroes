@extends('admin.layouts.app')

@section('title', 'Media Library')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Media Library</h1>
    <p class="text-sm text-gray-600 mt-1">Upload and manage media files</p>
</div>

<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <form id="uploadForm" enctype="multipart/form-data">
        @csrf
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-400 transition">
            <input type="file" name="file" id="fileInput" class="hidden" accept="image/*,video/*,application/pdf">
            <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 mb-4"></i>
            <p class="text-gray-600 mb-2">Click to upload or drag and drop</p>
            <p class="text-sm text-gray-500 mb-4">Images, Videos, PDF - Max file size: 10MB</p>
            <button type="button" onclick="document.getElementById('fileInput').click()" 
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-upload mr-2"></i> Select File
            </button>
            <div id="uploadProgress" class="mt-4 hidden">
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div id="progressBar" class="bg-blue-600 h-2 rounded-full" style="width: 0%"></div>
                </div>
                <p class="text-sm text-gray-600 mt-2">Uploading...</p>
            </div>
        </div>
    </form>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex gap-2">
            <a href="?" class="px-4 py-2 rounded-lg transition {{ !request('type') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <i class="fas fa-th mr-2"></i> All
            </a>
            <a href="?type=image" class="px-4 py-2 rounded-lg transition {{ request('type') == 'image' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <i class="fas fa-image mr-2"></i> Images
            </a>
            <a href="?type=video" class="px-4 py-2 rounded-lg transition {{ request('type') == 'video' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <i class="fas fa-video mr-2"></i> Videos
            </a>
            <a href="?type=document" class="px-4 py-2 rounded-lg transition {{ request('type') == 'document' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                <i class="fas fa-file mr-2"></i> Documents
            </a>
        </div>
        <div class="text-sm text-gray-600">
            <span class="font-semibold">{{ $media->total() }}</span> files
        </div>
    </div>

    @if($media->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($media as $item)
                <div class="relative group border rounded-lg overflow-hidden hover:shadow-lg transition">
                    @if($item->type == 'image')
                        <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->name }}" class="w-full h-32 object-cover">
                    @elseif($item->type == 'video')
                        <div class="w-full h-32 bg-gray-900 flex items-center justify-center">
                            <i class="fas fa-play-circle text-5xl text-white opacity-70"></i>
                        </div>
                    @else
                        <div class="w-full h-32 bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-file text-4xl text-gray-400"></i>
                        </div>
                    @endif
                    
                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                        <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" 
                            class="p-2 bg-white rounded-full text-blue-600 hover:bg-blue-600 hover:text-white transition">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button onclick="copyUrl('{{ asset('storage/' . $item->file_path) }}')" 
                            class="p-2 bg-white rounded-full text-green-600 hover:bg-green-600 hover:text-white transition">
                            <i class="fas fa-copy"></i>
                        </button>
                        <button onclick="deleteMedia({{ $item->id }})" 
                            class="p-2 bg-white rounded-full text-red-600 hover:bg-red-600 hover:text-white transition">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    
                    <div class="p-2 bg-white">
                        <p class="text-xs text-gray-600 truncate" title="{{ $item->name }}">{{ $item->name }}</p>
                        <p class="text-xs text-gray-500">{{ number_format($item->size / 1024, 1) }} KB</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $media->links() }}
        </div>
    @else
        <div class="text-center py-12 text-gray-500">
            <i class="fas fa-images text-5xl mb-4"></i>
            <p class="text-lg">No media files found.</p>
            <p class="text-sm mt-2">Upload your first file using the form above.</p>
        </div>
    @endif
</div>

@push('scripts')
<script>
document.getElementById('fileInput').addEventListener('change', function(e) {
    if (this.files.length > 0) {
        const formData = new FormData(document.getElementById('uploadForm'));
        const progressDiv = document.getElementById('uploadProgress');
        const progressBar = document.getElementById('progressBar');
        
        progressDiv.classList.remove('hidden');
        
        fetch('{{ route("admin.media.upload") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert('Upload failed. Please try again.');
                progressDiv.classList.add('hidden');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Upload failed. Please try again.');
            progressDiv.classList.add('hidden');
        });
    }
});

function deleteMedia(id) {
    if (confirm('Are you sure you want to delete this file?')) {
        fetch(`{{ route("admin.media.destroy", '') }}/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function copyUrl(url) {
    navigator.clipboard.writeText(url).then(() => {
        alert('URL copied to clipboard!');
    }).catch(err => {
        console.error('Failed to copy:', err);
    });
}
</script>
@endpush
@endsection
