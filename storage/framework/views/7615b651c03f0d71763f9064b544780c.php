<?php $__env->startSection('title', 'Kelola User'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola User</h1>
            <p class="text-gray-600 mt-1">Kelola data pengguna sistem</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="<?php echo e(route('admin.users.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus mr-2"></i>Tambah User Baru
            </a>
        </div>
    </div>
    
    <!-- Search and Filter -->
    <div class="bg-gray-50 p-4 rounded-lg border mb-6">
        <form action="<?php echo e(route('admin.users.index')); ?>" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari User</label>
                <input type="text" name="search" id="search" placeholder="Nama/Email" 
                    value="<?php echo e(request('search')); ?>" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                <select name="role" id="role" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="all" <?php echo e(request('role') == 'all' ? 'selected' : ''); ?>>Semua Role</option>
                    <option value="admin" <?php echo e(request('role') == 'admin' ? 'selected' : ''); ?>>Admin</option>
                    <option value="terapis" <?php echo e(request('role') == 'terapis' ? 'selected' : ''); ?>>Terapis</option>
                    <option value="kepala_terapis" <?php echo e(request('role') == 'kepala_terapis' ? 'selected' : ''); ?>>Kepala Terapis</option>
                </select>
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                <a href="<?php echo e(route('admin.users.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded ml-2">
                    Reset
                </a>
            </div>
        </form>
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
    
    <!-- Users Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pendidikan</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bidang</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terdaftar Sejak</th>
                    <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900"><?php echo e($user->name); ?></div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?php echo e($user->email); ?></div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?php echo e($user->phone ?: '-'); ?></div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                <?php echo e($user->role == 'admin' ? 'bg-purple-100 text-purple-800' : 
                                  ($user->role == 'kepala_terapis' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800')); ?>">
                                <?php echo e(ucfirst(str_replace('_', ' ', $user->role))); ?>

                            </span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?php echo e($user->pendidikan ?: '-'); ?></div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?php echo e($user->bidang ?: '-'); ?></div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?php echo e($user->created_at ? $user->created_at->format('d M Y, H:i') : 'N/A'); ?></div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="text-green-600 hover:text-green-900">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?php echo e(route('admin.users.change-password', $user->id)); ?>" class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-key"></i>
                                </a>
                                <?php if($user->id !== Auth::id()): ?>
                                    <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                            Tidak ada data user yang ditemukan.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="mt-4">
        <?php echo e($users->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp2\htdocs\klinik\resources\views/admin/users/index.blade.php ENDPATH**/ ?>