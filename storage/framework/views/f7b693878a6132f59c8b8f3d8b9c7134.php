<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Admin Dashboard - <?php echo $__env->yieldContent('title', 'Klinik'); ?></title>
    
    <!-- Tailwind CSS -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
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
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navbar -->
        <?php echo $__env->make('layouts.admin.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        
        <div class="flex relative">
            <!-- Sidebar -->
            <?php echo $__env->make('layouts.admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            
            <!-- Main Content -->
            <div class="w-full p-2 md:p-4 overflow-y-auto">
                <div class="container mx-auto py-2 md:py-4">
                    <?php echo $__env->yieldContent('content'); ?>
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
    <script src="<?php echo e(asset('js/alpine-dropdown-fix.js')); ?>"></script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\klinik\resources\views/layouts/admin/app.blade.php ENDPATH**/ ?>