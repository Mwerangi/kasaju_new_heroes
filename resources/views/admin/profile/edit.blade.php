@extends('admin.layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">My Profile</h1>
    <p class="text-sm text-gray-600 mt-1">Manage your account settings</p>
</div>

@if(session('success'))
    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

@if($errors->any())
    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Profile Information -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Profile Information</h2>
        
        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-save mr-2"></i> Update Profile
                </button>
            </div>
        </form>
    </div>

    <!-- Change Password -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Change Password</h2>
        
        <form action="{{ route('admin.profile.password') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Password *</label>
                    <input type="password" name="current_password" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">New Password *</label>
                    <input type="password" name="password" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                        required>
                    <p class="mt-1 text-xs text-gray-500">Minimum 8 characters</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password *</label>
                    <input type="password" name="password_confirmation" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                        required>
                </div>

                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-key mr-2"></i> Update Password
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Account Information -->
<div class="mt-6 bg-white rounded-lg shadow-md p-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Account Information</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-2">Role</label>
            <div class="text-lg font-semibold text-gray-900">
                @if($user->roles->count() > 0)
                    {{ $user->roles->first()->name }}
                @else
                    User
                @endif
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-2">Member Since</label>
            <div class="text-lg font-semibold text-gray-900">{{ $user->created_at->format('M d, Y') }}</div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-2">Last Updated</label>
            <div class="text-lg font-semibold text-gray-900">{{ $user->updated_at->diffForHumans() }}</div>
        </div>
    </div>
</div>
@endsection
