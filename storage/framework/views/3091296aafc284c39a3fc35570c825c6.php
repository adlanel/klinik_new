<div id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-gray-800 text-white sidebar transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-30 md:relative">
    <div class="px-4 py-6">
        <div class="md:hidden absolute right-4 top-4">
            <button id="close-sidebar" class="text-white hover:text-gray-300">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="flex items-center justify-center pb-6 border-b border-gray-700">
            <h2 class="text-xl font-semibold">Terapis Panel</h2>
        </div>
        
        <nav class="mt-6">
            <div class="space-y-2">
                <!-- Dashboard (ke menu appointment sebagai default) -->
                <a href="<?php echo e(route('terapis.appointments.index')); ?>" class="flex items-center px-4 py-3 hover:bg-gray-700 rounded-md <?php echo e(Request::routeIs('terapis.appointments.*') ? 'bg-blue-600' : ''); ?>">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    <span>Appointment</span>
                </a>

                <!-- Data Pasien -->
                <a href="<?php echo e(route('terapis.patients.index')); ?>" class="flex items-center px-4 py-3 hover:bg-gray-700 rounded-md <?php echo e(Request::routeIs('terapis.patients.*') ? 'bg-blue-600' : ''); ?>">
                    <i class="fas fa-user-injured mr-3"></i>
                    <span>Data Pasien</span>
                </a>
            </div>
        </nav>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle submenu visibility if needed in future
        const menuItems = document.querySelectorAll('.menu-item');
        
        menuItems.forEach(item => {
            const button = item.querySelector('button');
            if (!button) return;
            const content = item.querySelector('.menu-content');
            const icon = button.querySelector('.fas.fa-chevron-down');
            
            button.addEventListener('click', () => {
                content.classList.toggle('hidden');
                
                // Rotate icon when menu is open
                if (content.classList.contains('hidden')) {
                    icon.style.transform = 'rotate(0deg)';
                } else {
                    icon.style.transform = 'rotate(180deg)';
                }
            });
        });
    });
</script><?php /**PATH C:\xampp2\htdocs\klinik\resources\views/layouts/terapis/sidebar.blade.php ENDPATH**/ ?>