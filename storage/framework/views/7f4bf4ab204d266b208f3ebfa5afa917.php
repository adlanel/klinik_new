

<?php $__env->startSection('title', 'Berita & Artikel - Al-Fatih Center'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50">
    <!-- Hero Section -->
    <div class="relative pt-16 pb-10 md:pt-24 md:pb-16 bg-gradient-to-b from-blue-900 to-blue-800">
        <div class="container mx-auto px-6 max-w-5xl relative z-10">
            <div class="text-center text-white py-12">
                <h1 class="text-3xl md:text-5xl font-bold mb-6">Berita & Artikel</h1>
                <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto">
                    Temukan informasi terkini seputar kesehatan anak, tips parenting, dan kegiatan di Al-Fatih Center
                </p>
            </div>
        </div>
        
        <!-- Background pattern -->
        <div class="absolute inset-0 z-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(#ffffff 1px, transparent 2px); background-size: 20px 20px;"></div>
        </div>
        
        <!-- Bottom wave -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full">
                <path fill="#f9fafb" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,234.7C672,235,768,213,864,197.3C960,181,1056,171,1152,165.3C1248,160,1344,160,1392,160L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </div>
    
    <!-- News Grid Section -->
    <div class="container mx-auto px-6 py-12 md:py-20 max-w-6xl">
        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newsItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="group bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                <!-- News Image -->
                <div class="relative h-56 overflow-hidden">
                    <!-- Category label -->
                    <div class="absolute top-4 left-4 z-10">
                        <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1.5 rounded-full">Artikel</span>
                    </div>
                    
                    <img 
                        src="<?php echo e(asset('storage/homepage/news/' . $newsItem->image)); ?>" 
                        alt="<?php echo e($newsItem->title); ?>" 
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                        onerror="this.src='https://via.placeholder.com/600x400/e2f1ff/2563eb?text=<?php echo e(urlencode($newsItem->title)); ?>'"
                    >
                    <div class="absolute inset-0 bg-gradient-to-b from-gray-900/0 via-gray-900/20 to-gray-900/60 group-hover:opacity-90 transition-opacity"></div>
                </div>
                
                <!-- News Content -->
                <div class="p-6">
                    <!-- Meta info -->
                    <div class="flex items-center mb-3 text-sm text-gray-500">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <?php echo e($newsItem->formatted_date); ?>

                        </span>
                        <span class="mx-2">•</span>
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <?php echo e($newsItem->author); ?>

                        </span>
                    </div>
                    
                    <h3 class="font-bold text-xl mb-3 text-gray-800 group-hover:text-blue-600 transition-colors line-clamp-2"><?php echo e($newsItem->title); ?></h3>
                    
                    <p class="text-gray-600 mb-5 line-clamp-3"><?php echo e($newsItem->short_description); ?></p>
                    
                    <div class="flex items-center justify-between">
                        <a 
                            href="<?php echo e(route('news.show', $newsItem->slug)); ?>" 
                            class="inline-flex items-center px-4 py-2 bg-gray-100 text-blue-700 rounded-lg font-medium group-hover:bg-blue-600 group-hover:text-white transition-all duration-300"
                        >
                            <span>Baca Selengkapnya</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <!-- Pagination -->
        <div class="mt-12">
            <?php echo e($news->links()); ?>

        </div>
    </div>
    

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\klinik\resources\views/pages/news-index.blade.php ENDPATH**/ ?>