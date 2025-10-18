

<?php $__env->startSection('title', 'Logo Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Logo</h1>
            <p class="text-gray-600 mt-1">Upload dan kelola logo website</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="<?php echo e(route('admin.content.logos.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus mr-2"></i>Upload Logo Baru
            </a>
        </div>
    </div>
    
    <!-- Flash message -->
    <?php if(session('success')): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p><?php echo e(session('success')); ?></p>
        </div>
    <?php endif; ?>
    
    <?php if(session('error')): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p><?php echo e(session('error')); ?></p>
        </div>
    <?php endif; ?>
    
    <!-- Current Active Logo -->
    <div class="bg-gray-50 p-6 rounded-lg border mb-8">
        <h2 class="text-lg font-semibold mb-4">Logo Aktif Saat Ini</h2>
        <?php if($currentLogo): ?>
            <div class="flex flex-col md:flex-row items-center">
                <div class="bg-white p-4 rounded-lg border flex items-center justify-center" style="max-width: 300px; height: 150px;">
                    <img src="<?php echo e($currentLogo->url); ?>" alt="Current Logo" class="max-h-full max-w-full object-contain">
                </div>
                <div class="mt-4 md:mt-0 md:ml-6 flex flex-col">
                    <p class="text-sm text-gray-500 mb-2">Diupload: <?php echo e($currentLogo->created_at->format('d M Y, H:i')); ?></p>
                    <p class="text-sm text-gray-500 mb-4">Nama file: <?php echo e($currentLogo->path); ?></p>
                </div>
            </div>
        <?php else: ?>
            <div class="text-gray-500">Belum ada logo yang diupload.</div>
        <?php endif; ?>
    </div>
    
    <!-- Instructions -->
    <div class="mb-8 bg-blue-50 p-4 rounded-lg text-blue-800">
        <h3 class="font-semibold mb-2">Informasi</h3>
        <p>Saat upload logo baru, logo lama akan otomatis diganti dengan yang baru.</p>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp2\htdocs\klinik\resources\views/admin/logos/index.blade.php ENDPATH**/ ?>