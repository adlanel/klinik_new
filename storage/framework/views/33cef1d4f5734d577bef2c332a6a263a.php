<footer class="bg-blue-900 text-white">
    <!-- Main Footer Content -->
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- About Column -->
            <div>
                <h3 class="text-xl font-bold mb-4 text-blue-200">Klinik Alfatih Center</h3>
                <p class="text-gray-300 mb-4">Pusat layanan tumbuh kembang anak dengan pendekatan profesional dan terpercaya untuk mendukung perkembangan optimal anak Anda.</p>
            </div>
            
            <!-- Contact Column -->
            <div>
                <h3 class="text-xl font-bold mb-4 text-blue-200">Hubungi Kami</h3>
                <div class="flex items-start mb-3">
                    <svg class="h-5 w-5 text-blue-300 mt-1 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <div>
                        <p class="text-gray-300">Jl. Contoh No. 123</p>
                        <p class="text-gray-300">Jakarta, Indonesia</p>
                    </div>
                </div>
                <div class="flex items-center mb-3">
                    <svg class="h-5 w-5 text-blue-300 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <p class="text-gray-300">(021) 1234-5678</p>
                </div>
                <div class="flex items-center mb-3">
                    <svg class="h-5 w-5 text-blue-300 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <p class="text-gray-300">info@alfatihcenter.com</p>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-xl font-bold mb-4 text-blue-200">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="<?php echo e(url('/')); ?>" class="text-gray-300 hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="<?php echo e(route('about.index')); ?>" class="text-gray-300 hover:text-white transition-colors">Tentang Kami</a></li>
                    <li><a href="<?php echo e(route('layanan-fasilitas.index')); ?>" class="text-gray-300 hover:text-white transition-colors">Layanan & Fasilitas</a></li>
                    <li><a href="<?php echo e(route('news.index')); ?>" class="text-gray-300 hover:text-white transition-colors">Berita & Artikel</a></li>
                    <li><a href="<?php echo e(route('cabang-kontak.index')); ?>" class="text-gray-300 hover:text-white transition-colors">Cabang & Kontak</a></li>
                    <li><a href="<?php echo e(route('appointment.index')); ?>" class="text-gray-300 hover:text-white transition-colors">Buat Janji</a></li>
                </ul>
            </div>
            
            <!-- Hours & Social -->
            <div>
                <h3 class="text-xl font-bold mb-4 text-blue-200">Jam Operasional</h3>
                <div class="mb-5">
                    <p class="text-gray-300">Senin - Jumat: 08.00 - 17.00</p>
                    <p class="text-gray-300">Sabtu: 08.00 - 15.00</p>
                    <p class="text-gray-300">Minggu: Tutup</p>
                </div>
                
                <h3 class="text-xl font-bold mb-4 text-blue-200">Media Sosial</h3>
                <div class="flex space-x-4">
                    <a href="https://www.instagram.com/alfatihcenter" target="_blank" class="text-gray-300 hover:text-white transition-colors" aria-label="Instagram">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                    </a>
                    <a href="https://wa.me/628123456789" target="_blank" class="text-gray-300 hover:text-white transition-colors" aria-label="WhatsApp">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/alfatihcenter" target="_blank" class="text-gray-300 hover:text-white transition-colors" aria-label="Facebook">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="https://www.youtube.com/alfatihcenter" target="_blank" class="text-gray-300 hover:text-white transition-colors" aria-label="YouTube">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Copyright -->
    <div class="bg-blue-950 py-4">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-gray-400">&copy; <?php echo e(date('Y')); ?> Klinik Alfatih Center. Hak Cipta Dilindungi.</p>
                <div class="mt-4 md:mt-0">
                    <a href="/privacy-policy" class="text-sm text-gray-400 hover:text-gray-300 mr-4">Kebijakan Privasi</a>
                    <a href="/terms-of-service" class="text-sm text-gray-400 hover:text-gray-300">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </div>
</footer><?php /**PATH C:\xampp2\htdocs\klinik\resources\views/components/footer.blade.php ENDPATH**/ ?>