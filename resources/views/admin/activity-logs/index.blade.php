@extends('admin.layouts.app')

@section('title', 'Activity Logs')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Activity Logs</h1>
    <p class="text-sm text-gray-600 mt-1">System activity and user actions log</p>
</div>

<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <form method="GET" class="flex gap-4">
        <div class="flex-1">
            <select name="action" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">All Actions</option>
                <option value="created" {{ request('action') == 'created' ? 'selected' : '' }}>Created</option>
                <option value="updated" {{ request('action') == 'updated' ? 'selected' : '' }}>Updated</option>
                <option value="deleted" {{ request('action') == 'deleted' ? 'selected' : '' }}>Deleted</option>
            </select>
        </div>
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            <i class="fas fa-filter mr-2"></i> Filter
        </button>
        <a href="{{ route('admin.activity-logs.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
            <i class="fas fa-redo mr-2"></i> Reset
        </a>
    </form>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    @if($logs->count() > 0)
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Model</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($logs as $log)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $log->created_at->format('M d, Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $log->user ? $log->user->name : 'System' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($log->action == 'created')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-plus-circle"></i> Created
                                </span>
                            @elseif($log->action == 'updated')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <i class="fas fa-edit"></i> Updated
                                </span>
                            @elseif($log->action == 'deleted')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-trash"></i> Deleted
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ ucfirst($log->action) }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $log->description }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            @if($log->model_type)
                                <code class="text-xs bg-gray-100 px-2 py-1 rounded">{{ class_basename($log->model_type) }}</code>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="px-6 py-4 border-t">
            {{ $logs->links() }}
        </div>
    @else
        <div class="p-12 text-center text-gray-500">
            <i class="fas fa-history text-5xl mb-4"></i>
            <p class="text-lg">No activity logs found.</p>
        </div>
    @endif
</div>
@endsection
