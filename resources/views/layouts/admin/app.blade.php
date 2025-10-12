<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - @yield('title', 'Klinik')</title>
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js for interactive components -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    
    <!-- Additional Styles -->
    <style>
        .sidebar {
            min-height: calc(100vh - 64px);
        }
        
        /* Fix for dropdowns at the bottom of the page */
        .dropdown-menu-up {
            bottom: 100%;
            top: auto !important;
            margin-bottom: 0.5rem;
        }
        
        /* Fix for forms in dropdown menus */
        .update-status-form {
            margin: 0;
            padding: 0;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                min-height: 100vh;
                height: 100%;
                top: 0;
                padding-top: 1rem;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
        }
        
        /* For devices with "notch" */
        @supports (padding-top: env(safe-area-inset-top)) {
            .sidebar {
                padding-top: max(1rem, env(safe-area-inset-top));
                padding-left: env(safe-area-inset-left);
            }
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navbar -->
        @include('layouts.admin.navbar')
        
        <div class="flex relative">
            <!-- Sidebar -->
            @include('layouts.admin.sidebar')
            
            <!-- Main Content -->
            <div class="w-full p-2 md:p-4 overflow-y-auto">
                <div class="container mx-auto py-2 md:py-4">
                    @yield('content')
                </div>
            </div>
        </div>
        
        <!-- Overlay for mobile sidebar -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black opacity-50 z-20 hidden md:hidden"></div>
    </div>
    
    <!-- Sidebar Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('mobile-sidebar-toggle');
            const closeSidebar = document.getElementById('close-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            // Toggle sidebar
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
                document.body.classList.toggle('overflow-hidden');
            });
            
            // Close sidebar
            closeSidebar.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            });
            
            // Close sidebar when clicking on overlay
            overlay.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) { // md breakpoint
                    overlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
        });
    </script>
    
    <!-- Alpine.js dropdown fix script -->
    <script src="{{ asset('js/alpine-dropdown-fix.js') }}"></script>
    
    @stack('scripts')
    @yield('scripts')
</body>
</html>