<nav class="bg-white shadow-md relative z-40">
    <div class="max-w-full mx-auto px-6">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Mobile menu button -->
                <button id="open-sidebar" class="mr-2 md:hidden text-gray-600 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex-shrink-0 flex items-center">
                    <?php if(isset($currentLogo) && $currentLogo): ?>
                        <img src="<?php echo e($currentLogo->url); ?>" alt="Al-Fatih Center Logo" class="h-10 w-auto mr-3">
                    <?php else: ?>
                        <img src="<?php echo e(asset('images/logo-default.png')); ?>" alt="Al-Fatih Center Logo" class="h-10 w-auto mr-3">
                    <?php endif; ?>
                    <span class="text-xl font-bold text-blue-600">Alfatih Center</span>
                </div>
            </div>
            
            <div class="flex items-center">
                <div class="ml-3 relative">
                    <div>
                        <button type="button" class="flex items-center max-w-xs bg-white rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white">
                                    <?php echo e(substr(Auth::user()->name ?? 'Terapis', 0, 1)); ?>

                                </div>
                                <span class="ml-3 text-gray-700"><?php echo e(Auth::user()->name ?? 'Terapis'); ?></span>
                                <i class="fas fa-chevron-down ml-1 text-gray-500 text-xs"></i>
                            </div>
                        </button>
                    </div>
                    
                    <!-- Dropdown menu, show/hide based on menu state -->
                    <div class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" id="user-dropdown" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <a href="<?php echo e(route('terapis.profile.show')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sidebar toggle functionality
        const openBtn = document.getElementById('open-sidebar');
        const closeBtn = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('sidebar');

        if (openBtn) {
            openBtn.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
            });
        }
        
        // Toggle dropdown menu
        const menuButton = document.getElementById('user-menu-button');
        const dropdown = document.getElementById('user-dropdown');
        
        menuButton.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent event from bubbling to document
            dropdown.classList.toggle('hidden');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            // Only handle dropdown closing here, not sidebar
            if (dropdown && !dropdown.classList.contains('hidden') && 
                !menuButton.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
</script><?php /**PATH C:\xampp2\htdocs\klinik\resources\views/layouts/terapis/navbar.blade.php ENDPATH**/ ?>