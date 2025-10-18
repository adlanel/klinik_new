

<?php $__env->startSection('title', 'Manajemen Cabang'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Cabang</h1>
            <p class="text-gray-600 mt-1">Tambah, edit, dan hapus data cabang klinik</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="<?php echo e(route('admin.content.branches.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus mr-2"></i>Tambah Cabang Baru
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
    
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 text-left">No</th>
                    <th class="py-3 px-4 text-left">Nama Cabang</th>
                    <th class="py-3 px-4 text-left">Alamat</th>
                    <th class="py-3 px-4 text-left">No. Telepon</th>
                    <th class="py-3 px-4 text-left">Maps</th>
                    <th class="py-3 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4"><?php echo e($branches->firstItem() + $index); ?></td>
                        <td class="py-3 px-4 font-medium"><?php echo e($branch->nama_cabang); ?></td>
                        <td class="py-3 px-4">
                            <div class="max-w-xs truncate"><?php echo e($branch->alamat); ?></div>
                        </td>
                        <td class="py-3 px-4"><?php echo e($branch->no_telp ?? '-'); ?></td>
                        <td class="py-3 px-4">
                            <?php if($branch->link_maps): ?>
                                <a href="<?php echo e($branch->link_maps); ?>" target="_blank" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                                    <i class="fas fa-map-marker-alt mr-1"></i> Lihat Maps
                                </a>
                            <?php else: ?>
                                <span class="text-gray-500">Tidak tersedia</span>
                            <?php endif; ?>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex space-x-2">
                                <a href="<?php echo e(route('admin.content.branches.edit', $branch->id)); ?>" class="text-blue-600 hover:text-blue-900" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('admin.content.branches.destroy', $branch->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus cabang ini?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="py-6 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-map-marked-alt text-4xl mb-3 text-gray-400"></i>
                                <p class="text-lg">Belum ada data cabang</p>
                                <p class="text-sm mt-1">Klik tombol "Tambah Cabang Baru" untuk menambahkan cabang</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        <?php echo e($branches->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\klinik\resources\views/admin/branches/index.blade.php ENDPATH**/ ?>