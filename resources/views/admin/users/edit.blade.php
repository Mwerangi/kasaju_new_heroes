@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-2 text-sm text-gray-600 mb-2">
        <a href="{{ route('admin.users.index') }}" class="hover:text-blue-600">Users</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-gray-800">Edit User</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-800">Edit User</h1>
</div>

@if($errors->any())
    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Please fix the following errors:</strong>
        <ul class="mt-2">
            @foreach($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user-circle text-blue-600 mr-3"></i>
                    Basic Information
                </h2>
                
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            required>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            required>
                        <p class="text-xs text-gray-500 mt-1">Must be unique in the system</p>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number
                        </label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            placeholder="+1 (555) 000-0000">
                    </div>
                </div>
            </div>

            <!-- Password Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-lock text-blue-600 mr-3"></i>
                    Change Password
                </h2>
                
                <div class="mb-4 bg-yellow-50 border-l-4 border-yellow-400 p-3">
                    <p class="text-sm text-yellow-800">
                        <i class="fas fa-info-circle mr-1"></i>
                        Leave password fields empty to keep the current password
                    </p>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            New Password
                        </label>
                        <input type="password" id="password" name="password" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Minimum 8 characters (optional)</p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm New Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Role & Permissions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user-shield text-blue-600 mr-3"></i>
                    Role & Permissions
                </h2>
                
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                        Assign Role <span class="text-red-500">*</span>
                    </label>
                    <select id="role" name="role" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                        {{ $user->id === auth()->id() ? 'disabled' : '' }}
                        required>
                        <option value="">Select a role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" 
                                {{ old('role', $user->roles->first()?->name) == $role->name ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    @if($user->id === auth()->id())
                        <p class="text-xs text-yellow-600 mt-1">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            You cannot change your own role
                        </p>
                    @else
                        <p class="text-xs text-gray-500 mt-1">Determines user access levels and permissions</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4 uppercase">Publish</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1" 
                            {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                            {{ $user->id === auth()->id() ? 'disabled' : '' }}
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="is_active" class="ml-2 text-sm text-gray-700">
                            Active User
                        </label>
                    </div>
                    @if($user->id === auth()->id())
                        <p class="text-xs text-yellow-600">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            You cannot deactivate yourself
                        </p>
                    @else
                        <p class="text-xs text-gray-500">Inactive users cannot log in</p>
                    @endif
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition mb-2">
                        <i class="fas fa-save mr-2"></i> Update User
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="block w-full bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-center">
                        <i class="fas fa-times mr-2"></i> Cancel
                    </a>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h4 class="text-xs font-semibold text-gray-700 mb-3 uppercase">User Statistics</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-600">Current Role:</span>
                            <span class="font-medium text-gray-900">
                                {{ $user->roles->first()?->name ?? 'None' }}
                            </span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-600">Member Since:</span>
                            <span class="font-medium text-gray-900">
                                {{ $user->created_at->format('M d, Y') }}
                            </span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-600">Last Updated:</span>
                            <span class="font-medium text-gray-900">
                                {{ $user->updated_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h4 class="text-xs font-semibold text-gray-700 mb-2 uppercase">Help</h4>
                    <ul class="text-xs text-gray-600 space-y-1">
                        <li>• Leave password empty to keep current</li>
                        <li>• Email must be unique</li>
                        <li>• Cannot edit own role/status</li>
                        <li>• Changes take effect immediately</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
