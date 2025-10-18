<nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <?php if($currentLogo): ?>
                    <img src="<?php echo e(asset('storage/logo/' . $currentLogo->path)); ?>" 
                         alt="Logo Klinik" 
                         class="h-16 w-auto mr-4">
                <?php else: ?>
                    <div class="h-16 w-16 bg-blue-500 rounded mr-4 flex items-center justify-center">
                        <span class="text-white font-bold text-2xl">K</span>
                    </div>
                <?php endif; ?>

            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-6">
                    <a href="<?php echo e(url('/')); ?>" 
                       class="text-gray-700 hover:text-blue-600 px-4 py-3 rounded-md text-lg font-medium transition-colors">
                        Beranda
                    </a>
                    <a href="<?php echo e(route('about.index')); ?>" 
                       class="text-gray-700 hover:text-blue-600 px-4 py-3 rounded-md text-lg font-medium transition-colors">
                        Tentang Kami
                    </a>
                    <a href="<?php echo e(route('layanan-fasilitas.index')); ?>" 
                       class="text-gray-700 hover:text-blue-600 px-4 py-3 rounded-md text-lg font-medium transition-colors">
                        Layanan & Fasilitas
                    </a>
                    <a href="<?php echo e(route('news.index')); ?>" 
                       class="text-gray-700 hover:text-blue-600 px-4 py-3 rounded-md text-lg font-medium transition-colors">
                        Berita & Artikel
                    </a>
                    <a href="<?php echo e(route('cabang-kontak.index')); ?>" 
                       class="text-gray-700 hover:text-blue-600 px-4 py-3 rounded-md text-lg font-medium transition-colors">
                        Cabang & Kontak
                    </a>
                    <a href="<?php echo e(route('appointment.index')); ?>" 
                       class="bg-blue-600 text-white hover:bg-blue-700 px-6 py-3 rounded-md text-lg font-medium transition-colors">
                        Buat Janji
                    </a>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" 
                        class="mobile-menu-button bg-gray-50 inline-flex items-center justify-center p-3 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden mobile-menu hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-gray-50">
            <a href="<?php echo e(url('/')); ?>" 
               class="text-gray-700 hover:text-blue-600 block px-4 py-3 rounded-md text-lg font-medium transition-colors">
                Beranda
            </a>
            <a href="<?php echo e(route('about.index')); ?>" 
               class="text-gray-700 hover:text-blue-600 block px-4 py-3 rounded-md text-lg font-medium transition-colors">
                Tentang Kami
            </a>
            <a href="<?php echo e(route('layanan-fasilitas.index')); ?>" 
               class="text-gray-700 hover:text-blue-600 block px-4 py-3 rounded-md text-lg font-medium transition-colors">
                Layanan & Fasilitas
            </a>
            <a href="<?php echo e(route('news.index')); ?>" 
               class="text-gray-700 hover:text-blue-600 block px-4 py-3 rounded-md text-lg font-medium transition-colors">
                Berita & Artikel
            </a>
            <a href="<?php echo e(route('cabang-kontak.index')); ?>" 
               class="text-gray-700 hover:text-blue-600 block px-4 py-3 rounded-md text-lg font-medium transition-colors">
                Cabang & Kontak
            </a>
            <a href="<?php echo e(route('appointment.index')); ?>" 
               class="bg-blue-600 text-white hover:bg-blue-700 block px-4 py-3 rounded-md text-lg font-medium transition-colors">
                Buat Janji
            </a>
        </div>
    </div>
</nav>

<script>
// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            console.log('Mobile menu toggled');
        });
    } else {
        console.error('Mobile menu button or mobile menu not found');
    }
    
    // Handle smooth scrolling to consultation form when coming from other pages
    if (window.location.hash === '#consultation-form') {
        const consultationForm = document.querySelector('#consultation-form');
        if (consultationForm) {
            setTimeout(() => {
                consultationForm.scrollIntoView({ behavior: 'smooth' });
            }, 300);
        }
    }
    
    // Smooth scroll untuk tombol "Buat Janji"
    const appointmentLinks = document.querySelectorAll('a[href="#consultation-form"]');
    appointmentLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const consultationForm = document.getElementById('consultation-form');
            if (consultationForm) {
                consultationForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
                // Tutup mobile menu jika terbuka
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            }
        });
    });
});
</script>
<?php /**PATH C:\xampp\htdocs\klinik\resources\views/components/navbar.blade.php ENDPATH**/ ?>