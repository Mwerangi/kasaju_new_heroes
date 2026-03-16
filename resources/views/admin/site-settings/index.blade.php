@extends('admin.layouts.app')

@section('title', 'Site Settings')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Site Settings</h1>
    <p class="text-sm text-gray-600 mt-1">Manage general website settings and configuration</p>
</div>

@if(session('success'))
    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<form action="{{ route('admin.site-settings.update') }}" method="POST">
    @csrf
    
    <div class="space-y-6">
        @if($settings->count() > 0)
            @foreach($settings as $group => $groupSettings)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 capitalize flex items-center">
                        <i class="fas fa-cog text-blue-600 mr-3"></i>
                        {{ str_replace('_', ' ', $group) }} Settings
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($groupSettings as $setting)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ str_replace('_', ' ', ucfirst($setting->label ?? $setting->key)) }}
                                </label>
                                <input type="text" name="settings[{{ $setting->key }}]" 
                                    value="{{ $setting->value }}" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <i class="fas fa-cogs text-5xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">No settings configured yet.</p>
                <p class="text-gray-400 text-sm mt-2">Settings will appear here once configured in the database.</p>
            </div>
        @endif
    </div>

    @if($settings->count() > 0)
        <div class="mt-6 flex justify-end gap-4">
            <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                <i class="fas fa-times mr-2"></i> Cancel
            </a>
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-lg font-semibold">
                <i class="fas fa-save mr-2"></i> Save All Settings
            </button>
        </div>
    @endif
</form>
@endsection
