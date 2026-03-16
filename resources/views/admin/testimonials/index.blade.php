@extends('admin.layouts.app')

@section('title', 'Manage Testimonials')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manage Testimonials</h1>
        <p class="text-sm text-gray-600 mt-1">Client testimonials and reviews</p>
    </div>
    <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i> Add Testimonial
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6 border-b border-gray-200 flex items-center justify-between">
        <div class="text-sm text-gray-600">
            <span class="font-semibold">{{ $testimonials->total() }}</span> total testimonials
        </div>
        <button id="reorderBtn" class="px-3 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200">
            <i class="fas fa-sort mr-1"></i> Reorder
        </button>
    </div>

    @if($testimonials->count() > 0)
        <div class="divide-y divide-gray-200" id="sortableTestimonials">
            @foreach($testimonials as $testimonial)
                <div data-id="{{ $testimonial->id }}" class="p-6 hover:bg-gray-50 transition">
                    <div class="flex items-start gap-4">
                        <span class="drag-handle cursor-move text-gray-400 hover:text-gray-600 mt-2">
                            <i class="fas fa-grip-vertical"></i>
                        </span>
                        
                        @if($testimonial->client_image)
                            <img src="{{ asset('storage/' . $testimonial->client_image) }}" alt="{{ $testimonial->client_name }}" class="w-16 h-16 rounded-full object-cover">
                        @else
                            <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-user text-gray-400 text-xl"></i>
                            </div>
                        @endif

                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-2">
                                <div>
                                    <h3 class="font-semibold text-gray-900">{{ $testimonial->client_name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $testimonial->client_position }} 
                                        @if($testimonial->client_company)
                                            at {{ $testimonial->client_company }}
                                        @endif
                                    </p>
                                </div>
                                <div class="flex items-center gap-2">
                                    @if($testimonial->is_active)
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Active</span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-gray-100 text-gray-800 rounded-full">Inactive</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-2">
                                <div class="flex items-center text-yellow-400 mb-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimonial->rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                    <span class="text-sm text-gray-600 ml-2">({{ $testimonial->rating }}/5)</span>
                                </div>
                            </div>

                            <p class="text-gray-700 text-sm mb-3">{{ Str::limit($testimonial->feedback, 200) }}</p>

                            <div class="flex items-center gap-3 text-sm">
                                <span class="text-gray-500">Order: {{ $testimonial->order }}</span>
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="inline" onsubmit="return confirm('Delete this testimonial?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $testimonials->links() }}
        </div>
    @else
        <div class="p-12 text-center">
            <i class="fas fa-quote-right text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500 mb-4">No testimonials found</p>
            <a href="{{ route('admin.testimonials.create') }}" class="text-blue-600 hover:text-blue-700">
                <i class="fas fa-plus mr-1"></i> Add your first testimonial
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.getElementById('reorderBtn').addEventListener('click', function() {
    Sortable.create(document.getElementById('sortableTestimonials'), {
        handle: '.drag-handle',
        animation: 150,
        onEnd: function(evt) {
            const items = [];
            document.querySelectorAll('#sortableTestimonials > div').forEach((row, index) => {
                items.push({ id: row.dataset.id, order: index + 1 });
            });

            fetch('{{ route("admin.testimonials.reorder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ items: items })
            }).then(response => response.json())
            .then(data => { if(data.success) location.reload(); });
        }
    });
    
    this.textContent = 'Drag to reorder';
    this.classList.add('bg-blue-100', 'text-blue-700');
});
</script>
@endpush
@endsection
