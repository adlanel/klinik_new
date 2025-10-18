

<?php $__env->startSection('title', 'Banner Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Banner</h1>
            <p class="text-gray-600 mt-1">Upload dan kelola banner slider website</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="<?php echo e(route('admin.content.banners.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus mr-2"></i>Tambah Banner Baru
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
    
    <!-- Information Card -->
    <div class="mb-8 bg-blue-50 p-4 rounded-lg text-blue-800">
        <h3 class="font-semibold mb-2">Informasi</h3>
        <ul class="list-disc pl-5 space-y-1">
            <li>Banner akan ditampilkan berdasarkan urutan (order number)</li>
            <li>Setiap banner memiliki gambar desktop (layar besar) dan mobile (layar kecil)</li>
            <li>Format yang didukung: PNG, JPG, GIF, WEBP hingga 2MB</li>
        </ul>
    </div>
    
    <!-- Banners List -->
    <?php if($banners->count() > 0): ?>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-50 text-gray-600 uppercase">
                    <tr>
                        <th class="px-6 py-3">Urutan</th>
                        <th class="px-6 py-3">Preview Desktop</th>
                        <th class="px-6 py-3">Preview Mobile</th>
                        <th class="px-6 py-3">Tanggal Upload</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody id="banners-tbody" class="divide-y">
                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="bg-white hover:bg-gray-50" data-id="<?php echo e($banner->id); ?>">
                            <td class="px-6 py-4 font-medium">
                                <div class="flex items-center">
                                    <span class="mr-2"><?php echo e($banner->order_number); ?></span>
                                    <div class="cursor-move handle">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M5 8h10M5 12h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="h-16 w-32 relative">
                                    <img src="<?php echo e($banner->desktop_image_url); ?>" alt="Banner Desktop <?php echo e($banner->id); ?>" class="h-full w-full object-cover rounded">
                                    <span class="absolute bottom-0 right-0 bg-gray-800 text-white text-xs px-1 rounded-tl">Desktop</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="h-16 w-12 relative">
                                    <img src="<?php echo e($banner->mobile_image_url); ?>" alt="Banner Mobile <?php echo e($banner->id); ?>" class="h-full w-full object-cover rounded">
                                    <span class="absolute bottom-0 right-0 bg-gray-800 text-white text-xs px-1 rounded-tl">Mobile</span>
                                </div>
                            </td>
                            <td class="px-6 py-4"><?php echo e(\Carbon\Carbon::parse($banner->created_at)->format('d M Y, H:i')); ?></td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="<?php echo e(route('admin.content.banners.edit', $banner->id)); ?>" class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form class="inline-block" action="<?php echo e(route('admin.content.banners.destroy', $banner->id)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus banner ini?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    
        <!-- Pagination -->
        <div class="mt-6">
            <?php echo e($banners->links()); ?>

        </div>
    <?php else: ?>
        <div class="text-center py-8 text-gray-500">
            Belum ada banner yang diupload.
        </div>
    <?php endif; ?>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.13.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tbody = document.getElementById('banners-tbody');
        
        if (tbody) {
            new Sortable(tbody, {
                handle: '.handle',
                animation: 150,
                onEnd: function() {
                    updateBannerOrder();
                }
            });
        }
        
        function updateBannerOrder() {
            const rows = document.querySelectorAll('#banners-tbody tr');
            const bannerIds = Array.from(rows).map(row => row.getAttribute('data-id'));
            
            fetch('<?php echo e(route('admin.content.banners.update-order')); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({ banner_ids: bannerIds })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show a success message or update UI
                    const successMessage = document.createElement('div');
                    successMessage.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50';
                    successMessage.textContent = 'Urutan banner berhasil diperbarui';
                    document.body.appendChild(successMessage);
                    
                    // Remove the message after 3 seconds
                    setTimeout(() => {
                        successMessage.remove();
                    }, 3000);
                    
                    // Refresh the page to show the updated order numbers
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\klinik\resources\views/admin/banners/index.blade.php ENDPATH**/ ?>