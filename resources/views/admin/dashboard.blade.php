@extends('admin.layouts.app')

@section('page-title', 'Dashboard')

@section('content')
<!-- Quick Actions -->
<div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 mb-6 text-white">
    <h3 class="text-lg font-semibold mb-4"><i class="fas fa-bolt mr-2"></i>Quick Actions</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.blog-posts.create') }}" class="bg-white/20 hover:bg-white/30 rounded-lg p-4 text-center transition duration-200">
            <i class="fas fa-plus-circle text-2xl mb-2"></i>
            <p class="text-sm font-medium">New Blog Post</p>
        </a>
        <a href="{{ route('admin.services.create') }}" class="bg-white/20 hover:bg-white/30 rounded-lg p-4 text-center transition duration-200">
            <i class="fas fa-briefcase text-2xl mb-2"></i>
            <p class="text-sm font-medium">Add Service</p>
        </a>
        <a href="{{ route('admin.galleries.create') }}" class="bg-white/20 hover:bg-white/30 rounded-lg p-4 text-center transition duration-200">
            <i class="fas fa-image text-2xl mb-2"></i>
            <p class="text-sm font-medium">Upload Image</p>
        </a>
        <a href="{{ route('admin.inquiries.index') }}" class="bg-white/20 hover:bg-white/30 rounded-lg p-4 text-center transition duration-200">
            <i class="fas fa-envelope text-2xl mb-2"></i>
            <p class="text-sm font-medium">View Inquiries</p>
        </a>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- New Inquiries -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">New Inquiries</p>
                <p class="text-3xl font-bold text-blue-600">{{ $stats['new_inquiries'] }}</p>
                <p class="text-xs text-gray-500 mt-1">of {{ $stats['total_inquiries'] }} total</p>
            </div>
            <div class="bg-blue-100 rounded-full p-3">
                <i class="fas fa-envelope text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Services -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Active Services</p>
                <p class="text-3xl font-bold text-green-600">{{ $stats['total_services'] }}</p>
                <p class="text-xs text-gray-500 mt-1">services offered</p>
            </div>
            <div class="bg-green-100 rounded-full p-3">
                <i class="fas fa-briefcase text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Blog Posts -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Published Posts</p>
                <p class="text-3xl font-bold text-purple-600">{{ $stats['published_posts'] }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ $stats['draft_posts'] }} drafts</p>
            </div>
            <div class="bg-purple-100 rounded-full p-3">
                <i class="fas fa-blog text-purple-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Gallery Images -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Gallery Images</p>
                <p class="text-3xl font-bold text-yellow-600">{{ $stats['gallery_images'] }}</p>
                <p class="text-xs text-gray-500 mt-1">active images</p>
            </div>
            <div class="bg-yellow-100 rounded-full p-3">
                <i class="fas fa-images text-yellow-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Active Users -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Active Users</p>
                <p class="text-3xl font-bold text-indigo-600">{{ $stats['total_users'] }}</p>
                <p class="text-xs text-gray-500 mt-1">team members</p>
            </div>
            <div class="bg-indigo-100 rounded-full p-3">
                <i class="fas fa-users text-indigo-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Testimonials</p>
                <p class="text-3xl font-bold text-pink-600">{{ $stats['testimonials'] }}</p>
                <p class="text-xs text-gray-500 mt-1">active reviews</p>
            </div>
            <div class="bg-pink-100 rounded-full p-3">
                <i class="fas fa-star text-pink-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Inquiry Status Distribution -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition duration-200 md:col-span-2">
        <h4 class="text-sm text-gray-500 mb-4 font-semibold"><i class="fas fa-chart-pie mr-2"></i>Inquiry Status Distribution</h4>
        <div class="grid grid-cols-2 gap-4">
            <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                <div class="w-4 h-4 bg-blue-500 rounded-full mr-3"></div>
                <div>
                    <p class="text-xs text-gray-500">New</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $inquiryStats['new'] }}</p>
                </div>
            </div>
            <div class="flex items-center p-3 bg-yellow-50 rounded-lg">
                <div class="w-4 h-4 bg-yellow-500 rounded-full mr-3"></div>
                <div>
                    <p class="text-xs text-gray-500">Read</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $inquiryStats['read'] }}</p>
                </div>
            </div>
            <div class="flex items-center p-3 bg-green-50 rounded-lg">
                <div class="w-4 h-4 bg-green-500 rounded-full mr-3"></div>
                <div>
                    <p class="text-xs text-gray-500">Replied</p>
                    <p class="text-2xl font-bold text-green-600">{{ $inquiryStats['replied'] }}</p>
                </div>
            </div>
            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                <div class="w-4 h-4 bg-gray-500 rounded-full mr-3"></div>
                <div>
                    <p class="text-xs text-gray-500">Closed</p>
                    <p class="text-2xl font-bold text-gray-600">{{ $inquiryStats['closed'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <!-- Recent Inquiries -->
    <div class="bg-white rounded-lg shadow lg:col-span-2">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold"><i class="fas fa-envelope-open-text mr-2 text-blue-600"></i>Recent Inquiries</h3>
            <a href="{{ route('admin.inquiries.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                View All <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse($recentInquiries as $inquiry)
                    <div class="flex items-start justify-between pb-4 border-b last:border-0 hover:bg-gray-50 p-2 rounded transition duration-150">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800">{{ $inquiry->full_name }}</h4>
                            <p class="text-sm text-gray-600"><i class="fas fa-envelope text-xs mr-1"></i>{{ $inquiry->email }}</p>
                            @if($inquiry->phone)
                                <p class="text-sm text-gray-600"><i class="fas fa-phone text-xs mr-1"></i>{{ $inquiry->phone }}</p>
                            @endif
                            <p class="text-xs text-gray-500 mt-1"><i class="fas fa-clock text-xs mr-1"></i>{{ $inquiry->created_at->diffForHumans() }}</p>
                        </div>
                        <div>
                            @php
                                $statusColors = [
                                    'new' => 'bg-blue-100 text-blue-800',
                                    'read' => 'bg-yellow-100 text-yellow-800',
                                    'replied' => 'bg-green-100 text-green-800',
                                    'closed' => 'bg-gray-100 text-gray-800',
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$inquiry->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($inquiry->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-8">
                        <i class="fas fa-inbox text-4xl text-gray-300 mb-2"></i><br>
                        No inquiries yet
                    </p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Blog Posts -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold"><i class="fas fa-blog mr-2 text-purple-600"></i>Recent Posts</h3>
            <a href="{{ route('admin.blog-posts.index') }}" class="text-sm text-purple-600 hover:text-purple-800">
                View All <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse($recentPosts as $post)
                    <div class="pb-4 border-b last:border-0">
                        <h4 class="font-semibold text-sm text-gray-800 line-clamp-2">{{ $post->title }}</h4>
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-user text-xs mr-1"></i>{{ $post->author?->name ?? 'Unknown' }}
                        </p>
                        <p class="text-xs text-gray-500">
                            <i class="fas fa-clock text-xs mr-1"></i>{{ $post->created_at->diffForHumans() }}
                        </p>
                        @if($post->is_published)
                            <span class="inline-block mt-1 px-2 py-0.5 bg-green-100 text-green-800 text-xs rounded">Published</span>
                        @else
                            <span class="inline-block mt-1 px-2 py-0.5 bg-yellow-100 text-yellow-800 text-xs rounded">Draft</span>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">No posts yet</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b">
        <h3 class="text-lg font-semibold"><i class="fas fa-history mr-2 text-gray-600"></i>Recent Activity</h3>
    </div>
    <div class="p-6">
        <div class="space-y-4">
            @forelse($recentActivities as $activity)
                <div class="flex items-start pb-4 border-b last:border-0">
                    <div class="bg-gray-100 rounded-full p-2 mr-3 flex-shrink-0">
                        <i class="fas fa-history text-gray-600"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm">
                            <span class="font-semibold text-gray-800">{{ $activity->user?->name ?? 'System' }}</span>
                            <span class="text-gray-600">{{ $activity->description }}</span>
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-clock text-xs mr-1"></i>{{ $activity->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-4">No recent activity</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
