@extends('admin.layouts.app')

@section('title', 'Inquiry Management')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Inquiry Management</h1>
    <p class="text-sm text-gray-600 mt-1">Manage quote requests and customer inquiries</p>
</div>

<!-- Status Filter -->
<div class="bg-white rounded-lg shadow-md p-4 mb-6">
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.inquiries.index') }}" 
            class="px-4 py-2 rounded-lg {{ !request('status') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700' }}">
            All ({{ $stats['total'] }})
        </a>
        <a href="{{ route('admin.inquiries.index', ['status' => 'new']) }}" 
            class="px-4 py-2 rounded-lg {{ request('status') == 'new' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700' }}">
            New ({{ $stats['new'] }})
        </a>
        <a href="{{ route('admin.inquiries.index', ['status' => 'read']) }}" 
            class="px-4 py-2 rounded-lg {{ request('status') == 'read' ? 'bg-yellow-600 text-white' : 'bg-gray-100 text-gray-700' }}">
            Read ({{ $stats['read'] }})
        </a>
        <a href="{{ route('admin.inquiries.index', ['status' => 'replied']) }}" 
            class="px-4 py-2 rounded-lg {{ request('status') == 'replied' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700' }}">
            Replied ({{ $stats['replied'] }})
        </a>
        <a href="{{ route('admin.inquiries.index', ['status' => 'closed']) }}" 
            class="px-4 py-2 rounded-lg {{ request('status') == 'closed' ? 'bg-gray-600 text-white' : 'bg-gray-100 text-gray-700' }}">
            Closed ({{ $stats['closed'] }})
        </a>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    @if($inquiries->count() > 0)
        <div class="divide-y divide-gray-200">
            @foreach($inquiries as $inquiry)
                <div class="p-6 hover:bg-gray-50 transition">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $inquiry->company_name ?? $inquiry->full_name }}</h3>
                                @if($inquiry->status == 'new')
                                    <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full font-medium">New</span>
                                @elseif($inquiry->status == 'read')
                                    <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full font-medium">Read</span>
                                @elseif($inquiry->status == 'replied')
                                    <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full font-medium">Replied</span>
                                @else
                                    <span class="px-2 py-1 text-xs bg-gray-100 text-gray-800 rounded-full font-medium">Closed</span>
                                @endif
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600 mb-3">
                                <div>
                                    <i class="fas fa-user mr-2 text-gray-400"></i>{{ $inquiry->full_name }}
                                </div>
                                <div>
                                    <i class="fas fa-envelope mr-2 text-gray-400"></i>{{ $inquiry->email }}
                                </div>
                                <div>
                                    <i class="fas fa-phone mr-2 text-gray-400"></i>{{ $inquiry->phone }}
                                </div>
                                @if($inquiry->inquiry_type)
                                    <div>
                                        <i class="fas fa-tag mr-2 text-gray-400"></i>{{ ucfirst($inquiry->inquiry_type) }}
                                    </div>
                                @endif
                            </div>

                            @if($inquiry->message)
                                <p class="text-sm text-gray-700 mb-3">{{ Str::limit($inquiry->message, 150) }}</p>
                            @endif

                            @if($inquiry->attachments)
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-paperclip mr-2"></i>
                                    Has attachment
                                </div>
                            @endif
                        </div>

                        <div class="ml-4 text-right text-sm text-gray-500">
                            {{ $inquiry->created_at->diffForHumans() }}
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-3 border-t border-gray-200">
                        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            <i class="fas fa-eye mr-1"></i> View Details
                        </a>
                        
                        @if($inquiry->status == 'new')
                            <form action="{{ route('admin.inquiries.mark-read', $inquiry->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-yellow-600 hover:text-yellow-800 text-sm font-medium">
                                    <i class="fas fa-check mr-1"></i> Mark as Read
                                </button>
                            </form>
                        @endif

                        @if(in_array($inquiry->status, ['new', 'read']))
                            <form action="{{ route('admin.inquiries.mark-replied', $inquiry->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-800 text-sm font-medium">
                                    <i class="fas fa-reply mr-1"></i> Mark as Replied
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" class="inline" onsubmit="return confirm('Delete this inquiry?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                <i class="fas fa-trash mr-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $inquiries->links() }}
        </div>
    @else
        <div class="p-12 text-center">
            <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500">No inquiries found</p>
        </div>
    @endif
</div>
@endsection
