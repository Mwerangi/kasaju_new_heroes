@extends('admin.layouts.app')

@section('title', 'Manage Services')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manage Services</h1>
        <p class="text-sm text-gray-600 mt-1">Manage all services offered by New Heroes International</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i> Add New Service
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-600">
                <span class="font-semibold">{{ $services->total() }}</span> total services
            </div>
            <div>
                <button id="reorderBtn" class="px-3 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition">
                    <i class="fas fa-sort mr-1"></i> Reorder Services
                </button>
            </div>
        </div>
    </div>

    @if($services->count() > 0)
        <div id="servicesTable">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Featured</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="sortableServices">
                    @foreach($services as $service)
                        <tr data-id="{{ $service->id }}" class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if($service->icon_image)
                                        <img src="{{ asset('storage/' . $service->icon_image) }}" alt="{{ $service->title }}" class="w-10 h-10 rounded object-cover mr-3">
                                    @else
                                        <div class="w-10 h-10 rounded bg-blue-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-briefcase text-blue-600"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $service->title }}</div>
                                        <div class="text-xs text-gray-500">{{ Str::limit($service->short_description, 50) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="drag-handle cursor-move text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-grip-vertical mr-2"></i>
                                </span>
                                <span class="text-sm text-gray-900">{{ $service->order }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($service->is_active)
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Active
                                    </span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        <i class="fas fa-times-circle mr-1"></i> Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($service->is_featured)
                                    <span class="text-yellow-500"><i class="fas fa-star"></i></span>
                                @else
                                    <span class="text-gray-300"><i class="far fa-star"></i></span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.services.edit', $service) }}" class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this service?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $services->links() }}
        </div>
    @else
        <div class="p-12 text-center">
            <i class="fas fa-briefcase text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500 mb-4">No services found</p>
            <a href="{{ route('admin.services.create') }}" class="text-blue-600 hover:text-blue-700">
                <i class="fas fa-plus mr-1"></i> Add your first service
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.getElementById('reorderBtn').addEventListener('click', function() {
    const sortable = Sortable.create(document.getElementById('sortableServices'), {
        handle: '.drag-handle',
        animation: 150,
        onEnd: function(evt) {
            const items = [];
            document.querySelectorAll('#sortableServices tr').forEach((row, index) => {
                items.push({
                    id: row.dataset.id,
                    order: index + 1
                });
            });

            fetch('{{ route("admin.services.reorder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ items: items })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                }
            });
        }
    });
    
    this.textContent = 'Drag to reorder';
    this.classList.add('bg-blue-100', 'text-blue-700');
});
</script>
@endpush
@endsection
