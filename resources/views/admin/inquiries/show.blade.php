@extends('admin.layouts.app')

@section('title', 'Inquiry Details')

@section('content')
<div class="mb-6">
    <div class="flex items-center text-sm text-gray-600 mb-4">
        <a href="{{ route('admin.inquiries.index') }}" class="hover:text-blue-600">Inquiries</a>
        <i class="fas fa-chevron-right mx-2 text-xs"></i>
        <span class="text-gray-900">#{{ $inquiry->id }}</span>
    </div>
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Inquiry Details</h1>
        @if($inquiry->status == 'new')
            <span class="px-3 py-1 text-sm bg-blue-100 text-blue-800 rounded-full font-medium">New</span>
        @elseif($inquiry->status == 'read')
            <span class="px-3 py-1 text-sm bg-yellow-100 text-yellow-800 rounded-full font-medium">Read</span>
        @elseif($inquiry->status == 'replied')
            <span class="px-3 py-1 text-sm bg-green-100 text-green-800 rounded-full font-medium">Replied</span>
        @else
            <span class="px-3 py-1 text-sm bg-gray-100 text-gray-800 rounded-full font-medium">Closed</span>
        @endif
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Contact Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Contact Information</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Full Name</label>
                    <p class="text-gray-900">{{ $inquiry->full_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Company</label>
                    <p class="text-gray-900">{{ $inquiry->company_name ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                    <p class="text-gray-900">
                        <a href="mailto:{{ $inquiry->email }}" class="text-blue-600 hover:underline">{{ $inquiry->email }}</a>
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Phone</label>
                    <p class="text-gray-900">
                        <a href="tel:{{ $inquiry->phone }}" class="text-blue-600 hover:underline">{{ $inquiry->phone }}</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Inquiry Details -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Inquiry Details</h2>
            <div class="space-y-4">
                @if($inquiry->inquiry_type)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Inquiry Type</label>
                        <p class="text-gray-900">{{ ucfirst($inquiry->inquiry_type) }}</p>
                    </div>
                @endif

                @if($inquiry->cargo_description)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Cargo Description</label>
                        <p class="text-gray-900">{{ $inquiry->cargo_description }}</p>
                    </div>
                @endif

                @if($inquiry->origin_country || $inquiry->destination_country)
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Origin Country</label>
                            <p class="text-gray-900">{{ $inquiry->origin_country ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Destination Country</label>
                            <p class="text-gray-900">{{ $inquiry->destination_country ?? '-' }}</p>
                        </div>
                    </div>
                @endif

                @if($inquiry->message)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Message</label>
                        <div class="p-4 bg-gray-50 rounded-lg text-gray-900 whitespace-pre-wrap">{{ $inquiry->message }}</div>
                    </div>
                @endif

                @if($inquiry->attachments)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Attachments</label>
                        <a href="{{ asset('storage/' . $inquiry->attachments) }}" target="_blank" 
                            class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100">
                            <i class="fas fa-paperclip mr-2"></i>
                            View Attachment
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Actions -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Actions</h2>
            <div class="space-y-3">
                @if(in_array($inquiry->status, ['new', 'read']))
                    <form action="{{ route('admin.inquiries.mark-replied', $inquiry->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            <i class="fas fa-reply mr-2"></i> Mark as Replied
                        </button>
                    </form>
                @endif

                <a href="mailto:{{ $inquiry->email }}" class="block w-full px-4 py-2 bg-blue-600 text-white text-center rounded-lg hover:bg-blue-700">
                    <i class="fas fa-envelope mr-2"></i> Send Email
                </a>

                <a href="tel:{{ $inquiry->phone }}" class="block w-full px-4 py-2 bg-gray-100 text-gray-700 text-center rounded-lg hover:bg-gray-200">
                    <i class="fas fa-phone mr-2"></i> Call
                </a>

                <a href="{{ route('admin.inquiries.index') }}" class="block w-full px-4 py-2 bg-gray-100 text-gray-700 text-center rounded-lg hover:bg-gray-200">
                    <i class="fas fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>
        </div>

        <!-- Meta Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Information</h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Submitted:</span>
                    <span class="font-medium">{{ $inquiry->created_at->format('M d, Y H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Last Updated:</span>
                    <span class="font-medium">{{ $inquiry->updated_at->format('M d, Y H:i') }}</span>
                </div>
                @if($inquiry->assignedTo)
                    <div class="flex justify-between">
                        <span class="text-gray-500">Assigned To:</span>
                        <span class="font-medium">{{ $inquiry->assignedTo->name }}</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Delete -->
        <div class="bg-white rounded-lg shadow-md p-6 border-2 border-red-200">
            <h2 class="text-lg font-semibold text-red-600 mb-2">Delete Inquiry</h2>
            <p class="text-sm text-gray-600 mb-4">This action cannot be undone.</p>
            <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this inquiry?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    <i class="fas fa-trash mr-2"></i> Delete Inquiry
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
