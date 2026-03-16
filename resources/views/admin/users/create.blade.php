@extends('admin.layouts.app')

@section('title', 'Create User')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-2 text-sm text-gray-600 mb-2">
        <a href="{{ route('admin.users.index') }}" class="hover:text-blue-600">Users</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-gray-800">Create New User</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-800">Create New User</h1>
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

<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    
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
                        <input type="text" id="name" name="name" value="{{ old('name') }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            required>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            required>
                        <p class="text-xs text-gray-500 mt-1">Must be unique in the system</p>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number
                        </label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            placeholder="+1 (555) 000-0000">
                    </div>
                </div>
            </div>

            <!-- Password Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-lock text-blue-600 mr-3"></i>
                    Password
                </h2>
                
                <div class="space-y-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="password" name="password" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            required>
                        <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            required>
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
                        required>
                        <option value="">Select a role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Determines user access levels and permissions</p>
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
                            {{ old('is_active', 1) ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="is_active" class="ml-2 text-sm text-gray-700">
                            Active User
                        </label>
                    </div>
                    <p class="text-xs text-gray-500">Inactive users cannot log in</p>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition mb-2">
                        <i class="fas fa-save mr-2"></i> Create User
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="block w-full bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-center">
                        <i class="fas fa-times mr-2"></i> Cancel
                    </a>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h4 class="text-xs font-semibold text-gray-700 mb-2 uppercase">Help</h4>
                    <ul class="text-xs text-gray-600 space-y-1">
                        <li>• All fields marked with * are required</li>
                        <li>• Email must be unique</li>
                        <li>• Password minimum 8 characters</li>
                        <li>• User will receive login credentials</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
