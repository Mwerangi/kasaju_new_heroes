<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name') }}</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white overflow-y-auto">
            <div class="p-4 border-b border-gray-700">
                <h1 class="text-xl font-bold">New Heroes CMS</h1>
            </div>
            
            <nav class="p-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 mb-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-home mr-3"></i> Dashboard
                </a>
                
                <!-- Pages -->
                <div class="mb-2">
                    <button onclick="toggleMenu('pages')" class="flex items-center justify-between w-full px-4 py-3 rounded hover:bg-gray-700">
                        <span><i class="fas fa-file-alt mr-3"></i> Pages</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div id="pages-menu" class="ml-4 hidden">
                        <a href="{{ route('admin.pages.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">All Pages</a>
                    </div>
                </div>
                
                <!-- Services -->
                <div class="mb-2">
                    <button onclick="toggleMenu('services')" class="flex items-center justify-between w-full px-4 py-3 rounded hover:bg-gray-700">
                        <span><i class="fas fa-briefcase mr-3"></i> Services</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div id="services-menu" class="ml-4 hidden">
                        <a href="{{ route('admin.services.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">All Services</a>
                        <a href="{{ route('admin.services.create') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Add Service</a>
                    </div>
                </div>
                
                <!-- Process Steps -->
                <a href="{{ route('admin.process-steps.index') }}" class="flex items-center px-4 py-3 mb-2 rounded hover:bg-gray-700">
                    <i class="fas fa-tasks mr-3"></i> Process Steps
                </a>
                
                <!-- Gallery -->
                <div class="mb-2">
                    <button onclick="toggleMenu('gallery')" class="flex items-center justify-between w-full px-4 py-3 rounded hover:bg-gray-700">
                        <span><i class="fas fa-images mr-3"></i> Gallery</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div id="gallery-menu" class="ml-4 hidden">
                        <a href="{{ route('admin.galleries.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">All Images</a>
                        <a href="{{ route('admin.gallery-categories.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Categories</a>
                    </div>
                </div>
                
                <!-- Testimonials -->
                <a href="{{ route('admin.testimonials.index') }}" class="flex items-center px-4 py-3 mb-2 rounded hover:bg-gray-700">
                    <i class="fas fa-quote-left mr-3"></i> Testimonials
                </a>
                
                <!-- Blog -->
                <div class="mb-2">
                    <button onclick="toggleMenu('blog')" class="flex items-center justify-between w-full px-4 py-3 rounded hover:bg-gray-700">
                        <span><i class="fas fa-blog mr-3"></i> Blog</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div id="blog-menu" class="ml-4 hidden">
                        <a href="{{ route('admin.blog-posts.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">All Posts</a>
                        <a href="{{ route('admin.blog-posts.create') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Add Post</a>
                        <a href="{{ route('admin.blog-categories.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Categories</a>
                    </div>
                </div>
                
                <!-- Inquiries -->
                <a href="{{ route('admin.inquiries.index') }}" class="flex items-center px-4 py-3 mb-2 rounded hover:bg-gray-700">
                    <i class="fas fa-envelope mr-3"></i> Inquiries
                </a>
                
                <!-- Contact Info -->
                <a href="{{ route('admin.contact-info.index') }}" class="flex items-center px-4 py-3 mb-2 rounded hover:bg-gray-700">
                    <i class="fas fa-address-book mr-3"></i> Contact Info
                </a>
                
                <!-- Downloads -->
                <a href="{{ route('admin.downloads.index') }}" class="flex items-center px-4 py-3 mb-2 rounded hover:bg-gray-700">
                    <i class="fas fa-download mr-3"></i> Downloads
                </a>
                
                <!-- Media Library -->
                <a href="{{ route('admin.media.index') }}" class="flex items-center px-4 py-3 mb-2 rounded hover:bg-gray-700">
                    <i class="fas fa-photo-video mr-3"></i> Media Library
                </a>
                
                <!-- Settings -->
                <div class="mb-2">
                    <button onclick="toggleMenu('settings')" class="flex items-center justify-between w-full px-4 py-3 rounded hover:bg-gray-700">
                        <span><i class="fas fa-cog mr-3"></i> Settings</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div id="settings-menu" class="ml-4 hidden">
                        <a href="{{ route('admin.site-settings.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Site Settings</a>
                        <a href="{{ route('admin.seo-settings.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">SEO Settings</a>
                    </div>
                </div>
                
                @role('super-admin')
                <!-- Users -->
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 mb-2 rounded hover:bg-gray-700">
                    <i class="fas fa-users mr-3"></i> Users
                </a>
                
                <!-- Activity Logs -->
                <a href="{{ route('admin.activity-logs.index') }}" class="flex items-center px-4 py-3 mb-2 rounded hover:bg-gray-700">
                    <i class="fas fa-history mr-3"></i> Activity Logs
                </a>
                @endrole
            </nav>
        </aside>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between p-4">
                    <h2 class="text-2xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                    
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('home') }}" target="_blank" class="text-gray-600 hover:text-gray-800">
                            <i class="fas fa-external-link-alt mr-2"></i>View Website
                        </a>
                        
                        <div class="relative">
                            <button onclick="toggleMenu('profile')" class="flex items-center text-gray-700 hover:text-gray-900">
                                <span class="mr-2">{{ auth()->user()->name }}</span>
                                <i class="fas fa-user-circle text-2xl"></i>
                            </button>
                            <div id="profile-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                                <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user mr-2"></i>Profile
                                </a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-3" style="max-width: 400px;">
    </div>
    
    <!-- Toast Notifications -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('success') }}', 'success');
            });
        </script>
    @endif
    
    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('error') }}', 'error');
            });
        </script>
    @endif
    
    @if(session('info'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('info') }}', 'info');
            });
        </script>
    @endif
    
    @if(session('warning'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('warning') }}', 'warning');
            });
        </script>
    @endif
    
    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @foreach($errors->all() as $error)
                    showToast('{{ $error }}', 'error');
                @endforeach
            });
        </script>
    @endif
    
    <style>
        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
        
        .toast-enter {
            animation: slideInRight 0.3s ease-out;
        }
        
        .toast-exit {
            animation: slideOutRight 0.3s ease-in;
        }
        
        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            background: rgba(255, 255, 255, 0.7);
            animation: progressBar 5s linear;
        }
        
        @keyframes progressBar {
            from {
                width: 100%;
            }
            to {
                width: 0%;
            }
        }
    </style>
    
    <script>
        function showToast(message, type = 'info', duration = 5000) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = 'toast-enter relative bg-white rounded-lg shadow-2xl p-4 mb-3 border-l-4 transform transition-all hover:scale-105';
            
            // Determine icon, colors based on type
            let icon, borderColor, iconColor, bgColor;
            switch(type) {
                case 'success':
                    icon = 'fa-check-circle';
                    borderColor = 'border-green-500';
                    iconColor = 'text-green-500';
                    bgColor = 'bg-green-50';
                    break;
                case 'error':
                    icon = 'fa-times-circle';
                    borderColor = 'border-red-500';
                    iconColor = 'text-red-500';
                    bgColor = 'bg-red-50';
                    break;
                case 'warning':
                    icon = 'fa-exclamation-triangle';
                    borderColor = 'border-yellow-500';
                    iconColor = 'text-yellow-500';
                    bgColor = 'bg-yellow-50';
                    break;
                case 'info':
                default:
                    icon = 'fa-info-circle';
                    borderColor = 'border-blue-500';
                    iconColor = 'text-blue-500';
                    bgColor = 'bg-blue-50';
                    break;
            }
            
            toast.classList.add(borderColor);
            
            toast.innerHTML = `
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0">
                        <i class="fas ${icon} ${iconColor} text-xl"></i>
                    </div>
                    <div class="flex-1 pt-0.5">
                        <p class="text-gray-800 text-sm font-medium">${message}</p>
                    </div>
                    <button onclick="dismissToast(this)" class="flex-shrink-0 text-gray-400 hover:text-gray-600 transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="toast-progress"></div>
            `;
            
            container.appendChild(toast);
            
            // Auto dismiss after duration
            setTimeout(() => {
                dismissToast(toast);
            }, duration);
        }
        
        function dismissToast(element) {
            const toast = element.classList ? element : element.closest('.toast-enter');
            if (toast) {
                toast.classList.remove('toast-enter');
                toast.classList.add('toast-exit');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }
        }
        
        function toggleMenu(menuId) {
            const menu = document.getElementById(menuId + '-menu');
            if (menu) {
                menu.classList.toggle('hidden');
            }
        }
    </script>
    
    @stack('scripts')
</body>
</html>
        </div>
    </div>
    
    <script>
        function toggleMenu(menuId) {
            const menu = document.getElementById(menuId + '-menu');
            if (menu) {
                menu.classList.toggle('hidden');
            }
        }
    </script>
    
    @stack('scripts')
</body>
</html>
