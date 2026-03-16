@extends('admin.layouts.app')

@section('title', 'Manage Pages')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manage Pages</h1>
        <p class="text-sm text-gray-600 mt-1">Manage website pages and their content sections</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <div class="text-sm text-gray-600">
            <span class="font-semibold">{{ $pages->total() }}</span> total pages
        </div>
    </div>

    @if($pages->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Page</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sections</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Updated</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($pages as $page)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded bg-blue-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-file-alt text-blue-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $page->title }}</div>
                                        @if($page->meta_title)
                                            <div class="text-xs text-gray-500">{{ Str::limit($page->meta_title, 40) }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <code class="text-sm text-gray-600 bg-gray-100 px-2 py-1 rounded">{{ $page->slug }}</code>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900">{{ $page->sections->count() }} sections</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($page->is_active)
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Active
                                    </span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        <i class="fas fa-times-circle mr-1"></i> Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $page->updated_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.pages.edit', $page) }}" class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route($page->slug) }}" target="_blank" class="text-green-600 hover:text-green-900" title="View Page">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($pages->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $pages->links() }}
            </div>
        @endif
    @else
        <div class="p-12 text-center">
            <i class="fas fa-file-alt text-gray-300 text-6xl mb-4"></i>
            <p class="text-gray-500 text-lg mb-2">No pages found</p>
            <p class="text-sm text-gray-400">Pages are system-managed content areas</p>
        </div>
    @endif
</div>
@endsection
