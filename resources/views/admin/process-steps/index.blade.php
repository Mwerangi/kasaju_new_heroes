@extends('admin.layouts.app')

@section('title', 'Manage Process Steps')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manage Process Steps</h1>
        <p class="text-sm text-gray-600 mt-1">Manage the steps displayed in the process workflow</p>
    </div>
    <a href="{{ route('admin.process-steps.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i> Add New Step
    </a>
</div>

@if(session('success'))
    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-600">
                <span class="font-semibold">{{ $steps->total() }}</span> total steps
            </div>
            <div>
                <button id="reorderBtn" class="px-3 py-2 text-sm bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition">
                    <i class="fas fa-sort mr-1"></i> Reorder Steps
                </button>
            </div>
        </div>
    </div>

    @if($steps->count() > 0)
        <div id="stepsTable">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Step</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Step #</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="sortableSteps">
                    @foreach($steps as $step)
                        <tr data-id="{{ $step->id }}" class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if($step->image)
                                        <img src="{{ asset('storage/' . $step->image) }}" alt="{{ $step->title }}" class="w-10 h-10 rounded object-cover mr-3">
                                    @elseif($step->icon)
                                        <div class="w-10 h-10 rounded bg-blue-100 flex items-center justify-center mr-3">
                                            <i class="{{ $step->icon }} text-blue-600"></i>
                                        </div>
                                    @else
                                        <div class="w-10 h-10 rounded bg-blue-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-tasks text-blue-600"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $step->title }}</div>
                                        <div class="text-xs text-gray-500">{{ Str::limit($step->description, 50) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-sm font-semibold text-blue-600 bg-blue-100 rounded">{{ $step->step_number }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="drag-handle cursor-move text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-grip-vertical mr-2"></i>
                                </span>
                                <span class="text-sm text-gray-900">{{ $step->order }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($step->is_active)
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Active
                                    </span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        <i class="fas fa-times-circle mr-1"></i> Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.process-steps.edit', $step) }}" class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.process-steps.destroy', $step) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this step?');">
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
            {{ $steps->links() }}
        </div>
    @else
        <div class="p-12 text-center text-gray-500">
            <i class="fas fa-tasks text-5xl mb-4"></i>
            <p class="text-lg mb-4">No process steps found.</p>
            <a href="{{ route('admin.process-steps.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i> Add First Step
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const reorderBtn = document.getElementById('reorderBtn');
    const sortableList = document.getElementById('sortableSteps');
    let sortable = null;

    if (reorderBtn && sortableList) {
        reorderBtn.addEventListener('click', function() {
            if (sortable) {
                // Disable reordering
                sortable.destroy();
                sortable = null;
                reorderBtn.innerHTML = '<i class="fas fa-sort mr-1"></i> Reorder Steps';
                reorderBtn.classList.remove('bg-green-100', 'text-green-700');
                reorderBtn.classList.add('bg-gray-100', 'text-gray-700');
            } else {
                // Enable reordering
                sortable = Sortable.create(sortableList, {
                    animation: 150,
                    handle: '.drag-handle',
                    onEnd: function() {
                        saveOrder();
                    }
                });
                reorderBtn.innerHTML = '<i class="fas fa-check mr-1"></i> Done Reordering';
                reorderBtn.classList.remove('bg-gray-100', 'text-gray-700');
                reorderBtn.classList.add('bg-green-100', 'text-green-700');
            }
        });
    }

    function saveOrder() {
        const rows = sortableList.querySelectorAll('tr');
        const steps = [];
        
        rows.forEach((row, index) => {
            steps.push({
                id: row.dataset.id,
                order: index + 1
            });
        });

        fetch('{{ route("admin.process-steps.reorder") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ steps: steps })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update order numbers in the table
                rows.forEach((row, index) => {
                    row.querySelector('.text-sm.text-gray-900').textContent = index + 1;
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }
});
</script>
@endpush
@endsection
