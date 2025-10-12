<div id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-gray-800 text-white sidebar transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-30 md:relative">
    <div class="px-4 py-6">
        <div class="md:hidden absolute right-4 top-4">
            <button id="close-sidebar" class="text-white hover:text-gray-300">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="flex items-center justify-center pb-6 border-b border-gray-700">
            <h2 class="text-xl font-semibold">Admin Panel</h2>
        </div>
        
        <nav class="mt-6">
            <div class="space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 hover:bg-gray-700 rounded-md {{ Request::routeIs('admin.dashboard') ? 'bg-blue-600' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    <span>Dashboard</span>
                </a>
                
                <!-- Content -->
                <div class="menu-item">
                    <button class="w-full flex items-center justify-between px-4 py-3 hover:bg-gray-700 rounded-md transition focus:outline-none">
                        <div class="flex items-center">
                            <i class="fas fa-file-alt mr-3"></i>
                            <span>Web Content</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div class="menu-content hidden pl-10 space-y-1 mt-1">
                        <a href="{{ route('admin.content.logos.index') }}" class="block py-2 px-4 hover:text-blue-400 rounded-md {{ Request::routeIs('admin.content.logos.*') ? 'text-blue-400' : '' }}">Logo</a>
                        <a href="{{ route('admin.content.banners.index') }}" class="block py-2 px-4 hover:text-blue-400 rounded-md {{ Request::routeIs('admin.content.banners.*') ? 'text-blue-400' : '' }}">Banner</a>
                        <a href="{{ route('admin.content.aboutus.index') }}" class="block py-2 px-4 hover:text-blue-400 rounded-md {{ Request::routeIs('admin.content.aboutus.*') ? 'text-blue-400' : '' }}">Tentang Kami</a>
                        <a href="{{ route('admin.content.layanan.index') }}" class="block py-2 px-4 hover:text-blue-400 rounded-md {{ Request::routeIs('admin.content.layanan.*') ? 'text-blue-400' : '' }}">Layanan Kami</a>                    
                        <a href="{{ route('admin.content.fasilitas.index') }}" class="block py-2 px-4 hover:text-blue-400 rounded-md {{ Request::routeIs('admin.content.fasilitas.*') ? 'text-blue-400' : '' }}">Fasilitas Kami</a>
                        <a href="{{ route('admin.content.news.index') }}" class="block py-2 px-4 hover:text-blue-400 rounded-md {{ Request::routeIs('admin.content.news.*') ? 'text-blue-400' : '' }}">Berita & Artikel</a>
                        <a href="{{ route('admin.content.branches.index') }}" class="block py-2 px-4 hover:text-blue-400 rounded-md {{ Request::routeIs('admin.content.branches.*') ? 'text-blue-400' : '' }}">Cabang</a>
                    </div>
                </div>

                <!-- Appointment -->
                <a href="{{ route('admin.appointments.index') }}" class="flex items-center px-4 py-3 hover:bg-gray-700 rounded-md {{ Request::routeIs('admin.appointments.*') ? 'bg-blue-600' : '' }}">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    <span>Appointment</span>
                </a>
                
                <!-- Data Pasien -->
                <a href="{{ route('admin.patients.index') }}" class="flex items-center px-4 py-3 hover:bg-gray-700 rounded-md {{ Request::routeIs('admin.patients.*') ? 'bg-blue-600' : '' }}">
                    <i class="fas fa-user-injured mr-3"></i>
                    <span>Data Pasien</span>
                </a>

                <!-- Manage User -->
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 hover:bg-gray-700 rounded-md {{ Request::routeIs('admin.users.*') ? 'bg-blue-600' : '' }}">
                    <i class="fas fa-users-cog mr-3"></i>
                    <span>Kelola User</span>
                </a>
     
               
            </div>
        </nav>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle submenu visibility
        const menuItems = document.querySelectorAll('.menu-item');
        
        menuItems.forEach(item => {
            const button = item.querySelector('button');
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
</script>