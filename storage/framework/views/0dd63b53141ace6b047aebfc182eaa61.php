<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Klinik</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="bg-gray-100">

    <!-- Fixed Navbar -->
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 shadow-sm">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <!-- Mobile menu button (hidden on desktop) -->
                    <button type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 mr-3" 
                            id="sidebar-toggle">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    
                    <!-- Logo -->
                    <?php if($currentLogo): ?>
                        <img src="<?php echo e(asset('storage/logo/' . $currentLogo->path)); ?>" 
                             alt="Logo Klinik" 
                             class="h-10 w-auto mr-3">
                    <?php else: ?>
                        <div class="h-10 w-10 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                            <span class="text-white font-bold text-xl">K</span>
                        </div>
                    <?php endif; ?>
                    <span class="self-center text-xl font-semibold whitespace-nowrap text-gray-800">Admin Panel</span>
                </div>
                
                <!-- User Menu -->
                <div class="flex items-center">
                    <div class="flex items-center space-x-3">
                        <!-- User Info -->
                        <div class="text-right hidden md:block">
                            <div class="text-sm font-medium text-gray-900"><?php echo e(Auth::user()->name); ?></div>
                            <div class="text-xs text-gray-500"><?php echo e(ucfirst(Auth::user()->role)); ?></div>
                        </div>
                        
                        <!-- User Avatar & Dropdown -->
                        <div class="relative">
                            <button type="button" class="flex items-center space-x-2 text-sm rounded-lg p-2 hover:bg-gray-100 focus:ring-4 focus:ring-gray-300" 
                                    id="user-menu-button" aria-expanded="false">
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-medium text-sm"><?php echo e(substr(Auth::user()->name, 0, 1)); ?></span>
                                </div>
                                <!-- Dropdown icon -->
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- Dropdown menu -->
                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow-lg absolute right-0" 
                                 id="dropdown-user">
                                <div class="px-4 py-3">
                                    <p class="text-sm text-gray-900"><?php echo e(Auth::user()->name); ?></p>
                                    <p class="text-sm font-medium text-gray-900 truncate"><?php echo e(Auth::user()->email); ?></p>
                                </div>
                                <ul class="py-1">
                                    <li>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                    </li>
                                    <li>
                                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="block">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" 
                                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                    onclick="return confirm('Yakin ingin logout?')">
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Fixed Sidebar -->
    <aside class="fixed top-0 left-0 z-40 w-64 h-screen pt-24 bg-white border-r border-gray-200 transform transition-transform -translate-x-full md:translate-x-0" 
           id="logo-sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium">
                <!-- Dashboard -->
                <li>
                    <a href="/dashboard" 
                       class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" 
                             fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>

                <!-- Content Section -->
                <li class="pt-4">
                    <div class="flex items-center p-2 text-xs font-medium text-gray-400 uppercase">
                        Content
                    </div>
                </li>
                <li>
                    <a href="/admin/pages" 
                       class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group pl-8">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" 
                             fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-3">Halaman</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/articles" 
                       class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group pl-8">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" 
                             fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-3">Artikel & Berita</span>
                    </a>
                </li>

                <!-- User Section -->
                <li class="pt-4">
                    <div class="flex items-center p-2 text-xs font-medium text-gray-400 uppercase">
                        User
                    </div>
                </li>
                <li>
                    <a href="/admin/users" 
                       class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group pl-8">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" 
                             fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                        </svg>
                        <span class="ml-3">Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/patients" 
                       class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group pl-8">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" 
                             fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-3">Pasien</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Mobile overlay -->
    <div class="fixed inset-0 z-30 bg-gray-900 bg-opacity-50 md:hidden hidden" id="sidebar-overlay"></div>

    <!-- Main Content -->
    <div class="p-4 md:ml-64">
        <div class="pt-20">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <!-- Success Message -->
    <?php if(session('success')): ?>
        <div id="successAlert" class="fixed top-20 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg z-50">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <?php echo e(session('success')); ?>

            </div>
        </div>
    <?php endif; ?>

    <script>
        // Wait for DOM content to load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing...');
            
            // Get elements
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('logo-sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const userMenuButton = document.getElementById('user-menu-button');
            const dropdown = document.getElementById('dropdown-user');
            
            console.log('Found elements:', {
                sidebarToggle: sidebarToggle ? 'YES' : 'NO',
                sidebar: sidebar ? 'YES' : 'NO', 
                sidebarOverlay: sidebarOverlay ? 'YES' : 'NO'
            });

            // Mobile sidebar toggle
            if (sidebarToggle && sidebar && sidebarOverlay) {
                sidebarToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('🍔 Hamburger clicked!');
                    
                    // Toggle sidebar visibility
                    const isHidden = sidebar.classList.contains('-translate-x-full');
                    
                    if (isHidden) {
                        // Show sidebar
                        sidebar.classList.remove('-translate-x-full');
                        sidebarOverlay.classList.remove('hidden');
                        console.log('📱 Sidebar OPENED');
                    } else {
                        // Hide sidebar  
                        sidebar.classList.add('-translate-x-full');
                        sidebarOverlay.classList.add('hidden');
                        console.log('📱 Sidebar CLOSED');
                    }
                });

                // Close sidebar when clicking overlay
                sidebarOverlay.addEventListener('click', function() {
                    console.log('👆 Overlay clicked - closing sidebar');
                    sidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                });
            } else {
                console.error('❌ Sidebar toggle elements not found!');
            }

            // User dropdown functionality
            if (userMenuButton && dropdown) {
                userMenuButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    dropdown.classList.toggle('hidden');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!userMenuButton.contains(event.target) && !dropdown.contains(event.target)) {
                        dropdown.classList.add('hidden');
                    }
                });
            }

            // Auto-hide success messages
            const successAlert = document.getElementById('successAlert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.transition = 'opacity 0.5s';
                    successAlert.style.opacity = '0';
                    setTimeout(() => successAlert.remove(), 500);
                }, 3000);
            }
        });
    </script>

</body>
</html><?php /**PATH C:\xampp\htdocs\klinik\resources\views/layouts/admin.blade.php ENDPATH**/ ?>